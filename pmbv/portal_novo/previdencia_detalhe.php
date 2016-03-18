<?php
include ("../conexao.php");
include('funcoes.php');

$id = $_POST['id'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];


$sqlUlt = mysql_query("SELECT * FROM previdencia WHERE Acao = 'Publicado' AND id = '".$id."'");
$rsLinha2 = mysql_fetch_array($sqlUlt);

?>

    <div id="resultado" class="help-block text-center">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>
                        PREVIDÊNCIA: <?php echo $rsLinha2['Nome'];?>
                        <br>
                        <small class="text-muted">atualizado em <?php echo date('d/m/Y H:i:s a', strtotime($rsLinha2['DtAtualizacao']))?></small>
                    </h4>

                    <table class="table table-striped">

                        <tbody>
                        <tr>
                            <td><small>Banco</td>
                            <td><small><?php echo $rsLinha2['Banco'];?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th><small>Agência</small></th>
                                        <th><small>Conta</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><small><?php echo $rsLinha2['Agencia'];?></small></td>
                                        <td><small><?php echo $rsLinha2['Conta'];?></small></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>



                        <tr>
                            <td><small>Aplicação</small></td>
                            <td><small><?php echo $rsLinha2['Nome'];?></small></td>
                        </tr>

                        <tr>
                            <td><small>Tipo Aplicação</small></td>
                            <td><small><?php echo $rsLinha2['Tipo'];?></small></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="4">Concedente</th>
                                    </tr>
                                    <tr>
                                        <th><small>Saldo Anterior</small></th>
                                        <th><small>Aplicações (+)</small></th>
                                        <th><small>Resgates (-)</small></th>
                                        <th><small>Rendimento Líquido</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><small><?php echo 'R$ ' . number_format($rsLinha2['SaldoAnterior'], 2, ',', '.');?></small></td>
                                        <td><small><?php echo 'R$ ' . number_format($rsLinha2['Aplicacoes'], 2, ',', '.');?></small></td>
                                        <td><small><?php echo 'R$ ' . number_format($rsLinha2['Resgate'], 2, ',', '.');?></small></td>
                                        <td><small><?php echo 'R$ ' . number_format($rsLinha2['Rendimento'], 2, ',', '.');?></small></td>
                                    </tr>
                                    </tbody>
                                    <thead>
                                    <tr>
                                        <td colspan="2">Saldo Atual</td>
                                        <td colspan="2"><?php echo 'R$ ' . number_format($rsLinha2['Saldo'], 2, ',', '.');?></td>
                                    </tr>
                                    </thead>

                                </table>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    <h4>
                        ANEXOS
                        <br>
                    </h4>

                </div>
            </div>
        </div>
    </div>
