<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 29/08/14
 * Hora: 10:20
 * Página: Servidor
 *
 */

?>

<section class="content-wrapper content-midwet">
    <div class="content">
        <div class="row">

                <br clear="all">
            <p class="sobre">
                Conforme determina o Decreto n. 204/E de 22 de novembro de 2013, criamos este Portal da Transparência do Governo Municipal. Através deste portal, o cidadão poderá acompanhar a execução financeira.
                <br><br>
                Obrigada por sua visita!
            </p>

            <div class="col-md-12">

                <a class="btn btn-3d btn-xlg btn-purple" href="#">
                    RECEITAS
                    <span class="block font-lato">30 days demo for free</span>
                </a>

                <a class="btn btn-3d btn-xlg btn-purple" href="#">
                    DESPESAS
                    <span class="block font-lato">30 days demo for free</span>
                </a>

                <a class="btn btn-3d btn-xlg btn-purple" href="#">
                    OBRAS
                    <span class="block font-lato">30 days demo for free</span>
                </a>

                <a class="btn btn-3d btn-xlg btn-purple" href="#">
                    CONTRATOS E LICITAçÕES
                    <span class="block font-lato">30 days demo for free</span>
                </a>

                <a class="btn btn-3d btn-xlg btn-purple" href="#">
                    REEO / RGF
                    <span class="block font-lato">30 days demo for free</span>
                </a>

            </div>

                <?php
                //OBRAS
                $sqlReceita = mysql_query("SELECT * FROM obras WHERE Acao = 'Publicado' GROUP BY ano, mes ORDER BY ano DESC, mes DESC LIMIT 1");
                $rsRece = mysql_fetch_array($sqlReceita);
                $ContaReceita = mysql_num_rows($sqlReceita);

                if ($ContaReceita == 0){
                    $valRe = "0,00";
                    $atRe = "sem registro";
                }else{
                    $sqlRe = mysql_query("SELECT sum(valor_realizado) AS total FROM obras WHERE (Acao = 'Publicado') AND ( ano = ".$rsRece['ano'].") AND ( mes = ".$rsRece['mes'].")");
                    $rsRe = mysql_fetch_array($sqlRe);

                    $valRe = number_format($rsRe['total'], 2, ',', '.');
                    $atRe = date('d/m/Y H:i:s', strtotime($rsRece['DtAtualizacao']));
                }

                ?>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                    <p class="text-muted">OBRAS<br>
                            <small>
                                <span class="text-muted"><?php echo retorna_mes_extenso($rsRece['mes'])?>/<?php echo $rsRece['ano']?></span>
                            </small>
                    </p>

                    <h4>
                        <small>R$</small>
                        <?php echo $valRe;?>
                    </h4>

                    </div>
                </div>
            </div>
            <?php
            //CPL

            $sqlCPL = mysql_query("SELECT * FROM cpl WHERE Acao = 'Publicado' GROUP BY DATE_FORMAT(DtAtualizacao, '%Y'), DATE_FORMAT(DtAtualizacao, '%c') ORDER BY DATE_FORMAT(DtAtualizacao, '%Y') DESC, DATE_FORMAT(DtAtualizacao, '%c') DESC LIMIT 1");
            $rsCPL = mysql_fetch_array($sqlCPL);
            $ContaCPL = mysql_num_rows($sqlCPL);

            $ano = date('Y', strtotime($rsCPL['DtPublicacao']));
            $mes = date('m', strtotime($rsCPL['DtPublicacao']));

            if ($ContaCPL == 0){
                $valRe = "0,00";
                $atRe = "sem registro";
            }else{
                $sqlRe = mysql_query("SELECT sum(valor_licitacao) AS total FROM cpl WHERE (Acao = 'Publicado') AND ( DATE_FORMAT(DtAtualizacao, '%Y') = ".$ano.") AND ( DATE_FORMAT(DtAtualizacao, '%c') = ".$mes.")  ");



                $rsRe = mysql_fetch_array($sqlRe);

                $valRe1 = number_format($rsRe['total'], 2, ',', '.');
                $atRe1 = date('d/m/Y H:i:s', strtotime($rsCPL['DtAtualizacao']));
            }
            ?>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p class="text-muted">CONTRATOS E LICITAÇÕES<br>
                            <small>
                                <span class="text-muted"><?php echo retorna_mes_extenso(date('m', strtotime($rsCPL['DtAtualizacao'])))?>/<?php echo date('Y', strtotime($rsCPL['DtAtualizacao']))?></span>
                            </small>
                        </p>

                        <h4>
                            <small>R$</small>
                            <?php echo $valRe1;?>
                        </h4>

                    </div>
                </div>
            </div>

            <?php
            $sqlRREO = mysql_query("SELECT * FROM rreo WHERE  acao = 'Publicado' GROUP BY Ano, Bimestre ORDER BY Ano DESC, Pasta DESC LIMIT 1");
            $rsRREO = mysql_fetch_array($sqlRREO);
            $ContaRREO = mysql_num_rows($sqlRREO);

            if ($ContaRREO == 0){
                $atRREO = "sem registro";
            }else{

                $atRREO = date('d/m/Y H:i:s', strtotime($rsRREO['DtAtualizado']));
            }
            ?>

            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p class="text-muted">RREO / RGF<br>
                            <small>
                                <span class="text-muted"><?php echo ($rsRREO['Bimestre'])?>/<?php echo $rsRREO['Ano']?></span>
                            </small>
                        </p>

                        <a class="btn btn-block btn-info" title="RREO / RGF - <?php echo ($rsRREO['Bimestre'])?>/<?php echo $rsRREO['Ano']?>" href="?Pages=rreo">SAIBA MAIS</a>

                    </div>
                </div>
            </div>



