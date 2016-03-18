<script>
function verDiario(mes,ano,CdPrefeitura){
        $('#loading2').css('visibility','visible');
        $.post("diariointerna.php", { mes: mes, ano: ano, CdPrefeitura: CdPrefeitura },
            function(data){
                $('#verDiario').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }
</script>
<section class="page-title">

  <div class="container">
    <header>
      <ul class="breadcrumb dontPrint">
        <li><a class="inline" href="">Início</a></li>
        <li><a class="inline" href="">Publicações Oficiais</a></li>
        <li class="active">Diário Oficial</li>
      </ul>
      <h1>Diário Oficial</h1>
    </header>
  </div>
</section>


<div class="pt60 pb60">
  <div class="container">
    <div id="blog" class="row">
      <div class="col-md-9 col-sm-9" role="main">
        <div class="col-md-12 mb10">
          <div class="col-xs-12 col-sm-12 col-md-12" id="verDiario">

<?php
$sql = "SELECT * FROM diario_oficial WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' GROUP BY DATE_FORMAT(DtCadastro, '%Y'), DATE_FORMAT(DtCadastro, '%m') ORDER BY DATE_FORMAT(DtCadastro, '%Y') DESC, DATE_FORMAT(DtCadastro, '%m') DESC LIMIT 1";
        $sqlReceita = mysql_query($sql);
                $rsRece = mysql_fetch_array($sqlReceita);
                $ContaReceita = mysql_num_rows($sqlReceita);
 ?>
                  <h3><?php echo retorna_mes_extenso(date('m', strtotime($rsRece['DtCadastro']))); ?><span class="classh3"> <?php echo date('Y', strtotime($rsRece['DtCadastro'])); ?></span></h3>

                  <?php
                  $sqlverDiario = mysql_query("SELECT * FROM diario_oficial WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND DATE_FORMAT(DtCadastro, '%m') = ".date('m', strtotime($rsRece['DtCadastro']))." AND DATE_FORMAT(DtCadastro, '%Y') = ".date('Y', strtotime($rsRece['DtCadastro']))." AND Acao = 'Publicado' ORDER BY DtCadastro DESC") or die(mysql_error());
                  $DiarioOficial = mysql_num_rows($sqlverDiario);
                  for ($y = 0; $y < $DiarioOficial; $y++){
                      $verDiario = mysql_fetch_array($sqlverDiario);

                      ?>
                      <div class="col-xs-12 col-sm-4 col-md-4">
                          <div class="panel panel-default">
                              <div class="panel-body">
                                  <ul class="panel-actions">
                                      <li>
                                          <a href="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura["Pasta"]?>/diario/<?php echo $verDiario["Texto"]?>" target="_blank">
                                              <i class="fa fa-spin-2x fa-2x fa-file-pdf-o text-danger"></i>
                                          </a>
                                      </li>
                                  </ul>
                                  <p class="text-muted">Diário Oficial de <?php echo $rsConfig['Titulo'] ?> <br> nº <?php echo $verDiario["NumDiario"]?></p>
                                  <p>
                                      <small>
                                          <span class="text-muted"><?php echo date('d/m/Y', strtotime($verDiario["DtCadastro"])); ?></span>
                                      </small>
                                  </p>
                              </div>
                          </div>
                      </div>
                  <?php
                  }
                  ?>


              </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 dontPrint" role="complementary">
        <div class="panel-group" id="accordion1">
                <?php
                $sqlAno = mysql_query("SELECT DISTINCT DATE_FORMAT(DtCadastro, '%Y') FROM diario_oficial WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' ORDER BY DATE_FORMAT(DtCadastro, '%Y') DESC") or die(mysql_error());
                $Ano = mysql_num_rows($sqlAno);
                for ($i = 0; $i < $Ano; $i++){
                    $ResultadoAno = mysql_fetch_array($sqlAno);

                    if ($i > 0){
                        $classServ = "false";
                    }else{
                        $classServ = "true";
                    }
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion<?php echo $i ?>" href="#collapse<?php echo $i ?>" aria-expanded="" aria-controls="collapse<?php echo $i; ?>">
                                    <?php echo $ResultadoAno["DATE_FORMAT(DtCadastro, '%Y')"] ?>
                                </a>
                            </h4><!-- /panel-title -->
                        </div><!-- /panel-heading -->
                        <div id="collapse<?php echo $i ?>" class="panel-collapse collapse <?php echo $classServ == "true" ? 'in':'';?>" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                            <div class="panel-body">
                                <ul class="nav nav-pills nav-stacked" style="max-width: 100%">
                                    <?php
                                    $sqlMes = mysql_query("SELECT DISTINCT DATE_FORMAT(DtCadastro, '%m'), DATE_FORMAT(DtCadastro, '%Y'), CdPrefeitura FROM diario_oficial WHERE DATE_FORMAT(DtCadastro, '%Y') = ".$ResultadoAno["DATE_FORMAT(DtCadastro, '%Y')"]." AND CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' ORDER BY DtCadastro DESC");
                                    //$sqlMes = mysql_query("SELECT DISTINCT DATE_FORMAT(DtCadastro, '%m'), DATE_FORMAT(DtCadastro, '%Y') FROM site_diario_oficial WHERE DATE_FORMAT(DtCadastro, '%Y') = ".$ResultadoAno["DATE_FORMAT(DtCadastro, '%Y')"]." ORDER BY DtCadastro DESC");
                                    $mes = mysql_num_rows($sqlMes);
                                    for ($x = 0; $x < $mes; $x++){
                                        $ResultadoMes = mysql_fetch_array($sqlMes);
                                        ?>
                                        <li><a href="javascript:void(0)" onClick="verDiario(<?php echo $ResultadoMes["DATE_FORMAT(DtCadastro, '%m')"].",".$ResultadoMes["DATE_FORMAT(DtCadastro, '%Y')"]?>,<?php echo $ResultadoMes['CdPrefeitura']?>)"><?php echo retorna_mes_extenso($ResultadoMes["DATE_FORMAT(DtCadastro, '%m')"])?></a></li>
                                    <?php }?>
                                </ul>
                            </div><!-- /panel-body -->
                        </div><!-- /panel-collapse -->
                    </div><!-- /panel -->
                <?php }?>


            </div><!-- /panel-group -->
      </div>
    </div>
  </div>
</div>
