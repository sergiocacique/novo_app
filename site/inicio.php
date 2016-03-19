<?php
if ($rsPortal['Banner'] == "sim"){?>
<header id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <!--    <ol class="carousel-indicators">-->
    <!--        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>-->
    <!--        <li data-target="#myCarousel" data-slide-to="1"></li>-->
    <!--        <li data-target="#myCarousel" data-slide-to="2"></li>-->
    <!--    </ol>-->

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <?php

        $sql = "SELECT * FROM site_banner WHERE (Acao = 'publicado') AND CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' ORDER BY Posicao DESC";

        $sqlBanner = mysql_query($sql);
        $Banner = mysql_num_rows($sqlBanner);

        for ($y = 0; $y < $Banner; $y++){
            $verBanner = mysql_fetch_array($sqlBanner);

            if ($y > 0){
                $classServ = "false";
            }else{
                $classServ = "true";
            }

            ?>
            <div class="item <?php echo $classServ == "true" ? 'active':'';?>">
                <div class="fill" style="background-image:url('http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/Banner/<?php echo $verBanner['imagem'];?>');"></div>

            </div>
        <?php
        }
        ?>
    </div>

    <!-- Controls -->
<!--    <a class="left carousel-control" href="#myCarousel" data-slide="prev">-->
<!--        <span class="icon-prev"></span>-->
<!--    </a>-->
<!--    <a class="right carousel-control" href="#myCarousel" data-slide="next">-->
<!--        <span class="icon-next"></span>-->
<!--    </a>-->
</header>
<?php } ?>
<div class="container">
    <div class="row nomargin">

        <div class="col-xs-12 col-md-9 col-sm-8">

        <div class="col-xs-12 col-md-12 col-sm-12">
            <div id="owl-destaque">

                <?php
                $sqlEstrutura = mysql_query("SELECT *  FROM site_noticias WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' AND Destaque = 'sim' ORDER BY DtCadastro DESC LIMIT 4") or die(mysql_error());
                $contador = mysql_num_rows($sqlEstrutura);

                for ($i = 0; $i < $contador; $i++){
                    $linha = mysql_fetch_array($sqlEstrutura);
                ?>
                <div class="item"><img class="img-responsive" src="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/noticias/<?php echo $linha['Imagem']; ?>" alt="Owl Image"></div>
                <?php }?>

            </div>
            <br clear="all">
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div id="owl-carousel" class="owl-carousel" data-plugin-options='{"singleItem": false, "items":"<?php echo $rsPortal['QtdNoticias'];?>", "autoPlay": 4000, "navigation": true, "pagination": false}'>
                    <?php
                    $idNoticiaDestaque = "";
                    $sqlEstrutura1 = mysql_query("SELECT *  FROM site_noticias WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY DtCadastro DESC LIMIT ".$rsPortal['QtdNoticias']."") or die(mysql_error());
                    $contador1 = mysql_num_rows($sqlEstrutura1);

                    for ($i1 = 0; $i1 < $contador1; $i1++){
                    $linha1 = mysql_fetch_array($sqlEstrutura1);

                        $sqlLinha = mysql_query("SELECT * FROM site_noticias_categoria WHERE CdCategoria = '".$linha1['CdCategoria']."'");
                        $rsLinha = mysql_fetch_array($sqlLinha);

                        $idNoticiaDestaque = $idNoticiaDestaque. " CdNoticia <> ".$linha1['CdNoticia']." AND"
                    ?>
                    <div class="img-hover">
                        <a href="blog-single-default.html">
                            <img class="img-responsive" src="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/noticias/<?php echo $linha1['Imagem']; ?>" alt="">
                        </a>

                        <h4 class="text-left margin-top-20"><a href="blog-single-default.html"><?php echo $rsLinha['Categoria'];?></a></h4>
                        <p class="text-left"><?php echo $linha1['Titulo'];?></p>
                        <ul class="text-left size-12 list-inline list-separator">
                            <li>
                                <i class="fa fa-calendar"></i>
                                <?php echo twitter_time($linha1['DtCadastro']);?>
                            </li>

                        </ul>
                    </div>
                    <?php }?>

                </div>
            </div>
        </div>
        <?php if ($rsPortal['AcessoRapido'] == "sim"){?>
        <div class="col-xs-12 col-md-3 col-sm-4">
            <div class="side-nav">
                <div class="side-nav-head">
                    <h4>ACESSO RÁPIDO</h4>
                </div>
                <ul class="list-group list-unstyled">
                    <?php
                    $sqlAcesso = mysql_query("SELECT *  FROM site_acesso_rapido WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado'  ORDER BY Posicao ASC") or die(mysql_error());
                    $contaAcesso = mysql_num_rows($sqlAcesso);

                    for ($a = 0; $a < $contaAcesso; $a++){
                    $Acessos = mysql_fetch_array($sqlAcesso);
                    ?>
                    <li class="list-group-item AcessoRapido">
                        <a href="<?php echo $Acessos['Link'];?>"><?php echo $Acessos['Nome'];?></a>
                    </li>
                    <?php }?>
                </ul>
            </div>

            <div class="side-nav">


                <div id="owl-gabinete">

                  <?php
                  $sqlGlossario = mysql_query("SELECT * FROM gabinete WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' ORDER BY Tipo ASC");
                  $Glossario = mysql_num_rows($sqlGlossario);

                  for ($y = 0; $y < $Glossario; $y++){
                      $verGlossario = mysql_fetch_array($sqlGlossario);

                      ?>
                    <div class="item"><img src="https://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'];?>/departamento/<?php echo $verGlossario['Imagem']?>" alt="<?php echo $verGlossario['Nome']; ?>"></div>
                    <?php
                    }
                    ?>

                </div>


            </div>
        </div>
        <?php }?>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="side-nav">


                <div id="owl-demo">

                    <?php
                    $sqlServ = mysql_query("SELECT *  FROM site_servicos WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado'  ORDER BY RAND()");
                    $contador2 = mysql_num_rows($sqlServ);

                    for ($i2 = 0; $i2 < $contador2; $i2++){
                        $Serv = mysql_fetch_array($sqlServ);
                        ?>

                        <div class="item"><a href="<?php echo $Serv['Link'];?>"><img src="http://www.minhaprefeitura.com.br/municipio/<?php echo $rsPrefeitura['Pasta'];?>/<?php echo $Serv['img'];?>" alt="<?php echo $Serv['Nome'];?>"></a></div>
                    <?php }?>
                </div>


            </div>
        </div>

    </div>
