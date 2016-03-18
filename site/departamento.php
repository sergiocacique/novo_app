<section class="page-title">
  <?php
  $ID = $_GET['id'];

  $sqlPagina = mysql_query("SELECT * FROM departamento WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND CdDepartamento = '".$ID."'");
  $rsPagina = mysql_fetch_array($sqlPagina);
   ?>
  <div class="container">
    <header>
      <ul class="breadcrumb dontPrint">
        <li><a class="inline" href="">Início</a></li>
        <li><a class="inline" href="">Secretarias</a></li>
        <li class="active"><?php echo $rsPagina['NomeDepartamento'];?></li>
      </ul>
      <h1><?php echo $rsPagina['NomeDepartamento'];?></h1>
    </header>
  </div>
</section>

<div class="pt60 pb60">
  <div class="container">
    <div id="blog" class="row">
      <div class="col-md-9 col-sm-9" role="main">
        <div class="col-md-12 mb10">

          <div class="col-md-12 col-sm-12">
            <h1><?php echo $rsPagina['NomeSecretario']?></h1>
            <h3><?php echo $rsPagina['Cargo']?></h3><br /><br />
            <p class="h3 similar-h3 mb10">
              <small>
              <strong>E-mail:</strong>
              <?php echo $rsPagina['Email']?>
            </small><br /><br />
            <small>
            <strong>Telefone:</strong>
            <?php echo $rsPagina['Telefones']?>
            </small><br /><br />
            <small>
            <strong>Horário:</strong>
            <?php echo $rsPagina['Horario']?>
            <strong>Endereço:</strong>
            <?php echo $rsPagina['Endereco']?>
            </small>
          </p>
            <?php echo $rsPagina['Sobre']?></div>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 dontPrint" role="complementary"><?php include 'lateral.php';?></div>
    </div>
  </div>
</div>
