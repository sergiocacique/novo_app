<?php

include ("conexao.php");
include ("funcao.php");

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();


// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: login.php"); exit;
}

?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Portal da Transparência</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/bootstrap.css">


    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.1.11.1.min.js"></script>
    <script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script>

        function loadImages() {
            if (document.getElementById) {  // DOM3 = IE5, NS6
                document.getElementById('loading').style.visibility = 'hidden';
            }
            else {
                if (document.layers) {  // Netscape 4
                    document.hidepage.visibility = 'hidden';
                }
                else {  // IE 4
                    document.all.hidepage.style.visibility = 'hidden';
                }
            }
        }

        $(window).load(function() {
            // Animate loader off screen
            $("#loading2").delay(200).fadeOut("slow");
        });

        function listaChamado(acao){
            start();
            $('#loading2').css('visibility','visible');
            $.post("inicio_chamado.php", { acao: acao },
                function(data){
                    $('#conteudo').html(data);
                    $('html, body').animate({scrollTop:0}, 'slow');
                }).done(function() {
                    $('#loading2').css('visibility','hidden');
                });
        }

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
<body class="orders index">
<div id="loading2">
    <div id="loading">
        <div class="container">
            <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-1">
                <h1>Carregando dados</h1>
                <p>aguarde por favor</p>
                <div id="circleG">
                    <div id="circleG_1" class="circleG"></div>
                    <div id="circleG_2" class="circleG"></div>
                    <div id="circleG_3" class="circleG"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ("menu.php");?>
<?php include ("topo.php");?>
<?php
$sqlPagina = mysql_query("SELECT * FROM admin WHERE CdUsuario = '".$_SESSION['UsuarioID']."'");
$rsPagina = mysql_fetch_array($sqlPagina);
 ?>
<div id="conteudo" class="container">
  <div class="row discovery">
      <div class="col-sm-9 col-md-10">
        <div class="header">
            <h1>Meus Dados</h1>
        </div>
      </div>
  </div>
    <div class="row discovery2 col-md-8">
      <div class="table-responsive">
        <form class="validate" action="meusdados_gravar.php" method="post">

          <div class=" col-sm-12 col-md-12">
            <div class="fancy-form">
              <label>Nome Completo</label>
              <input id="nome" name="nome" class="form-control" type="text" value="<?php echo $rsPagina['Nome'];?>">
            </div>
          </div>



        <div class=" col-sm-12 col-md-6">
          <div class="fancy-form">
            <label>CPF</label>
            <input disabled="disabled" data-mask="cpf" id="cpf" name="cpf" class="form-control" type="text" value="<?php echo $rsPagina['CPF'];?>">
          </div>
        </div>

        <div class=" col-sm-12 col-md-6">
          <div class="fancy-form">
            <label>Data de Nascimento</label>
            <input data-mask="date" id="DtNascimento" name="DtNascimento" class="form-control" type="text" value="<?php echo date('d/m/Y', strtotime($rsPagina['DtNascimento']));?>">
          </div>
        </div>

          <div class="box-branco">
            <div class=" col-sm-12 col-md-12">
            <h4>Dados de Acesso</h4>
            <div class=" col-sm-12 col-md-6">
              <div class="fancy-form">
                <label>E-mail</label>
                <input id="email" name="email" class="form-control" type="text" value="<?php echo $rsPagina['Email'];?>">
              </div>
            </div>

            <div class=" col-sm-12 col-md-6">
              <div class="fancy-form">
                <label>Senha</label>
                <input id="senha" name="senha" class="form-control" type="password">
              </div>
            </div>
          </div>
          </div>



        <div class=" col-sm-12 col-md-12">
          <button type="submit" class="btn btn-3d btn-teal btn-block margin-top-30">
  				GRAVAR
  			</button></div>

        </form>
        </div>
    </div>
</div>

</body>
</html>
