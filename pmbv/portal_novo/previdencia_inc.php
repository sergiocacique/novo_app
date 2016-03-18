<?php
include ("../conexao.php");
include('funcoes.php');

?>
<div id="box_convenios">

</div>

<div class="pull-left">
    <p class="btn-group">
        <a title="Anterior" href="javascript:void(0)" onclick="buscaMes(<?php echo $mesAno = $mesAnterior.",".$anoAnterior?>)" class="btn btn-silc">
            <i class="tamFont fa fa-arrow-left"></i>
        </a>

        <a title="Escolher Período" href="javascript:void(0)" class="ConvMes btn btn-silc" data-toggle="modal" data-target="#pesquisa"><?php echo retorna_mes_extenso($MesSelecionado);?> de <?php echo $AnoSeleciona;?></a>
        <a title="Posterior" href="javascript:void(0)" onclick="buscaMes(<?php echo $mesAno = $mesSeguinte.",".$anoSeguinte?>)" class="btn btn-silc">
            <i class="tamFont fa fa-arrow-right"></i></a>
    </p>
</div>

<div id="corpo_servidor">
    <table class="table table-hover">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Saldo Anterior</th>
            <th>Saldo Atual</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $sql = "SELECT * FROM previdencia WHERE (Acao = 'Publicado') AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")";


        $sqlGlossario = mysql_query($sql);
        $Glossario = mysql_num_rows($sqlGlossario);

        $total = 0;
        for ($y = 0; $y < $Glossario; $y++){
            $verGlossario = mysql_fetch_array($sqlGlossario);

            $valor = $verGlossario['Saldo'];
            $total = $total + $valor;

            ?>

            <tr class='clickable-row' onclick="AbreModal(<?php echo $verGlossario['id'];?>)"  >
                <td><?php echo $verGlossario['Nome'];?></td>
                <td><?php echo $verGlossario['Tipo'];?></td>
                <td>R$ <?php echo number_format($verGlossario['SaldoAnterior'], 2, ',', '.');?></td>
                <td>R$ <?php echo number_format($verGlossario['Saldo'], 2, ',', '.');?></td>
            </tr>
        <?php
        }
        ?>
        

        </tbody>
    </table>
</div>

