<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\BusinessLocation;
use App\Models\City;
use App\Models\Veiculo;
use App\Models\Mdfe;
use App\Models\Ciot;
use App\Models\Percurso;
use App\Models\ValePedagio;
use App\Models\InfoDescarga;
use App\Models\MunicipioCarregamento;
use App\Models\UnidadeCarga;
use App\Models\NFeDescarga;
use App\Models\CTeDescarga;
use App\Models\LacreTransporte;
use App\Models\LacreUnidadeCarga;
use App\Services\MdfeService;
use NFePHP\DA\MDFe\Damdfe;
use Yajra\DataTables\Facades\DataTables;

class MdfeController extends Controller
{

	public function index(){

		$business_id = request()->session()->get('user.business_id');

		if(request()->ajax()){
			$mdfes = Mdfe::with('veiculoTracao')
			->where('business_id', $business_id)
			->select(['id', 'uf_inicio', 'uf_fim', 'data_inicio_viagem', 'condutor_nome',
				'valor_carga', 'quantidade_carga', 'estado', 'mdfe_numero', 'chave', 'veiculo_tracao_id']);

			return Datatables::of($mdfes)
			->addColumn('veiculo', function($row){
				return $row->veiculoTracao ? $row->veiculoTracao->placa : '';
			})
			->addColumn('action', function($row){
				$html = '';
				if($row->mdfe_numero > 0 && $row->chave){
					$html .= '<a href="/mdfe/ver/' . $row->id . '" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-eye-open"></i> Ver</a> ';
				}else{
					$html .= '<a href="/mdfe/gerar/' . $row->id . '" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-send"></i> Emitir</a> ';
					$html .= '<a href="/mdfe/edit/' . $row->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a> ';
				}
				$html .= '<a href="/mdfe/delete/' . $row->id . '" class="btn btn-xs btn-danger delete_user_button"><i class="glyphicon glyphicon-trash"></i> Excluir</a>';
				return $html;
			})
			->rawColumns(['action'])
			->make(true);
		}

		return view('mdfe.list');
	}

	public function new(){

		$business_id = request()->session()->get('user.business_id');

		$vars = $this->registerVars($business_id);
		$vars['mdfe'] = null;

		return view('mdfe.register')->with($vars);
	}

	public function edit($id){

		$business_id = request()->session()->get('user.business_id');

		$mdfe = $this->loadMdfeCompleto($business_id, $id);

		if(!$mdfe){
			abort(403, 'Unauthorized action.');
		}

		$vars = $this->registerVars($business_id);
		$vars['mdfe'] = $mdfe;

		return view('mdfe.register')->with($vars);
	}

	public function save(Request $request){

		$business_id = request()->session()->get('user.business_id');

		$data = $this->extractMdfeData($request);
		$data['business_id'] = $business_id;
		$data['location_id'] = $this->resolveLocationId($request, $business_id);
		$data['estado'] = 'NOVO';
		$data['chave'] = '';
		$data['protocolo'] = '';
		$data['encerrado'] = 0;

		$temp = new Mdfe($data);
		$lastNumero = $temp->lastMDFe($temp);
		$data['mdfe_numero'] = (int)$lastNumero + 1;

		$mdfe = Mdfe::create($data);

		$this->syncRelacionamentos($mdfe, $request);

		return redirect('/mdfe')->with('status', [
			'success' => 1,
			'msg' => 'MDF-e salvo com sucesso!'
		]);
	}

	public function update(Request $request){

		$business_id = request()->session()->get('user.business_id');

		$mdfe = Mdfe::where('business_id', $business_id)
		->where('id', $request->mdfe_id)
		->first();

		if(!$mdfe){
			abort(403, 'Unauthorized action.');
		}

		$data = $this->extractMdfeData($request);

		if($request->select_location_id){
			$data['location_id'] = $request->select_location_id;
		}

		$mdfe->update($data);

		$this->syncRelacionamentos($mdfe, $request);

		return redirect('/mdfe')->with('status', [
			'success' => 1,
			'msg' => 'MDF-e atualizado com sucesso!'
		]);
	}

