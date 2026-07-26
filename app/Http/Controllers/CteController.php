<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\BusinessLocation;
use App\Models\Cte;
use App\Models\ComponenteCte;
use App\Models\MedidaCte;
use App\Models\Contact;
use App\Models\Veiculo;
use App\Models\NaturezaOperacao;
use App\Models\City;
use App\Services\CTeService;
use NFePHP\DA\CTe\Dacte;
use NFePHP\DA\CTe\Daevento;
use Yajra\DataTables\Facades\DataTables;

class CteController extends Controller
{

	public function index()
	{
		$business_id = request()->session()->get('user.business_id');

		if (request()->ajax()) {
			$ctes = Cte::where('business_id', $business_id)
				->with(['remetente', 'destinatario'])
				->select([
					'id', 'remetente_id', 'destinatario_id', 'valor_transporte',
					'valor_receber', 'valor_carga', 'produto_predominante',
					'data_previsata_entrega', 'estado'
				]);

			return Datatables::of($ctes)
				->addColumn('remetente', function ($row) {
					return optional($row->remetente)->name;
				})
				->addColumn('destinatario', function ($row) {
					return optional($row->destinatario)->name;
				})
				->editColumn('data_previsata_entrega', function ($row) {
					return $row->data_previsata_entrega ?
						\Carbon\Carbon::parse($row->data_previsata_entrega)->format('d/m/Y') : '';
				})
				->addColumn('action', function ($row) {
					$html = '<a href="/cte/ver/' . $row->id . '" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> Ver</a>&nbsp;';

					if ($row->estado != 'APROVADO' && $row->estado != 'CANCELADO') {
						$html .= '<a href="/cte/edit/' . $row->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> @lang(\'messages.edit\')</a>&nbsp;';
						$html .= '<a href="/cte/gerar/' . $row->id . '" class="btn btn-xs btn-success"><i class="fa fa-file"></i> Emitir</a>&nbsp;';
						$html .= '<a href="/cte/delete/' . $row->id . '" class="btn btn-xs btn-danger delete_user_button"><i class="glyphicon glyphicon-trash"></i> @lang(\'messages.delete\')</a>';
					}

					return $html;
				})
				->rawColumns(['action'])
				->make(true);
		}

		return view('cte.list');
	}

	public function new()
	{
		$business_id = request()->session()->get('user.business_id');

		$lastCte = Cte::lastCTeAux($business_id);

		$naturezas = $this->prepareNaturezas($business_id);
		$clientes = Contact::contactDropdown($business_id, false, true, false);
		$clientesAux = Contact::where('business_id', $business_id)
			->with('cidade')
			->get(['id', 'name', 'cpf_cnpj', 'ie_rg', 'rua', 'numero', 'bairro', 'cep', 'city_id']);
		$veiculos = $this->prepareVeiculos($business_id);
		$cidades = $this->prepareCidades();
		$tiposTomador = Cte::tiposTomador();
		$modals = Cte::modals();
		$unidadesMedida = Cte::unidadesMedida();
		$tiposMedida = Cte::tiposMedida();

		$business_locations = BusinessLocation::forDropdown($business_id, false, true);
		$bl_attributes = $business_locations['attributes'];
		$business_locations = $business_locations['locations'];

		$default_location = null;
		if (count($business_locations) == 1) {
			foreach ($business_locations as $id => $name) {
				$default_location = BusinessLocation::findOrFail($id);
			}
		}

		$form_partials = [];

		return view('cte.register')
			->with(compact(
				'lastCte', 'naturezas', 'clientes', 'clientesAux', 'veiculos', 'cidades',
				'tiposTomador', 'modals', 'unidadesMedida', 'tiposMedida',
				'business_locations', 'bl_attributes', 'default_location', 'form_partials'
			));
	}

	public function save(Request $request)
	{
		$business_id = request()->session()->get('user.business_id');

		try {
			$data = $request->only([
				'natureza_id', 'globalizado', 'cst', 'perc_icms', 'remetente_id', 'destinatario_id',
				'veiculo_id', 'tomador', 'valor_carga', 'retira', 'detalhes_retira',
				'valor_transporte', 'valor_receber', 'tpDoc', 'descOutros', 'nDoc', 'vDocFisc'
			]);

			$data['business_id'] = $business_id;
			$data['usuario_id'] = request()->session()->get('user.id');
			$data['modal'] = $request->modal_transp;
			$data['produto_predominante'] = $request->prod_predominante;
			$data['observacao'] = $request->obs;
			$data['data_previsata_entrega'] = $this->convertData($request->data_prevista_entrega);
			$data['logradouro_tomador'] = $request->rua_tomador;
			$data['numero_tomador'] = $request->numero_tomador;
			$data['bairro_tomador'] = $request->bairro_tomador;
			$data['cep_tomador'] = $request->cep_tomador;
			$data['municipio_tomador'] = $request->cidade_tomador;
			$data['municipio_envio'] = $request->cidade_envio;
			$data['municipio_inicio'] = $request->cidade_inicio;
			$data['municipio_fim'] = $request->cidade_fim;
			// NOTA: o model Cte só guarda uma única "chave_nfe" (varchar). Quando o
			// formulario informa mais de uma chave de NFe vinculada, elas sao
			// concatenadas por virgula e o service se encarrega de separá-las
			// novamente ao montar a tag <infNFe> (uma por chave).
			$data['chave_nfe'] = $request->chaves_nfe ? trim($request->chaves_nfe, ', ') : $request->chave_nfe;
			$data['estado'] = 'NOVO';
			$data['sequencia_cce'] = 0;
			$data['cte_numero'] = 0;
			$data['location_id'] = $this->resolveLocationId($request, $business_id);

			$cte = Cte::create($data);

			$this->salvarMedidas($cte, $request->medidas);
			$this->salvarComponentes($cte, $request->componentes);

			return redirect('/cte')->with('status', [
				'success' => 1,
				'msg' => 'CT-e salvo com sucesso!'
			]);
		} catch (\Exception $e) {
			\Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

			return redirect()->back()->with('status', [
				'success' => 0,
				'msg' => __('messages.something_went_wrong')
			]);
		}
	}

	public function edit($id)
	{
		$business_id = request()->session()->get('user.business_id');

		$cte = Cte::where('business_id', $business_id)
			->with(['componentes', 'medidas'])
			->find($id);

		if (!$cte) {
			abort(403, 'Unauthorized action.');
		}

		$lastCte = Cte::lastCTeAux($business_id);

		$naturezas = $this->prepareNaturezas($business_id);
		$clientes = Contact::contactDropdown($business_id, false, true, false);
		$clientesAux = Contact::where('business_id', $business_id)
			->with('cidade')
			->get(['id', 'name', 'cpf_cnpj', 'ie_rg', 'rua', 'numero', 'bairro', 'cep', 'city_id']);
		$veiculos = $this->prepareVeiculos($business_id);
		$cidades = $this->prepareCidades();
		$tiposTomador = Cte::tiposTomador();
		$modals = Cte::modals();
		$unidadesMedida = Cte::unidadesMedida();
		$tiposMedida = Cte::tiposMedida();

		$business_locations = BusinessLocation::forDropdown($business_id, false, true);
		$bl_attributes = $business_locations['attributes'];
		$business_locations = $business_locations['locations'];

		$default_location = null;
		if (count($business_locations) == 1) {
			foreach ($business_locations as $id2 => $name) {
				$default_location = BusinessLocation::findOrFail($id2);
			}
		}

		$form_partials = [];

		return view('cte.edit')
			->with(compact(
				'cte', 'lastCte', 'naturezas', 'clientes', 'clientesAux', 'veiculos', 'cidades',
				'tiposTomador', 'modals', 'unidadesMedida', 'tiposMedida',
				'business_locations', 'bl_attributes', 'default_location', 'form_partials'
			));
	}

	public function update(Request $request)
	{
		$business_id = request()->session()->get('user.business_id');

		try {
			$cte = Cte::where('business_id', $business_id)->find($request->id);

			if (!$cte) {
				abort(403, 'Unauthorized action.');
			}

			$data = $request->only([
				'natureza_id', 'globalizado', 'cst', 'perc_icms', 'remetente_id', 'destinatario_id',
				'veiculo_id', 'tomador', 'valor_carga', 'retira', 'detalhes_retira',
				'valor_transporte', 'valor_receber', 'tpDoc', 'descOutros', 'nDoc', 'vDocFisc'
			]);

			$data['modal'] = $request->modal_transp;
			$data['produto_predominante'] = $request->prod_predominante;
			$data['observacao'] = $request->obs;
			$data['data_previsata_entrega'] = $this->convertData($request->data_prevista_entrega);
			$data['logradouro_tomador'] = $request->rua_tomador;
			$data['numero_tomador'] = $request->numero_tomador;
			$data['bairro_tomador'] = $request->bairro_tomador;
			$data['cep_tomador'] = $request->cep_tomador;
			$data['municipio_tomador'] = $request->cidade_tomador;
			$data['municipio_envio'] = $request->cidade_envio;
			$data['municipio_inicio'] = $request->cidade_inicio;
			$data['municipio_fim'] = $request->cidade_fim;
			$data['chave_nfe'] = $request->chaves_nfe ? trim($request->chaves_nfe, ', ') : $request->chave_nfe;
			$data['location_id'] = $this->resolveLocationId($request, $business_id);

			$cte->update($data);

			ComponenteCte::where('cte_id', $cte->id)->delete();
			MedidaCte::where('cte_id', $cte->id)->delete();

			$this->salvarMedidas($cte, $request->medidas);
			$this->salvarComponentes($cte, $request->componentes);

			return redirect('/cte')->with('status', [
				'success' => 1,
				'msg' => 'CT-e atualizado com sucesso!'
			]);
		} catch (\Exception $e) {
			\Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

			return redirect()->back()->with('status', [
				'success' => 0,
				'msg' => __('messages.something_went_wrong')
			]);
		}
	}

	public function delete($id)
	{
		$business_id = request()->session()->get('user.business_id');

		try {
			$cte = Cte::where('business_id', $business_id)->where('id', $id)->first();

			if (!$cte) {
				abort(403, 'Unauthorized action.');
			}

			ComponenteCte::where('cte_id', $cte->id)->delete();
			MedidaCte::where('cte_id', $cte->id)->delete();
			$cte->delete();

			return redirect('/cte')->with('status', [
				'success' => 1,
				'msg' => 'Registro removido'
			]);
		} catch (\Exception $e) {
			\Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

			return redirect('/cte')->with('status', [
				'success' => 0,
				'msg' => __('messages.something_went_wrong')
			]);
		}
	}

	public function gerar($id)
	{
		$business_id = request()->session()->get('user.business_id');
		$cte = Cte::where('business_id', $business_id)->find($id);

		if (!$cte) {
			abort(403, 'Unauthorized action.');
		}

		return view('cte.gerar')->with(compact('cte'));
	}

	public function renderizar($id)
	{
		$business_id = request()->session()->get('user.business_id');
		$cte = Cte::where('business_id', $business_id)
			->with(['componentes', 'medidas', 'remetente', 'destinatario', 'veiculo', 'natureza'])
			->find($id);

		if (!$cte) {
			abort(403, 'Unauthorized action.');
		}

		$config = Business::getConfigCte($business_id, $cte);

		$logo = '';
		if ($config->logo) {
			$logo = public_path('uploads/business_logos/') . $config->logo;
		}

		$cte_service = new CTeService($this->cteServiceConfig($config), $config);

		$gerado = $cte_service->gerarCTe($cte);

		if (isset($gerado['xml_erros'])) {
			$erros = $gerado['xml_erros'];
			return view('nfe.erros')->with(compact('erros'));
		}

		try {
			$dacte = new Dacte($gerado['xml']);
			$pdf = $dacte->render($logo);

			return response($pdf)->header('Content-Type', 'application/pdf');
		} catch (\Exception $e) {
			echo "Ocorreu um erro durante o processamento :" . $e->getMessage();
		}
	}

	public function gerarXml($id)
	{
		$business_id = request()->session()->get('user.business_id');
		$cte = Cte::where('business_id', $business_id)
			->with(['componentes', 'medidas', 'remetente', 'destinatario', 'veiculo', 'natureza'])
			->find($id);

		if (!$cte) {
			abort(403, 'Unauthorized action.');
		}

		$config = Business::getConfigCte($business_id, $cte);

		$cte_service = new CTeService($this->cteServiceConfig($config), $config);

		$gerado = $cte_service->gerarCTe($cte);

		if (!isset($gerado['xml_erros'])) {
			return response($gerado['xml'])->header('Content-Type', 'application/xml');
		} else {
			foreach ($gerado['xml_erros'] as $e) {
				echo $e . "<br>";
			}
		}
	}

	public function transmitir(Request $request)
	{
		$business_id = request()->session()->get('user.business_id');
		$cte = Cte::where('business_id', $business_id)
			->with(['componentes', 'medidas', 'remetente', 'destinatario', 'veiculo', 'natureza'])
			->find($request->id);

		if (!$cte) {
			return response()->json('erro', 403);
		}

		$config = Business::getConfigCte($business_id, $cte);
		$cnpj = $this->normalizaCnpj($config->cnpj);

		$cte_service = new CTeService($this->cteServiceConfig($config), $config);

		if ($cte->estado == 'REJEITADO' || $cte->estado == 'NOVO' || $cte->estado == null) {
			$gerado = $cte_service->gerarCTe($cte);

			if (!isset($gerado['xml_erros'])) {
				$signed = $cte_service->sign($gerado['xml']);
				$resultado = $cte_service->transmitir($signed, $gerado['chave'], $cnpj);

				if (isset($resultado['successo'])) {
					$cte->chave = $gerado['chave'];
					$cte->cte_numero = $gerado['nCT'];
					$cte->estado = 'APROVADO';
					$cte->save();

					return response()->json($resultado, 200);
				} else {
					$cte->estado = 'REJEITADO';
					$cte->save();

					if (isset($resultado['protocolo'])) {
						return response()->json($resultado['protocolo'], $resultado['status']);
					} else {
						return response()->json($resultado, 404);
					}
				}
			} else {
				return response()->json($gerado['xml_erros'][0], 407);
			}
		} else {
			return response()->json("Este CT-e já esta aprovado", 403);
		}
	}

	public function ver($id)
	{
		$business_id = request()->session()->get('user.business_id');
		$cte = Cte::where('business_id', $business_id)
			->with(['remetente', 'destinatario', 'natureza'])
			->find($id);

		if (!$cte) {
			abort(403, 'Unauthorized action.');
		}

		return view('cte.ver')->with(compact('cte'));
	}

	public function baixarXml($id)
	{
		$business_id = request()->session()->get('user.business_id');
		$cte = Cte::where('business_id', $business_id)->find($id);

		if (!$cte) {
			abort(403, 'Unauthorized action.');
		}

		$config = Business::getConfigCte($business_id, $cte);
		$cnpj = $this->normalizaCnpj($config->cnpj);

		if (file_exists(public_path('xml_cte/' . $cnpj . '/' . $cte->chave . '.xml'))) {
			return response()->download(public_path('xml_cte/' . $cnpj . '/' . $cte->chave . '.xml'));
		} else {
			return redirect()->back()->with('status', [
				'success' => 0,
				'msg' => 'Arquivo não encontrado!!'
			]);
		}
	}

	public function baixarXmlCancelado($id)
	{
		$business_id = request()->session()->get('user.business_id');
		$cte = Cte::where('business_id', $business_id)->find($id);

		if (!$cte) {
			abort(403, 'Unauthorized action.');
		}

		$config = Business::getConfigCte($business_id, $cte);
		$cnpj = $this->normalizaCnpj($config->cnpj);

		if (file_exists(public_path('xml_cte_cancelado/' . $cnpj . '/' . $cte->chave . '.xml'))) {
			return response()->download(public_path('xml_cte_cancelado/' . $cnpj . '/' . $cte->chave . '.xml'));
		} else {
			return redirect()->back()->with('status', [
				'success' => 0,
				'msg' => 'Arquivo não encontrado!!'
			]);
		}
	}

	public function imprimir($id)
	{
		$business_id = request()->session()->get('user.business_id');
		$cte = Cte::where('business_id', $business_id)->find($id);

		if (!$cte) {
			abort(403, 'Unauthorized action.');
		}

		$config = Business::getConfigCte($business_id, $cte);
		$cnpj = $this->normalizaCnpj($config->cnpj);

		$logo = '';
		if ($config->logo) {
			$logo = public_path('uploads/business_logos/') . $config->logo;
		}

		try {
			if (file_exists(public_path('xml_cte/' . $cnpj . '/' . $cte->chave . '.xml'))) {
				$xml = file_get_contents(public_path('xml_cte/' . $cnpj . '/' . $cte->chave . '.xml'));

				$dacte = new Dacte($xml);
				$pdf = $dacte->render($logo);

				return response($pdf)->header('Content-Type', 'application/pdf');
			} else {
				return redirect('/cte')->with('status', [
					'success' => 0,
					'msg' => 'Arquivo não encontrado!!'
				]);
			}
		} catch (\Exception $e) {
			echo "Ocorreu um erro durante o processamento :" . $e->getMessage();
		}
	}

	public function imprimirCancelamento($id)
	{
		$business_id = request()->session()->get('user.business_id');
		$cte = Cte::where('business_id', $business_id)->find($id);

		if (!$cte) {
			abort(403, 'Unauthorized action.');
		}

		$config = Business::getConfigCte($business_id, $cte);
		$cnpj = $this->normalizaCnpj($config->cnpj);

		$logo = '';
		if ($config->logo) {
			$logo = 'data://text/plain;base64,' . base64_encode(file_get_contents(
				public_path('uploads/business_logos/' . $config->logo)
			));
		}

		try {
			if (file_exists(public_path('xml_cte_cancelado/' . $cnpj . '/' . $cte->chave . '.xml'))) {
				$xml = file_get_contents(public_path('xml_cte_cancelado/' . $cnpj . '/' . $cte->chave . '.xml'));

				$dadosEmitente = $this->getEmitente($config);

				$daevento = new Daevento($xml, $dadosEmitente);
				$pdf = $daevento->render($logo);

				return response($pdf)->header('Content-Type', 'application/pdf');
			} else {
				return redirect('/cte')->with('status', [
					'success' => 0,
					'msg' => 'Arquivo não encontrado!!'
				]);
			}
		} catch (\Exception $e) {
			echo "Ocorreu um erro durante o processamento :" . $e->getMessage();
		}
	}

	public function imprimirCorrecao($id)
	{
		$business_id = request()->session()->get('user.business_id');
		$cte = Cte::where('business_id', $business_id)->find($id);

		if (!$cte) {
			abort(403, 'Unauthorized action.');
		}

		$config = Business::getConfigCte($business_id, $cte);
		$cnpj = $this->normalizaCnpj($config->cnpj);

		$logo = '';
		if ($config->logo) {
			$logo = 'data://text/plain;base64,' . base64_encode(file_get_contents(
				public_path('uploads/business_logos/' . $config->logo)
			));
		}

		try {
			if (file_exists(public_path('xml_cte_correcao/' . $cnpj . '/' . $cte->chave . '.xml'))) {
				$xml = file_get_contents(public_path('xml_cte_correcao/' . $cnpj . '/' . $cte->chave . '.xml'));

				$dadosEmitente = $this->getEmitente($config);

				$daevento = new Daevento($xml, $dadosEmitente);
				$pdf = $daevento->render($logo);

				return response($pdf)->header('Content-Type', 'application/pdf');
			} else {
				return redirect('/cte')->with('status', [
					'success' => 0,
					'msg' => 'Arquivo não encontrado!!'
				]);
			}
		} catch (\Exception $e) {
			echo "Ocorreu um erro durante o processamento :" . $e->getMessage();
		}
	}

	public function cancelar(Request $request)
	{
		$business_id = request()->session()->get('user.business_id');
		$cte = Cte::where('business_id', $business_id)->find($request->id);

		if (!$cte) {
			return response()->json('erro', 403);
		}

		$config = Business::getConfigCte($business_id, $cte);
		$cnpj = $this->normalizaCnpj($config->cnpj);

		$cte_service = new CTeService($this->cteServiceConfig($config), $config);

		$resultado = $cte_service->cancelar($cte, $request->justificativa, $cnpj);

		if (!isset($resultado['erro'])) {
			$cte->estado = 'CANCELADO';
			$cte->save();

			return response()->json($resultado, 200);
		} else {
			return response()->json($resultado, $resultado['status']);
		}
	}

	public function corrigir(Request $request)
	{
		$business_id = request()->session()->get('user.business_id');
		$cte = Cte::where('business_id', $business_id)->find($request->id);

		if (!$cte) {
			return response()->json('erro', 403);
		}

		$config = Business::getConfigCte($business_id, $cte);
		$cnpj = $this->normalizaCnpj($config->cnpj);

		$cte_service = new CTeService($this->cteServiceConfig($config), $config);

		$resultado = $cte_service->cartaCorrecao($cte, $request->justificativa, $cnpj);

		if (!isset($resultado['erro'])) {
			return response()->json($resultado, 200);
		} else {
			return response()->json($resultado, $resultado['status']);
		}
	}

	public function consultar(Request $request)
	{
		$business_id = request()->session()->get('user.business_id');
		$cte = Cte::where('business_id', $business_id)->find($request->id);

		if (!$cte) {
			return response()->json('erro', 403);
		}

		$config = Business::getConfigCte($business_id, $cte);

		if (!$config->certificado) {
			return response()->json('Configure o certificado para consultar', 403);
		}

		$cte_service = new CTeService($this->cteServiceConfig($config), $config);

		try {
			$res = $cte_service->consultar($cte);
			return response()->json($res, 200);
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 401);
		}
	}

