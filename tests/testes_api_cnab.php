<style>
    .sucesso {
        background: #02be3b;
    }
    .erro {
        background: red;
    }
</style>
<?php
require_once '../lib/functions.php';
require_once '../lib/models/database.php';
$strCnab = "3201903010000014200096206760174753****3153153453JOÃO MACEDO   BAR DO JOÃO       
5201903010000013200556418150633123****7687145607MARIA JOSEFINALOJA DO Ó - MATRIZ
3201903010000012200845152540736777****1313172712MARCOS PEREIRAMERCADO DA AVENIDA
2201903010000011200096206760173648****0099234234JOÃO MACEDO   BAR DO JOÃO       
1201903010000015200096206760171234****7890233000JOÃO MACEDO   BAR DO JOÃO       
2201903010000010700845152540738723****9987123333MARCOS PEREIRAMERCADO DA AVENIDA
2201903010000050200845152540738473****1231231233MARCOS PEREIRAMERCADO DA AVENIDA
3201903010000060200232702980566777****1313172712JOSÉ COSTA    MERCEARIA 3 IRMÃOS
1201903010000020000556418150631234****3324090002MARIA JOSEFINALOJA DO Ó - MATRIZ
5201903010000080200845152540733123****7687145607MARCOS PEREIRAMERCADO DA AVENIDA
2201903010000010200232702980568473****1231231233JOSÉ COSTA    MERCEARIA 3 IRMÃOS
3201903010000610200232702980566777****1313172712JOSÉ COSTA    MERCEARIA 3 IRMÃOS
4201903010000015232556418150631234****6678100000MARIA JOSEFINALOJA DO Ó - FILIAL
8201903010000010203845152540732344****1222123222MARCOS PEREIRAMERCADO DA AVENIDA
3201903010000010300232702980566777****1313172712JOSÉ COSTA    MERCEARIA 3 IRMÃOS
9201903010000010200556418150636228****9090000000MARIA JOSEFINALOJA DO Ó - MATRIZ
4201906010000050617845152540731234****2231100000MARCOS PEREIRAMERCADO DA AVENIDA
2201903010000010900232702980568723****9987123333JOSÉ COSTA    MERCEARIA 3 IRMÃOS
8201903010000000200845152540732344****1222123222MARCOS PEREIRAMERCADO DA AVENIDA
2201903010000000500232702980567677****8778141808JOSÉ COSTA    MERCEARIA 3 IRMÃOS
3201903010000019200845152540736777****1313172712MARCOS PEREIRAMERCADO DA AVENIDA";
$url = "http://$_SERVER[HTTP_HOST]/lib/api/imp_cnab.php";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$data = '{"stringcnab":' . json_encode($strCnab) . '}';
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$resp = curl_exec($curl);
//curl_close($curl);
$objResp = json_decode($resp);
//
echo '<p>Teste api de importação</p>';
echo 'TESTE 1';
echo '<br>';
if ($objResp->error === 1 && $objResp->message === 'JSON enviado incorretamente') {
    echo '<span class="sucesso">SUCESSO</span>';
} else {
    echo '<span class="erro">ERRO</span>';
}
echo '<br>';
$data = '{"string_cnab":' . json_encode($strCnab) . '}';
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$resp = curl_exec($curl);
$objResp = json_decode($resp);

$con = new Database();
$con = $con->connect();

$arrCnab = decodificarCNAB($strCnab);
foreach ($arrCnab as $key => $item) {
    $querySelect = "SELECT id FROM transicoes
            WHERE tipo = '" . $item['tipo'] . "'
            AND  data = '" . $item['data']['ano'] . "-" . $item['data']['mes'] . "-" . $item['data']['dia'] . "'
            AND  valor='" . $item['valor'] . "'
            AND  cpf='" . $item['cpf'] . "'
            AND  cartao ='" . $item['cartao'] . "'
            AND  hora ='" . $item['hora'] . "'
            AND  dono_loja ='" . trim($item['dono_loja']) . "'
            AND  nome_loja ='" . trim($item['nome_loja']) . "'
            ";
    $consulta = $con->query($querySelect);
    if ($consulta->fetch(PDO::FETCH_ASSOC)) {
        $queryDelete = "DELETE FROM transicoes WHERE tipo = '" . $item['tipo'] . "'
            AND  data = '" . $item['data']['ano'] . "-" . $item['data']['mes'] . "-" . $item['data']['dia'] . "'
            AND  valor='" . $item['valor'] . "'
            AND  cpf='" . $item['cpf'] . "'
            AND  cartao ='" . $item['cartao'] . "'
            AND  hora ='" . $item['hora'] . "'
            AND  dono_loja ='" . trim($item['dono_loja']) . "'
            AND  nome_loja ='" . trim($item['nome_loja']) . "'
            ";
        $con->query($queryDelete);

    }
}
$data = '{"string_cnab":' . json_encode($strCnab) . '}';
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$resp = curl_exec($curl);
$objResp = json_decode($resp);
echo 'TESTE 2';
echo '<br>';
if ($objResp->error === 0 && $objResp->sucess === 1 && $objResp->message === 'Foram feitas 21 tentativas de inserção de dados, onde 21 foram um sucesso e 0 falharam.') {
    echo '<span class="sucesso">SUCESSO</span>';
} else {
    echo '<span class="erro">ERRO</span>';
}
//$data = '{"string_cnab":' . json_encode($strCnab) . '}';
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$resp = curl_exec($curl);
$objResp = json_decode($resp);
echo '<br>';
echo 'TESTE 3';
echo '<br>';
if ($objResp->error === 1 && $objResp->sucess === 0 && $objResp->message === 'Foram feitas 21 tentativas de inserção de dados, onde 0 foram um sucesso e 21 falharam.') {
    echo '<span class="sucesso">SUCESSO</span>';
} else {
    echo '<span class="erro">ERRO</span>';
}

