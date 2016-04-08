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
<?php include ("menu_informativos.php");?>
<?php include ("topo.php");?>


<div id="conteudo" class="">
    <div class="row discovery">
        <div class="col-sm-9 col-md-10">
            <div class="header">
                <h1>Informativos</h1>
                <div class="tagline">  </div>
            </div>

            <div class="category col-md-10">
                <div class="title">
                    <h4>Canais</h4>
                </div>

                <div class="cards">
                    <div class="item">
                        <a id="ember4500" class="ember-view" href="informativos_noticias.php">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                            <br>
                            <span class="card-name">Notícias</span>
                        </a>
                    </div>

                    <div class="item">
                        <a id="ember4500" class="ember-view" href="informativos_eventos.php">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                            <br>
                            <span class="card-name">Eventos</span>
                        </a>
                    </div>

                    <div class="item">
                        <a id="ember4500" class="ember-view" href="informativos_links_uteis.php">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                            <br>
                            <span class="card-name">Links Úteis</span>
                        </a>
                    </div>

                </div>

            </div>

            <!-- <div class="category col-md-10">
                <div class="title">
                    <h4>Multimídia</h4>

                </div>

                <div class="cards">
                    <div class="item">
                        <a id="ember4500" class="ember-view" href="informativos_galeria_de_foto.php">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                            <br>
                            <span class="card-name">Galeria de Fotos</span>
                        </a>
                    </div>

                    <div class="item">
                        <a id="ember4500" class="ember-view" href="informativos_galeria_de_videos.php">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                            <br>
                            <span class="card-name">Galeria de Vídeos</span>
                        </a>
                    </div>


                </div>

            </div> -->
        </div>
    </div>
</div>
<div class="container"></div>
</body>
</html>
