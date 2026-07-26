<?php
namespace App\Services;

use NFePHP\MDFe\Make;
use NFePHP\MDFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\MDFe\Common\Standardize;
use NFePHP\MDFe\Complements;
use App\Models\Business;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

class MdfeService{

	private $config;
	private $tools;

	public function __construct($config, $certificado){

		$this->config = $config;
		$this->tools = new Tools(json_encode($config), Certificate::readPfx($certificado->certificado, base64_decode($certificado->senha_certificado)));
	}

	/**
	 * Monta o XML do MDF-e a partir do model Mdfe (com relacionamentos carregados)
	 * retorna ['chave' => .., 'xml' => .., 'nMDF' => ..] ou ['xml_erros' => [...]]
	 */
	public function gerarMDFe($mdfe){
		date_default_timezone_set('America/Belem');
		$business_id = request()->session()->get('user.business_id');
		$config = Business::getConfigMdfe($business_id, $mdfe);

		$make = new Make();

		$lastNumero = $mdfe->lastMDFe($mdfe);
		$nMDF = (int)$lastNumero + 1;

		//ide
		$stdIde = new \stdClass();
		$stdIde->cUF = Business::getcUF($config->cidade->uf);
		$stdIde->tpAmb = (int)$config->ambiente;
		$stdIde->tpEmit = (int)$mdfe->tp_emit;
		$stdIde->tpTransp = (int)$mdfe->tp_transp;
		$stdIde->mod = '58';
		$stdIde->serie = '1';
		$stdIde->nMDF = $nMDF;
		$stdIde->cMDF = str_pad(rand(1, 99999999), 8, '0', STR_PAD_LEFT);
		$stdIde->cDV = 0;
		$stdIde->modal = '1'; //rodoviario
		$stdIde->dhEmi = date("Y-m-d\TH:i:sP");
		$stdIde->tpEmis = 1;
		$stdIde->procEmi = 0;
		$stdIde->verProc = '1.0.0';
		$stdIde->UFIni = $mdfe->uf_inicio;
		$stdIde->UFFim = $mdfe->uf_fim;
		$stdIde->dhIniViagem = \Carbon\Carbon::parse($mdfe->data_inicio_viagem)->format("Y-m-d\TH:i:sP");
		$stdIde->indCarregaPosterior = $mdfe->carga_posterior;

		$make->tagide($stdIde);

		foreach($mdfe->municipiosCarregamento as $m){
			$std = new \stdClass();
			$std->cMunCarrega = $m->cidade->codigo;
			$std->xMunCarrega = $m->cidade->nome;
			$make->taginfMunCarrega($std);
		}

		foreach($mdfe->percurso as $p){
			$std = new \stdClass();
			$std->UFPer = $p->uf;
			$make->taginfPercurso($std);
		}

		//emit
		$cnpj = preg_replace('/[^0-9]/', '', $config->cnpj);

		$stdEmit = new \stdClass();
		$stdEmit->CNPJ = $cnpj;
		$stdEmit->IE = preg_replace('/[^0-9]/', '', $config->ie);
		$stdEmit->xNome = $config->razao_social;
		$stdEmit->xFant = $config->name ?? $config->razao_social;
		$make->tagemit($stdEmit);

		$stdEnder = new \stdClass();
		$stdEnder->xLgr = $config->rua;
		$stdEnder->nro = $config->numero;
		$stdEnder->xBairro = $config->bairro;
		$stdEnder->cMun = $config->cidade->codigo;
		$stdEnder->xMun = $config->cidade->nome;
		$stdEnder->CEP = preg_replace('/[^0-9]/', '', $config->cep);
		$stdEnder->UF = $config->cidade->uf;
		$stdEnder->fone = preg_replace('/[^0-9]/', '', $config->telefone);
		$make->tagenderEmit($stdEnder);

		//veiculo de tracao
		$veicTracao = $mdfe->veiculoTracao;

		$std = new \stdClass();
		$std->placa = strtoupper(str_replace('-', '', $veicTracao->placa));
		$std->tara = $veicTracao->tara;
		$std->tpRod = $veicTracao->tipo_rodado;
		$std->tpCar = $veicTracao->tipo_carroceira;
		$std->UF = $veicTracao->uf;

		$condutor = new \stdClass();
		$condutor->xNome = $mdfe->condutor_nome;
		$condutor->CPF = preg_replace('/[^0-9]/', '', $mdfe->condutor_cpf);
		$std->condutor = [$condutor];

		if($veicTracao->proprietario_documento){
			$doc = preg_replace('/[^0-9]/', '', $veicTracao->proprietario_documento);
			$prop = new \stdClass();
			if(strlen($doc) == 11){
				$prop->CPF = $doc;
			}else{
				$prop->CNPJ = $doc;
			}
			$prop->RNTRC = $veicTracao->rntrc;
			$prop->xNome = $veicTracao->proprietario_nome;
			$prop->IE = $veicTracao->proprietario_ie;
			$prop->UF = $veicTracao->proprietario_uf;
			$prop->tpProp = $veicTracao->proprietario_tp;
			$std->prop = $prop;
		}

		$make->tagveicTracao($std);

		foreach([$mdfe->veiculoReboque1, $mdfe->veiculoReboque2, $mdfe->veiculoReboque3] as $reboque){
			if($reboque){
				$std = new \stdClass();
				$std->placa = strtoupper(str_replace('-', '', $reboque->placa));
				$std->tara = $reboque->tara;
				$std->tpCar = $reboque->tipo_carroceira;
				$std->UF = $reboque->uf;
				$make->tagveicReboque($std);
			}
		}

		if($mdfe->lac_rodo){
			$std = new \stdClass();
			$std->nLacre = $mdfe->lac_rodo;
			$make->taglacRodo($std);
		}

		//infANTT - precisa existir para poder anexar infCIOT/valePed/infContratante
		$std = new \stdClass();
		$std->RNTRC = $veicTracao->rntrc ?: '';
		$make->taginfANTT($std);

		foreach($mdfe->ciots as $c){
			$std = new \stdClass();
			$std->CIOT = $c->codigo;
			$doc = preg_replace('/[^0-9]/', '', $c->cpf_cnpj);
			if(strlen($doc) == 11){
				$std->CPF = $doc;
			}else{
				$std->CNPJ = $doc;
			}
			$make->taginfCIOT($std);
		}

		if(count($mdfe->valesPedagio) > 0){
			foreach($mdfe->valesPedagio as $v){
				$std = new \stdClass();
				$std->CNPJForn = preg_replace('/[^0-9]/', '', $v->cnpj_fornecedor);
				$docPagador = preg_replace('/[^0-9]/', '', $v->cnpj_fornecedor_pagador);
				if(strlen($docPagador) == 11){
					$std->CPFPg = $docPagador;
				}else{
					$std->CNPJPg = $docPagador;
				}
				$std->nCompra = $v->numero_compra;
				$std->vValePed = $v->valor;
				$make->tagdisp($std);
			}
			$make->tagvalePed(null);
		}

		$cnpjContratante = preg_replace('/[^0-9]/', '', $mdfe->cnpj_contratante);
		if(strlen($cnpjContratante) > 5){
			$std = new \stdClass();
			if(strlen($cnpjContratante) == 11){
				$std->CPF = $cnpjContratante;
			}else{
				$std->CNPJ = $cnpjContratante;
			}
			$make->taginfContratante($std);
		}

		//documentos transportados / municipios de descarga
		$nItem = 0;
		foreach($mdfe->infoDescarga as $d){
			$nItem++;

			$std = new \stdClass();
			$std->cMunDescarga = $d->cidade->codigo;
			$std->xMunDescarga = $d->cidade->nome;
			$std->nItem = $nItem;
			$make->taginfMunDescarga($std);

			$stdUnidTransp = new \stdClass();
			$stdUnidTransp->tpUnidTransp = $d->tp_unid_transp;
			$stdUnidTransp->idUnidTransp = $d->id_unid_transp;
			$stdUnidTransp->qtdRat = $d->quantidade_rateio;

			if($d->unidadeCarga){
				$stdUnidCarga = new \stdClass();
				$stdUnidCarga->idUnidCarga = $d->unidadeCarga->id_unidade_carga;
				$stdUnidCarga->qtdRat = $d->unidadeCarga->quantidade_rateio;

				if(count($d->lacresUnidCarga) > 0){
					$stdLac = new \stdClass();
					$stdLac->nLacre = $d->lacresUnidCarga->pluck('numero')->toArray();
					$stdUnidCarga->lacUnidCarga = $stdLac;
				}
				$stdUnidTransp->infUnidCarga = [$stdUnidCarga];
			}

			if(count($d->lacresTransp) > 0){
				$stdLacT = new \stdClass();
				$stdLacT->nLacre = $d->lacresTransp->pluck('numero')->toArray();
				$stdUnidTransp->lacUnidTransp = $stdLacT;
			}

			if($d->nfe){
				$stdNFe = new \stdClass();
				$stdNFe->chNFe = $d->nfe->chave;
				$stdNFe->SegCodBarra = $d->nfe->seg_cod_barras;
				$stdNFe->infUnidTransp = [$stdUnidTransp];
				$stdNFe->nItem = $nItem;
				$make->taginfNFe($stdNFe);
			}

			if($d->cte){
				$stdCTe = new \stdClass();
				$stdCTe->chCTe = $d->cte->chave;
				$stdCTe->SegCodBarra = $d->cte->seg_cod_barras;
				$stdCTe->infUnidTransp = [$stdUnidTransp];
				$stdCTe->nItem = $nItem;
				$make->taginfCTe($stdCTe);
			}
		}

		//seguradora (opcional)
		if($mdfe->seguradora_nome){
			$std = new \stdClass();
			$std->respSeg = 1; //1-emitente do MDFe
			$std->CNPJ = $cnpj;

			$infSeg = new \stdClass();
			$infSeg->xSeg = $mdfe->seguradora_nome;
			$infSeg->CNPJ = preg_replace('/[^0-9]/', '', $mdfe->seguradora_cnpj);
			$std->infSeg = $infSeg;

			$std->nApol = $mdfe->numero_apolice;
			$std->nAver = $mdfe->numero_averbacao ? [$mdfe->numero_averbacao] : null;

			$make->tagseg($std);
		}

		//produto predominante (obrigatorio para modal rodoviario)
		$std = new \stdClass();
		$std->tpCarga = $mdfe->tp_carga;
		$std->xProd = $mdfe->produto_pred_nome ?: 'CARGA GERAL';
		$std->cEAN = $mdfe->produto_pred_cod_barras;
		$std->NCM = preg_replace('/[^0-9]/', '', $mdfe->produto_pred_ncm);
		$make->tagprodPred($std);

		//totais
		$std = new \stdClass();
		$std->vCarga = $mdfe->valor_carga;
		$std->cUnid = '01'; //01-KG 02-TON
		$std->qCarga = $mdfe->quantidade_carga;
		$make->tagtot($std);

		//autorizados a baixar o xml
		$autXml = preg_replace('/[^0-9]/', '', $config->aut_xml);
		if(strlen($autXml) > 10){
			$std = new \stdClass();
			$std->CNPJ = $autXml;
			$make->tagautXML($std);
		}

		//informacoes adicionais
		if($mdfe->info_adicional_fisco || $mdfe->info_complementar){
			$std = new \stdClass();
			$std->infAdFisco = $mdfe->info_adicional_fisco;
			$std->infCpl = $mdfe->info_complementar;
			$make->taginfAdic($std);
		}

		//responsavel tecnico
		$std = new \stdClass();
		$std->CNPJ = getenv('RESP_CNPJ');
		$std->xContato = getenv('RESP_NOME');
		$std->email = getenv('RESP_EMAIL');
		$std->fone = getenv('RESP_FONE');
		$make->taginfRespTec($std);

		try{
			$make->montaMDFe();
			return [
				'chave' => $make->getChave(),
				'xml' => $make->getXML(),
				'nMDF' => $nMDF
			];
		}catch(\Exception $e){
			return [
				'xml_erros' => $make->getErrors()
			];
		}
	}