</div>
<?php if ($rsPortal['Social'] == "sim"){?>
<section class="theme-color">
    <div class="container">
        <div class="col-md-7 col-sm-7">
            <div class="side-nav">
                <div class="side-nav-head">
                    <h4>TV PREFEITURA</h4>
                </div>
                <iframe width="640" height="360" src="https://www.youtube.com/embed/ODt5Es8cX7U" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

        <div class="col-md-5 col-sm-5">
            <div class="side-nav">
                <div class="side-nav-head">
                    <h4>RÁDIO PREFEITURA</h4>
                </div>
<iframe width="100%" height="360" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/90634813&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=false"></iframe>
            </div>
        </div>
</div>
</section>
<?php }else{ ?>
  <section class="theme-color">
      <div class="container">
          <div class="col-md-4 col-sm-4" style="border-right: #C3C3C3 1px dashed;">
              <div class="side-nav">
                  <div class="side-nav-head">
                      <h4>LICITAÇÕES</h4>
                  </div>
                  <ul class="list-group list-unstyled">
                      <li class="list-group-item">
                          <a href="javascript:void(0)">Contas Públicas</a>
                      </li>
                      <li class="list-group-item">
                          <a href="javascript:void(0)">Acesso à informação - SIC</a>
                      </li>
                      <li class="list-group-item">
                          <a href="javascript:void(0)">Solicitação de Informação</a>
                      </li>
                      <li class="list-group-item">
                          <a href="javascript:void(0)">Perguntas Frequentes</a>
                      </li>
                      <li class="list-group-item">
                          <a href="javascript:void(0)">Portal da Transparência</a>
                      </li>
                      <li class="list-group-item">
                          <a href="javascript:void(0)">Legislação</a>
                      </li>
                      <li class="list-group-item">
                          <a href="javascript:void(0)">Licitações</a>
                      </li>
                      <li class="list-group-item">
                          <a href="javascript:void(0)">Concursos</a>
                      </li>
                  </ul>
              </div>
          </div>

          <div class="col-md-4 col-sm-4" style="border-right: #C3C3C3 1px dashed;">
              <div class="side-nav">
                  <div class="side-nav-head">
                      <h4>DIÁRIO OFICIAL</h4>
                      <p>Acesse as informações sobre o andamento de licitações e concursos, ou consulte as leis do município por meio dos campos abaixo.</p>
                  </div>

                  <ul class="list-group list-unstyled">
                      <?php
                      $sqlGlossario = mysql_query("SELECT * FROM diario_oficial WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY DtCadastro DESC LIMIT 2");
                      $Glossario = mysql_num_rows($sqlGlossario);

                      for ($y = 0; $y < $Glossario; $y++){
                          $verGlossario = mysql_fetch_array($sqlGlossario);


                          ?>
                          <li>
                              <div class="row">
                                  <div class="col-md-12">
                                      <a class="curva4 padding10 g92" href="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura["Pasta"]?>/diario/<?php echo $verGlossario["Texto"]?>">
                                          <strong><?php echo $verGlossario['NumDiario'];?></strong>
                                      </a>
                                      <p class="mb0">
                                          <?php echo date('d/m/Y', strtotime($verGlossario["DtCadastro"])); ?>
                                      </p>
                                      <a class="btn btn-default pull-left btn-sm" href="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura["Pasta"]?>/diario/<?php echo $verGlossario["Texto"]?>" title="">Baixar</a>
                                  </div>
                              </div>
                              <hr class="hr-secretarias">
                          </li>
                      <?php
                      }
                      ?>

                  </ul>
                  <a class="btn btn-default pull-right btn-sm" href="<?php echo $UrlAmigavel;?>?Pages=diario_oficial" title="Mais Diários">Mais Diários</a>
              </div>
          </div>

          <div class="col-md-4 col-sm-4">
              <div class="side-nav">
                  <div class="side-nav-head">
                      <h4>SECRETARIAS</h4>
                  </div>

                  <ul class="list-group list-unstyled">
                      <?php
                      $sqlGlossario = mysql_query("SELECT * FROM departamento WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY Rand() Limit 3");
                      $Glossario = mysql_num_rows($sqlGlossario);

                      for ($y = 0; $y < $Glossario; $y++){
                          $verGlossario = mysql_fetch_array($sqlGlossario);
                          ?>
                          <li>
                              <div class="row">
                                  <div class="col-md-12">
                                          <strong><?php echo $verGlossario['NomeDepartamento'];?></strong>
                                      <p class="mb0">
                                          <strong>Resp:</strong>
                                          <?php echo $verGlossario['NomeSecretario'];?>
                                          <br>
                                          <strong>Fone:</strong>
                                          <?php echo $verGlossario['Telefones'];?>
                                      </p>
                                  </div>
                              </div>
                              <hr class="hr-secretarias">
                          </li>
                      <?php
                      }
                      ?>

                  </ul>
                  <a class="btn btn-default pull-right btn-sm" href="<?php echo $UrlAmigavel;?>secretarias" title="Mais Secretarias">Mais Secretarias</a>
              </div>
          </div>
      </div>
  </section>
<?php }?>
<section class="parallax parallax-2" style="height:360px; background-image: url('https://www.minhaprefeitura.com.br/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/20-min.jpg');">
    <div class="overlay dark-8"><!-- dark overlay [1 to 9 opacity] --></div>

    <div class="container">
        <div class="text-center">
            <!-- <h3 class="font-Roboto weight-700 nomargin"><?php echo $rsConfig['Titulo'] ?></h3>
            <p class="font-lato weight-300 lead nomargin-top"> </p>
            <h6>
                <?php echo $rsConfig['Endereco'] ?>
                <br>
                <?php echo $rsConfig['Email'] ?>
                <br>
                <?php echo $rsConfig['Telefone'] ?>
            </h6>
            <h5></h5>
            <p></p> -->
        </div>
    </div>



