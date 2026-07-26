<?php

namespace Tests\Concerns;

/**
 * Gera, em runtime, um certificado digital A1 (PKCS#12) autoassinado e o
 * grava no Business de teste, exatamente no formato que os Services fiscais
 * esperam (ver App\Http\Controllers\BusinessController::store/update):
 * - `certificado`: conteúdo binário bruto do .pfx.
 * - `senha_certificado`: senha em texto puro codificada em base64
 *   (os Services fazem `base64_decode($certificado->senha_certificado)`).
 *
 * Isso permite testar a MONTAGEM do XML (NFePHP\Common\Certificate::readPfx
 * só precisa conseguir abrir o PKCS#12 com a senha certa) sem depender de um
 * certificado real de homologação/produção da SEFAZ, que não existe neste
 * ambiente local.
 */
trait CreatesFiscalCertificate
{
    /**
     * Gera um par de chaves + certificado X509 autoassinado válido por 1 ano
     * e o empacota em um PKCS#12, aplicando o resultado no $business
     * informado (não persiste sozinho - chame ->save() se precisar, embora
     * setFiscalCertificateOn já salve por padrão).
     */
    protected function setFiscalCertificateOn($business, string $password = 'senha-teste-123'): void
    {
        $privateKey = openssl_pkey_new([
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ]);

        $dn = [
            'countryName' => 'BR',
            'organizationName' => 'Empresa Teste LTDA',
            'commonName' => 'EMPRESA TESTE LTDA:00000000000191',
        ];

        $csr = openssl_csr_new($dn, $privateKey, ['digest_alg' => 'sha256']);
        $x509 = openssl_csr_sign($csr, null, $privateKey, 365, ['digest_alg' => 'sha256']);

        $pfx = '';
        openssl_pkcs12_export($x509, $pfx, $privateKey, $password);

        $business->certificado = $pfx;
        $business->senha_certificado = base64_encode($password);
        $business->save();
    }
}
