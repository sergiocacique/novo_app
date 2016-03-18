<?php
include ("../conexao.php");
include('funcoes.php');

$id = $_POST['id'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];


$sqlUlt = mysql_query("SELECT * FROM obras WHERE Acao = 'Publicado' AND id = '".$id."'");
$rsLinha2 = mysql_fetch_array($sqlUlt);

if ($rsLinha2['fisico'] < 20){
    $valorCss = "progress-bar progress-bar-danger";
}elseif ($rsLinha2['fisico'] < 40){
    $valorCss = "progress-bar progress-bar-warning";
}elseif ($rsLinha2['fisico'] < 60){
    $valorCss = "progress-bar progress-bar-info";
}elseif ($rsLinha2['fisico'] < 75){
    $valorCss = "progress-bar";
}elseif ($rsLinha2['fisico'] < 100){
    $valorCss = "progress-bar progress-bar-success";
}elseif ($rsLinha2['fisico'] > 98){
    $valorCss = "progress-bar progress-bar-success";
}
?>

    <div id="resultado" class="help-block text-center">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>
                        OBRAS DE <?php echo $rsLinha2['numero_processo'];?>
                        <br>
                        <small class="text-muted">atualizado em <?php echo date('d/m/Y H:i:s a', strtotime($rsLinha2['DtAtualizacao']))?></small>
                    </h4>

                    <table class="table table-striped">

                        <tbody>
                        <tr>
                            <td>Processo</td>
                            <td><?php echo $rsLinha2['numero_processo'];?></td>
                        </tr>
                        <tr>
                            <td>Objeto</td>
                            <td><?php echo $rsLinha2['objeto'];?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Convênio (R$)</th>
                                        <th>Recurso Próprio (R$)</th>
                                        <th>Valor Total (R$)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?php echo 'R$ ' . number_format($rsLinha2['convenio'], 2, ',', '.');?></td>
                                        <td><?php echo 'R$ ' . number_format($rsLinha2['recurso_proprio'], 2, ',', '.');?></td>
                                        <td><?php echo 'R$ ' . number_format($rsLinha2['total'], 2, ',', '.');?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td>Realizado (%)</td>
                            <td>
                                <div class="progress progress-striped">
                                    <div class="<?php echo $valorCss;?>" role="progressbar" aria-valuenow="<?php echo $rsLinha2['fisico'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $rsLinha2['fisico'];?>%">
                                        <span class="sr-only"><?php echo $rsLinha2['fisico'];?>% Complete</span>
                                        <div class="progress-text"><?php echo $rsLinha2['fisico'];?>%</div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Valor Realizado (R$)</td>
                            <td><?php echo 'R$ ' . number_format($rsLinha2['valor_realizado'], 2, ',', '.');?></td>
                        </tr>

                        <tr>
                            <td>Observação</td>
                            <td><?php echo $rsLinha2['observacao'];?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?php echo $rsLinha2['estatus'];?></td>
                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
