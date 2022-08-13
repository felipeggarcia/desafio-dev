
<?php include '../lib/functions.php';?>
<html>
<?php include 'head.html';?>
<body>
<?php include 'header.html';?>

<section >
    <form action="importacao.php" method="post" enctype="multipart/form-data">
        <p></p>
        <h3>Importação CNAB</h3>
        <div class="import-form">
            <input type="file" id="file-cnab" name="file-cnab"  accept=".txt">
            <br>
            <input type="submit" value="Importar Dados">
        </div>
    </form>
<?php
    if(isset($_FILES['file-cnab'])){
        $myfile = fopen($_FILES['file-cnab']['tmp_name'], "r") ;
        $strCnab=fread($myfile,filesize($_FILES['file-cnab']['tmp_name']));
        fclose($myfile);
        $url = "http://$_SERVER[HTTP_HOST]/desafio-dev/lib/api/imp_cnab.php";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $data='{"string_cnab":'.json_encode($strCnab).'}';
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $resp = curl_exec($curl);
        curl_close($curl);
        $objResp=json_decode($resp);
        if($objResp->error&&$objResp->sucess) echo '<div class="message warning">';
        if(!$objResp->error&&$objResp->sucess) echo '<div class="message sucess">';
        if($objResp->error&&!$objResp->sucess) echo '<div class="message error">';

        echo $objResp->message ;
        echo '</div>';
    }
?>
</section>


<script async type="text/javascript" src="../script.js"></script>


</body>
</html>