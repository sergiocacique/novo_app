<?php
include ("../conexao.php");
include('funcoes.php');
$DtFinal = date('Y-m-d', strtotime('-1 days'));
?>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>
                        EMPRESAS SANCIONADAS
                        <br>
                    </h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>CPF / CNPJ</th>
                            <th>Nome</th>
                            <th>Data Final</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $dDtAgora = date('Y-m-d');

                        $Nome = $_POST['objeto'];
                            $Nome = str_replace(" ","%", $Nome);
                            $Nome = str_replace("+","%", $Nome);


                        $sql = "SELECT * ,T1.id as IdCIEIS FROM CEIS T1 INNER JOIN CEIS_INFO T2 ON T1.id = T2.CdCEIS WHERE (Nome LIKE '%" . $Nome . "%' AND T2.Acao = 'Publicado') AND (FimSancao is null OR FimSancao >= '$dDtAgora') GROUP BY CNPJ ORDER BY PublicacaoSancao DESC ";
                        $sqlGlossario = mysql_query($sql);
                        $Glossario = mysql_num_rows($sqlGlossario);

                        $total = 0;
                        for ($y = 0; $y < $Glossario; $y++){
                            $verGlossario = mysql_fetch_array($sqlGlossario);

                            ?>

                            <tr class='clickable-row' onclick="verDetalhe(<?php echo $verGlossario['id'];?>)"  >
                                <td><small><?php echo $verGlossario['CNPJ'];?></small></td>
                                <td><small><?php echo $verGlossario['Nome'];?></small></td>
                                <td><small>
                                        <?php
                                        if ($verGlossario['FimSancao'] != "") {
                                            echo date('d/m/Y', strtotime($verGlossario['FimSancao']));
                                        }else{
                                            echo "**";
                                        }
                                        ?>
                                        </small></td>
                            </tr>
                        <?php
                        }
                        ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
