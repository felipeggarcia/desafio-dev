<?php
require_once '../models/database.php';
require_once '../functions.php';

$objJson=json_decode(file_get_contents('php://input'));
if(isset($objJson->string_cnab)){
    $con = new Database();
    $con=$con->connect();
    $arrCnab=decodificarCNAB($objJson->string_cnab);
    $consulta = $con->query("SELECT * FROM tipo_transicao");
    $arrTipo=[];
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $arrTipo[]=$linha['tipo'];
    }
    $countErros=0;
    $countSucessos=0;
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
                    $countSucessos++;
                }else{
                    $countErros++;// erro de conecção com o banco de dados
                }

            }else{
                $countErros++;;//dado duplicado
            }

        }else{
            $countErros++;//não é dado válido
        }
    }
    $response='';
    if($countErros>0&&$countSucessos>0)$response = '{"error":1, "sucess":1,"message":';
    if($countErros==0&&$countSucessos>0)$response =  '{"error":0, "sucess":1,"message":';
    if($countErros>0&&$countSucessos==0)$response =  '{"error":1, "sucess":0,"message":';
    if($countErros==0&&$countSucessos==0)$response =  '{"error":0, "sucess":0,"message":';
$response.='"Foram feitas '.($countErros+$countSucessos).' tentativas de inserção de dados, onde '.$countSucessos.' foram um sucesso e '.$countErros.' falharam."}';
    print_r(($response));

 }else{
    echo '{"error":1, "message":"JSON enviado incorretamente"}';
}


