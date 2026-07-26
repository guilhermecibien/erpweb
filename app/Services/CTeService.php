<?php
namespace App\Services;

use NFePHP\CTe\MakeCTe;
use NFePHP\CTe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\CTe\Common\Standardize;
use App\Models\Business;
use App\Models\City;
use NFePHP\CTe\Complements;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

/**
 * Serviço responsável por montar, assinar, transmitir, cancelar e consultar
 * o CT-e (Conhecimento de Transporte Eletrônico), seguindo o mesmo padrão
 * de contrato de retorno usado em App\Services\NFeService.
 *
 * Observações / limitações assumidas (falta de homologação real com a SEFAZ):
 * - Série do CT-e é fixa em '1' (não existe coluna numero_serie_cte no banco).
 * - O CT-e é sempre emitido como "normal" (tpCTe = 0) e serviço "normal" (tpServ = 0).
 * - O tomador do serviço é sempre um dos participantes já cadastrados
 *   (Remetente/Expedidor/Recebedor/Destinatário - tag toma3), nunca um tomador
 *   avulso (toma4), pois o model Cte não guarda um contato de tomador próprio.
 * - Os campos de endereço do tomador (logradouro_tomador, numero_tomador, etc)
 *   são persistidos no banco mas não são usados na montagem do XML, pois a tag
 *   toma3 não carrega endereço próprio (usa o endereço do participante referenciado).
 * - Apenas o modal Rodoviário (01) grava dados adicionais (RNTRC do veículo).
 *   Os demais modais são aceitos pelo <ide>/<infModal> mas sem tags específicas.
 */
class CTeService
{
    private $config;
    private $tools;

    public function __construct($config, $certificado)
    {
        $this->config = $config;
        $this->tools = new Tools(
            json_encode($config),
            Certificate::readPfx($certificado->certificado, base64_decode($certificado->senha_certificado))
        );
        $this->tools->model('57');
    }

