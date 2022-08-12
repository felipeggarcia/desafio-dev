
<?php include '../lib/functions.php';?>
<html>
<?php include 'head.html';?>
<body>
<?php include 'header.html';?>

<section >
    <form action="../api/imp_cnab.php" method="post"  enctype="multipart/form-data">
        <p></p>
        <h3>Importação CNAB</h3>
        <div class="import-form">
            <input type="file" id="file-cnab" name="file-cnab"  accept=".txt">
            <br>
            <input type="submit" value="Importar Dados">
        </div>
    </form>

</section>


<script async type="text/javascript" src="../script.js"></script>


</body>
</html>