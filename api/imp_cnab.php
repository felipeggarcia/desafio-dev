<?php
require_once '../models/database.php';
require_once '../lib/functions.php';

if(isset($_FILES['file-cnab'])){
    $con = new Database();
    $con=$con->connect();
    $myfile = fopen($_FILES['file-cnab']['tmp_name'], "r") or die("Unable to open file!");
    $strCnab=fread($myfile,filesize($_FILES['file-cnab']['tmp_name']));
    fclose($myfile);
    $arrCnab=decodificarCNAB($strCnab);
    $consulta = $con->query("SELECT * FROM tipo_transicao");
    $arrTipo=[];
    $response=[];
while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $arrTipo[]=$linha['tipo'];
}
    echo '<pre>';

    foreach ($arrCnab as $key =>$item){
        if (in_array($item['tipo']??'', $arrTipo)&&
            checkdate ( $item['data']['mes']??0, $item['data']['dia']??0, $item['data']['ano']??0 )&&
            is_numeric($item['valor']??'')&&
            validaCPF($item['cpf']??'')
            &&validaHora($item['hora']??'')
            ){
            $querySelect="SELECT id FROM transicoes
            WHERE tipo = '".$item['tipo']."' 
            AND  data = '".$item['data']['ano']."-".$item['data']['mes']."-".$item['data']['dia']."'
            AND  valor='".$item['valor']."' 
            AND  cpf='".$item['cpf']."' 
            AND  cartao ='".$item['cartao']."' 
            AND  hora ='".$item['hora']."' 
            AND  dono_loja ='".trim($item['dono_loja'])."' 
            AND  nome_loja ='".trim($item['nome_loja'])."' 
            ";
            $consulta=$con->query($querySelect);
            if(!$consulta->fetch(PDO::FETCH_ASSOC)){
                $queryInsert="INSERT INTO `transicoes`
                (`id`, `tipo`, `data`, `valor`, `cpf`, `cartao`, `hora`, `dono_loja`, `nome_loja`)VALUES
                (NULL,
                 '".$item['tipo']."',
                 '".$item['data']['ano']."-".$item['data']['mes']."-".$item['data']['dia']."',
                 '".$item['valor']."',' ".$item['cpf']."', '".$item['cartao']."', '".$item['hora']."', 
                 '".trim($item['dono_loja'])."','".trim($item['nome_loja'])."')";
                if($con->query($queryInsert)){
                    $response[$key]=1;
                }else{
                    $response[$key]=0;
                }

            }else{
                $response[$key]=0;
            }

        }else{
            $response[$key]=0;
        }
    }

    echo '<pre>';
    print_r($response);

    echo'</pre>';

 }else{

 }