	public function delete($id){

		$business_id = request()->session()->get('user.business_id');

		$mdfe = Mdfe::where('business_id', $business_id)
		->where('id', $id)
		->first();

		if(!$mdfe){
			abort(403, 'Unauthorized action.');
		}

		$this->limparRelacionamentos($mdfe);
		$mdfe->delete();

		return redirect('/mdfe')->with('status', [
			'success' => 1,
			'msg' => 'MDF-e removido com sucesso!'
		]);
	}

	public function gerar($id){

		$business_id = request()->session()->get('user.business_id');

		$mdfe = Mdfe::where('business_id', $business_id)
		->where('id', $id)
		->first();

		if(!$mdfe){
			abort(403, 'Unauthorized action.');
		}

		if($mdfe->mdfe_numero > 0 && $mdfe->chave){
			return redirect('/mdfe/ver/' . $mdfe->id);
		}

		return view('mdfe.gerar')->with(compact('mdfe'));
	}

	public function renderizar($id){

		$business_id = request()->session()->get('user.business_id');
		$mdfe = $this->loadMdfeCompleto($business_id, $id);

		if(!$mdfe){
			abort(403, 'Unauthorized action.');
		}

		$config = Business::getConfigMdfe($business_id, $mdfe);
		$service = $this->buildService($config);

		$gerado = $service->gerarMDFe($mdfe);

		if(isset($gerado['xml_erros'])){
			foreach($gerado['xml_erros'] as $e){
				echo $e . "<br>";
			}
			return;
		}

		$logo = '';
		if($config->logo){
			$logo = public_path('uploads/business_logos/') . $config->logo;
		}

		try {
			$damdfe = new Damdfe($gerado['xml']);
			$pdf = $damdfe->render($logo);

			return response($pdf)
			->header('Content-Type', 'application/pdf');
		} catch (\Exception $e) {
			return response($gerado['xml'])
			->header('Content-Type', 'application/xml');
		}
	}

	public function gerarXml($id){

		$business_id = request()->session()->get('user.business_id');
		$mdfe = $this->loadMdfeCompleto($business_id, $id);

		if(!$mdfe){
			abort(403, 'Unauthorized action.');
		}

		$config = Business::getConfigMdfe($business_id, $mdfe);
		$service = $this->buildService($config);

		$gerado = $service->gerarMDFe($mdfe);

		if(!isset($gerado['xml_erros'])){
			return response($gerado['xml'])
			->header('Content-Type', 'application/xml');
		}else{
			foreach($gerado['xml_erros'] as $e){
				echo $e . "<br>";
			}
		}
	}

	public function transmitir(Request $request){

		$business_id = request()->session()->get('user.business_id');
		$mdfe = $this->loadMdfeCompleto($business_id, $request->id);

		if(!$mdfe){
			return response()->json('erro', 403);
		}

		if($mdfe->estado != 'REJEITADO' && $mdfe->estado != 'NOVO'){
			return response()->json("Este MDF-e já esta " . $mdfe->estado, 403);
		}

		$config = Business::getConfigMdfe($business_id, $mdfe);
		$cnpj = $this->normalizaCnpj($config->cnpj);
		$service = $this->buildService($config);

		$gerado = $service->gerarMDFe($mdfe);

		if(isset($gerado['xml_erros'])){
			return response()->json($gerado['xml_erros'][0], 407);
		}

		$signed = $service->sign($gerado['xml']);
		$resultado = $service->transmitir($signed, $gerado['chave'], $cnpj);

		if(isset($resultado['successo'])){
			$mdfe->chave = $resultado['chave'];
			$mdfe->protocolo = $resultado['protocolo'];
			$mdfe->mdfe_numero = $gerado['nMDF'];
			$mdfe->estado = 'APROVADO';
			$mdfe->save();

			return response()->json($resultado, 200);
		}else{
			$mdfe->estado = 'REJEITADO';
			$mdfe->save();

			if(isset($resultado['protocolo'])){
				return response()->json($resultado['protocolo'], $resultado['status']);
			}else{
				return response()->json($resultado, 404);
			}
		}
	}

	public function cancelar(Request $request){

		$business_id = request()->session()->get('user.business_id');
		$mdfe = Mdfe::where('business_id', $business_id)
		->where('id', $request->id)
		->first();

		if(!$mdfe){
			return response()->json('erro', 403);
		}

		$config = Business::getConfigMdfe($business_id, $mdfe);
		$cnpj = $this->normalizaCnpj($config->cnpj);
		$service = $this->buildService($config);

		$resultado = $service->cancelar($mdfe, $request->justificativa, $cnpj);

		if(!isset($resultado['erro'])){
			$mdfe->estado = 'CANCELADO';
			$mdfe->save();

			return response()->json($resultado, 200);
		}else{
			return response()->json($resultado, $resultado['status']);
		}
	}

