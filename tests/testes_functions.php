<style>
    .sucesso{
        background: #02be3b;
    }
    .erro{
        background: red;
    }
</style>
<?php
require_once '../lib/functions.php';

echo '<p>Teste função formataDinheiro($valor)</p>';
    echo 'TESTE 1';
    echo '<br>';
    if(formataDinheiro(412.3)==='412,30'){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 2';
    echo '<br>';
    if(formataDinheiro(1412.3134123)==='1412,31'){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo '<hr>';

echo '<p>Teste função validaCPF($cpf)</p>';
    echo 'TESTE 1';
    echo '<br>';
    if(validaCPF(88393530032)){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 2';
    echo '<br>';
    if(!validaCPF(883935300312)){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 3';
    echo '<br>';
    if(!validaCPF(8839353003)){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 4';
    echo '<br>';
    if(!validaCPF(11111111111)){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 5';
    echo '<br>';
    if(validaCPF('10233514040')){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo '<hr>';

echo '<p>Teste função formataCPF($cpf)</p>';
    echo 'TESTE 1';
    echo '<br>';
    if(formataCPF('17666742088')==='176.667.420-88'){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 2';
    echo '<br>';
    if(formataCPF(17666742088)==='176.667.420-88'){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo '<hr>';
echo '<p>Teste função validaHora($hora)</p>';
    echo 'TESTE 1';
    echo '<br>';
    if(validaHora('19:39:55')){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 2';
    echo '<br>';
    if(!validaHora('25:39:55')){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 3';
    echo '<br>';
    if(!validaHora('19:69:55')){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 4';
    echo '<br>';
    if(!validaHora('19:49:75')){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo '<hr>';
echo '<p>Teste função decodificarCNAB($strCnab)</p>';
    echo 'TESTE 1';
    echo '<br>';
    $arrCNAB=decodificarCNAB('3201903010000014200096206760174753****3153153453JOÃO MACEDO   BAR DO JOÃO       
5201903010000013200556418150633123****7687145607MARIA JOSEFINALOJA DO Ó - MATRIZ');

    if(count($arrCNAB)===2){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 2';
    echo '<br>';
    if($arrCNAB['0']['tipo']==='3'){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 3';
    echo '<br>';
    if($arrCNAB['0']['data']['ano']==='2019'){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 4';
    echo '<br>';
    if($arrCNAB['0']['data']['mes']==='03'){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 5';
    echo '<br>';
    if($arrCNAB['0']['data']['dia']==='01'){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 6';
    echo '<br>';
    if($arrCNAB['0']['valor']==='0000014200'){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 7';
    echo '<br>';
    if($arrCNAB['0']['cpf']==='09620676017'){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 8';
    echo '<br>';
    if($arrCNAB['0']['cartao']==='4753****3153'){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 9';
    echo '<br>';
    if($arrCNAB['0']['hora']==='15:34:53'){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 10';
    echo '<br>';
    if($arrCNAB['0']['dono_loja']==='JOÃO MACEDO   '){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';
echo 'TESTE 11';
    echo '<br>';
    if($arrCNAB['1']['nome_loja']==='LOJA DO Ó - MATRIZ'){
        echo '<span class="sucesso">SUCESSO</span>';
    }else{
        echo '<span class="erro">ERRO</span>';
    }
echo '<br>';