foreach ($arrCnab as $key => $item) {
    $querySelect = "SELECT id FROM transicoes
            WHERE tipo = '" . $item['tipo'] . "'
            AND  data = '" . $item['data']['ano'] . "-" . $item['data']['mes'] . "-" . $item['data']['dia'] . "'
            AND  valor='" . $item['valor'] . "'
            AND  cpf='" . $item['cpf'] . "'
            AND  cartao ='" . $item['cartao'] . "'
            AND  hora ='" . $item['hora'] . "'
            AND  dono_loja ='" . trim($item['dono_loja']) . "'
            AND  nome_loja ='" . trim($item['nome_loja']) . "'
            ";
    $consulta = $con->query($querySelect);
    if ($consulta->fetch(PDO::FETCH_ASSOC)) {
        $queryDelete = "DELETE FROM transicoes WHERE tipo = '" . $item['tipo'] . "'
            AND  data = '" . $item['data']['ano'] . "-" . $item['data']['mes'] . "-" . $item['data']['dia'] . "'
            AND  valor='" . $item['valor'] . "'
            AND  cpf='" . $item['cpf'] . "'
            AND  cartao ='" . $item['cartao'] . "'
            AND  hora ='" . $item['hora'] . "'
            AND  dono_loja ='" . trim($item['dono_loja']) . "'
            AND  nome_loja ='" . trim($item['nome_loja']) . "'
            ";
        $con->query($queryDelete);

    }
}
$strCnab = "3201903010000014200096206760174753****3153153453JOÃO MACEDO   BAR DO JOÃO       
5201903010000013200556418150633123****7687145607MARIA JOSEFINALOJA DO Ó - MATRIZ
3201903010000012200845152540736777****1313172712MARCOS PEREIRAMERCADO DA AVENIDA
2201903010000011200096206760173648****009923423JOÃO MACEDO   BAR DO JOÃO       
1201903010000015200096206760171234****7890233000JOÃO MACEDO   BAR DO JOÃO       
2201903010000010700845152540738723****9987123333MARCOS PEREIRAMERCADO DA AVENIDA
22019030100000502008451152540738473****1231231233MARCOS PEREIRAMERCADO DA AVENIDA
3201903010000060200232702980566777****1313172712JOSÉ COSTA    MERCEARIA 3 IRMÃOS
1201903010000020000556418150631234****3324090002MARIA JOSEFINALOJA DO Ó - MATRIZ
5201903010000080200845152540733123****7687145607MARCOS PEREIRAMERCADO DA AVENIDA
22019030100000102002327029280568473****1231231233JOSÉ COSTA    MERCEARIA 3 IRMÃOS
3201903010000610200232702980566777****1313172712JOSÉ COSTA    MERCEARIA 3 IRMÃOS
4201903010000015232556418150631234****6678100000MARIA JOSEFINALOJA DO Ó - FILIAL
8201903010000010203845152540732344****1222123222MARCOS PEREIRAMERCADO DA AVENIDA
3201903010000010300232702980566777****1313172712JOSÉ COSTA    MERCEARIA 3 IRMÃOS
9201903010000010200556418150636228****9090000000MARIA JOSEFINALOJA DO Ó - MATRIZ
4201906010000050617845152540731234****2231100000MARCOS PEREIRAMERCADO DA AVENIDA
2201903010000010900232702980568723****9987123333JOSÉ COSTA    MERCEARIA 3 IRMÃOS
2201903010000000500232702980567677****8778141808JOSÉ COSTA    MERCEARIA 3 IRMÃOS3201903010000019200845152540736777****1313172712MARCOS PEREIRAMERCADO DA AVENIDA";

$data = '{"string_cnab":' . json_encode($strCnab) . '}';
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$resp = curl_exec($curl);
$objResp = json_decode($resp);
echo '<br>';
echo 'TESTE 4';
echo '<br>';
if ($objResp->error === 1 && $objResp->sucess === 1 && $objResp->message === 'Foram feitas 19 tentativas de inserção de dados, onde 15 foram um sucesso e 4 falharam.') {
    echo '<span class="sucesso">SUCESSO</span>';
} else {
    echo '<span class="erro">ERRO</span>';
}

