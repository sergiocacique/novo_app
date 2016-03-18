<section class="page-title">

  <div class="container">
    <header>
      <ul class="breadcrumb dontPrint">
        <li><a class="inline" href="">Início</a></li>
        <li><a class="inline" href="">O Município</a></li>
        <li><a class="inline" href="">Serviços</a></li>
        <li class="active">Serviço ao Servidor Público</li>
      </ul>
      <h1> Serviço ao Servidor Público</h1>
    </header>
  </div>
</section>



<div class="pt60 pb60">
  <div class="container">
    <div id="blog" class="row">
      <div class="col-md-9 col-sm-9" role="main">
        <div class="col-md-12 mb10">
          <ul class="nav nav-list mt10">
            <?php
            $sqlGlossario = mysql_query("SELECT * FROM vw_servicos WHERE  tipo = 'servidor' AND CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY Titulo ASC");
            $Glossario = mysql_num_rows($sqlGlossario);

            for ($y = 0; $y < $Glossario; $y++){
                $verGlossario = mysql_fetch_array($sqlGlossario);

                ?>
            <li>
              <a href="<?php echo $UrlAmigavel ?>?Pages=o_municipio_servico_ver&servico=<?php echo $verGlossario['id']; ?>" title="<?php echo $verGlossario['Titulo']; ?>">
                  <h2 class="similar-h3 nomargin"><?php echo $verGlossario['Titulo']; ?></h2>
                  <p class="nomargin">
                  <strong>Departamento vinculado:</strong>
                  <?php echo $verGlossario['NomeDepartamento']; ?>
                  </p>
              </a>
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