    public function gerarCTe($cte)
    {
        date_default_timezone_set('America/Belem');
        $business_id = request()->session()->get('user.business_id');
        $config = Business::getConfigCte($business_id, $cte);

        try {
            $make = new MakeCTe('PL_CTe_400');

            $stdInfCte = new \stdClass();
            $stdInfCte->versao = '4.00';
            $stdInfCte->Id = null;
            $make->taginfCTe($stdInfCte);

            $cteLast = $cte->lastCTe($cte);
            $nCT = (int) $cteLast + 1;

            $cnpj = preg_replace('/[^0-9]/', '', $config->cnpj);

            $municipioEnvio = $cte->municipioEnvio;
            $municipioInicio = City::find($cte->municipio_inicio);
            $municipioFim = City::find($cte->municipio_fim);

            if (!$municipioEnvio || !$municipioInicio || !$municipioFim) {
                return ['xml_erros' => ['Município de envio, início ou fim da prestação não informado corretamente.']];
            }

            $stdIde = new \stdClass();
            $stdIde->cUF = Business::getcUF($config->cidade->uf);
            $stdIde->cCT = rand(11111111, 99999999);
            $stdIde->CFOP = $config->cidade->uf != $municipioFim->uf ?
                $cte->natureza->cfop_saida_inter_estadual : $cte->natureza->cfop_saida_estadual;
            $stdIde->natOp = $this->retiraAcentos($cte->natureza->natureza);
            $stdIde->serie = '1';
            $stdIde->nCT = $nCT;
            $stdIde->dhEmi = date("Y-m-d\TH:i:sP");
            $stdIde->tpImp = 1;
            $stdIde->tpEmis = 1;
            $stdIde->cDV = 0;
            $stdIde->tpAmb = (int) $config->ambiente;
            $stdIde->tpCTe = 0;
            $stdIde->procEmi = 0;
            $stdIde->verProc = '1.0.0';
            $stdIde->indGlobalizado = $cte->globalizado;
            $stdIde->cMunEnv = $municipioEnvio->codigo;
            $stdIde->xMunEnv = $this->retiraAcentos($municipioEnvio->nome);
            $stdIde->UFEnv = $municipioEnvio->uf;
            $stdIde->modal = $cte->modal;
            $stdIde->tpServ = 0;
            $stdIde->cMunIni = $municipioInicio->codigo;
            $stdIde->xMunIni = $this->retiraAcentos($municipioInicio->nome);
            $stdIde->UFIni = $municipioInicio->uf;
            $stdIde->cMunFim = $municipioFim->codigo;
            $stdIde->xMunFim = $this->retiraAcentos($municipioFim->nome);
            $stdIde->UFFim = $municipioFim->uf;
            $stdIde->retira = $cte->retira;
            $stdIde->xDetRetira = $cte->detalhes_retira;
            $stdIde->indIEToma = 1;

            $make->tagide($stdIde);

            // toma3 - tomador é sempre um dos participantes já cadastrados
            $stdToma3 = new \stdClass();
            $stdToma3->toma = $cte->tomador;
            $make->tagtoma3($stdToma3);

            if ($cte->observacao) {
                $stdCompl = new \stdClass();
                $stdCompl->xObs = $this->retiraAcentos($cte->observacao);
                $make->tagcompl($stdCompl);
            }

            // EMITENTE
            $stdEmit = new \stdClass();
            $stdEmit->xNome = $config->razao_social;
            $stdEmit->xFant = $config->name;
            $stdEmit->IE = preg_replace('/[^0-9]/', '', $config->ie);
            $stdEmit->CRT = $config->regime;
            if (strlen($cnpj) == 11) {
                $stdEmit->CPF = $cnpj;
            } else {
                $stdEmit->CNPJ = $cnpj;
            }
            $make->tagemit($stdEmit);

            $stdEnderEmit = new \stdClass();
            $stdEnderEmit->xLgr = $config->rua;
            $stdEnderEmit->nro = $config->numero;
            $stdEnderEmit->xBairro = $config->bairro;
            $stdEnderEmit->cMun = $config->cidade->codigo;
            $stdEnderEmit->xMun = $this->retiraAcentos($config->cidade->nome);
            $stdEnderEmit->UF = $config->cidade->uf;
            $stdEnderEmit->CEP = preg_replace('/[^0-9]/', '', $config->cep);
            $stdEnderEmit->fone = preg_replace('/[^0-9]/', '', $config->telefone);
            $make->tagenderEmit($stdEnderEmit);

            // REMETENTE
            $remetente = $cte->remetente;
            $stdRem = new \stdClass();
            $stdRem->xNome = $remetente->name;
            $remCnpjCpf = preg_replace('/[^0-9]/', '', $remetente->cpf_cnpj);
            if (strlen($remCnpjCpf) == 14) {
                $stdRem->CNPJ = $remCnpjCpf;
            } else {
                $stdRem->CPF = $remCnpjCpf;
            }
            if ($remetente->ie_rg && $remetente->ie_rg != 'ISENTO') {
                $stdRem->IE = preg_replace('/[^0-9]/', '', $remetente->ie_rg);
            }
            $make->tagrem($stdRem);

            $stdEnderReme = new \stdClass();
            $stdEnderReme->xLgr = $remetente->rua;
            $stdEnderReme->nro = $remetente->numero;
            $stdEnderReme->xBairro = $remetente->bairro;
            if ($remetente->cidade) {
                $stdEnderReme->cMun = $remetente->cidade->codigo;
                $stdEnderReme->xMun = $this->retiraAcentos($remetente->cidade->nome);
                $stdEnderReme->UF = $remetente->cidade->uf;
            }
            $stdEnderReme->CEP = preg_replace('/[^0-9]/', '', $remetente->cep);
            $stdEnderReme->cPais = '1058';
            $stdEnderReme->xPais = 'BRASIL';
            $make->tagenderReme($stdEnderReme);

            // DESTINATARIO
            $destinatario = $cte->destinatario;
            $stdDest = new \stdClass();
            $stdDest->xNome = $destinatario->name;
            $destCnpjCpf = preg_replace('/[^0-9]/', '', $destinatario->cpf_cnpj);
            if (strlen($destCnpjCpf) == 14) {
                $stdDest->CNPJ = $destCnpjCpf;
            } else {
                $stdDest->CPF = $destCnpjCpf;
            }
            if ($destinatario->ie_rg && $destinatario->ie_rg != 'ISENTO') {
                $stdDest->IE = preg_replace('/[^0-9]/', '', $destinatario->ie_rg);
            }
            $make->tagdest($stdDest);

            $stdEnderDest = new \stdClass();
            $stdEnderDest->xLgr = $destinatario->rua;
            $stdEnderDest->nro = $destinatario->numero;
            $stdEnderDest->xBairro = $destinatario->bairro;
            if ($destinatario->cidade) {
                $stdEnderDest->cMun = $destinatario->cidade->codigo;
                $stdEnderDest->xMun = $this->retiraAcentos($destinatario->cidade->nome);
                $stdEnderDest->UF = $destinatario->cidade->uf;
            }
            $stdEnderDest->CEP = preg_replace('/[^0-9]/', '', $destinatario->cep);
            $stdEnderDest->cPais = '1058';
            $stdEnderDest->xPais = 'BRASIL';
            $make->tagenderDest($stdEnderDest);

            // VALOR DA PRESTAÇÃO
            $stdVPrest = new \stdClass();
            $stdVPrest->vTPrest = $this->format2($cte->valor_transporte);
            $stdVPrest->vRec = $this->format2($cte->valor_receber);
            $make->tagvPrest($stdVPrest);

            foreach ($cte->componentes as $componente) {
                $stdComp = new \stdClass();
                $stdComp->xNome = $componente->nome;
                $stdComp->vComp = $this->format2($componente->valor);
                $make->tagComp($stdComp);
            }

            // IMPOSTO ICMS
            $vBC = $this->format2($cte->valor_transporte);
            $pICMS = $this->format2($cte->perc_icms, 2);
            $stdICMS = new \stdClass();
            $stdICMS->cst = $cte->cst;
            $stdICMS->vBC = $vBC;
            $stdICMS->pICMS = $pICMS;
            $stdICMS->vICMS = $this->format2($vBC * ($cte->perc_icms / 100));
            $make->tagicms($stdICMS);

            // INFORMAÇÕES DA CARGA
            $make->taginfCTeNorm();

            $stdInfCarga = new \stdClass();
            $stdInfCarga->vCarga = $this->format2($cte->valor_carga);
            $stdInfCarga->proPred = $cte->produto_predominante;
            $make->taginfCarga($stdInfCarga);

            foreach ($cte->medidas as $medida) {
                $stdInfQ = new \stdClass();
                $stdInfQ->cUnid = $medida->cod_unidade;
                $stdInfQ->tpMed = $medida->tipo_medida;
                $stdInfQ->qCarga = $this->format($medida->quantidade_carga);
                $make->taginfQ($stdInfQ);
            }

            // DOCUMENTOS VINCULADOS
            $chavesNfe = [];
            if ($cte->chave_nfe) {
                $chavesNfe = array_filter(array_map('trim', explode(',', $cte->chave_nfe)));
            }

            if (!empty($chavesNfe)) {
                foreach ($chavesNfe as $chaveNfe) {
                    $stdInfNFe = new \stdClass();
                    $stdInfNFe->chave = preg_replace('/[^0-9]/', '', $chaveNfe);
                    $make->taginfNFe($stdInfNFe);
                }
            } elseif ($cte->tpDoc) {
                $stdInfOutros = new \stdClass();
                $stdInfOutros->tpDoc = $cte->tpDoc;
                $stdInfOutros->descOutros = $cte->descOutros;
                $stdInfOutros->nDoc = $cte->nDoc;
                $stdInfOutros->vDocFisc = $cte->vDocFisc ? $this->format2($cte->vDocFisc) : null;
                $make->taginfOutros($stdInfOutros);
            }

            // MODAL
            $stdInfModal = new \stdClass();
            $stdInfModal->versaoModal = '4.00';
            $make->taginfModal($stdInfModal);

            if ($cte->modal == '01') {
                $stdRodo = new \stdClass();
                $stdRodo->RNTRC = $cte->veiculo && $cte->veiculo->rntrc ? $cte->veiculo->rntrc : '';
                $make->tagrodo($stdRodo);
            }

            // AUTORIZADOS A BAIXAR O XML
            $autXml = preg_replace('/[^0-9]/', '', $config->aut_xml ?? '');
            if (strlen($autXml) > 10) {
                $stdAutXML = new \stdClass();
                $stdAutXML->CNPJ = $autXml;
                $make->tagautXML($stdAutXML);
            }

            // RESPONSÁVEL TÉCNICO
            $stdRespTec = new \stdClass();
            $stdRespTec->CNPJ = getenv('RESP_CNPJ');
            $stdRespTec->xContato = getenv('RESP_NOME');
            $stdRespTec->email = getenv('RESP_EMAIL');
            $stdRespTec->fone = getenv('RESP_FONE');
            $make->taginfRespTec($stdRespTec);

            $make->montaCTe();

            return [
                'chave' => $make->getChave(),
                'xml' => $make->getXML(),
                'nCT' => $nCT,
            ];
        } catch (\Exception $e) {
            $erros = isset($make) ? $make->getErrors() : [];
            if (empty($erros)) {
                $erros = [$e->getMessage()];
            }
            return ['xml_erros' => $erros];
        }
    }

