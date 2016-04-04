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
<?php include ("menu_publicacoes_oficiais.php");?>
<?php include ("topo.php");?>
<?php
$id = $_GET['id'];

$sqlPagina = mysql_query("SELECT * FROM publicacoes_oficiais_categoria WHERE CdCategoria = '".$id."'");
$rsPagina = mysql_fetch_array($sqlPagina);
 ?>

<div id="conteudo" class="">
    <div class="row discovery">
        <div class="col-sm-9 col-md-10">
          <div class="header">
              <h1><?php echo $rsPagina['Nome'];?></h1>
              <a class="btn btn-3d btn-reveal btn-red" href="publicacoes_oficiais_licitacao_novo.php?id=<?php echo $rsPagina['CdCategoria'];?>">ADICIONAR NOVA <?php echo $rsPagina['Nome'];?></a>
          </div>
        </div>
    </div>

    <div class="row discovery2">

      <div class="table-responsive">

        <?php
        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

        //$cmd = "select *, concat(DtCadastro, ' ', HrCadastro) as dthr from site_noticias WHERE Acao = 'Publicado' ORDER BY dthr DESC";
        $cmd = "select * from vw_publicacoes WHERE CdPrefeitura = '".$_SESSION['PrefeituraID']."' AND CdCategoria = '".$rsPagina['CdCategoria']."' AND Acao <> 'Excluido' ORDER BY DtAbertura DESC";

        $produtos = mysql_query($cmd);

        $total = mysql_num_rows($produtos);

        $registros = 50;

        $numPaginas = ceil($total/$registros);

        $inicio = ($registros*$pagina)-$registros;


        $cmd = "select * from vw_publicacoes WHERE CdPrefeitura = '".$_SESSION['PrefeituraID']."' AND CdCategoria = '".$rsPagina['CdCategoria']."' AND Acao <> 'Excluido' ORDER BY DtAbertura DESC limit $inicio,$registros";
        $produtos = mysql_query($cmd);
        $total = mysql_num_rows($produtos);
        while ($produto = mysql_fetch_array($produtos)) {
          if($produto['Acao'] == "Publicado"){
            $cor = "border-verde";
            $corFonte = "font-verde";
          }elseif ($produto['Acao'] == "Aguardando") {
            $cor = "border-laranja";
            $corFonte = "font-laranja";
          }elseif ($produto['Acao'] == "Excluido") {
            $cor = "border-vermelho";
            $corFonte = "font-vermelho";
          }else{
            $cor = "border-cinza";
            $corFonte = "font-cinza";
          }
        ?>
  			<div class="col-sm-10 col-md-10">
          <div class="listar <?php echo $cor;?>">
          <a href="publicacoes_oficiais_licitacao_editar.php?receita=<?php echo $produto['id'];?>">

          <h5 class="<?php echo $corFonte;?>"><?php echo $produto['Titulo'];?></h5>
          <p>
            <?php echo $produto['Descricao'];?><br /><br />
            <strong>Categoria:</strong> <?php echo $produto['Nome'];?><br>
            <strong>SubCategoria:</strong> <?php echo $produto['Nome2'];?><br>
            <strong>Abertura:</strong> <?php echo date('d/m/Y', strtotime($produto['DtAbertura']));?><br>

          </p>
        </a>
      </div>
        </div>
        <?php
        }
        ?>

        </div>
    </div>
</div>

</body>
</html>
