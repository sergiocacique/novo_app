<?php
include ("../conexao.php");
include('funcoes.php');
?>

<div id="resultado">

    <div class="pull-left">
        <p class="btn-group">
            <a title="Anterior" href="javascript:void(0)" onclick="buscaAno(<?php echo $anoAnteriorRREO?>)" class="btn btn-silc">
                <i class="tamFont fa fa-arrow-left"></i>
            </a>
            <a title="Escolher Período" href="javascript:void(0)" class="ConvMes btn btn-silc" data-toggle="modal" data-target="#pesquisa"><?php echo $AnoSeleciona;?></a>
            <a title="Posterior" href="javascript:void(0)" onclick="buscaAno(<?php echo $anoSeguinteRREO?>)" class="btn btn-silc"><i class="tamFont fa fa-arrow-right"></i></a>
        </p>
    </div>




    <div class="rreo">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

            <?php

            $sql = "SELECT DISTINCT Bimestre FROM rreo WHERE (Acao = 'Publicado') AND ( ano = ".$SelAno.") ORDER BY Bimestre DESC";


            $sqlGlossario = mysql_query($sql);
            $Glossario = mysql_num_rows($sqlGlossario);

            for ($y = 0; $y < $Glossario; $y++){
                $verGlossario = mysql_fetch_array($sqlGlossario);

                if ($y > 0){
                    $classServ = "false";
                }else{
                    $classServ = "true";
                }
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading<?php echo $y; ?>">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $y; ?>" aria-expanded="" aria-controls="collapse<?php echo $y; ?>">
                                <?php echo $verGlossario['Bimestre'];?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse<?php echo $y; ?>" class="panel-collapse collapse <?php echo $classServ == "true" ? 'in':'';?>" role="tabpanel" aria-labelledby="heading<?php echo $y; ?>">
                        <div class="panel-body">
                            <?php

                            $sql1 = "SELECT * FROM rreo WHERE (Acao = 'Publicado') AND ( ano = ".$SelAno.") AND (Bimestre = '".$verGlossario['Bimestre']."')";

                            $sqlRREO = mysql_query($sql1);
                            $RREO = mysql_num_rows($sqlRREO);

                            for ($i = 0; $i < $RREO; $i++){
                                $verRREO = mysql_fetch_array($sqlRREO);

                                ?>
                                <div class="col-xs-4 col-sm-4 col-md-4 panel panel-default">
                                    <div class="panel-body">
                                        <ul class="panel-actions">
                                            <li>
                                                <a href="<?php echo $UrlAmigavel ?>dinamico/<?php echo $verRREO['Ano'];?>/<?php echo $verRREO['Pasta'];?>/<?php echo $verRREO['Arquivo'];?>" target="_blank">
                                                    <i class="fa fa-file-pdf-o fa-spin-2x fa-2x text-danger"></i>
                                                </a>
                                            </li>
                                        </ul>
                                        <p class="text-muted"><?php echo $verRREO['Nome'];?></p>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


</div>