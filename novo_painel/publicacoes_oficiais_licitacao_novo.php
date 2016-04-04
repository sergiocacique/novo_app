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
            <h1>Adicionar Nova <?php echo $rsPagina['Nome'];?></h1>
        </div>
      </div>
  </div>
    <div class="row discovery2">
      <div class="table-responsive">
        <form class="validate" action="publicacoes_oficiais_licitacao_novo_adicionar.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="CdCategoria" value="<?php echo $rsPagina['CdCategoria'];?>">


          <div class=" col-sm-12 col-md-6">
            <div class="fancy-form">
              <label>Titulo</label>
              <input id="titulo" name="titulo" class="form-control" type="text" placeholder="Digite o titulo">
            </div>
          </div>


          <div class=" col-sm-12 col-md-5">
            <label>Sub Categoria</label>
            <div class="fancy-form fancy-form-select">
              <select class="form-control" id="Subcategoria" name="Subcategoria">
                <?php
                $sqlGlossario = mysql_query("SELECT * FROM publicacoes_oficiais_sub WHERE CdCategoria = ".$id." ORDER BY Nome2 ASC");
                $Glossario = mysql_num_rows($sqlGlossario);

                for ($y = 0; $y < $Glossario; $y++){
                    $verGlossario = mysql_fetch_array($sqlGlossario);

                    ?>
                <option value="<?php echo $verGlossario['CdSub']; ?>"><?php echo $verGlossario['Nome2']; ?></option>
                <?php
                }
                ?>
              </select>
            <i class="fancy-arrow"></i>
          </div>
        </div>

        <div class=" col-sm-12 col-md-11">
          <div class="fancy-form">
            <label>Descrição</label>
            <input id="Descricao" name="Descricao" class="form-control" type="text" placeholder="">
          </div>
        </div>

        <div class=" col-sm-12 col-md-7">
          <div class="fancy-form">
            <label>Data Abertura</label>
            <input data-mask="date" id="dtAbertura" name="dtAbertura" class="form-control" type="text" placeholder="">
          </div>
        </div>


          <div class=" col-sm-12 col-md-6">
            <label>Ação</label>
            <div class="fancy-form fancy-form-select">
              <select class="form-control" id="acao" name="acao">
                <?php
                $sqlGlossario = mysql_query("SELECT * FROM acao ORDER BY NomeAcao ASC");
                $Glossario = mysql_num_rows($sqlGlossario);

                for ($y = 0; $y < $Glossario; $y++){
                    $verGlossario = mysql_fetch_array($sqlGlossario);

                    ?>
                <option value="<?php echo $verGlossario['NomeAcao']; ?>"><?php echo $verGlossario['NomeAcao']; ?></option>
                <?php
                }
                ?>
              </select>
            <i class="fancy-arrow"></i>
          </div>
        </div>

        <div class=" col-sm-12 col-md-11">
          <div class="col-md-12">
        <label>
          Arquivo
          <small class="text-muted">obrigatório</small>
        </label>

        <!-- custom file upload -->
        <div class="fancy-file-upload fancy-file-primary">
          <i class="fa fa-upload"></i>
          <input type="file" class="form-control" onchange="jQuery(this).next('input').val(this.value);" name="arquivo" id="arquivo" />
          <input type="text" class="form-control" placeholder="no file selected" readonly="" />
          <span class="button">Procurar Arquivo</span>
        </div>
        <small class="text-muted block">Tamanho máximo: 2Mb (pdf)</small>

      </div>
        </div>

        <div class=" col-sm-12 col-md-11">
          <button type="submit" class="btn btn-3d btn-teal btn-block margin-top-30">
  				GRAVAR
  			</button></div>

        </form>
        </div>
    </div>
</div>

</body>
</html>
