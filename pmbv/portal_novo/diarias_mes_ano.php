<?php
include ("../conexao.php");
include('funcoes.php');

$SelAno = $_POST['ano'];
$SelMes = $_POST['mes'];
?>
<?php

    $sqlUlt = mysql_query("SELECT * FROM diarias  WHERE Acao = 'Publicado' AND mes = ".$SelMes." AND ano = ".$SelAno." GROUP BY ano, mes ORDER BY ano DESC, mes DESC LIMIT 1");
    $rsLinha2 = mysql_fetch_array($sqlUlt);

    $Conta = mysql_num_rows($sqlUlt);

    ?>
    <div id="resultados" class="content">
        <div class="row text-left">
            <?php
            if ($Conta != 0) {
                ?>
                <div class="col-md-12">
                    <div class="heading-title heading-dotted text-center">
                        <h2>
                            DIÁRIAS
                        </h2>
                    </div>
                </div>
                <br clear="all"><br clear="all">
                <div id="anos" class="col-md-12">
                    <div class="col-md-1">
                    <div class="btn-group">
                        <button type="button" id="dashboardRange" class="btn btn-3d btn-black pull-right dropdown-toggle" data-toggle="dropdown">
                            <span><?php echo $SelAno;?></span>
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php
                            $sqlAnos = mysql_query("SELECT * FROM diarias WHERE  Acao = 'Publicado' GROUP BY ano ORDER BY ano DESC");
                            $Anos = mysql_num_rows($sqlAnos);

                            for ($y = 0; $y < $Anos; $y++){
                                $verAnos = mysql_fetch_array($sqlAnos);
                                ?>
                                <li><a href="javascript:void(0)" onclick="carregaAno(<?php echo $verAnos['ano'];?>)"><?php echo $verAnos['ano'];?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    </div>
                    <div class="col-md-11 text-left">
                    <?php

                    $sql = "SELECT * FROM diarias WHERE Acao = 'Publicado' AND ano = " . $SelAno . " AND Acao = 'Publicado' GROUP BY mes ORDER BY ano DESC, mes DESC";

                    $sqlGlossario = mysql_query($sql);
                    $Glossario = mysql_num_rows($sqlGlossario);

                    $total = 0;
                    $totalliberado = 0;
                    for ($y = 0; $y < $Glossario; $y++) {
                        $verGlossario = mysql_fetch_array($sqlGlossario);

                        if ($verGlossario['Acao'] == "Aguardando"){
                            $classStatus = "btn-red";
                        }else{
                            if ($verGlossario['mes'] == $SelMes){
                                $classStatus = "btn-purple";
                            }else{
                                $classStatus = "btn-dirtygreen";
                            }
                        }



                        ?>
                        <a onclick="carregaMesAno(<?php echo $verGlossario['mes']; ?>,<?php echo $verGlossario['ano']; ?>)" href="javascript:void(0)">
                            <i class="btn btn-3d <?php echo $classStatus;?>"><?php echo retorna_mes_extenso($verGlossario['mes']); ?> / <?php echo $verGlossario['ano']; ?></i>
                        </a>
                    <?php
                    }
                    ?>
                        </div>

                </div>
                <br clear="all"><br clear="all">
                <div id="verDados" class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <h4>
                                DIÁRIAS DE <?php echo retorna_mes_extenso($SelMes); ?> / <?php echo $SelAno; ?>
                                <br>
                                <small class="text-muted">atualizado em <?php echo date('d/m/Y H:i:s a', strtotime($rsLinha2['DtAtualizacao']))?></small>
                            </h4>
                            <div class="btn-group">
                                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" type="button">
                                    BAIXAR DIÁRIAS
                                    <i class="fa fa-arrow-down"></i>
                                </button>
                                <ul class="dropdown-menu text-left" role="menu">
                                    <li>
                                        <a href="javascript:void(0)">Tipo de arquivo</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="diariasXLS.php?mes=<?php echo $MesSelecionado;?>&ano=<?php echo $AnoSeleciona;?>&extensao=xls"> Excel (XLS)  </a>
                                    </li>
                                    <li>
                                        <a href="diariasXLS.php?mes=<?php echo $MesSelecionado;?>&ano=<?php echo $AnoSeleciona;?>&extensao=ods"> Open Office Calc (ODS)  </a>
                                    </li>
                                    <li>
                                        <a href="diariasXLS.php?mes=<?php echo $MesSelecionado;?>&ano=<?php echo $AnoSeleciona;?>&extensao=odt"> Open Office Writer (ODT)  </a>
                                    </li>

                                </ul>
                            </div><br clear="all">
                            <?php
                            $sql = "SELECT * FROM diarias WHERE  Acao = 'Publicado' AND mes = ".$SelMes." AND ano = ".$SelAno." ORDER BY Acao ASC";
                            $sqlGlossario = mysql_query($sql);
                            $Glossario = mysql_num_rows($sqlGlossario);

                            if ($Glossario == 0) {
                                ?>
                                <pre class="col-md-12 xdebug-var-dump" dir="ltr">vázio</pre>
                            <?php
                            }else{

                                $total = 0;
                                for ($y = 0; $y < $Glossario; $y++) {
                                    $verGlossario = mysql_fetch_array($sqlGlossario);


                                    ?>
                                    <div class="panel-body <?php if($y == 0){?>bordered-bottom<?php }?> text-left">
                                        <h4 class="text-muted text-left col-md-9" style="cursor: pointer" onclick="Mudarestado('<?php echo $y;?>')">
                                            <?php echo $verGlossario['nome'];?><br><br><small><?php echo $verGlossario['objetivo'];?></small><br><br>
                                        </h4>
                                        <?php
                                        if ($verGlossario['Acao'] == 'Publicado'){
                                            $color = "dirtygreen";
                                        }elseIf ($verGlossario['Acao'] == 'Aguardando'){
                                            $color = "amber";
                                        }else{
                                            $color = "red";
                                        }
                                        ?>

                                        <div class="col-md-10 col-md-offset-1 ocultar success" id="<?php echo $y;?>">
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-xs-3">
                                                    <col class="col-xs-6">
                                                </colgroup>
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><?php echo $verGlossario['objetivo'];?></td>
                                                </tr>
                                                <?php if ($verGlossario['cargo'] != ""){
                                                    ?>
                                                <tr>
                                                    <td>Cargo</td>
                                                    <td><?php echo $verGlossario['cargo'];?></td>
                                                </tr>
                                                <?php }?>
                                                <tr>
                                                    <td>Destino</td>
                                                    <td><?php echo $verGlossario['destino'];?></td>
                                                </tr>
                                                <?php if ($verGlossario['periodo'] != ""){?>
                                                    <tr>
                                                        <td>Periodo</td>
                                                        <td><?php echo $verGlossario['periodo'];?></td>
                                                    </tr>
                                                <?php }?>
                                                <tr>
                                                    <td>Diárias</td>
                                                    <td><?php echo  $verGlossario['dias'];?></td>
                                                </tr>
                                                <tr>
                                                    <td>Valor Diária R$</td>
                                                    <td><?php echo  'R$' . number_format($verGlossario['valor_diaria'], 2, ',', '.');?></td>
                                                </tr>
                                                <tr>
                                                    <td>Valor Bruto R$</td>
                                                    <td><?php echo  'R$' . number_format($verGlossario['valor_bruto'], 2, ',', '.');?></td>
                                                </tr>

                                                <tr>
                                                    <td> - Valor INSS R$</td>
                                                    <td><?php echo  'R$' . number_format($verGlossario['inss'], 2, ',', '.');?></td>
                                                </tr>

                                                <tr>
                                                    <td> - Valor IRFF R$</td>
                                                    <td><?php echo  'R$' . number_format($verGlossario['irff'], 2, ',', '.');?></td>
                                                </tr>
                                                <tr>
                                                    <td>Valor Liquido R$</td>
                                                    <td><?php echo  'R$' . number_format($verGlossario['valor_liquido'], 2, ',', '.');?></td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                <?php
                                }

                            }
                            ?>

                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php
            }else{
                ?>
                <h5>
                    Nenhum registro encontrado
                </h5>
            <?php
            }
            ?>
        </div>
    </div>
