<?php
include ("../conexao.php");
include('funcoes.php');

$id = $_POST['id'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];


$sqlUlt = mysql_query("SELECT * FROM convenios WHERE Acao = 'Publicado' AND id = '".$id."'");
$rsLinha2 = mysql_fetch_array($sqlUlt);

?>

    <div id="resultado" class="help-block text-center">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>
                        CONVÊNIOS
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
                            <td>SIAFI</td>
                            <td><?php echo $rsLinha2['nunSIAFI'];?></td>
                        </tr>
                        <tr>
                            <td>Orgão</td>
                            <td><?php echo $rsLinha2['orgao'];?></td>
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
                                        <th>Valor Aprovado (R$)</th>
                                        <th>Valor Liberado (R$)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?php echo 'R$ ' . number_format($rsLinha2['aprovado'], 2, ',', '.');?></td>
                                        <td><?php echo 'R$ ' . number_format($rsLinha2['liberado'], 2, ',', '.');?></td>
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
                                        <th>Início da Vigência</th>
                                        <th>Fim da Vigência</th>
                                        <th>Publicação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <?php
                                            if ($rsLinha2['InicioVigencia'] != ""){
                                                echo date('d/m/Y', strtotime($rsLinha2['InicioVigencia']));
                                            }else{
                                                echo "**";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($rsLinha2['FimVigencia'] != ""){
                                                echo date('d/m/Y', strtotime($rsLinha2['FimVigencia']));
                                            }else{
                                                echo "**";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($rsLinha2['Publicacao'] != ""){
                                                echo date('d/m/Y', strtotime($rsLinha2['Publicacao']));
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
                            <td>Data Última Liberação</td>
                            <td>
                                <?php
                                if ($rsLinha2['DtUltLiberacao'] != ""){
                                    echo date('d/m/Y', strtotime($rsLinha2['DtUltLiberacao']));
                                }else{
                                    echo "**";
                                }
                                ?>
                                </td>
                        </tr>

                        <tr>
                            <td>Valor Última Liberação (R$)</td>
                            <td><?php echo 'R$ ' . number_format($rsLinha2['VlUltLiberacao'], 2, ',', '.');?></td>
                        </tr>

                        <tr>
                            <td>Contrapartida</td>
                            <td><?php echo 'R$ ' . number_format($rsLinha2['Contrapartida'], 2, ',', '.');?></td>
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
