<?php
/**
 * Created by PhpStorm.
 * User: elidiane
 * Date: 24/11/14
 * Time: 09:34
 */
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

        function contratos_licitacoes(){
            $('#loading2').css('visibility','visible');
            $.post("contratos_licitacoes.php",
                function(data){
                    $('#conteudo').html(data);
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
<?php include ("menu_o_municipio.php");?>
<?php include ("topo.php");?>

<div id="conteudo" class="">
    <div class="container">
        <div class="row discovery">
            <div class="col-sm-9 col-md-10">
                <div class="header">
                    <h1>O Município</h1>
                    <div class="tagline"> Tudo sobre o seu município. </div>
                </div>

                <div class="category col-md-12">
                    <div class="title">
                        <h4>Canais</h4>
                    </div>

                    <div class="cards">
                        <div class="item">
                            <a id="ember4500" class="ember-view" href="o_municipio_historia.php">
                                <span class="card">
                                    <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                                </span>
                                <br>
                                <span class="card-name">História do Município</span>
                            </a>
                        </div>

                        <div class="item">
                            <a id="ember4500" class="ember-view" href="o_municipio_dados.php">
                                <span class="card">
                                    <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                                </span>
                                <br>
                                <span class="card-name">Dados do Município</span>
                            </a>
                        </div>

                        <div class="item">
                            <a id="ember4500" class="ember-view" href="o_municipio_simbolo.php">
                                <span class="card">
                                    <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                                </span>
                                <br>
                                <span class="card-name">Símbolos do Município</span>
                            </a>
                        </div>

                        <div class="item">
                            <a id="ember4500" class="ember-view" href="o_municipio_projetos.php">
                                <span class="card">
                                    <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                                </span>
                                <br>
                                <span class="card-name">Projetos</span>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="category col-md-12">
                    <div class="title">
                        <h4>Atrações Turisticas</h4>
                    </div>

                    <div class="cards">
                        <div class="item">
                            <a id="ember4500" class="ember-view" href="o_municipio_categoria.php">
                                <span class="card">
                                    <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                                </span>
                                <br>
                                <span class="card-name">Categorias</span>
                            </a>
                        </div>

                        <div class="item">
                            <a id="ember4500" class="ember-view" href="o_municipio_atracoes.php">
                                <span class="card">
                                    <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                                </span>
                                <br>
                                <span class="card-name">Atrações</span>
                            </a>
                        </div>


                    </div>

                </div>

                <div class="category col-md-12">
                    <div class="title">
                        <h4>Serviços</h4>
                    </div>

                    <div class="cards">
                        <div class="item">
                            <a id="ember4500" class="ember-view" href="o_municipio_servicos_cidadao.php">
                                <span class="card">
                                    <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                                </span>
                                <br>
                                <span class="card-name">Serviços ao Cidadão</span>
                            </a>
                        </div>

                        <div class="item">
                            <a id="ember4500" class="ember-view" href="o_municipio_servicos_empreendedor.php">
                                <span class="card">
                                    <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                                </span>
                                <br>
                                <span class="card-name">Serviços ao Empreendedor</span>
                            </a>
                        </div>

                        <div class="item">
                            <a id="ember4500" class="ember-view" href="o_municipio_servicos_estudante.php">
                                <span class="card">
                                    <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                                </span>
                                <br>
                                <span class="card-name">Serviços ao Estudante</span>
                            </a>
                        </div>

                        <div class="item">
                            <a id="ember4500" class="ember-view" href="o_municipio_servicos_servidor_publico.php">
                                <span class="card">
                                    <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                                </span>
                                <br>
                                <span class="card-name">Serviços ao Servidor Público</span>
                            </a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="container"></div>
</div>
</body>
</html>
