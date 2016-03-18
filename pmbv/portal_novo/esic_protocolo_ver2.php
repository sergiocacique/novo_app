<?php
$protocolo = base64_decode($_GET['protocolo']);

$sqlPro = mysql_query("SELECT * FROM sic_ticket WHERE Protocolo = '".$protocolo."'");
$rsPro = mysql_fetch_array($sqlPro);

$sqlSIC = mysql_query("SELECT * FROM sic_usuario WHERE id = '".$rsPro['CdUsuario']."'");
$rsSIC = mysql_fetch_array($sqlSIC);
?>



    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Protocolo: <?php echo $rsPro['Protocolo']?></h3>
                </div><!-- /panel-heading -->

                <div class="panel-body">

                    <form id="tip-validate" class="form-bordered" action="esic_salvar_pedido.php" method="post">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <span>Interessado</span>
                                <div class="input-group"><?php echo $rsSIC['Nome']?></div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <span for="tipDtAbertura">Data de abertura</span>
                                <div class="input-group"><?php echo strftime('%d de %B de %Y', strtotime($rsPro['DtCadastro']))?></div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <span for="tipDtFinal">Prazo de atendimento</span>
                                <div class="input-group"><?php echo strftime('%d de %B de %Y', strtotime($rsPro['DtFinal']))?></div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <span for="tipOrgao">Órgão</span>
                                <div class="input-group"><?php echo $rsPro['Orgao']?></div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <span for="tipFormaResposta">Forma de recebimento da resposta</span>
                                <div class="input-group"><?php echo $rsPro['Recebimento']?></div>
                            </div>
                        </div>



                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <span for="tipDescricao">Descrição da solicitação</span>
                                <div class="input-group"><?php echo $rsPro['Assunto']?></div>
                            </div>
                        </div>


                    </form>
                </div>
            </div><!-- /panel-rpcdefault -->



        </div><!-- /.cols -->
    </div>