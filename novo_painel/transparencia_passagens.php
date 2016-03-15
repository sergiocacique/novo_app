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
<?php include ("menu_transparencia.php");?>
<?php include ("topo.php");?>


<div id="conteudo" class="container">
    <div class="row discovery">
        <div class="col-sm-9 col-md-10">
          <div class="header">
              <h1>Passagens</h1>
              <a class="btn btn-3d btn-reveal btn-red" href="transparencia_passagens_novo.php">ADICIONAR NOVA PASSAGEM</a>
          </div>
          <?php
          $sqlGlossario = mysql_query("SELECT * FROM passagens WHERE CdPrefeitura = '".$_SESSION['PrefeituraID']."' AND Acao <> 'Excluido' GROUP BY ano ORDER BY ano DESC");
          $Glossario = mysql_num_rows($sqlGlossario);

          for ($y = 0; $y < $Glossario; $y++){
              $verGlossario = mysql_fetch_array($sqlGlossario);

              ?>
          <div class="category">
              <div class="title">
                  <h4><?php echo $verGlossario['ano'];?></h4>
                  Passagens de <strong><?php echo $verGlossario['ano'];?></strong>.
              </div>
              <?php
              $sqlGlossario1 = mysql_query("SELECT * FROM passagens WHERE ano = '".$verGlossario['ano']."' AND CdPrefeitura = '".$_SESSION['PrefeituraID']."' AND Acao <> 'Excluido' GROUP BY mes ORDER BY mes DESC");
              $Glossario1 = mysql_num_rows($sqlGlossario1);

              for ($x = 0; $x < $Glossario1; $x++){
                  $verGlossario1 = mysql_fetch_array($sqlGlossario1);

                  ?>
              <div class="cards">
                  <div class="item">
                      <a class="btn btn-3d btn-reveal btn-blue" href="transparencia_passagens_ver.php?mes=<?php echo $verGlossario1['mes'];?>&ano=<?php echo $verGlossario1['ano'];?>"><?php echo retorna_mes_extenso($verGlossario1['mes']);?></a>
                  </div>
                  </div>

                  <?php
                  }
                  ?>


          </div>
          <?php
          }
          ?>
        </div>
    </div>

</div>

</body>
</html>
