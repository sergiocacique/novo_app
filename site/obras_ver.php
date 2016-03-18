<?php
include ("conexao.php");
include ("funcoes.php");
$id = (string) $_POST['id'];
$CdPrefeitura = (string) $_POST['prefeitura'];


$sqlLinha = mysql_query("SELECT * FROM obras WHERE id = '".$id."'");
$rsLinha = mysql_fetch_array($sqlLinha);
?>
<div class="container">
    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8 pull-left">
            <h2 class="title title-d"> <strong></strong> </h2>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 pull-left">
            <div id="atualiza" class="pull-right hidden-xs">
                <div class="btn-group">
                    <button type="button" id="dashboardRange" class="btn type-d dropdown-toggle" data-toggle="dropdown">
                        <span>BUSCAR OBRAS</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        $sqlAnos = mysql_query("SELECT * FROM obras WHERE (CdPrefeitura = ".$CdPrefeitura.") AND Acao = 'Publicado' GROUP BY ano, mes ORDER BY ano DESC, mes DESC ");
                        $Anos = mysql_num_rows($sqlAnos);

                        for ($y = 0; $y < $Anos; $y++){
                            $verAnos = mysql_fetch_array($sqlAnos);
                            ?>
                            <li><a href="javascript:void(0)" onclick="carregaMesAno(<?php echo $verAnos['mes'];?>,<?php echo $verAnos['ano'];?>,<?php echo $verAnos['CdPrefeitura']?>)"><?php echo retorna_mes_extenso($verAnos['mes']);?> / <?php echo $verAnos['ano'];?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br clear="all">
</div>

<section id="ver" class="texto-simples container">
    <div class="row">
        <table class="table table-bordered table-striped">
            <colgroup>
                <col class="col-xs-1">
                <col class="col-xs-7">
            </colgroup>

            <tbody>
            <tr>
                <td>Processo</td>
                <td><?php echo $rsLinha['numero_processo'];?></td>
            </tr>
            <tr>
                <td>Obra</td>
                <td><?php echo $rsLinha['objeto'];?></td>
            </tr>

            <tr class="info">
                <td colspan="2">

                    <table class="table table-bordered table-striped">
                        <colgroup>
                            <col class="col-xs-4">
                            <col class="col-xs-4">
                            <col class="col-xs-4">
                        </colgroup>

                        <tbody>
                        <tr>
                            <td colspan="3">Concedente</td>
                        </tr>
                        <tr>
                            <td>Convênio</td>
                            <td>Recurso Próprio</td>
                            <td>Total (Convênio + Recurso Próprio)</td>
                        </tr>
                        <tr>
                            <td>R$ <?php echo number_format($rsLinha['convenio'], 2, ',', '.');?></td>
                            <td>R$ <?php echo number_format($rsLinha['recurso_proprio'], 2, ',', '.');?></td>
                            <td>R$ <?php echo number_format($rsLinha['total'], 2, ',', '.');?></td>
                        </tr>

                        </tbody>
                    </table>

                </td>
            </tr>
            <tr>
                <td>Valor gasto (R$)</td>
                <td><?php echo number_format($rsLinha['valor_realizado'], 2, ',', '.');?></td>
            </tr>

            <?php
            if ($rsLinha['fisico'] < 20){
                $valorCss = "progress-bar progress-bar-danger";
            }elseif ($rsLinha['fisico'] < 40){
                $valorCss = "progress-bar progress-bar-warning";
            }elseif ($rsLinha['fisico'] < 60){
                $valorCss = "progress-bar progress-bar-info";
            }elseif ($rsLinha['fisico'] < 75){
                $valorCss = "progress-bar";
            }elseif ($rsLinha['fisico'] < 100){
                $valorCss = "progress-bar progress-bar-success";
            }

            ?>
            <tr>
                <td>Execução</td>
                <td>
                    <div class="progress progress-striped">
                        <div class="<?php echo $valorCss;?>" role="progressbar" aria-valuenow="<?php echo $rsLinha['fisico'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $rsLinha['fisico'];?>%">
                            <span class="sr-only"><?php echo $rsLinha['fisico'];?>% Complete</span>
                            <div class="progress-text"><?php echo $rsLinha['fisico'];?>%</div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Observação</td>
                <td><?php echo $rsLinha['observacao'];?></td>
            </tr>

            </tbody>
        </table>
    </div>
</section>
