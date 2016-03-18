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
            <th>Nome</th>
            <th>Destino</th>
            <th>Periodo</th>
            <th>Valor</th>
        </tr>
        </thead>
        <tbody>
    <?php

    $sql = "SELECT * FROM diarias WHERE (acao = 'Publicado') AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")";


    $sqlGlossario = mysql_query($sql);
    $Glossario = mysql_num_rows($sqlGlossario);

    $total = 0;
    $totalliberado = 0;
    for ($y = 0; $y < $Glossario; $y++){
    $verGlossario = mysql_fetch_array($sqlGlossario);

     $valor = $verGlossario['valor_liquido'];
        $total = $total + $valor;

    ?>

        <tr class='clickable-row' onclick="AbreModal(<?php echo $verGlossario['id'];?>)"  >
            <td><?php echo $verGlossario['nome'];?></td>
            <td><?php echo $verGlossario['destino'];?></td>
            <td><?php echo $verGlossario['periodo'];?></td>
            <td>R$ <?php echo number_format($verGlossario['valor_liquido'], 2, ',', '.');?></td>
        </tr>
    <?php
    }
    ?>

        </tbody>
    </table>
</div>

