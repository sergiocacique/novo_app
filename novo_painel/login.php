<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WD5 - Portal da Transparência</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- PRINCIPAL -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/cidade.css">
    <link rel="stylesheet" href="css/cidade-social.css">
    <link rel="stylesheet" href="css/wrapkit-skins-all.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/login.css">
    <!-- VENDOR -->
    <script src="lib/jquery.js"></script>
    <script src="lib/bootstrap.js"></script>
    <script src="lib/jquery-ui.js"></script>
    <script src="lib/modernizr.custom.js"></script>
    <script src="js/tempo.js"></script>
    <script src="../js/jquery.forms.js"></script>
    <script src="../js/jquery.mask.js"></script>
    <script src="../js/jquery.validate.min.js"></script>
    <!-- END VENDOR -->
    <!-- FIM PRINCIPAL -->
    <script>
        jQuery(function($){
            // JQUERY MASK INPUT
            $('[data-mask="date"]').mask('00/00/0000');
            $('[data-mask="time"]').mask('00:00:00');
            $('[data-mask="date_time"]').mask('00/00/0000 00:00:00');
            $('[data-mask="zip"]').mask('00000-000');
            $('[data-mask="money"]').mask('000.000.000.000.000,00', {reverse: true});
            $('[data-mask="phone"]').mask('0000-0000');
            $('[data-mask="phone_with_ddd"]').mask('(00) 0000-0000');
            $('[data-mask="phone_us"]').mask('(000) 000-0000');
            $('[data-mask="cpf"]').mask('000.000.000-00', {reverse: true});
            $('[data-mask="ip_address"]').mask('099.099.099.099');
            $('[data-mask="percent"]').mask('##0,00%', {reverse: true});
            // END JQUERY MASK INPUT
        });
    </script>

</head>
<body class="body">

    <section class="content-wrapper">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-md-offset-3">
                    <div class="login_img"></div>
                    <div class="panel-group" id="accordion1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
                                        Já tenho acesso
                                    </a>
                                </h4><!-- /panel-title -->
                            </div><!-- /panel-heading -->
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="col-md-10 col-md-offset-1">
                                        <form action="validacao.php" method="post">

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <input name="txUsuario" id="txUsuario" class="form-control" placeholder="Email">
                                            </div>

                                            <div class="form-group">
                                                <input type="password" name="txSenha" id="txSenha" class="form-control" placeholder="Senha">
                                            </div>
                                        </div><!-- /.form-group -->

                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="form-tip pt-20">
                                                    <a class="no-text-decoration size-13 margin-top-10 block" href="#">Esqueceu sua senha?</a>
                                                </div>
                                            </div>

                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                            <div class="animated-hue pull-right">
                                                <button id="btnSignin" type="submit" class="btn btn-primary">ENTRAR</button>
                                            </div>

                                        </div><!-- /.form-group -->
                                    </form>
                                    </div>
                                </div><!-- /panel-body -->
                            </div><!-- /panel-collapse -->
                        </div><!-- /panel -->

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo">
                                        Primeiro Acesso
                                    </a>
                                </h4><!-- /panel-title-->
                            </div><!-- /panel-heading-->
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="col-md-10 col-md-offset-1">
                                        <form action="cria_acesso.php" method="post">

                                            <div class="form-group col-md-12">
                                                <div class="form-group">
                                                    <input data-mask="cpf" name="txtCPF" id="txtCPF" class="form-control" placeholder="CPF">
                                                </div>

                                                <div class="form-group">
                                                    <input name="txtMatricula" id="txtMatricula" class="form-control" placeholder="Matricula">
                                                </div>
                                            </div><!-- /.form-group -->

                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="form-tip pt-20">
                                                    <a class="no-text-decoration size-13 margin-top-10 block" href="#"></a>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                                <div class="animated-hue pull-right">
                                                    <button id="btnSignin" type="submit" class="btn btn-primary">ENTRAR</button>
                                                </div>

                                            </div><!-- /.form-group -->
                                        </form>
                                    </div>
                                </div><!-- /panel-body-->
                            </div><!-- /panel-collapse-->
                        </div><!-- /panel-->


                    </div><!-- /panel-group -->
                </div><!-- /.cols -->
            </div>
        </div>
    </section>

    <!-- VENDOR -->
    <script src="lib/jquery.js"></script>
    <script src="lib/bootstrap.js"></script>
    <script src="lib/jquery-ui.js"></script>
    <script src="lib/modernizr.custom.js"></script>
    <script src="js/tempo.js"></script>
    <!-- END VENDOR -->

    <!-- PRINCIPAL -->

    <!-- FIM PRINCIPAL -->
</body>
</html>