	public function corrigir(Request $request){
		//MDF-e nao possui evento de carta de correcao na Sefaz
		return response()->json([
			'erro' => true,
			'msg' => 'MDF-e não possui evento de carta de correção.'
		], 400);
	}

	public function consultar(Request $request){

		$business_id = request()->session()->get('user.business_id');
		$mdfe = Mdfe::where('business_id', $business_id)
		->where('id', $request->id)
		->first();

		if(!$mdfe){
			return response()->json('erro', 403);
		}

		$config = Business::getConfigMdfe($business_id, $mdfe);
		$service = $this->buildService($config);

		try{
			$res = $service->consultar($mdfe);
			return response()->json($res, 200);
		}catch(\Exception $e){
			return response()->json($e->getMessage(), 401);
		}
	}

	public function ver($id){

		$business_id = request()->session()->get('user.business_id');
		$mdfe = Mdfe::where('business_id', $business_id)
		->where('id', $id)
		->first();

		if(!$mdfe){
			abort(403, 'Unauthorized action.');
		}

		return view('mdfe.ver')->with(compact('mdfe'));
	}

	public function baixarXml($id){

		$business_id = request()->session()->get('user.business_id');
		$mdfe = Mdfe::where('business_id', $business_id)
		->where('id', $id)
		->first();

		if(!$mdfe){
			abort(403, 'Unauthorized action.');
		}

		$config = Business::getConfigMdfe($business_id, $mdfe);
		$cnpj = $this->normalizaCnpj($config->cnpj);

		if(file_exists(public_path('xml_mdfe/' . $cnpj . '/' . $mdfe->chave . '.xml'))){
			return response()->download(public_path('xml_mdfe/' . $cnpj . '/' . $mdfe->chave . '.xml'));
		}else{
			return redirect()->back()
			->with('status', [
				'success' => 0,
				'msg' => 'Arquivo não encontrado!!'
			]);
		}
	}

	public function baixarXmlCancelado($id){

		$business_id = request()->session()->get('user.business_id');
		$mdfe = Mdfe::where('business_id', $business_id)
		->where('id', $id)
		->first();

		if(!$mdfe){
			abort(403, 'Unauthorized action.');
		}

		$config = Business::getConfigMdfe($business_id, $mdfe);
		$cnpj = $this->normalizaCnpj($config->cnpj);

		if(file_exists(public_path('xml_mdfe_cancelado/' . $cnpj . '/' . $mdfe->chave . '.xml'))){
			return response()->download(public_path('xml_mdfe_cancelado/' . $cnpj . '/' . $mdfe->chave . '.xml'));
		}else{
			return redirect()->back()
			->with('status', [
				'success' => 0,
				'msg' => 'Arquivo não encontrado!!'
			]);
		}
	}

	public function imprimir($id){

		$business_id = request()->session()->get('user.business_id');
		$mdfe = Mdfe::where('business_id', $business_id)
		->where('id', $id)
		->first();

		if(!$mdfe){
			abort(403, 'Unauthorized action.');
		}

		$config = Business::getConfigMdfe($business_id, $mdfe);
		$cnpj = $this->normalizaCnpj($config->cnpj);

		$logo = '';
		if($config->logo){
			$logo = public_path('uploads/business_logos/') . $config->logo;
		}

		$path = public_path('xml_mdfe/' . $cnpj . '/' . $mdfe->chave . '.xml');

		if(!file_exists($path)){
			return redirect('/mdfe')
			->with('status', [
				'success' => 0,
				'msg' => 'Arquivo não encontrado!!'
			]);
		}

		$xml = file_get_contents($path);

		try {
			$damdfe = new Damdfe($xml);
			$pdf = $damdfe->render($logo);

			return response($pdf)
			->header('Content-Type', 'application/pdf');
		} catch (\Exception $e) {
			return response($xml)
			->header('Content-Type', 'application/xml');
		}
	}

