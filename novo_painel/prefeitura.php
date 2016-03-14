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

$sqlPerfil2 = mysql_query("SELECT * FROM vw_admin WHERE CdUsuario = ".$_SESSION['UsuarioID']." ");
$verPerfil2 = mysql_fetch_array($sqlPerfil2);
if($verPerfil2['NomePerfil'] != "Desenvolvedor"){
  header('Location: index.php');
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Minha Prefeitura - Dashboard</title>
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
<div class="pane">
    <header class=" hide_when_collapsed">
        <h1>PÁGINA INICIAL</h1>
    </header>
    <div class=" hide_when_collapsed scroll_content">

        <div class="section">

            <ul class="filters">
                <li class="selected">
                    <a href="#">
                        Folha de Pagamento
                    </a>
                </li>
                <li>
                    <a href="#">
                        Servidores Cedidos
                    </a>
                </li>
                <li>
                    <a href="#">
                        Diárias
                    </a>
                </li>
                <li>
                    <a href="#">
                        Passagens
                    </a>
                </li>
            </ul>
        </div>




    </div>
</div>
<?php include ("topo.php");?>


<div id="conteudo" class="container">
    <div class="row discovery">
        <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-1">
            <div class="header">
                <h1>Prefeituras</h1>
                <div class="tagline"> Selecione abaixo qual prefeitura deseja administrar. </div>
            </div>

            <div class="category">
                <div class="title">
                    <h4>Prefeituras</h4>
                    Canais são as maneiras como os clientes interagem com você.
                </div>

                <div class="cards">
                  <?php
                  $sqlGlossario = mysql_query("SELECT * FROM prefeitura ORDER BY Fantasia ASC");
                  $Glossario = mysql_num_rows($sqlGlossario);

                  for ($y = 0; $y < $Glossario; $y++){
                      $verGlossario = mysql_fetch_array($sqlGlossario);

                      ?>
                    <div class="item">
                        <a id="ember4500" class="ember-view" href="ver_prefeitura.php?prefeitura=<?php echo $verGlossario['CdPrefeitura']; ?>">
                            <span class="card">
                                <img src="imagens/brasao/<?php echo $verGlossario['Pasta']; ?>.png" class="logo_prefeituras">
                            </span>
                            <br>
                            <span class="card-name"><?php echo $verGlossario['Fantasia']; ?></span>
                        </a>
                    </div>
                    <?php
                    }
                    ?>

                    <div class="item">
                        <a id="ember4500" class="ember-view" href="#/discovery/feature/email">
                            <span class="card">
                                <img src="imagens/brasao/mais.png" class="logo_prefeituras">
                            </span>
                            <br>
                            <span class="card-name">Adicionar Prefeitura</span>
                        </a>
                    </div>
                </div>

            </div>

            <div class="category">
                <div class="title">
                    <h4>Pressem</h4>
                    Base de conhecimento, comunidades e widgets que capacitam seus clientes.
                </div>

                <div class="cards">
                    <div class="item">
                        <a id="ember4500" class="ember-view" href="#/discovery/feature/email">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                            <br>
                            <span class="card-name">Fundos de Investimentos</span>
                        </a>
                    </div>

                    <div class="item">
                        <a id="ember4500" class="ember-view" href="#/discovery/feature/email">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                            <br>
                            <span class="card-name">DAIR</span>
                        </a>
                    </div>

                    <div class="item">
                        <a id="ember4500" class="ember-view" href="#/discovery/feature/email">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                            <br>
                            <span class="card-name">APR</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container"></div>
</body>
</html>
