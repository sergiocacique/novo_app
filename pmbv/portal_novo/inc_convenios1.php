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
    $mesAnterior = 1;
    $anoAnterior = ($AnoSeleciona-1);
}
?>
<script>

    function buscaMes(mes,ano){
        $('#resultado').html("Pesquisando...");
        $.post("inc_convenios.php", { mes: mes, ano: ano },
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

        <a title="Escolher Período" href="javascript:void(0)" class="ConvMes btn btn-silc" data-toggle="modal" data-target="#pesquisa"><?php echo retorna_mes_extenso($MesSelecionado);?> de <?php echo $AnoSeleciona;?></a>
        <a title="Posterior" href="javascript:void(0)" onclick="buscaMes(<?php echo $mesAno = $mesSeguinte.",".$anoSeguinte?>)" class="btn btn-silc">
            <i class="tamFont fa fa-arrow-right"></i></a>
    </p>
</div>

<div id="corpo_servidor">
    <?php

    $sql = "SELECT * FROM convenios WHERE (Lixo = 'nao') AND (Ativo = 'sim') AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")";


    $sqlGlossario = mysql_query($sql);
    $Glossario = mysql_num_rows($sqlGlossario);

    $total = 0;
    for ($y = 0; $y < $Glossario; $y++){
    $verGlossario = mysql_fetch_array($sqlGlossario);

     $valor = $verGlossario['aprovado'];
        $total = $total + $valor;


    ?>
    <div id="convenio_table">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading<?php echo $y; ?>">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $y; ?>" aria-expanded="true" aria-controls="collapse<?php echo $y; ?>">
                            <span class="esquerda"><?php echo $verGlossario['nunSIAFI'];?> - <?php echo $verGlossario['orgao'];?></span>
                            <span class="direita">R$ <?php echo number_format($verGlossario['aprovado'], 2, ',', '.');?></span>
                        </a>
                    </h4>
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
                                    <td>SIAFI</td>
                                    <td><?php echo $verGlossario['nunSIAFI'];?></td>
                                </tr>
                                <tr>
                                    <td>Orgão</td>
                                    <td><?php echo $verGlossario['orgao'];?></td>
                                </tr>
                                <tr>
                                    <td>Objeto</td>
                                    <td><?php echo $verGlossario['objeto'];?></td>
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
                                                <td colspan="2">Concedente</td>
                                            </tr>
                                            <tr>
                                                <td>Aprovado</td>
                                                <td>Liberado</td>
                                            </tr>
                                            <tr>
                                                <td>R$ <?php echo number_format($verGlossario['aprovado'], 2, ',', '.');?></td>
                                                <td>R$ <?php echo number_format($verGlossario['liberado'], 2, ',', '.');?></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Vigência</td>
                                    <td><?php echo date('d/m/Y', strtotime($verGlossario['vigencia']));?></td>
                                </tr>
                                <tr>
                                    <td>Prorrogação solicitada</td>
                                    <td><?php echo $verGlossario['prorrogacao'];?></td>
                                </tr>

                                <?php
                                if ($verGlossario['execucao'] < 20){
                                    $valorCss = "progress-bar progress-bar-danger";
                                }elseif ($verGlossario['execucao'] < 40){
                                    $valorCss = "progress-bar progress-bar-warning";
                                }elseif ($verGlossario['execucao'] < 60){
                                    $valorCss = "progress-bar progress-bar-info";
                                }elseif ($verGlossario['execucao'] < 75){
                                    $valorCss = "progress-bar";
                                }elseif ($verGlossario['execucao'] < 100){
                                    $valorCss = "progress-bar progress-bar-success";
                                }

                                ?>
                                <tr>
                                    <td>Execução</td>
                                    <td>
                                        <div class="progress progress-striped">
                                            <div class="<?php echo $valorCss;?>" role="progressbar" aria-valuenow="<?php echo $verGlossario['execucao'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $verGlossario['execucao'];?>%">
                                                <span class="sr-only"><?php echo $verGlossario['execucao'];?>% Complete</span>
                                                <div class="progress-text"><?php echo $verGlossario['execucao'];?>%</div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><?php echo $verGlossario['estatus'];?></td>
                                </tr>
                                <tr>
                                    <td>Obs</td>
                                    <td><?php echo $verGlossario['observacao'];?></td>
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
    <div class="callout callout-warning" id="resultados">R$ <?php echo number_format($total, 2, ',', '.');?></div>
</div>