	public function imprimirCancelamento($id){

		$business_id = request()->session()->get('user.business_id');
		$mdfe = Mdfe::where('business_id', $business_id)
		->where('id', $id)
		->first();

		if(!$mdfe){
			abort(403, 'Unauthorized action.');
		}

		$config = Business::getConfigMdfe($business_id, $mdfe);
		$cnpj = $this->normalizaCnpj($config->cnpj);

		$path = public_path('xml_mdfe_cancelado/' . $cnpj . '/' . $mdfe->chave . '.xml');

		if(!file_exists($path)){
			return redirect('/mdfe')
			->with('status', [
				'success' => 0,
				'msg' => 'Arquivo não encontrado!!'
			]);
		}

		//Nao existe classe de DA para evento de MDF-e no sped-da, retorna o xml puro
		$xml = file_get_contents($path);

		return response($xml)
		->header('Content-Type', 'application/xml');
	}

	public function xmls(){

		$business_id = request()->session()->get('user.business_id');
		$aprovadas = [];
		$canceladas = [];

		$business_locations = BusinessLocation::forDropdown($business_id, false, true);
		$bl_attributes = $business_locations['attributes'];
		$business_locations = $business_locations['locations'];

		$default_location = null;
		if(count($business_locations) == 1){
			foreach($business_locations as $id => $name){
				$default_location = BusinessLocation::findOrFail($id);
			}
		}

		return view('mdfe.lista')
		->with(compact('aprovadas', 'canceladas'))
		->with('bl_attributes', $bl_attributes)
		->with('default_location', $default_location)
		->with('select_location_id', null)
		->with('business_locations', $business_locations);
	}

	public function filtroXml(Request $request){

		$data_inicio = str_replace("/", "-", $request->data_inicio);
		$data_final = str_replace("/", "-", $request->data_final);
		$select_location_id = $request->select_location_id;

		$data_inicio_convert = \Carbon\Carbon::parse($data_inicio)->format('Y-m-d');
		$data_final_convert = \Carbon\Carbon::parse($data_final)->format('Y-m-d');
		$data_final_convert = date('Y-m-d', strtotime($data_final_convert . ' + 1 days'));

		$business_id = request()->session()->get('user.business_id');

		$aprovadas = Mdfe::where('business_id', $business_id)
		->whereBetween('created_at', [$data_inicio_convert, $data_final_convert])
		->where('mdfe_numero', '>', 0)
		->where('estado', 'APROVADO')
		->orderBy('id', 'desc');

		if($select_location_id){
			$aprovadas->where('location_id', $select_location_id);
		}
		$aprovadas = $aprovadas->get();

		$canceladas = Mdfe::where('business_id', $business_id)
		->whereBetween('created_at', [$data_inicio_convert, $data_final_convert])
		->where('mdfe_numero', '>', 0)
		->where('estado', 'CANCELADO')
		->orderBy('id', 'desc');

		if($select_location_id){
			$canceladas->where('location_id', $select_location_id);
		}
		$canceladas = $canceladas->get();

		$business = Business::find($business_id);
		$cnpj = $this->normalizaCnpj($business->cnpj);

		$msg = [];

		if(sizeof($aprovadas) > 0){
			try{
				if(!is_dir(public_path('xml_mdfe/' . $cnpj))){
					mkdir(public_path('xml_mdfe/' . $cnpj), 0777, true);
				}
				$zip_file = public_path('xml_mdfe/' . $cnpj . '/' . 'xml.zip');
				$zip = new \ZipArchive();
				$zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

				foreach($aprovadas as $n){
					if(file_exists(public_path('xml_mdfe/' . $cnpj . '/' . $n->chave . '.xml'))){
						$zip->addFile(public_path('xml_mdfe/' . $cnpj . '/' . $n->chave . '.xml'), $n->chave . '.xml');
					}
				}
				$zip->close();
			}catch(\Exception $e){
				array_push($msg, "Erro ao gerar arquivo de XML!!");
			}
		}

		if(sizeof($canceladas) > 0){
			try{
				if(!is_dir(public_path('xml_mdfe_cancelado/' . $cnpj))){
					mkdir(public_path('xml_mdfe_cancelado/' . $cnpj), 0777, true);
				}
				$zip_file = public_path('xml_mdfe_cancelado/' . $cnpj . '/' . 'xml_cancelado.zip');
				$zip = new \ZipArchive();
				$zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

				foreach($canceladas as $n){
					if(file_exists(public_path('xml_mdfe_cancelado/' . $cnpj . '/' . $n->chave . '.xml'))){
						$zip->addFile(public_path('xml_mdfe_cancelado/' . $cnpj . '/' . $n->chave . '.xml'), $n->chave . '.xml');
					}
				}
				$zip->close();
			}catch(\Exception $e){
				array_push($msg, "Erro ao gerar arquivo de XML de Cancelamento!!");
			}
		}

		$business_locations = BusinessLocation::forDropdown($business_id, false, true);
		$bl_attributes = $business_locations['attributes'];
		$business_locations = $business_locations['locations'];

		$default_location = null;
		if(count($business_locations) == 1){
			foreach($business_locations as $id => $name){
				$default_location = BusinessLocation::findOrFail($id);
			}
		}

		return view('mdfe.lista')
		->with(compact('aprovadas', 'canceladas', 'business', 'data_inicio', 'data_final', 'msg'))
		->with('bl_attributes', $bl_attributes)
		->with('default_location', $default_location)
		->with('select_location_id', $select_location_id)
		->with('business_locations', $business_locations);
	}

