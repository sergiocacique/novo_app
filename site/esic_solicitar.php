<script>
    function carregaProjeto(id,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>obras_ver.php", { id: id, prefeitura: prefeitura },
            function(data){
                $('#ver').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

</script>

<section class="texto-simples">
    <div class="container">
        <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
        <h2 class="title title-d"> <strong>e-SIC</strong></h2>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="divisor divisor-c">
            <span> </span>
        </div>
    </div>
            </div>
        </div>
</section>

<?php
// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();


// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['ID_SIC'])) {
// Destrói a sessão por segurança
    session_destroy();
// Redireciona o visitante de volta pro login
    ?>
    <script language="JavaScript">
        window.location="<?php echo $UrlAmigavel ?>?Pages=esic_consulta";
    </script>
    <?php
}
?>
<section id="ver" class="texto-simples mar-top-30">

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-md-12">
                    <div class="content">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Solicitar Informação</h3>
                            </div>
                            <div class="panel-body bordered-bottom">
                                <form id="signinForm" role="form" action="salvar_solicitacao.php" novalidate="novalidate" method="post">
                                    <input type="hidden" name="ID_SIC" value="<?php echo $_SESSION['ID_SIC']?>">
                                    <input type="hidden" name="prefeitura" value="<?php echo $dominio;?>">
                                    <input type="hidden" name="CdPrefeitura" value="<?php echo $rsPrefeitura['CdPrefeitura'];?>">
                                    <div class="form-group">
                                        <label class="control-label" for="tipSelect">Prioridade</label>
                                        <label class="select">
                                            <select id="tipSelect" name="tipSelect">
                                                <option value="Baixa">Baixa</option>
                                                <option value="Média">Média</option>
                                                <option value="Alta">Alta</option>
                                            </select>
                                            <span class="fake-addon"></span>
                                        </label>
                                    </div><!-- /.form-group -->

                                    <div class="form-group">
                                        <label class="control-label" for="recebimento">Forma de Recebimento da Resposta</label>
                                        <label class="select">
                                            <select id="recebimento" name="recebimento">
                                                <option value="E-mail">E-mail</option>
                                                <option value="Papel (Valor das cópias custeado pelo solicitante)">Papel (Valor das cópias custeado pelo solicitante)</option>
                                                <option value="CD/DVD (Fornecido pelo interessado)">CD/DVD (Fornecido pelo interessado)</option>
                                                <option value="Pendrive (Fornecido pelo interessado)">Pendrive (Fornecido pelo interessado)</option>
                                            </select>
                                            <span class="fake-addon"></span>
                                        </label>

                                    </div><!-- /.form-group -->


                                    <div class="form-group">
                                        <label class="control-label" for="tipAssunto">Assunto</label>
                                        <div class="input-group input-group-in">
                                            <input class="form-control" name="tipAssunto" id="tipAssunto">
                                            <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                        </div><!-- /.input-group -->
                                    </div><!-- /.form-group -->


                                    <div class="form-group">
                                        <label class="control-label" for="txtPedido">Especificações do pedido</label>
                                        <div class="input-group input-group-in">
                                            <textarea rows="8" id="txtPedido" class="form-control autogrow" name="txtPedido"></textarea>
                                            <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                        </div><!-- /.input-group -->
                                    </div><!-- /.form-group -->


                                    <div class="form-group clearfix">
                                        <div class="pull-right">
                                            <button type="reset" class="btn btn-default">Limpar</button>
                                            <button type="submit" class="btn btn-primary">Enviar solicitação</button>
                                        </div>
                                    </div><!-- /.form-group -->
                                </form><!-- /form -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
</div>

</section>


<section class="line-100 type-c line-advantages">
    <div class="container">
        <div class="grid-12 pull-left">
            <h4 class="title title-d">
                <strong>ACESSO À </strong>INFORMAÇÃO
            </h4>
        </div>
        <div class="col-md-8 mar-20">
            <div class="divisor divisor-b">
                <span> </span>
            </div>
        </div>
        <div class="col-md-8 mar-10">
            <p class="text text-c"> O objetivo do e-SIC é facilitar o exercício do direito fundamental de acesso às informações públicas. Por meio deste sistema, você faz o seu pedido e acompanha todo o trâmite. </p>
        </div>
        <div class="clear"> </div>
        <div class="col-md-8 mar-20">
            <a class="btn type-d" title="saiba mais sobre o e-SIC" href="<?php echo $legal ?>esic">SAIBA MAIS</a>
        </div>
    </div>
</section>
