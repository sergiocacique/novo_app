<section class="page-title">
  <?php
  $ID = $_GET['servico'];

  $sqlPagina = mysql_query("SELECT * FROM vw_servicos WHERE id = '".$ID."'");
  $rsPagina = mysql_fetch_array($sqlPagina);

  if($rsPagina['Tipo'] == "cidadao"){
    $tituloServ = "Serviço ao Cidadão";
  }elseif ($rsPagina['Tipo'] == "empreendedor") {
    $tituloServ = "Serviço ao Empreendedor";
  }elseif ($rsPagina['Tipo'] == "estudante") {
    $tituloServ = "Serviço ao Estudante";
  }elseif ($rsPagina['Tipo'] == "servidor") {
    $tituloServ = "Serviço ao Servidor Público";
  }
   ?>
  <div class="container">
    <header>
      <ul class="breadcrumb dontPrint">
        <li><a class="inline" href="">Início</a></li>
        <li><a class="inline" href="">O Município</a></li>
        <li><a class="inline" href="">Serviços</a></li>
        <li class="active"><?php echo $rsPagina['Titulo']?></li>
      </ul>
      <h1><?php echo $rsPagina['Titulo']?></h1>
    </header>
  </div>
</section>

<div class="pt60 pb60">
  <div class="container">
    <div id="blog" class="row">
      <div class="col-md-9 col-sm-9" role="main">
        <div class="col-md-12 mb10">
          <p class="h3 similar-h3 mb10">
        <small>
        <strong>Tipo de Serviço:</strong>
        <?php echo $tituloServ?>
        </small>
        </p>
        <p class="h3 similar-h3 mb10">
      <small>
      <strong>Departamento Vinculado:</strong>
      <?php echo $rsPagina['NomeDepartamento']?>
      </small>
      </p>
        <div class="col-md-12 mb15"><?php echo $rsPagina['Descricao']?></div>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 dontPrint" role="complementary"><?php include 'lateral.php';?></div>
    </div>
  </div>
</div>