    public function sign($xml)
    {
        return $this->tools->signCTe($xml);
    }

    public function transmitir($signedXml, $chave, $cnpj)
    {
        try {
            $response = $this->tools->sefazEnviaCTe($signedXml);
            $st = new Standardize();
            $std = $st->toStd($response);

            $cStat = $std->cStat ?? ($std->protCTe->infProt->cStat ?? null);
            $xMotivo = $std->xMotivo ?? ($std->protCTe->infProt->xMotivo ?? '');

            if ($cStat != 100) {
                return ['erro' => true, 'protocolo' => "[$cStat] - $xMotivo", 'status' => 402];
            }

            try {
                $xml = Complements::toAuthorize($signedXml, $response);

                if (!is_dir(public_path('xml_cte/' . $cnpj))) {
                    mkdir(public_path('xml_cte/' . $cnpj), 0777, true);
                }
                file_put_contents(public_path('xml_cte/' . $cnpj . '/' . $chave . '.xml'), $xml);

                $nProt = $std->protCTe->infProt->nProt ?? null;

                return ['successo' => true, 'recibo' => $nProt];
            } catch (\Exception $e) {
                return ['erro' => true, 'protocolo' => $e->getMessage(), 'status' => 401];
            }
        } catch (\Exception $e) {
            return ['erro' => true, 'protocolo' => $e->getMessage(), 'status' => 401];
        }
    }

