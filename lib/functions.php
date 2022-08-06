<?php
function decodificarCNAB($strCnab)
{
    $arrCnab = explode(PHP_EOL,$strCnab);

    foreach ($arrCnab as $key =>$item){
        $arrDecodedCnab[$key]['tipo'] = mb_substr($item, 0, 1);
        $arrDecodedCnab[$key]['data'] = mb_substr($item, 1, 9);
        $arrDecodedCnab[$key]['valor'] = mb_substr($item, 9, 10)/100;
        $arrDecodedCnab[$key]['cpf'] = mb_substr($item, 19, 11);
        $arrDecodedCnab[$key]['cartao'] = mb_substr($item, 30, 12);
        $arrDecodedCnab[$key]['hora'] = mb_substr($item, 42, 6);
        $arrDecodedCnab[$key]['dono_loja'] = mb_substr($item, 48, 14);
        $arrDecodedCnab[$key]['nome_loja'] = mb_substr($item, 62, 19);
    }
    return $arrDecodedCnab;
}