	public function xmls()
	{
		$business_id = request()->session()->get('user.business_id');

		$aprovadas = [];
		$canceladas = [];

		$business_locations = BusinessLocation::forDropdown($business_id, false, true);
		$bl_attributes = $business_locations['attributes'];
		$business_locations = $business_locations['locations'];

		$default_location = null;
		if (count($business_locations) == 1) {
			foreach ($business_locations as $id => $name) {
				$default_location = BusinessLocation::findOrFail($id);
			}
		}

		return view('cte.lista')
			->with(compact('aprovadas', 'canceladas'))
			->with('bl_attributes', $bl_attributes)
			->with('default_location', $default_location)
			->with('select_location_id', null)
			->with('business_locations', $business_locations);
	}

	public function filtroXml(Request $request)
	{
		$business_id = request()->session()->get('user.business_id');

		$data_inicio = str_replace("/", "-", $request->data_inicio);
		$data_final = str_replace("/", "-", $request->data_final);
		$select_location_id = $request->select_location_id;

		$data_inicio_convert = \Carbon\Carbon::parse($data_inicio)->format('Y-m-d');
		$data_final_convert = \Carbon\Carbon::parse($data_final)->format('Y-m-d');
		$data_final_convert = date('Y-m-d', strtotime($data_final_convert . ' + 1 days'));

		// NOTA: Cte::filtroDataCliente()/filtroCliente() (métodos estáticos do model)
		// fazem join com uma tabela "clientes"/"cliente_id" que não existe no
		// schema de CT-e (remetente/destinatário usam a tabela "contacts"), por
		// isso não são usados aqui - a consulta é feita diretamente, sempre
		// isolada por business_id (isolamento multiempresa obrigatório).
		$aprovadasQuery = Cte::where('business_id', $business_id)
			->whereBetween('data_registro', [$data_inicio_convert, $data_final_convert])
			->where('cte_numero', '>', 0)
			->where('estado', 'APROVADO')
			->orderBy('id', 'desc');

		if ($select_location_id) {
			$aprovadasQuery->where('location_id', $select_location_id);
		}
		$aprovadas = $aprovadasQuery->get();

		$canceladasQuery = Cte::where('business_id', $business_id)
			->whereBetween('data_registro', [$data_inicio_convert, $data_final_convert])
			->where('cte_numero', '>', 0)
			->where('estado', 'CANCELADO')
			->orderBy('id', 'desc');

		if ($select_location_id) {
			$canceladasQuery->where('location_id', $select_location_id);
		}
		$canceladas = $canceladasQuery->get();

		$business = Business::find($business_id);
		$cnpj = $this->normalizaCnpj($business->cnpj);

		$msg = [];

		if (sizeof($aprovadas) > 0) {
			try {
				if (!is_dir(public_path('xml_cte/' . $cnpj))) {
					mkdir(public_path('xml_cte/' . $cnpj), 0777, true);
				}
				$zip_file = public_path('xml_cte/' . $cnpj . '/' . 'xml.zip');
				$zip = new \ZipArchive();
				$zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

				foreach ($aprovadas as $n) {
					if (file_exists(public_path('xml_cte/' . $cnpj . '/' . $n->chave . '.xml'))) {
						$zip->addFile(public_path('xml_cte/' . $cnpj . '/' . $n->chave . '.xml'), $n->chave . '.xml');
					}
				}
				$zip->close();
			} catch (\Exception $e) {
				array_push($msg, "Erro ao gerar arquivo de XML!!");
			}
		}

		if (sizeof($canceladas) > 0) {
			try {
				if (!is_dir(public_path('xml_cte_cancelado/' . $cnpj))) {
					mkdir(public_path('xml_cte_cancelado/' . $cnpj), 0777, true);
				}
				$zip_file = public_path('xml_cte_cancelado/' . $cnpj . '/' . 'xml_cancelado.zip');
				$zip = new \ZipArchive();
				$zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

				foreach ($canceladas as $n) {
					if (file_exists(public_path('xml_cte_cancelado/' . $cnpj . '/' . $n->chave . '.xml'))) {
						$zip->addFile(public_path('xml_cte_cancelado/' . $cnpj . '/' . $n->chave . '.xml'), $n->chave . '.xml');
					}
				}
				$zip->close();
			} catch (\Exception $e) {
				array_push($msg, "Erro ao gerar arquivo de XML de Cancelamento!!");
			}
		}

		$business_locations = BusinessLocation::forDropdown($business_id, false, true);
		$bl_attributes = $business_locations['attributes'];
		$business_locations = $business_locations['locations'];

		$default_location = null;
		if (count($business_locations) == 1) {
			foreach ($business_locations as $id => $name) {
				$default_location = BusinessLocation::findOrFail($id);
			}
		}

		return view('cte.lista')
			->with(compact('canceladas', 'aprovadas', 'business', 'data_inicio', 'data_final', 'msg'))
			->with('bl_attributes', $bl_attributes)
			->with('default_location', $default_location)
			->with('select_location_id', $select_location_id)
			->with('business_locations', $business_locations);
	}

