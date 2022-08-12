<html lang="pt-br">
    <?php
    include 'head.html';
    include 'header.html';
    require_once '../models/database.php';
    require_once '../lib/functions.php';
    $total=0;
    $objCon = new Database();
    $objCon = $objCon->connect();
    $strQuery = "SELECT DISTINCT nome_loja FROM `transicoes`;";
    $objConsulta = $objCon->query($strQuery);
    $arrLojas=[];
    while ($arrLinha = $objConsulta->fetch(PDO::FETCH_ASSOC)) {
        $arrLojas[] = $arrLinha['nome_loja'];
    }
    $strFiltrarLoja='';
    if(isset($_GET['loja'])){
        $strFiltrarLoja=$_GET['loja'];
    }

    ?>

    <body>
    <div class="tabela-container">
        <h2 style="width:100%">Registro de Transições</h2>
        <form action="resgistro_transicoes.php" method="get"  enctype="multipart/form-data">
            <h4>Filtrar por Loja</h4>
            <select name="loja" style="width: 200px">
                <option value=""></option>
                <?php
                foreach ($arrLojas as $strLoja){
                    $strSelected=$strFiltrarLoja==$strLoja?"selected":'';
                    echo '<option value="'.$strLoja.'"'.$strSelected.'>'.$strLoja.'</option>';
                }
                ?>
            </select>
            <input type="submit" value="Filtrar">
        </form>
    <br>
    <table>
        <tr>
            <th>Tipo</th>
            <th>Data</th>
            <th>Valor</th>
            <th>CPF</th>
            <th>Cartão</th>
            <th>Nome da Loja</th>
            <th>Dono da Loja</th>
        </tr>
        <?php


            //Exibir uma lista das operações importadas por lojas, e nesta lista deve conter um totalizador do saldo em cont
            $strQuery = "SELECT *  FROM transicoes
            JOIN tipo_transicao ON tipo_transicao.tipo=transicoes.tipo ";
            if($strFiltrarLoja)$strQuery.='WHERE nome_loja="'.$strFiltrarLoja.'"';
            $strQuery.="ORDER BY data,hora DESC ;";
            $objConsulta = $objCon->query($strQuery);

        while ($arrLinha = $objConsulta->fetch(PDO::FETCH_ASSOC)) {
            if($arrLinha['sinal']=='+'){
                echo '<tr class="entrada">';
                $total+=$arrLinha['valor']/100;
            }else{
                echo '<tr class="saida">';
                $total-=$arrLinha['valor']/100;
            }

            echo '<td>'.$arrLinha['descricao'].'</td>';
            echo '<td>'.date_format(date_create($arrLinha['data'].$arrLinha['hora']),"d/m/Y H:i:s").'</td>';
            echo '<td>R$ '.formataDinheiro($arrLinha['valor']/100) .'</td>';
            echo '<td>'.formataCPF($arrLinha['cpf']).'</td>';
            echo '<td>'.$arrLinha['cartao'].'</td>';
            echo '<td>'.trim($arrLinha['nome_loja']).'</td>';
            echo '<td>'.trim($arrLinha['dono_loja']).'</td>';


            echo '</tr>';
        }
        echo '</table>';
        echo '<br>';
        echo 'TOTAL: R$ '.formataDinheiro($total);
            //
            //
            //while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            //    echo "tipo: {$linha['tipo']} - descricao: {$linha['descricao']}<br />";
            //}

        ?>
    </div>

    <script async type="text/javascript" src="../script.js"></script>
    </body>
</html>