	public function baixarZipXmlAprovado(){
		$business_id = request()->session()->get('user.business_id');
		$business = Business::find($business_id);
		$cnpj = $this->normalizaCnpj($business->cnpj);

		if(file_exists(public_path('xml_mdfe/' . $cnpj . '/' . 'xml.zip'))){
			return response()->download(public_path('xml_mdfe/' . $cnpj . '/' . 'xml.zip'));
		}else{
			return redirect()->back()
			->with('status', [
				'success' => 0,
				'msg' => 'Arquivo não encontrado!!'
			]);
		}
	}

	public function baixarZipXmlReprovado(){
		$business_id = request()->session()->get('user.business_id');
		$business = Business::find($business_id);
		$cnpj = $this->normalizaCnpj($business->cnpj);

		if(file_exists(public_path('xml_mdfe_cancelado/' . $cnpj . '/' . 'xml_cancelado.zip'))){
			return response()->download(public_path('xml_mdfe_cancelado/' . $cnpj . '/' . 'xml_cancelado.zip'));
		}else{
			return redirect()->back()
			->with('status', [
				'success' => 0,
				'msg' => 'Arquivo não encontrado!!'
			]);
		}
	}

	public function naoencerrados(){

		$business_id = request()->session()->get('user.business_id');

		$naoEncerrados = Mdfe::where('business_id', $business_id)
		->where('estado', 'APROVADO')
		->where('encerrado', 0)
		->get();

		return view('mdfe.nao_encerrados')->with(compact('naoEncerrados'));
	}

	public function encerrar($chave, $protocolo, $location_id){

		$business_id = request()->session()->get('user.business_id');

		$mdfe = Mdfe::where('business_id', $business_id)
		->where('chave', $chave)
		->where('protocolo', $protocolo)
		->where('location_id', $location_id)
		->first();

		if(!$mdfe){
			abort(403, 'Unauthorized action.');
		}

		$config = Business::getConfigMdfe($business_id, $mdfe);
		$cnpj = $this->normalizaCnpj($config->cnpj);
		$service = $this->buildService($config);

		$cUF = Business::getcUF($config->cidade->uf);
		$cMun = $config->cidade->codigo;

		$resultado = $service->encerrar($mdfe, $cnpj, $cUF, $cMun);

		if(!isset($resultado['erro'])){
			$mdfe->encerrado = 1;
			$mdfe->save();

			return redirect('/mdfe/naoencerrados')
			->with('status', [
				'success' => 1,
				'msg' => 'MDF-e encerrado com sucesso!'
			]);
		}else{
			return redirect('/mdfe/naoencerrados')
			->with('status', [
				'success' => 0,
				'msg' => 'Erro ao encerrar MDF-e'
			]);
		}
	}