	public function baixarZipXmlAprovado()
	{
		$business_id = request()->session()->get('user.business_id');
		$business = Business::find($business_id);
		$cnpj = $this->normalizaCnpj($business->cnpj);

		if (file_exists(public_path('xml_cte/' . $cnpj . '/' . 'xml.zip'))) {
			return response()->download(public_path('xml_cte/' . $cnpj . '/' . 'xml.zip'));
		} else {
			return redirect()->back()->with('status', [
				'success' => 0,
				'msg' => 'Arquivo não encontrado!!'
			]);
		}
	}

	public function baixarZipXmlReprovado()
	{
		$business_id = request()->session()->get('user.business_id');
		$business = Business::find($business_id);
		$cnpj = $this->normalizaCnpj($business->cnpj);

		if (file_exists(public_path('xml_cte_cancelado/' . $cnpj . '/' . 'xml_cancelado.zip'))) {
			return response()->download(public_path('xml_cte_cancelado/' . $cnpj . '/' . 'xml_cancelado.zip'));
		} else {
			return redirect()->back()->with('status', [
				'success' => 0,
				'msg' => 'Arquivo não encontrado!!'
			]);
		}
	}

	/**
	 * Importação simplificada de XML de CT-e para apoio ao preenchimento manual.
	 * NOTA: não faz o parse completo de todas as tags do CT-e (remetente,
	 * destinatário, componentes, medidas, etc), apenas extrai os campos
	 * principais (chave, número, valores) e devolve um resumo para o usuário -
	 * o preenchimento automático dos campos do formulário não está implementado.
	 */
	public function importarXml(Request $request)
	{
		if (!$request->hasFile('file')) {
			return redirect()->back()->with('status', [
				'success' => 0,
				'msg' => 'Nenhum arquivo enviado!!'
			]);
		}

		try {
			$conteudo = file_get_contents($request->file('file')->getRealPath());
			$xml = new \SimpleXMLElement($conteudo);

			$ns = $xml->getNamespaces(true);
			$infCte = $xml->infCte ?? ($xml->CTe->infCte ?? null);

			$dados = [];
			if ($infCte) {
				$id = (string) $infCte->attributes()->Id;
				$dados['chave'] = str_replace('CTe', '', $id);
				$dados['nCT'] = (string) ($infCte->ide->nCT ?? '');
				$dados['remetente'] = (string) ($infCte->rem->xNome ?? '');
				$dados['destinatario'] = (string) ($infCte->dest->xNome ?? '');
				$dados['valor_transporte'] = (string) ($infCte->vPrest->vTPrest ?? '');
				$dados['valor_receber'] = (string) ($infCte->vPrest->vRec ?? '');
			}

			return redirect('/cte/new')->with('status', [
				'success' => 1,
				'msg' => 'XML importado. Dados encontrados: ' . json_encode($dados)
			]);
		} catch (\Exception $e) {
			return redirect()->back()->with('status', [
				'success' => 0,
				'msg' => 'Não foi possível ler o XML enviado: ' . $e->getMessage()
			]);
		}
	}

