<section class="page-title">

  <div class="container">
    <header>
      <ul class="breadcrumb dontPrint">
        <li><a class="inline" href="">Início</a></li>
        <li><a class="inline" href="">Informativos</a></li>
        <li class="active">Eventos</li>
      </ul>
      <h1>Eventos</h1>
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
        <div class="col-md-12 mb10">
          <ul class="nav nav-list mt10">
            <?php
            $sqlGlossario = mysql_query("SELECT * FROM vw_eventos WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY Titulo ASC");
            $Glossario = mysql_num_rows($sqlGlossario);

            for ($y = 0; $y < $Glossario; $y++){
                $verGlossario = mysql_fetch_array($sqlGlossario);

                ?>
            <li>
                  <h2 class="similar-h3 nomargin"><?php echo $verGlossario['Titulo']; ?></h2>
                  <p class="h3 similar-h3 mb10">
                  <small><?php echo $verGlossario['Descricao']; ?></small>
                  </p>
                  <p class="nomargin">
                  <strong>Departamento vinculado:</strong>
                  <?php echo $verGlossario['NomeDepartamento']; ?>
                  </p>

                  <p class="nomargin">
                  <strong>Data:</strong>
                  <?php echo date('d', strtotime($verGlossario['DtInicio'])); ?> de  <?php echo retorna_mes_extenso(date('m', strtotime($verGlossario['DtInicio']))); ?> de <?php echo date('Y', strtotime($verGlossario['DtInicio'])); ?>
                  <?php if($verGlossario['DtFim'] == "" OR $verGlossario['DtFim'] == "0000-00-00")
                  {
                  }else{?>
                  à
                  <?php echo date('d', strtotime($verGlossario['DtFim'])); ?> de  <?php echo retorna_mes_extenso(date('m', strtotime($verGlossario['DtFim']))); ?> de <?php echo date('Y', strtotime($verGlossario['DtFim'])); ?>
                  <?php }?>
                  </p>
              <div class="divider half-margins"></div>
            </li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 dontPrint" role="complementary"><?php include 'lateral.php';?></div>
    </div>
  </div>
</div>