	public function sign($xml){
		return $this->tools->signMDFe($xml);
	}

	public function transmitir($signXml, $chave, $cnpj){
		try{
			$idLote = str_pad(rand(1, 999999999), 15, '0', STR_PAD_LEFT);
			$resp = $this->tools->sefazEnviaLote([$signXml], $idLote);
			sleep(6);

			$st = new Standardize($resp);
			$std = $st->toStd();

			if(!isset($std->infRec)){
				$arr = $st->toArray();
				return [
					'erro' => true,
					'protocolo' => $this->normalizeInfProt($arr),
					'status' => 402
				];
			}

			$recibo = $std->infRec->nRec;
			sleep(2);

			$protocolo = $this->tools->sefazConsultaRecibo($recibo);
			$stCl = new Standardize($protocolo);
			$arrProt = $stCl->toArray();

			$infProt = $this->findKey($arrProt, 'infProt');
			$cStat = $infProt['cStat'] ?? null;

			if($cStat == '100'){
				$xml = Complements::toAuthorize($signXml, $protocolo);

				if(!is_dir(public_path('xml_mdfe/' . $cnpj))){
					mkdir(public_path('xml_mdfe/' . $cnpj), 0777, true);
				}
				file_put_contents(public_path('xml_mdfe/' . $cnpj . '/' . $chave . '.xml'), $xml);

				return [
					'successo' => true,
					'chave' => $chave,
					'protocolo' => $infProt['nProt'] ?? null
				];
			}else{
				return [
					'erro' => true,
					'protocolo' => $this->normalizeInfProt($arrProt),
					'status' => 402
				];
			}
		}catch(\Exception $e){
			return [
				'erro' => true,
				'protocolo' => $e->getMessage(),
				'status' => 402
			];
		}
	}