</section>
<?php
if ($rsPortal['OutraNoticias'] == "sim"){?>
<div class="container">
    <div class="row nomargin">

        <div class="col-xs-12 col-md-9 col-sm-8">

            <div class="col-xs-12 col-sm-12 col-md-12">
                    <?php
                    $sqlEstrutura3 = mysql_query("SELECT *  FROM site_noticias WHERE ".$idNoticiaDestaque." CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY DtCadastro DESC LIMIT ".$rsPortal['QtdOutraNoticias']."") or die(mysql_error());
                    $contador3 = mysql_num_rows($sqlEstrutura3);

                    for ($i3 = 0; $i3 < $contador3; $i3++){
                    $linha3 = mysql_fetch_array($sqlEstrutura3);

                        $sqlLinha1 = mysql_query("SELECT * FROM site_noticias_categoria WHERE CdCategoria = '".$linha3['CdCategoria']."'");
                        $rsLinha1 = mysql_fetch_array($sqlLinha1);
                    ?>
                    <div class="col-xs-4 col-sm-4 col-md-4 margin-top30">
                    <div class="img-hover box-mais-news border-<?php echo $rsLinha1['Color'];?>">
                        <a href="blog-single-default.html">
                            <img class="img-responsive" src="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/noticias/<?php echo $linha3['Imagem']; ?>" alt="">
                        </a>

                        <h4 class="text-left margin-top-20"><a href="blog-single-default.html"><?php echo $rsLinha1['Categoria'];?></a></h4>
                        <p class="text-left"><?php echo $linha3['Titulo'];?></p>
                        <ul class="text-left size-12 list-inline list-separator">
                            <li>
                                <i class="fa fa-calendar"></i>
                                <?php echo twitter_time($linha3['DtCadastro']);?>
                            </li>

                        </ul>
                    </div>
                    </div>
                    <?php }?>


            </div>
        </div>
        <?php if ($rsPortal['AcessoRapido'] == "sim"){?>
        <div class="col-xs-12 col-md-3 col-sm-4">
            <div class="side-nav">
                <div class="side-nav-head">
                    <h4>ACESSO RÁPIDO</h4>
                </div>
                <ul class="list-group list-unstyled">
                    <?php
                    $sqlAcesso = mysql_query("SELECT *  FROM site_acesso_rapido WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado'  ORDER BY Posicao ASC") or die(mysql_error());
                    $contaAcesso = mysql_num_rows($sqlAcesso);

                    for ($a = 0; $a < $contaAcesso; $a++){
                    $Acessos = mysql_fetch_array($sqlAcesso);
                    ?>
                    <li class="list-group-item AcessoRapido">
                        <a href="<?php echo $Acessos['Link'];?>"><?php echo $Acessos['Nome'];?></a>
                    </li>
                    <?php }?>
                </ul>
            </div>


            <div class="side-nav">
                <div class="side-nav-head">
                    <h4>SECRETARIAS</h4>
                </div>

                <ul class="list-group list-unstyled">
                    <?php
                    $sqlGlossario = mysql_query("SELECT * FROM departamento WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY Rand() Limit 4");
                    $Glossario = mysql_num_rows($sqlGlossario);

                    for ($y = 0; $y < $Glossario; $y++){
                        $verGlossario = mysql_fetch_array($sqlGlossario);
                        ?>
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                        <strong><?php echo $verGlossario['NomeDepartamento'];?></strong>
                                    <p class="mb0">
                                        <strong>Resp:</strong>
                                        <?php echo $verGlossario['NomeSecretario'];?>
                                        <br>
                                        <strong>Fone:</strong>
                                        <?php echo $verGlossario['Telefones'];?>
                                    </p>
                                </div>
                            </div>
                            <hr class="hr-secretarias">
                        </li>
                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
        <?php }?>


    </div>
</div>
<?php }?>
