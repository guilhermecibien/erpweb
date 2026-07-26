<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Validates a CPF (11 digits) or CNPJ (14 digits) check-digit algorithm.
 * Digit-check logic mirrors PedidoEcommerceController::validaCPF()/validaCNPJ().
 */
class ValidaDocumento implements Rule
{
    public function passes($attribute, $value)
    {
        $documento = preg_replace('/[^0-9]/', '', (string) $value);

        if (strlen($documento) == 11) {
            return $this->validaCPF($documento);
        }

        if (strlen($documento) == 14) {
            return $this->validaCNPJ($documento);
        }

        return false;
    }

    public function message()
    {
        return 'O :attribute informado é inválido.';
    }

    private function validaCPF($cpf)
    {
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    private function validaCNPJ($cnpj)
    {
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }

        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;
        if ($cnpj[13] != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }

        return true;
    }
}
