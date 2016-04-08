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
<?php include ("menu_departamento.php");?>
<?php include ("topo.php");?>

<?php
$sqlPagina = mysql_query("SELECT * FROM gabinete WHERE CdPrefeitura = '".$_SESSION['PrefeituraID']."' AND Tipo = 'Vice'");
$rsPagina = mysql_fetch_array($sqlPagina);

$total = mysql_num_rows($sqlPagina)
 ?>
<div id="conteudo">
  <div class="row discovery">
      <div class="col-sm-9 col-md-10">
        <div class="header">
            <h1>Gabinete do Vice - Prefeito</h1>
        </div>
      </div>
  </div>

    <div class="row discovery2">
      <div class="table-responsive">
        <form class="validate" action="departamento_vice_prefeito_gravar.php" method="post" enctype="multipart/form-data">
          <?php
            if($total == 0){
            ?>
            <input type="hidden" name="acao" value="novo">
            <?php
            }else{
            ?>
              <input type="hidden" name="acao" value="atualizar">
              <input type="hidden" name="id" value="<?php echo $rsPagina['id'];?>">
          <?php
          }
          ?>
          <div class=" col-sm-12 col-md-9">
            <div class="fancy-form">
              <label>Nome</label>
              <input id="Nome" name="Nome" class="form-control" type="text" value="<?php echo $rsPagina['Nome'];?>">
            </div>
          </div>

          <div class=" col-sm-12 col-md-9">
            <div class="fancy-form">
              <label>Email</label>
              <input id="Email" name="Email" class="form-control" type="text" value="<?php echo $rsPagina['Email'];?>">
            </div>
          </div>

          <div class=" col-sm-12 col-md-9">
            <div class="fancy-form">
              <label>Telefone</label>
              <input id="Telefone" name="Telefone" class="form-control" type="text" value="<?php echo $rsPagina['Telefone'];?>">
            </div>
          </div>

          <div class=" col-sm-9 col-md-9">
            <textarea name="editor1" id="editor1"><?php echo $rsPagina['Descricao'];?></textarea>
              <script>
                  CKEDITOR.replace( 'editor1' );
              </script>
          </div>

          <div class=" col-sm-12 col-md-9">
            <div class="fancy-form">
              <label>Profissão</label>
              <input id="Profissao" name="Profissao" class="form-control" type="text" value="<?php echo $rsPagina['Profissao'];?>">
            </div>
          </div>

          <!-- FOTO  -->
          <div class=" col-sm-9 col-md-9">
            <div class="col-md-12">
					<label>
						Foto da Chamada - opcional
						<small class="text-muted">Largura de 253px</small>
					</label>

					<!-- custom file upload -->
					<div class="fancy-file-upload fancy-file-primary">
						<i class="fa fa-upload"></i>
						<input type="file" class="form-control" onchange="jQuery(this).next('input').val(this.value);" name="arquivo" id="arquivo" />
						<input type="text" class="form-control" placeholder="no file selected" readonly="" />
						<span class="button">Procurar Foto</span>
					</div>
					<small class="text-muted block">Tamanho máximo: 1Mb (jpg/png/gif)</small>

				</div>
          </div>


        <div class=" col-sm-9 col-md-9">
          <button type="submit" class="btn btn-3d btn-teal btn-block margin-top-30">
  				GRAVAR
  			</button></div>

        </form>
        </div>
    </div>
</div>

</body>
</html>