	private function cteServiceConfig($config)
	{
		return [
			"atualizacao" => date('Y-m-d h:i:s'),
			"tpAmb" => (int) $config->ambiente,
			"razaosocial" => $config->razao_social,
			"siglaUF" => $config->cidade->uf,
			"cnpj" => $this->normalizaCnpj($config->cnpj),
			"schemes" => "PL_CTe_400",
			"versao" => "4.00",
			"CSC" => $config->csc,
			"CSCid" => $config->csc_id
		];
	}

	private function normalizaCnpj($cnpj)
	{
		return preg_replace('/[^0-9]/', '', (string) $cnpj);
	}

	private function resolveLocationId(Request $request, $business_id)
	{
		if ($request->select_location_id) {
			return $request->select_location_id;
		}

		$bl = BusinessLocation::where('business_id', $business_id)->first();
		return $bl ? $bl->id : null;
	}

	private function convertData($data)
	{
		if (!$data) {
			return null;
		}

		try {
			return \Carbon\Carbon::createFromFormat('d/m/Y', $data)->format('Y-m-d');
		} catch (\Exception $e) {
			try {
				return \Carbon\Carbon::parse($data)->format('Y-m-d');
			} catch (\Exception $e2) {
				return null;
			}
		}
	}

	private function salvarMedidas($cte, $medidasJson)
	{
		if (!$medidasJson) {
			return;
		}

		$medidas = json_decode($medidasJson, true);
		if (!is_array($medidas)) {
			return;
		}

		foreach ($medidas as $m) {
			MedidaCte::create([
				'cte_id' => $cte->id,
				'cod_unidade' => $m['unidade_medida'] ?? null,
				'tipo_medida' => $m['tipo_medida'] ?? null,
				'quantidade_carga' => isset($m['quantidade']) ? str_replace(',', '.', $m['quantidade']) : 0,
			]);
		}
	}

