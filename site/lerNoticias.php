<?php
$CdPagina = $_GET['noticia'];

$sqlPagina = mysql_query("SELECT * FROM vw_noticias WHERE CdNoticia = '".$CdPagina."'");
$rsPagina = mysql_fetch_array($sqlPagina);
?>
<section class="page-title">
  <div class="container">
    <header>
      <ul class="breadcrumb dontPrint">
        <li><a class="inline" href="">Início</a></li>
        <li><a class="inline" href="">Informativos</a></li>
        <li><a class="inline" href="">Notícias</a></li>
        <li class="active"><?php echo $rsPagina['Titulo'];?></li>
      </ul>
      <h1><?php echo $rsPagina['Titulo'];?></h1>
    </header>
  </div>
</section>

<div class="pt60 pb60">
  <div class="container">
    <div id="blog" class="row">
      <div class="col-md-9 col-sm-9" role="main">
        <div class="col-md-12 mb10">
          <?php
          if($rsPagina['Imagem'] != "") {
          ?>
          <h6>Foto: <?php echo $rsPagina['Fotografo'];?></h6>
          <img class="img-rounded pula" src="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/noticias/<?php echo $rsPagina['Imagem']; ?>" width="100%">
          <?php
          }
          ?>
          <h6><span class="cat_<?php echo $rsPagina['Color'];?>"><?php echo $rsPagina['LegendaFoto'];?></span></h6>
          <?php echo $rsPagina['Materia'];?>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 dontPrint" role="complementary"><?php include 'lateral.php';?></div>
    </div>
  </div>
</div>
