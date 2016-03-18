<script>
    function Mudarestado(el) {
        var display = document.getElementById(el).style.display;
        if(display == "block")
            document.getElementById(el).style.display = 'none';
        else
            document.getElementById(el).style.display = 'block';
    }

    function carregaAno(ano){
        $('#loading2').css('visibility','visible');
        $.post("passagens_ano.php", { ano: ano },
            function(data){
                $('#anos').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    function carregaMesAno(mes,ano){
        $('#loading2').css('visibility','visible');
        $.post("passagens_mes_ano.php", { mes: mes, ano: ano },
            function(data){
                $('#resultado').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }
</script>
<section class="content-wrapper content-midwet">
    <div id="resultado">
        <?php
        $sqlUlt = mysql_query("SELECT * FROM passagens WHERE Acao = 'Publicado' GROUP BY DATE_FORMAT(DtViagem, '%Y'), DATE_FORMAT(DtViagem, '%m') ORDER BY DATE_FORMAT(DtViagem, '%Y') DESC, DATE_FORMAT(DtViagem, '%m') DESC LIMIT 1");
        $rsLinha2 = mysql_fetch_array($sqlUlt);

        $Conta = mysql_num_rows($sqlUlt);

        $MesSelecionado = date('m', strtotime($rsLinha2['DtViagem']));
        $AnoSeleciona = date('Y', strtotime($rsLinha2['DtViagem']));
        ?>
        <div id="resultados" class="content">
            <div class="row">
                <?php
                if ($Conta != 0) {
                    ?>
                    <div class="col-md-12">
                        <div class="heading-title heading-dotted text-center">
                            <h2>
                                PASSAGENS
                            </h2>
                        </div>
                    </div>
                    <br clear="all"><br clear="all">
                    <div id="anos" class="col-md-12 text-left">
                        <div class="col-md-1">
                            <div class="btn-group">
                                <button type="button" id="dashboardRange" class="btn btn-3d btn-black pull-right dropdown-toggle" data-toggle="dropdown">
                                    <span><?php echo $AnoSeleciona;?></span>
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <?php
                                    $sqlAnos = mysql_query("SELECT * FROM passagens WHERE Acao = 'Publicado' GROUP BY DATE_FORMAT(DtViagem, '%Y') ORDER BY DATE_FORMAT(DtViagem, '%Y') DESC");
                                    $Anos = mysql_num_rows($sqlAnos);

                                    for ($y = 0; $y < $Anos; $y++){
                                        $verAnos = mysql_fetch_array($sqlAnos);
                                        ?>
                                        <li><a href="javascript:void(0)" onclick="carregaAno(<?php echo date('Y', strtotime($verAnos['DtViagem']));?>)"><?php echo date('Y', strtotime($verAnos['DtViagem']));?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-11 text-left">
                            <?php

                            $sql = "SELECT * FROM passagens WHERE DATE_FORMAT(DtViagem, '%Y' )= " . $AnoSeleciona . " AND Acao = 'Publicado' GROUP BY DATE_FORMAT(DtViagem, '%m') ORDER BY DATE_FORMAT(DtViagem, '%Y') DESC, DATE_FORMAT(DtViagem, '%m') DESC";
                            $sqlGlossario = mysql_query($sql);
                            $Glossario = mysql_num_rows($sqlGlossario);

                            $total = 0;
                            $totalliberado = 0;
                            for ($y = 0; $y < $Glossario; $y++) {
                                $verGlossario = mysql_fetch_array($sqlGlossario);

                                ?>
                                <a onclick="carregaMesAno(<?php echo date('m', strtotime($verGlossario['DtViagem'])); ?>,<?php echo date('Y', strtotime($verGlossario['DtViagem'])); ?>)" href="javascript:void(0)">
                                    <i class="btn btn-3d btn-dirtygreen"><?php echo retorna_mes_extenso(date('m', strtotime($verGlossario['DtViagem']))); ?> / <?php echo date('Y', strtotime($verGlossario['DtViagem'])); ?></i>
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
                                    PASSAGENS DE <?php echo retorna_mes_extenso($MesSelecionado); ?> / <?php echo $AnoSeleciona; ?>
                                    <br>
                                    <small class="text-muted">atualizado em <?php echo date('d/m/Y H:i:s a', strtotime($rsLinha2['DtAtualizacao']))?></small>
                                </h4>
                                <div class="btn-group">
                                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" type="button">
                                        BAIXAR PASSAGENS
                                        <i class="fa fa-arrow-down"></i>
                                    </button>
                                    <ul class="dropdown-menu text-left" role="menu">
                                        <li>
                                            <a href="javascript:void(0)">Tipo de arquivo</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="passagensXLS.php?mes=<?php echo $MesSelecionado;?>&ano=<?php echo $AnoSeleciona;?>&extensao=xls"> Excel (XLS)  </a>
                                        </li>
                                        <li>
                                            <a href="passagensXLS.php?mes=<?php echo $MesSelecionado;?>&ano=<?php echo $AnoSeleciona;?>&extensao=ods"> Open Office Calc (ODS)  </a>
                                        </li>
                                        <li>
                                            <a href="passagensXLS.php?mes=<?php echo $MesSelecionado;?>&ano=<?php echo $AnoSeleciona;?>&extensao=odt"> Open Office Writer (ODT)  </a>
                                        </li>

                                    </ul>
                                </div><br clear="all">

                                <?php
                                $sql1 = "SELECT * FROM passagens WHERE Acao = 'Publicado' AND DATE_FORMAT(DtViagem, '%m') = ".$MesSelecionado." AND DATE_FORMAT(DtViagem, '%Y') = ".$AnoSeleciona." ORDER BY Acao ASC";
                                $sqlGlossario = mysql_query($sql1);
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
                                                <?php echo $verGlossario['Nome'];?><br><br><small><?php echo $verGlossario['Objetivo'];?></small><br><br>
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
                                                        <td colspan="2"><?php echo $verGlossario['Objetivo'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Destino</td>
                                                        <td><?php echo $verGlossario['Destino'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Data da Viagem</td>
                                                        <td><?php echo date('d/m/Y', strtotime($verGlossario['DtViagem']));?></td>
                                                    </tr>
                                                    <?php if ($verGlossario['DtVolta'] != "" AND $verGlossario['DtVolta'] != "0000-00-00"){?>
                                                    <tr>
                                                        <td>Data da Volta</td>
                                                        <td><?php echo date('d/m/Y', strtotime($verGlossario['DtVolta']));?></td>
                                                    </tr>
                                                    <?php }?>
                                                    <tr>
                                                        <td>Valor R$</td>
                                                        <td><?php echo  'R$' . number_format($verGlossario['valor'], 2, ',', '.');?></td>
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
    </div>
</section>