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


<section id="ver" class="texto-simples mar-top-30">

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8">
                <div class="content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Consulta de Protocolo</h3>
                        </div>
                        <div class="panel-body bordered-bottom">
                            <form id="signinForm" role="form" action="verificar.php" novalidate="novalidate" method="post">
                                <input type="hidden" name="prefeitura" value="<?php echo $dominio;?>">
                                <p class="lead">Dados de acesso</p>
                                <div class="form-group">
                                    <div class="input-group input-group-in">
                                <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                                </span>
                                        <input id="email" class="form-control" placeholder="seu_nome@provedor.com.br" name="email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-in">
                                <span class="input-group-addon">
                                <i class="fa fa-lock"></i>
                                </span>
                                        <input type="password" id="senha" class="form-control" placeholder="senha" name="senha">
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="animated-hue pull-right">
                                        <button id="btnSignin" class="btn btn-primary" type="submit">
                                            Consultar
                                            <i class="fa fa-chevron-circle-right"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>

                        </div>
                        <div class="panel-body">
                            <p class="lead">Ainda não tenho acesso</p>
                            <form id="signinForm" role="form" action="esic_cadastro.php" novalidate="novalidate" method="post">
                                <input type="hidden" name="prefeitura" value="<?php echo $dominio;?>">
                                <input type="hidden" name="CdPrefeitura" value="<?php echo $rsPrefeitura['CdPrefeitura'];?>">
                                <div class="form-group">
                                    <div class="input-group input-group-in">
                                <span class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                                </span>
                                        <input id="email" class="form-control" placeholder="seu_nome@provedor.com.br" name="email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-in">
                                <span class="input-group-addon">
                                <i class="fa fa-lock"></i>
                                </span>
                                        <input type="password" id="senha" class="form-control" placeholder="senha" name="senha">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-in">
                                <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                                </span>
                                        <input id="nome" class="form-control" placeholder="Nome Completo" name="nome">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-in">
                                <span class="input-group-addon">
                                <i class="fa fa-location-arrow"></i>
                                </span>
                                        <input id="CPF" class="form-control" placeholder="CPF" name="CPF">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-in">
                                <span class="input-group-addon">
                                <i class="fa fa-road"></i>
                                </span>
                                        <input id="CEP" class="form-control" placeholder="CEP" name="CEP">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-in">
                                <span class="input-group-addon">
                                <i class="fa fa-road"></i>
                                </span>
                                        <input id="endereco" class="form-control" placeholder="Endereço" name="endereco">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-in">
                                <span class="input-group-addon">
                                <i class="fa fa-road"></i>
                                </span>
                                        <input id="bairro" class="form-control" placeholder="Bairro" name="bairro">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-in">
                                <span class="input-group-addon">
                                <i class="fa fa-road"></i>
                                </span>
                                        <input id="cidade" class="form-control" placeholder="Cidade" name="cidade">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-in">
                                <span class="input-group-addon">
                                <i class="fa fa-road"></i>
                                </span>
                                        <input id="estado" class="form-control" placeholder="Estado" name="estado">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-in">
                                <span class="input-group-addon">
                                <i class="fa fa-phone"></i>
                                </span>
                                        <input id="telefone" class="form-control" placeholder="Telefone" name="telefone">
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="animated-hue pull-right">
                                        <button id="btnSignin" class="btn btn-primary" type="submit">
                                            Cadastrar
                                            <i class="fa fa-chevron-circle-right"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $sqSIC = mysql_query("SELECT * FROM prefeitura_config WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."'");
            $rsSIC = mysql_fetch_array($sqSIC);

            if ($rsSIC['SIC'] != '') {
            ?>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="title title-d"><strong>SIC</strong></h2>
                    </div>
                    <div class="panel-body bordered-bottom">
                        <p>O Serviço de Informações ao Cidadão (SIC) é a unidade física existente em todos os órgãos e
                            entidades do poder público, para atender o cidadão que deseja solicitar o acesso à
                            informação pública.</p>
                    </div>
                    <div class="panel-body callout-success">
                        <p><?php echo $rsSIC['SIC'];?></p>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
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