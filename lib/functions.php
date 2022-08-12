<?php
function decodificarCNAB($strCnab): array
{
    $arrCnab = explode(PHP_EOL,$strCnab);

    foreach ($arrCnab as $key =>$item){
        if(mb_substr($item, 0, 1)){//validar os dados aqui
            $arrDecodedCnab[$key]['tipo'] = mb_substr($item, 0, 1);
            $arrDecodedCnab[$key]['data']['ano'] = mb_substr($item, 1, 4);
            $arrDecodedCnab[$key]['data']['mes'] = mb_substr($item, 5, 2);
            $arrDecodedCnab[$key]['data']['dia'] = mb_substr($item, 7, 2);
            $arrDecodedCnab[$key]['valor'] = mb_substr($item, 9, 10);
            $arrDecodedCnab[$key]['cpf'] = mb_substr($item, 19, 11);
            $arrDecodedCnab[$key]['cartao'] = mb_substr($item, 30, 12);
            $arrDecodedCnab[$key]['hora']= mb_substr($item, 42, 2).':'.mb_substr($item, 44, 2).':'.mb_substr($item, 46, 2);
            $arrDecodedCnab[$key]['dono_loja'] = mb_substr($item, 48, 14);
            $arrDecodedCnab[$key]['nome_loja'] = mb_substr($item, 62, 19);
        }

    }
    return $arrDecodedCnab;
}
function validaCPF($cpf): bool
{
    $cpf = preg_replace('/D/is', '', $cpf);

    if (strlen($cpf) != 11) {
        return false;
    }

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

function validaHora($hora){
    return  preg_match("#([0-1]\d|2[0-3]):[0-5]\d:[0-5]\d#", $hora);
}
function formataCPF($cpf){
    return substr($cpf, 0, 3).'.'.substr($cpf, 3, 3).'.'.substr($cpf, 6, 3).'-'.substr($cpf, 9, 2);
}
function formataDinheiro($valor){
    return number_format(round( $valor,2, PHP_ROUND_HALF_DOWN),2,',','');
}
