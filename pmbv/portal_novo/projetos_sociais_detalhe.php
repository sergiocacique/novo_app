<?php
include ("../conexao.php");
include('funcoes.php');

$id = $_POST['id'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];


$sqlUlt = mysql_query("SELECT * FROM projetos_sociais WHERE Acao = 'Publicado' AND id = '".$id."'");
$rsLinha2 = mysql_fetch_array($sqlUlt);

?>

    <div id="resultado" class="help-block text-center">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>
                        PROJETOS SOCIAIS
                        <br>

                        <small class="text-muted"><?php
                            if ($rsLinha2['DtAtualizacao'] != ""){
                                echo "atualizado em ". date('d/m/Y H:i:s a', strtotime($rsLinha2['DtAtualizacao']));
                            }else{

                            }
                            ?></small>
                    </h4>

                    <table class="table table-striped">

                        <tbody>
                        <tr>
                            <td>PROJETO</td>
                            <td><?php echo $rsLinha2['servico'];?></td>
                        </tr>
                        <tr>
                            <td>PUBLICO</td>
                            <td><?php echo $rsLinha2['publico'];?></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th colspan="3">DESPESAS</th>
                                    </tr>
                                    <tr>
                                        <th>BOLSISTA</th>
                                        <th>DESPESAS COM BOLSISTA (R$)</th>
                                        <th>OUTRAS DESPESAS (R$)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?php echo 'R$ ' . number_format($rsLinha2['bolsista_qtd'], 2, ',', '.');?></td>
                                        <td><?php echo 'R$ ' . number_format($rsLinha2['bolsista_valor'], 2, ',', '.');?></td>
                                        <td><?php echo 'R$ ' . number_format($rsLinha2['outras_despesas'], 2, ',', '.');?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th colspan="3">RECURSO</th>
                                    </tr>
                                    <tr>
                                        <th>CONVÊNIOS (R$)</th>
                                        <th>FNAS (R$)</th>
                                        <th>RECURSO PRÓPRIO (R$)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>

                                        <td>
                                            <?php
                                            if ($rsLinha2['convenio'] != ""){
                                                echo  'R$ ' . number_format($rsLinha2['convenio'], 2, ',', '.');
                                            }else{
                                                echo "**";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($rsLinha2['FNAS'] != ""){
                                                echo  'R$ ' . number_format($rsLinha2['FNAS'], 2, ',', '.');
                                            }else{
                                                echo "**";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($rsLinha2['recurso_proprio'] != ""){
                                                echo  'R$ ' . number_format($rsLinha2['recurso_proprio'], 2, ',', '.');
                                            }else{
                                                echo "**";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>


                        <tr>
                            <td>TOTAL (R$)</td>
                            <td><?php echo 'R$ ' . number_format($rsLinha2['total'], 2, ',', '.');?></td>
                        </tr>

                        <tr>
                            <td>OBS.</td>
                            <td><?php echo $rsLinha2['obs'];?></td>
                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