	private function salvarComponentes($cte, $componentesJson)
	{
		if (!$componentesJson) {
			return;
		}

		$componentes = json_decode($componentesJson, true);
		if (!is_array($componentes)) {
			return;
		}

		foreach ($componentes as $c) {
			ComponenteCte::create([
				'cte_id' => $cte->id,
				'nome' => $c['nome'] ?? null,
				'valor' => isset($c['valor']) ? str_replace(',', '.', $c['valor']) : 0,
			]);
		}
	}

	private function prepareNaturezas($business_id)
	{
		$naturezas = NaturezaOperacao::where('business_id', $business_id)->get();

		$temp = [];
		foreach ($naturezas as $n) {
			$temp[$n->id] = $n->natureza;
		}
		return $temp;
	}

	private function prepareVeiculos($business_id)
	{
		$veiculos = Veiculo::where('business_id', $business_id)->get();

		$temp = [];
		foreach ($veiculos as $v) {
			$temp[$v->id] = $v->placa . ' - ' . $v->modelo;
		}
		return $temp;
	}

	private function prepareCidades()
	{
		$cidades = City::all();

		$temp = [];
		foreach ($cidades as $c) {
			$temp[$c->id] = $c->nome . ' (' . $c->uf . ')';
		}
		return $temp;
	}

	private function getEmitente($config)
	{
		return [
			'razao' => $config->razao_social,
			'logradouro' => $config->rua,
			'numero' => $config->numero,
			'complemento' => '',
			'bairro' => $config->bairro,
			'CEP' => $config->cep,
			'municipio' => $config->cidade->nome,
			'UF' => $config->cidade->uf,
			'telefone' => '',
			'email' => ''
		];
	}
}
