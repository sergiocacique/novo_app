<?php
include ("../conexao.php");
include('funcoes.php');

?>
<script>

    function buscaMes(mes,ano){
        $('#resultado').html("Pesquisando...");
        $.post("inc_convenios.php", { mes: mes, ano: ano },
            function(data){
                $('#resultado').html(data);
            });
    }



    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            carregaDadosClienteJSon(id);
            $('#modalVizualizar').modal('show');
        });
    });






</script>

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
            <th>SIAFI</th>
            <th>ORGÃO</th>
            <th>Aprovado</th>
            <th>Liberado</th>
        </tr>
        </thead>
        <tbody>
    <?php

    $sql = "SELECT * FROM convenios WHERE (Acao = 'Publicado') AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")";


    $sqlGlossario = mysql_query($sql);
    $Glossario = mysql_num_rows($sqlGlossario);

    $total = 0;
    $totalliberado = 0;
    for ($y = 0; $y < $Glossario; $y++){
    $verGlossario = mysql_fetch_array($sqlGlossario);

     $valor = $verGlossario['aprovado'];
        $total = $total + $valor;

    $valor1 = $verGlossario['liberado'];
    $totalliberado = $totalliberado + $valor1;
    ?>

        <tr class='clickable-row' onclick="AbreModal(<?php echo $verGlossario['id'];?>)">
            <td><?php echo $verGlossario['nunSIAFI'];?></td>
            <td><?php echo $verGlossario['orgao'];?></td>
            <td>R$ <?php echo number_format($verGlossario['aprovado'], 2, ',', '.');?></td>
            <td>R$ <?php echo number_format($verGlossario['liberado'], 2, ',', '.');?></td>
        </tr>
    <?php
    }
    ?>

<!--        <thead>-->
<!--        <tr class="warning">-->
<!--            <th></th>-->
<!--            <th></th>-->
<!--            <th>R$ --><?php //echo number_format($total, 2, ',', '.');?><!--</th>-->
<!--            <th>R$ --><?php //echo number_format($totalliberado, 2, ',', '.');?><!--</th>-->
<!--        </tr>-->
<!--        </thead>-->

        </tbody>
    </table>
</div>

