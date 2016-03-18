<?php
include ("../conexao.php");
include('funcoes.php');
if (isset($_POST['ano']) and ($_POST['ano'] != ''))
{
    $SelAno = $_POST['ano'];
    $SelAno = mysql_real_escape_string($SelAno);
}else{
    $SelAno = date('Y');
}

if (isset($_POST['mes']) and ($_POST['mes'] != ''))
{
    $SelMes = $_POST['mes'];
    $SelMes = mysql_real_escape_string($SelMes);
}else{
    $SelMes = date('n');
}

$MesSelecionado = $SelMes;
$AnoSeleciona = $SelAno;



$mesSeguinte = ($MesSelecionado+1);
$anoSeguinte = ($AnoSeleciona);

if($mesSeguinte > 12){
    $mesSeguinte = 1;
    $anoSeguinte = ($AnoSeleciona+1);
}


$mesAnterior = ($MesSelecionado-1);
$anoAnterior = ($AnoSeleciona);

if($mesAnterior == 0){
    $mesAnterior = 12;
    $anoAnterior = ($AnoSeleciona-1);
}
?>
<script>

    function buscaMes(mes,ano){
        $('#resultado').html("Pesquisando...");
        $.post("inc_projetos_sociais.php", { mes: mes, ano: ano },
            function(data){
                $('#resultado').html(data);
            });
    }


</script>

<div id="box_convenios">

</div>

<div class="pull-left">
    <p class="btn-group">
        <a title="Anterior" href="javascript:void(0)" onclick="buscaMes(<?php echo $mesAno = $mesAnterior.",".$anoAnterior?>)" class="btn btn-silc">
            <i class="tamFont fa fa-arrow-left"></i>
        </a>

        <a title="Escolher Período" class="ConvMes btn btn-silc" data-toggle="modal" data-target="#pesquisa"><?php echo retorna_mes_extenso($MesSelecionado);?> de <?php echo $AnoSeleciona;?></a>
        <a title="Posterior" href="javascript:void(0)" onclick="buscaMes(<?php echo $mesAno = $mesSeguinte.",".$anoSeguinte?>)" class="btn btn-silc">
            <i class="tamFont fa fa-arrow-right"></i></a>
    </p>
</div>

<div id="corpo_servidor">
    <?php

    $sql = "SELECT * FROM projetos_sociais WHERE (Acao = 'Publicado') AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")";


    $sqlGlossario = mysql_query($sql);
    $Glossario = mysql_num_rows($sqlGlossario);

    $total = 0;
    for ($y = 0; $y < $Glossario; $y++){
    $verGlossario = mysql_fetch_array($sqlGlossario);

     $valor = $verGlossario['total'];
        $total = $total + $valor;


    ?>
    <div id="convenio_table">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading<?php echo $y; ?>">
                        <a onclick="janelaEditarCliente(<?php echo $verGlossario['id'];?>)">
                            <span class="esquerda ta500"><?php echo $verGlossario['servico'];?></span>
                            <span class="direita negrito">R$ <?php echo number_format($verGlossario['total'], 2, ',', '.');?></span>
                        </a>
                </div>
                <div id="collapse<?php echo $y; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $y; ?>">
                    <div class="panel-body">
                        <div role="tabpanel">
                            <table class="table table-bordered table-striped">
                                <colgroup>
                                    <col class="col-xs-1">
                                    <col class="col-xs-7">
                                </colgroup>

                                <tbody>
                                <tr>
                                    <td>SERVIÇOS SOCIOASSISTENCIAIS</td>
                                    <td><?php echo $verGlossario['servico'];?></td>
                                </tr>
                                <tr>
                                    <td>PÚBLICO BENEFICIADO/ REFERENCIADO</td>
                                    <td><?php echo $verGlossario['publico'];?></td>
                                </tr>

                                <tr class="info">
                                    <td colspan="2">

                                        <table class="table table-bordered table-striped">
                                            <colgroup>
                                                <col class="col-xs-6">
                                                <col class="col-xs-6">
                                            </colgroup>

                                            <tbody>
                                            <tr>
                                                <td colspan="2">BOLSISTAS</td>
                                            </tr>
                                            <tr>
                                                <td>QUANT.</td>
                                                <td>VALOR (R$)</td>
                                            </tr>
                                            <tr>
                                                <td>R$ <?php echo $verGlossario['bolsista_qtd'];?></td>
                                                <td>R$ <?php echo number_format($verGlossario['bolsista_valor'], 2, ',', '.');?></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>

                                    </td>
                                </tr>
                                <tr>
                                    <td>OUTRAS DESPESAS (R$)</td>
                                    <td>R$ <?php echo number_format($verGlossario['outras_despesas'], 2, ',', '.');?></td>
                                </tr>
                                <tr class="info">
                                    <td colspan="2">

                                        <table class="table table-bordered table-striped">
                                            <colgroup>
                                                <col class="col-xs-6">
                                                <col class="col-xs-6">
                                                <col class="col-xs-6">
                                            </colgroup>

                                            <tbody>
                                            <tr>
                                                <td colspan="3">FONTE FINANCIAMENTO</td>
                                            </tr>
                                            <tr>
                                                <td>CONVÊNIO (R$)</td>
                                                <td>FNAS (R$)</td>
                                                <td>RECURSO PRÓPRIO (R$)</td>
                                            </tr>
                                            <tr>
                                                <td>R$ <?php echo number_format($verGlossario['convenio'], 2, ',', '.');?></td>
                                                <td>R$ <?php echo number_format($verGlossario['FNAS'], 2, ',', '.');?></td>
                                                <td>R$ <?php echo number_format($verGlossario['recurso_proprio'], 2, ',', '.');?></td>
                                            </tr>

                                            </tbody>
                                        </table>

                                    </td>
                                </tr>
                                <tr>
                                    <td>TOTAL (R$)</td>
                                    <td>R$ <?php echo number_format($verGlossario['total'], 2, ',', '.');?></td>
                                </tr>

                                <tr>
                                    <td>OBSERVAÇÃO</td>
                                    <td><?php echo $verGlossario['obs'];?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>