    public function cancelar($cte, $justificativa, $cnpj)
    {
        try {
            $chave = $cte->chave;
            $response = $this->tools->sefazConsultaChave($chave);
            $stdCl = new Standardize($response);
            $arr = $stdCl->toArray();
            sleep(2);

            $nProt = $arr['protCTe']['infProt']['nProt'] ?? null;

            $response = $this->tools->sefazCancela($chave, $justificativa, $nProt);
            sleep(2);
            $stdCl = new Standardize($response);
            $std = $stdCl->toStd();
            $arr = $stdCl->toArray();

            $cStat = $std->cStat ?? ($std->retEventoCTe->infEvento->cStat ?? null);

            if ($cStat == '135' || $cStat == '155' || $cStat == '101') {
                $xml = Complements::toAuthorize($this->tools->lastRequest, $response);

                if (!is_dir(public_path('xml_cte_cancelado/' . $cnpj))) {
                    mkdir(public_path('xml_cte_cancelado/' . $cnpj), 0777, true);
                }
                file_put_contents(public_path('xml_cte_cancelado/' . $cnpj . '/' . $chave . '.xml'), $xml);

                return $arr;
            }

            return ['erro' => true, 'data' => $arr, 'status' => 402];
        } catch (\Exception $e) {
            return ['erro' => true, 'data' => $e->getMessage(), 'status' => 401];
        }
    }

    public function cartaCorrecao($cte, $correcao, $cnpj)
    {
        try {
            $chave = $cte->chave;
            $nSeqEvento = $cte->sequencia_cce + 1;
            $infCorrecao = [
                ['grupoAlterado' => 'Complemento', 'campoAlterado' => 'Observação',
                    'valorAlterado' => substr($correcao, 0, 1000)],
            ];

            $response = $this->tools->sefazCCe($chave, $infCorrecao, $nSeqEvento);
            sleep(2);

            $stdCl = new Standardize($response);
            $std = $stdCl->toStd();
            $arr = $stdCl->toArray();

            $cStat = $std->cStat ?? ($std->retEventoCTe->infEvento->cStat ?? null);

            if ($cStat == '135' || $cStat == '136') {
                $xml = Complements::toAuthorize($this->tools->lastRequest, $response);

                if (!is_dir(public_path('xml_cte_correcao/' . $cnpj))) {
                    mkdir(public_path('xml_cte_correcao/' . $cnpj), 0777, true);
                }
                file_put_contents(public_path('xml_cte_correcao/' . $cnpj . '/' . $chave . '.xml'), $xml);

                $cte->sequencia_cce = $nSeqEvento;
                $cte->save();

                return $arr;
            }

            return ['erro' => true, 'data' => $arr, 'status' => 402];
        } catch (\Exception $e) {
            return ['erro' => true, 'data' => $e->getMessage(), 'status' => 401];
        }
    }

    public function consultar($cte)
    {
        try {
            $chave = $cte->chave;
            $response = $this->tools->sefazConsultaChave($chave);

            $stdCl = new Standardize($response);
            $arr = $stdCl->toArray();

            return $arr;
        } catch (\Exception $e) {
            return ['erro' => true, 'data' => $e->getMessage(), 'status' => 401];
        }
    }

    public function format($number, $dec = 4)
    {
        return number_format((float) $number, $dec, ".", "");
    }

    public function format2($number, $dec = 2)
    {
        return number_format((float) $number, $dec, ".", "");
    }

    private function retiraAcentos($texto)
    {
        return preg_replace(
            array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/",
                "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/",
                "/(ñ)/", "/(Ñ)/", "/(ç)/", "/(Ç)/", "/(°)/"),
            explode(" ", "a A e E i I o O u U n N c C o"),
            $texto
        );
    }
}
