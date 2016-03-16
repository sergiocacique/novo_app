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
<?php
$Protocolo = $_GET['protocolo'];

$sqlPagina = mysql_query("SELECT * FROM servidor WHERE Protocolo = '".$Protocolo."'");
$rsPagina = mysql_fetch_array($sqlPagina);

$sqlPagina1 = mysql_query("SELECT CdPrefeitura, Protocolo, sum(RemuneracaoBasica) as serv FROM servidor WHERE Protocolo = '".$Protocolo."'");
$rsPagina1 = mysql_fetch_array($sqlPagina1);
$total = mysql_num_rows($sqlPagina);
?>

<div id="conteudo" class="container">
    <div class="row discovery">
        <div class="col-sm-9 col-md-10">
          <div class="header">
              <h1>Folha de Pagamento de <strong><?php echo retorna_mes_extenso($rsPagina['Mes'])?>/<?php echo $rsPagina['Ano']?></strong></h1>
              <a class="btn btn-3d btn-reveal btn-amber" href="transparencia_folha_pagamento.php">SELECIONAR OUTRO MÊS</a>
              <a class="btn btn-3d btn-reveal btn-red" href="transparencia_folha_pagamento_novo.php">ADICIONAR NOVA FOLHA DE PAGAMENTO</a>
          </div>
        </div>
    </div>

    <div class="row discovery2">

      <div class="table-responsive">

        <table class="table table-condensed">
          <div class="col-sm-12 col-md-12">
          <div class="box-branco">
            <div class="col-sm-12 col-md-8">
                <p>
                  Total de Servidores: <strong><?php echo $total;?></strong><br>
                  Total Gasto: <strong>R$ <?php echo number_format($rsPagina1['serv'], 2, ',', '.');?></strong><br>
                </p>
            </div>
            <?php if($rsPagina['Acao'] != "Publicado" OR $rsPagina['Acao'] != "Excluido"){?>
            <div class="col-sm-12 col-md-4">
                <a class="btn btn-3d btn-reveal btn-green" href="transparencia_folha_pagamento_gravar.php?protocolo=<?php echo $Protocolo;?>&acao=publicar">PUBLICAR</a>
                <a class="btn btn-3d btn-reveal btn-red" href="transparencia_folha_pagamento_gravar.php?protocolo=<?php echo $Protocolo;?>&acao=excluir">EXCLUIR</a>
            </div>
            <?php }?>
          </div>
        </div>
        		<thead>
        			<tr>
        				<th>CPF</th>
        				<th>Nome do Servidor</th>
        				<th>Cargo</th>
        			</tr>
        		</thead>
        		<tbody>
              <?php
              $sqlGlossario = mysql_query("SELECT * FROM servidor WHERE CdPrefeitura = '".$_SESSION['PrefeituraID']."' AND Protocolo = '".$Protocolo."' AND Acao <> 'Excluido' ORDER BY Nome ASC");
              $Glossario = mysql_num_rows($sqlGlossario);

              for ($y = 0; $y < $Glossario; $y++){
                  $verGlossario = mysql_fetch_array($sqlGlossario);

                  ?>
        			<tr>
        				<td><?php echo mask($verGlossario['CPF'],'***.###.###-**'); ?></td>
        				<td><?php echo $verGlossario['Nome']; ?></td>
        				<td><?php echo $verGlossario['Cargo']; ?></td>
        			</tr>
              <?php
              }
              ?>
        		</tbody>
        	</table>

        </div>
    </div>
</div>

</body>
</html>