	/**
	 * Monta as variaveis usadas pela view mdfe.register (create/edit compartilham a mesma view)
	 */
	private function registerVars($business_id){

		$business_locations = BusinessLocation::forDropdown($business_id, false, true);
		$bl_attributes = $business_locations['attributes'];
		$business_locations = $business_locations['locations'];

		$default_location = null;
		if(count($business_locations) == 1){
			foreach($business_locations as $id => $name){
				$default_location = BusinessLocation::findOrFail($id);
			}
		}

		$cidades = [];
		foreach(City::all() as $c){
			$cidades[$c->id] = $c->nome;
		}

		$veiculos = [];
		foreach(Veiculo::where('business_id', $business_id)->get() as $v){
			$veiculos[$v->id] = $v->placa . ' - ' . $v->modelo;
		}

		return [
			'lastMdfe' => Mdfe::lastMDFeAux($business_id),
			'clientesAux' => [],
			'cidades' => $cidades,
			'business_locations' => $business_locations,
			'bl_attributes' => $bl_attributes,
			'default_location' => $default_location,
			'tiposUnidadeTransporte' => Mdfe::tiposUnidadeTransporte(),
			'ufs' => City::ufs(),
			'veiculos' => $veiculos,
			'form_partials' => [],
		];
	}

	private function resolveLocationId(Request $request, $business_id){
		if($request->select_location_id){
			return $request->select_location_id;
		}

		$business_locations = BusinessLocation::forDropdown($business_id, false, true);
		$business_locations = $business_locations['locations'];

		if(count($business_locations) == 1){
			foreach($business_locations as $id => $name){
				return $id;
			}
		}

		return null;
	}

