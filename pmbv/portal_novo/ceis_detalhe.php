<?php
include ("../conexao.php");
include('funcoes.php');

$id = $_POST['id'];

$sqlUlt = mysql_query("SELECT * FROM CEIS WHERE id = '".$id."'");
$rsLinha2 = mysql_fetch_array($sqlUlt);

$sqlUlt2 = mysql_query("SELECT count(*) as total FROM CEIS WHERE id = '".$id."'");
$rsLinha22 = mysql_fetch_array($sqlUlt2);
?>

    <div id="resultado" class="help-block text-center">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>
                        <?php echo $rsLinha2['Nome'];?>
                        <br>
                        <small class="text-muted">atualizado em <?php echo date('d/m/Y H:i:s a', strtotime($rsLinha2['DtAtualizacao']))?></small>
                    </h4>

                    <table class="table table-striped">

                        <tbody>
                        <tr>
                            <td>Tipo de Pessoa</td>
                            <td><?php echo $rsLinha2['Tipo'];?></td>
                        </tr>
                        <tr>
                            <td>CNPJ</td>
                            <td><?php echo $rsLinha2['CNPJ'];?></td>
                        </tr>
                        <tr>
                            <td>Nome informado</td>
                            <td><?php echo $rsLinha2['Nome'];?></td>
                        </tr>

                        <tr>
                            <td>Quantidade de Registros</td>
                            <td><?php echo $rsLinha22['total'];?></td>
                        </tr>


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <?php



        $sql = "SELECT * FROM CEIS_INFO WHERE (Acao = 'Publicado') AND ( CdCEIS = ".$rsLinha2['id'].") ORDER BY PublicacaoSancao DESC";

        $sqlGlossario = mysql_query($sql);
        $Glossario = mysql_num_rows($sqlGlossario);

        $total = 0;
        for ($y = 0; $y < $Glossario; $y++){
        $verGlossario = mysql_fetch_array($sqlGlossario);

            $sqlSancao = mysql_query("SELECT * FROM CEIS_Sancao WHERE id = '".$verGlossario['TipoSancao']."'");
            $rsSancao = mysql_fetch_array($sqlSancao);

            $sqlEstru = mysql_query("SELECT * FROM estrutura WHERE CdEstrutura = '".$verGlossario['OrgaoSancionador']."'");
            $rsEstru = mysql_fetch_array($sqlEstru);

        ?>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>
                        DETALHES da SANÇÃO APLICADAS
                        <br>
                        <small class="text-muted">atualizado em <?php echo date('d/m/Y H:i:s a', strtotime($verGlossario['DtAtualizacao']))?></small>
                    </h4>

                    <table class="table table-striped">

                        <tbody>
                        <tr>
                            <td>Tipo da sanção</td>
                            <td><?php echo $rsSancao['Nome'];?></td>
                        </tr>
                        <tr>
                            <td>Fundamentação legal</td>
                            <td><?php echo $verGlossario['Fundamento'];?></td>
                        </tr>
                        <tr>
                            <td>Descrição da fundamentação legal</td>
                            <td><?php echo $verGlossario['Descricao'];?></td>
                        </tr>

                        <tr>
                            <td>Data de início da sanção</td>
                            <td>
                                <?php
                                if ($verGlossario['InicioSancao'] != "") {
                                    echo date('d/m/Y', strtotime($verGlossario['InicioSancao']));
                                }else{
                                    echo "**";
                                }
                                ?>
                                </td>
                        </tr>

                        <tr>
                            <td>Data de fim da sanção</td>
                            <td>
                                <?php
                                if ($verGlossario['FimSancao'] != "") {
                                    echo date('d/m/Y', strtotime($verGlossario['FimSancao']));
                                }else{
                                    echo "**";
                                }
                                ?>
                                </td>
                        </tr>

                        <tr>
                            <td>Data de publicação da sanção</td>
                            <td>
                                <?php
                                if ($verGlossario['PublicacaoSancao'] != "") {
                                    echo date('d/m/Y', strtotime($verGlossario['PublicacaoSancao']));
                                }else{
                                    echo "**";
                                }
                                ?>
                                </td>
                        </tr>

                        <tr>
                            <td>Publicação</td>
                            <td><?php echo $verGlossario['Publicacao'];?></td>
                        </tr>

                        <tr>
                            <td>Data em julgamento</td>
                            <td>
                                <?php
                                    if ($verGlossario['DtTransito'] != "") {
                                        echo date('d/m/Y', strtotime($verGlossario['DtTransito']));
                                    }else{
                                        echo "**";
                                }
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Número do processo</td>
                            <td><?php echo $verGlossario['Processo'];?></td>
                        </tr>

                        <tr>
                            <td>Órgão sancionador</td>
                            <td><?php echo $rsEstru['Nome'];?></td>
                        </tr>

                        <tr>
                            <td>Complemento do órgão sancionador</td>
                            <td><?php echo $verGlossario['ComplementoOrgao'];?></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