	public function cancelar($mdfe, $justificativa, $cnpj){
		try{
			$chave = $mdfe->chave;
			$nProt = $mdfe->protocolo;

			$response = $this->tools->sefazCancela($chave, $justificativa, $nProt);
			sleep(2);

			$st = new Standardize($response);
			$arr = $st->toArray();
			$infEvento = $this->findKey($arr, 'infEvento');
			$cStat = $infEvento['cStat'] ?? null;

			if(in_array($cStat, ['135', '136', '155'])){
				$xml = Complements::toAuthorize($this->tools->lastRequest, $response);

				if(!is_dir(public_path('xml_mdfe_cancelado/' . $cnpj))){
					mkdir(public_path('xml_mdfe_cancelado/' . $cnpj), 0777, true);
				}
				file_put_contents(public_path('xml_mdfe_cancelado/' . $cnpj . '/' . $chave . '.xml'), $xml);

				return array_merge($arr, ['infEvento' => $infEvento]);
			}else{
				return [
					'erro' => true,
					'data' => array_merge($arr, ['infEvento' => $infEvento]),
					'status' => 402
				];
			}
		}catch(\Exception $e){
			return [
				'erro' => true,
				'data' => $e->getMessage(),
				'status' => 402
			];
		}
	}

	public function encerrar($mdfe, $cnpj, $cUF, $cMun){
		try{
			$chave = $mdfe->chave;
			$nProt = $mdfe->protocolo;

			$response = $this->tools->sefazEncerra($chave, $nProt, $cUF, $cMun);
			sleep(2);

			$st = new Standardize($response);
			$arr = $st->toArray();
			$infEvento = $this->findKey($arr, 'infEvento');
			$cStat = $infEvento['cStat'] ?? null;

			if(in_array($cStat, ['135', '136'])){
				$xml = Complements::toAuthorize($this->tools->lastRequest, $response);

				if(!is_dir(public_path('xml_mdfe_encerrado/' . $cnpj))){
					mkdir(public_path('xml_mdfe_encerrado/' . $cnpj), 0777, true);
				}
				file_put_contents(public_path('xml_mdfe_encerrado/' . $cnpj . '/' . $chave . '.xml'), $xml);

				return array_merge($arr, ['infEvento' => $infEvento]);
			}else{
				return [
					'erro' => true,
					'data' => array_merge($arr, ['infEvento' => $infEvento]),
					'status' => 402
				];
			}
		}catch(\Exception $e){
			return [
				'erro' => true,
				'data' => $e->getMessage(),
				'status' => 402
			];
		}
	}

