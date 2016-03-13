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
<?php include ("menu_informativos.php");?>
<?php include ("topo.php");?>

<?php
$CdNoticia = $_GET['noticia'];

$sqlPagina = mysql_query("SELECT * FROM site_noticias WHERE CdNoticia = '".$CdNoticia."'");
$rsPagina = mysql_fetch_array($sqlPagina);
 ?>
<div id="conteudo" class="container">
  <div class="row discovery">
      <div class="col-sm-9 col-md-10">
        <div class="header">
            <h1>Alterar Notícias</h1>
        </div>
      </div>
  </div>

    <div class="row discovery2">
      <div class="table-responsive">
        <form class="validate" action="informativos_noticias_gravar.php" method="post" enctype="multipart/form-data">
          <input type="hidden" id="CdNoticia" name="CdNoticia" value="<?php echo $rsPagina['CdNoticia'];?>">

          <div class=" col-sm-12 col-md-3">
            <div class="fancy-form">
              <label>Data</label>
              <input id="dtcadastro" name="dtcadastro" class="form-control masked" type="text" placeholder="<?php echo date('d/m/Y', strtotime($rsPagina['DtCadastro']));?>" data-placeholder="_" data-format="99/99/9999" value="<?php echo date('d/m/Y', strtotime($rsPagina['DtCadastro']));?>">
            </div>
          </div>

          <div class=" col-sm-12 col-md-9">
            <div class="fancy-form">
              <label>Titulo</label>
              <input id="titulo" name="titulo" class="form-control" type="text" placeholder="<?php echo $rsPagina['Titulo'];?>" value="<?php echo $rsPagina['Titulo'];?>">
            </div>
          </div>

            <div class=" col-sm-12 col-md-6">
              <label>Categoria</label>
              <div class="fancy-form fancy-form-select">
            	<select class="form-control" id="categoria" name="categoria">
                <?php
                $sqlGlossario = mysql_query("SELECT * FROM site_noticias_categoria ORDER BY Categoria ASC");
                $Glossario = mysql_num_rows($sqlGlossario);

                for ($y = 0; $y < $Glossario; $y++){
                    $verGlossario = mysql_fetch_array($sqlGlossario);

                    ?>
            		<option value="<?php echo $verGlossario['CdCategoria']; ?>" <?php if ($rsPagina['CdCategoria'] == $verGlossario['CdCategoria']){?>selected<?php }?>><?php echo $verGlossario['Categoria']; ?></option>
                <?php
                }
                ?>
            	</select>
              <i class="fancy-arrow"></i>
            </div>
          </div>

          <div class=" col-sm-12 col-md-6">
            <label>Departamento</label>
            <div class="fancy-form fancy-form-select">
              <select class="form-control" id="departamento" name="departamento">
                <?php
                $sqlGlossario = mysql_query("SELECT * FROM departamento WHERE CdPrefeitura = '".$_SESSION['PrefeituraID']."' ORDER BY NomeDepartamento ASC");
                $Glossario = mysql_num_rows($sqlGlossario);

                for ($y = 0; $y < $Glossario; $y++){
                    $verGlossario = mysql_fetch_array($sqlGlossario);

                    ?>
                <option value="<?php echo $verGlossario['CdDepartamento']; ?>" <?php if ($rsPagina['CdSecretaria'] == $verGlossario['CdDepartamento']){?>selected<?php }?>><?php echo $verGlossario['NomeDepartamento']; ?></option>
                <?php
                }
                ?>
              </select>
            <i class="fancy-arrow"></i>
          </div>
        </div>


          <div class=" col-sm-12 col-md-12">
            <label>Matéria</label>
            <textarea name="editor1" id="editor1"><?php echo $rsPagina['Materia'];?></textarea>
              <script>
                  CKEDITOR.replace( 'editor1' );
              </script>
          </div>

          <!-- FOTO  -->
          <div class=" col-sm-12 col-md-12">
            <div class="col-md-12">
					<label>
						Foto da Chamada - opcional
						<small class="text-muted">Largura de 808px</small>
					</label>

					<!-- custom file upload -->
					<div class="fancy-file-upload fancy-file-primary">
						<i class="fa fa-upload"></i>
						<input type="file" class="form-control" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" name="arquivo" id="arquivo" />
						<input type="text" class="form-control" placeholder="no file selected" readonly="" />
						<span class="button">Procurar Foto</span>
					</div>
					<small class="text-muted block">Tamanho máximo: 1Mb (jpg/png/gif)</small>

				</div>
          </div>

          <div class=" col-sm-12 col-md-6">
            <div class="fancy-form">
              <label>Fotografo</label>
              <input id="Fotografo" name="Fotografo" class="form-control" type="text" placeholder="<?php echo $rsPagina['Fotografo'];?>" value="<?php echo $rsPagina['Fotografo'];?>">
            </div>
          </div>

          <div class=" col-sm-12 col-md-6">
            <div class="fancy-form">
              <label>Fotografo</label>
              <input id="LegendaFoto" name="LegendaFoto" class="form-control" type="text" placeholder="<?php echo $rsPagina['LegendaFoto'];?>" value="<?php echo $rsPagina['LegendaFoto'];?>">
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
                <option value="<?php echo $verGlossario['NomeAcao']; ?>" <?php if ($rsPagina['Acao'] == $verGlossario['NomeAcao']){?>selected<?php }?>><?php echo $verGlossario['NomeAcao']; ?></option>
                <?php
                }
                ?>
              </select>
            <i class="fancy-arrow"></i>
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
