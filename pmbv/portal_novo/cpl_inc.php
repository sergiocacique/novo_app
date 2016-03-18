<?php
include ("../conexao.php");
include('funcoes.php');

?>
<script>

    function buscaMes(mes,ano){
        $('#resultado').html("Pesquisando...");
        $('html, body').animate({scrollTop:0}, 'slow');
        $.post("cpl_inc.php", { mes: mes, ano: ano },
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
            <th>Processo</th>
            <th>unidade</th>
            <th>Vencedor</th>
            <th>Valor</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $sql = "SELECT * FROM cpl WHERE (Acao = 'Aprovado') AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")";


        $sqlGlossario = mysql_query($sql);
        $Glossario = mysql_num_rows($sqlGlossario);

        $total = 0;
        for ($y = 0; $y < $Glossario; $y++){
            $verGlossario = mysql_fetch_array($sqlGlossario);

            $valor = $verGlossario['Valor'];
            $total = $total + $valor;

            $sql2 = "SELECT * FROM cpl_empresa WHERE (CdCPL = ".$verGlossario['id'].") AND (Acao = 'Aprovado') AND (Situacao = 'Ganhadora')";
            $sqlEmpresa = mysql_query($sql2);
            $Empresa = mysql_num_rows($sqlEmpresa);

            ?>

            <tr class='clickable-row' onclick="AbreModal(<?php echo $verGlossario['id'];?>)">
                <td><?php echo $verGlossario['Processo'];?></td>
                <td><?php echo $verGlossario['Unidade'];?></td>
                <td class="txtResumido"><?php
                    for ($x = 0; $x < $Empresa; $x++){
                        $verEmpresa = mysql_fetch_array($sqlEmpresa);

                        echo $verEmpresa['Nome']."<br>";
                    }
                    ?></td>
                <td><?php echo 'R$' . number_format($verGlossario['Valor'], 2, ',', '.');?></td>
            </tr>
        <?php
        }
        ?>

        </tbody>
    </table>
</div>