	public function consultar($mdfe){
		try{
			$chave = $mdfe->chave;
			$response = $this->tools->sefazConsultaChave($chave);

			$st = new Standardize($response);
			$arr = $st->toArray();

			return $this->normalizeInfProt($arr, true);
		}catch(\Exception $e){
			return [
				'erro' => true,
				'message' => $e->getMessage()
			];
		}
	}

	/**
	 * Garante que a chave 'protMDFe' (e 'xMotivo' quando solicitado) fique
	 * disponivel no nivel raiz do array, independente de como o Standardize
	 * tenha aninhado a resposta da Sefaz.
	 */
	private function normalizeInfProt($arr, $withMotivo = false){
		if(!is_array($arr)){
			return $arr;
		}
		if(!isset($arr['protMDFe'])){
			$protMDFe = $this->findKey($arr, 'protMDFe');
			if($protMDFe){
				$arr['protMDFe'] = $protMDFe;
			}
		}
		if($withMotivo && !isset($arr['xMotivo'])){
			$xMotivo = $this->findKey($arr, 'xMotivo');
			if($xMotivo){
				$arr['xMotivo'] = $xMotivo;
			}
		}
		return $arr;
	}

	/**
	 * Busca recursivamente uma chave dentro de um array multi-nivel
	 */
	private function findKey($array, $key){
		if(!is_array($array)){
			return null;
		}
		if(array_key_exists($key, $array)){
			return $array[$key];
		}
		foreach($array as $value){
			if(is_array($value)){
				$found = $this->findKey($value, $key);
				if($found !== null){
					return $found;
				}
			}
		}
		return null;
	}
}
