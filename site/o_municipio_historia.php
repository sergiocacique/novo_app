<section class="page-title">

  <div class="container">
    <header>
      <ul class="breadcrumb dontPrint">
        <li><a class="inline" href="">Início</a></li>
        <li><a class="inline" href="">O Município</a></li>
        <li class="active">História do Município</li>
      </ul>
      <h1>História do Município</h1>
    </header>
  </div>
</section>

<?php
$sqlPagina = mysql_query("SELECT * FROM prefeitura WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."'");
$rsPagina = mysql_fetch_array($sqlPagina);
 ?>

<div class="pt60 pb60">
  <div class="container">
    <div id="blog" class="row">
      <div class="col-md-9 col-sm-9" role="main">
        <div class="col-md-12 mb10"><?php echo $rsPagina['Sobre'];?></div>
      </div>
      <div class="col-md-3 col-sm-3 dontPrint" role="complementary"><?php include 'lateral.php';?></div>
    </div>
  </div>
</div>
