<section class="page-title">
  <?php
  $sqlPagina = mysql_query("SELECT * FROM gabinete WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Tipo = 'Prefeito'");
  $rsPagina = mysql_fetch_array($sqlPagina);
   ?>
  <div class="container">
    <header>
      <ul class="breadcrumb dontPrint">
        <li><a class="inline" href="">Início</a></li>
        <li class="active">Gabinete do Prefeito(a)</li>
      </ul>
      <h1>Gabinete do Prefeito(a)</h1>
    </header>
  </div>
</section>

<div class="pt60 pb60">
  <div class="container">
    <div id="blog" class="row">
      <div class="col-md-9 col-sm-9" role="main">
        <div class="col-md-12 mb10">
          <div class="col-md-4 col-sm-4">
            <div class="col-md-9 col-md-offset-4 hidden-xs text-center margin-bottom20">
              <img class="img-responsive img-circle" src="https://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'];?>/departamento/<?php echo $rsPagina['Imagem']?>" title="Foto do(a) Prefeito(a): <?php echo $rsPagina['Nome']?>" alt="Foto do(a) Prefeito(a): <?php echo $rsPagina['Nome']?>">
            </div>
          </div>

          <div class="col-md-8 col-sm-8">
            <h1><?php echo $rsPagina['Nome']?></h1>
            <h3>Prefeito(a)</h3><br /><br />
            <p class="h3 similar-h3 mb10">
              <small>
              <strong>E-mail:</strong>
              <?php echo $rsPagina['Email']?>
              </small>
          </p>

          <p class="h3 similar-h3 mb10">
            <small>
            <strong>Telefone:</strong>
            <?php echo $rsPagina['Telefone']?>
            </small>
        </p>

        <p class="h3 similar-h3 mb10">
          <small>
          <strong>Profissão:</strong>
          <?php echo $rsPagina['Profissao']?>
          </small>
      </p>
            <?php echo $rsPagina['Descricao']?></div>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 dontPrint" role="complementary"><?php include 'lateral.php';?></div>
    </div>
  </div>
</div>