	private function extractMdfeData(Request $request){
		return [
			'uf_inicio' => $request->uf_inicio,
			'uf_fim' => $request->uf_fim,
			'data_inicio_viagem' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->data_inicio_viagem)->format('Y-m-d'),
			'carga_posterior' => $request->carga_posterior ? 1 : 0,
			'tp_emit' => $request->tipo_emitente,
			'tp_transp' => $request->tipo_transportador,
			'lac_rodo' => $request->lac_rodo,
			'cnpj_contratante' => $request->cnpj_contratante,
			'quantidade_carga' => $this->toDecimal($request->quantidade_carga),
			'valor_carga' => $this->toDecimal($request->valor_carga),
			'veiculo_tracao_id' => $request->veiculo_tracao_id,
			'veiculo_reboque1_id' => $request->veiculo_reboque1_id ?: null,
			'veiculo_reboque2_id' => $request->veiculo_reboque2_id ?: null,
			'veiculo_reboque3_id' => $request->veiculo_reboque3_id ?: null,
			'produto_pred_nome' => $request->produto_pred_nome,
			'produto_pred_cod_barras' => $request->produto_pred_cod_barras,
			'produto_pred_ncm' => $request->produto_pred_ncm,
			'cep_carrega' => $request->cep_carrega,
			'latitude_carregamento' => $request->latitude_carrega,
			'longitude_carregamento' => $request->longitude_carrega,
			'cep_descarrega' => $request->cep_descarrega,
			'latitude_descarregamento' => $request->latitude_descarrega,
			'longitude_descarregamento' => $request->longitude_descarrega,
			'tp_carga' => $request->tp_carga,
			'seguradora_nome' => $request->seguradora_nome,
			'seguradora_cnpj' => $request->seguradora_cnpj,
			'numero_apolice' => $request->numero_apolice,
			'numero_averbacao' => $request->numero_averbacao,
			'condutor_nome' => $request->condutor_nome,
			'condutor_cpf' => $request->condutor_cpf,
			'info_complementar' => $request->info_complementar,
			'info_adicional_fisco' => $request->info_adicional_fisco,
		];
	}

	/**
	 * Recria os relacionamentos do MDF-e a partir dos campos json enviados pelo form
	 * (municipios_descarregamentos, percurso, ciots, vales, descargas)
	 */
	private function syncRelacionamentos($mdfe, Request $request){

		$this->limparRelacionamentos($mdfe);

		$municipios = json_decode($request->municipios_descarregamentos, true) ?: [];
		foreach($municipios as $cidadeId){
			MunicipioCarregamento::create([
				'mdfe_id' => $mdfe->id,
				'cidade_id' => $cidadeId
			]);
		}

		$percurso = json_decode($request->percurso, true) ?: [];
		foreach($percurso as $uf){
			Percurso::create([
				'mdfe_id' => $mdfe->id,
				'uf' => $uf
			]);
		}

		$ciots = json_decode($request->ciots, true) ?: [];
		foreach($ciots as $c){
			Ciot::create([
				'mdfe_id' => $mdfe->id,
				'codigo' => $c['codigo'],
				'cpf_cnpj' => $c['doc_ciot']
			]);
		}

		$vales = json_decode($request->vales, true) ?: [];
		foreach($vales as $v){
			ValePedagio::create([
				'mdfe_id' => $mdfe->id,
				'cnpj_fornecedor' => $v['cnpj_fornecedor'],
				'cnpj_fornecedor_pagador' => $v['doc_pagador'],
				'numero_compra' => $v['numero_compra'],
				'valor' => $this->toDecimal($v['valor'])
			]);
		}

		$descargas = json_decode($request->descargas, true) ?: [];
		foreach($descargas as $d){
			$info = InfoDescarga::create([
				'mdfe_id' => $mdfe->id,
				'tp_unid_transp' => $d['tipo_unidade_transporte'],
				'id_unid_transp' => $d['id_unidade_transporte'],
				'quantidade_rateio' => $this->toDecimal($d['qtd_rateio_transporte'] ?? 0),
				'cidade_id' => $d['municipio_descarregamento']
			]);

			if(!empty($d['id_unidade_carga'])){
				UnidadeCarga::create([
					'info_id' => $info->id,
					'id_unidade_carga' => $d['id_unidade_carga'],
					'quantidade_rateio' => $this->toDecimal($d['qtd_rateio_unidade'] ?? 0)
				]);
			}

			if(!empty($d['chave_nfe'])){
				NFeDescarga::create([
					'info_id' => $info->id,
					'chave' => $d['chave_nfe'],
					'seg_cod_barras' => $d['segunda_nfe'] ?? ''
				]);
			}

			if(!empty($d['chave_cte'])){
				CTeDescarga::create([
					'info_id' => $info->id,
					'chave' => $d['chave_cte'],
					'seg_cod_barras' => $d['segunda_cte'] ?? ''
				]);
			}

			foreach(($d['lacres_transporte'] ?? []) as $lacre){
				if($lacre){
					LacreTransporte::create(['info_id' => $info->id, 'numero' => $lacre]);
				}
			}

			foreach(($d['lacres_unidade_carga'] ?? []) as $lacre){
				if($lacre){
					LacreUnidadeCarga::create(['info_id' => $info->id, 'numero' => $lacre]);
				}
			}
		}
	}

	private function limparRelacionamentos($mdfe){
		foreach($mdfe->infoDescarga as $info){
			$info->lacresTransp()->delete();
			$info->lacresUnidCarga()->delete();
			if($info->cte){
				$info->cte->delete();
			}
			if($info->nfe){
				$info->nfe->delete();
			}
			if($info->unidadeCarga){
				$info->unidadeCarga->delete();
			}
			$info->delete();
		}

		$mdfe->municipiosCarregamento()->delete();
		$mdfe->percurso()->delete();
		$mdfe->ciots()->delete();
		$mdfe->valesPedagio()->delete();
	}

	private function loadMdfeCompleto($business_id, $id){
		return Mdfe::with([
			'veiculoTracao', 'veiculoReboque1', 'veiculoReboque2', 'veiculoReboque3',
			'municipiosCarregamento.cidade', 'percurso', 'ciots', 'valesPedagio',
			'infoDescarga.cidade', 'infoDescarga.cte', 'infoDescarga.nfe',
			'infoDescarga.unidadeCarga', 'infoDescarga.lacresTransp', 'infoDescarga.lacresUnidCarga'
		])
		->where('business_id', $business_id)
		->where('id', $id)
		->first();
	}

	private function buildService($config){
		$cnpj = $this->normalizaCnpj($config->cnpj);

		return new MdfeService([
			"atualizacao" => date('Y-m-d h:i:s'),
			"tpAmb" => (int)$config->ambiente,
			"razaosocial" => $config->razao_social,
			"siglaUF" => $config->cidade->uf,
			"cnpj" => $cnpj,
			"schemes" => "PL_MDFe_300",
			"versao" => "3.00"
		], $config);
	}

	private function normalizaCnpj($cnpj){
		return preg_replace('/[^0-9]/', '', $cnpj);
	}

	private function toDecimal($v){
		if($v === null || $v === ''){
			return 0;
		}
		$v = str_replace('.', '', $v);
		$v = str_replace(',', '.', $v);
		return $v;
	}
}