<!--            e-sic-->

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="kit-cover kit-cover-sm ui-corner-top">
                        <img alt="" src="../img/trianglify1.svg">
                    </div>
                    <div class="kit-cover-headline">
                        <a class="kit-avatar center border-white kit-avatar-96" href="#">
                            <img alt="" src="../img/esic_icon.jpg">
                        </a>
                        <div class="text-center">
                            <p class="headline-label">
                                <a href="#">e-SIC</a>
                            </p>


                            <div class="col-md-12">

                                <p>O objetivo do e-SIC é facilitar o exercício do direito fundamental de acesso às informações públicas. Por meio deste sistema, você faz o seu pedido e acompanha todo o trâmite. </p>
                                <br clear="all">
                            </div>


                            <div class="col-md-6 text-left">

                                <p>
                                <strong>SIC - Serviço de Informação ao Cidadão</strong><br><br>
                                Centro de Ciencias, Tecnologia e Inovação<br>
                                Av. Surumu, 1820 - Mecejana - Boa Vista / RR - CEP: 69305-070<br>
                                Ao Lado do Mercado Romeu Caldas<br>

                                </p>

                            </div>

                            <div class="col-md-6 text-right">

                                <p>
                                    Horário de Funcionamento: 8:00 às 12:00 / 14:00 às 18:00<br>
                                    transparencia@boavista.rr.gov.br
                                </p>

                            </div>


                        </div>
                    </div>

                    <div class="panel-body text-center">
                        <div class="row">

                            <div class="clearfix"></div>
                            <br>
                            <div class="col-xs-8 col-xs-offset-2">
                                <p>
                                    <a class="btn btn-block btn-info" href="?Pages=esic_dica_pedido">Saiba Mais</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!--            <div class="col-md-12">-->
<!--                <div class="panel panel-default">-->
<!---->
<!--                    <div class="panel-body text-center">-->
<!--                        <div class="row">-->
<!---->
<!--                            <div class="clearfix"></div>-->
<!--                            <br>-->
<!--                            <div class="col-xs-8 col-xs-offset-2">-->
<!--                                <h4>Estrutura Organizacional</h4>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

            <div class="col-md-6">
                <div class="panel panel-default">

                    <div class="panel-body text-center">
                        <div class="row">

                            <div class="clearfix"></div>
                            <br>
                            <div class="col-xs-12">
                                <h4>Legislação</h4>
                            </div>
                            <div class="scroll col-md-12">
                                <?php
                                $sql = "SELECT * FROM Leis WHERE (Acao = 'Publicado')";

                                $sqlGlossario = mysql_query($sql);
                                $Glossario = mysql_num_rows($sqlGlossario);

                                $total = 0;
                                for ($y = 0; $y < $Glossario; $y++){
                                    $verGlossario = mysql_fetch_array($sqlGlossario);

                                    ?>
                                    <div class="media">
                                        <div class="media-body text-left">
                                            <h5 class="media-heading text-left text-primary"><?php echo $verGlossario['Titulo'];?></h5>
                                            <p class="text-left text-warning">
                                                 N&ordm; <strong><?php echo $verGlossario['NumLeis']?></strong>, De <?php echo strftime('%d de %B de %Y', strtotime($verGlossario['DtPub']));?>
                                            </p>
                                            <a href="?Pages=verLei&lei=<?php echo $verGlossario['CdLeis']?>" class="btn btn-silc" type="button">visualizar</a>
                                        </div>
                                    </div>
                                    <hr>
                                <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">

                    <div class="panel-body text-center">
                        <div class="row">

                            <div class="clearfix"></div>
                            <br>
                            <div class="col-xs-12">
                                <h4>Perguntas Frequentes</h4>
                            </div>

                            <div class="scroll col-md-12">

                                <?php
                                $sql = "SELECT * FROM perguntas_frequentes WHERE (Acao = 'Publicado')";

                                $sqlGlossario = mysql_query($sql);
                                $Glossario = mysql_num_rows($sqlGlossario);

                                $total = 0;
                                for ($y = 0; $y < $Glossario; $y++){
                                $verGlossario = mysql_fetch_array($sqlGlossario);

                                ?>
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="media-heading text-left text-primary"><?php echo $verGlossario['Titulo'];?></h5>
                                        <p class="text-left text-warning">
                                            <?php echo $verGlossario['Descricao'];?>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>




