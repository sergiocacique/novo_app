

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
                <?php
                if ($verBanner['Exibir'] == "sim") {
                    ?>
                    <div class="carousel-caption">
                        <h2><?php echo $verBanner['titulo'];?></h2>
                    </div>
                <?php
                }
                ?>
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
<div class="container">
    <div class="row nomargin">
        <?php
        //$sqlPagina = mysql_query("SELECT *, concat(DtCadastro, ' ', HrCadastro) as dthr  FROM site_noticias WHERE Acao = 'Publicado' ORDER BY dthr DESC");
        $sqlPagina = mysql_query("SELECT * FROM site_noticias WHERE Acao = 'Publicado' AND  CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' ORDER BY DtCadastro DESC");
        $rsPagina = mysql_fetch_array($sqlPagina);
        $contador1 = mysql_num_rows($sqlPagina);

        if ($contador1 == 0){
            ?>
            <div class="col-md-8 col-sm-8">
                    <div class="legenda">
                        <div class="legenda2">
                                <div class="titulo_<?php echo $rsLinha2['Color'];?> fonte-14 text-center largura-40 maiusculo">sem noticia</div>
                                <p class="legenda_capa fonte-14 maiusculo">ainda não há notícia cadastrada</p>
                        </div>
                    </div>
                    <img class="img-responsive tam-fixo400" src="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/noticias/sem-noticia.jpg" alt="ainda não há notícia cadastrada" border="0">
            </div>
            <?php

        }else{

        $sqlLinha2 = mysql_query("SELECT * FROM site_noticias_categoria WHERE CdCategoria = '".$rsPagina['CdCategoria']."'");
        $rsLinha2 = mysql_fetch_array($sqlLinha2);
        ?>

            <div class="col-md-8 col-sm-8 minDestaque">
                <a href="<?php echo $UrlAmigavel ?><?php echo $rsPrefeitura['Pasta'] ?>/lerNoticias/<?php echo $rsPagina['CdNoticia'];?>/<?php echo removeAcentos($rsPagina['Titulo'], '-');?>">
                    <div class="legenda">
                        <div class="legenda2">
                            <a href="<?php echo $UrlAmigavel ?><?php echo $rsPrefeitura['Pasta'] ?>/lerNoticias/<?php echo $rsPagina['CdNoticia'];?>/<?php echo removeAcentos($rsPagina['Titulo'], '-');?>">
                                <div class="titulo_<?php echo $rsLinha2['Color'];?> fonte-14 text-center largura-40 maiusculo"><?php echo $rsLinha2['Categoria'];?></div>
                                <p class="legenda_capa fonte-14 maiusculo"><?php echo $rsPagina['Legenda'];?></p>
                            </a>
                        </div>
                    </div>
                    <?php
                    if($rsPagina['Imagem'] != "") {
                        ?>
                        <img class="img-responsive tam-fixo400"
                             src="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/noticias/<?php echo $rsPagina['Imagem']; ?>"
                             alt="<?php echo $rsPagina['Titulo']; ?>" border="0">
                    <?php
                    }else{
                        ?>
                        <img class="img-responsive tam-fixo400" src="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/noticias/sem-noticia.jpg" alt="ainda não há notícia cadastrada" border="0">
                    <?php
                    }
                    ?>
                </a>
            </div>

        <?php }?>

        <div class="col-md-3 col-sm-3">
            <a class="btn btn-3d btn-xlg btn-purple btnTamanho" href="#">
                DIÁRIO OFICIAL
                <span class="block font-lato">MUNICIPAL</span>
            </a>
            <br clear="all">

            <a class="btn btn-3d btn-xlg btn-red btnTamanho" href="#">
                PORTAL DA
                <span class="block font-lato">TRANSPARÊNCIA</span>
            </a>
            <br clear="all">
            <a class="btn btn-3d btn-xlg btn-teal btnTamanho" href="#">
                NOTA FISCAL
                <span class="block font-lato">ELETRÔNICA</span>
            </a>
            <br clear="all">
            <a class="btn btn-3d btn-xlg btn-green btnTamanho" href="#">
                SERVICOS
                <span class="block font-lato">PARA O CIDADÃO</span>
            </a>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"></h2>
        </div>
        <?php
        if ($contador1 == 0){

        for($i1 =1; $i1 < 6; $i1++) {
            ?>

            <div class="col-md-2 text-left">
                <div>
                        <h3>
                            <small><span class="cat_azul maiusculo">sem notícia</span>
                            </small>
                        </h3>
                        <img class="img-responsive tam-fixo" alt="" src="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/noticias/sem-noticia.jpg">

                        <div class="caption">

                            <p class="fonte-11 maiusculo">não há notícia cadastrada</p>

                        </div>
                </div>
            </div>
        <?php
        }

        }else{
        //$sqlEstrutura = mysql_query("SELECT *, concat(DtCadastro, ' ', HrCadastro) as dthr  FROM site_noticias WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' AND CdNoticia <> ".$rsPagina['CdNoticia']." ORDER BY dthr DESC LIMIT 3") or die(mysql_error());
        $sqlEstrutura = mysql_query("SELECT *  FROM site_noticias WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' AND CdNoticia <> ".$rsPagina['CdNoticia']." ORDER BY DtCadastro DESC LIMIT 4") or die(mysql_error());
        $contador = mysql_num_rows($sqlEstrutura);

            if ($contador == 0){
                for($i1 =1; $i1 < 4; $i1++) {
                    ?>
                    <div class="col-sm-6 col-md-3">
                        <div>
                            <h3>
                                <small><span class="cat_azul maiusculo">sem notícia</span>
                                </small>
                            </h3>
                            <img class="img-responsive tam-fixo" alt="" src="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/noticias/sem-noticia.jpg">

                            <div class="caption">

                                <p class="fonte-11 maiusculo">não há notícia cadastrada</p>

                            </div>
                        </div>
                    </div>
                <?php
                }
            }else{
        for ($i = 0; $i < $contador; $i++){
        $linha = mysql_fetch_array($sqlEstrutura);

            $sqlLinha = mysql_query("SELECT * FROM site_noticias_categoria WHERE CdCategoria = '".$linha['CdCategoria']."'");
            $rsLinha = mysql_fetch_array($sqlLinha);

        ?>
    <div class="col-sm-6 col-md-3">
        <div class="thumbnail minimo">
            <?php
            if($linha['Imagem'] != "") {
                ?>
            <img class="img-responsive" alt="" src="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/noticias/<?php echo $linha['Imagem']; ?>">
            <?php
            }else{?>
                <img class="img-responsive" alt="" src="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/noticias/sem-noticia.jpg">
            <?php
            }
            ?>
            <div class="caption">
                <h4><?php echo $rsLinha['Categoria'];?></h4>
                <p><?php echo $linha['Titulo'];?></p>
                <a class="btn btn-primary" role="button" href="<?php echo $UrlAmigavel ?><?php echo $rsPrefeitura['Pasta'] ?>/lerNoticias/<?php echo $linha['CdNoticia'];?>/<?php echo removeAcentos($linha['Titulo'], '-');?>">leia mais</a>
            </div>
        </div>


    </div>
        <?php } }
        }?>
    </div>


</div>
<section class="parallax parallax-2" style="background-image: url('municipio/<?php echo $rsPrefeitura['Pasta'] ?>/20-min.jpg');">
    <div class="overlay dark-8"><!-- dark overlay [1 to 9 opacity] --></div>

    <div class="container">
        <div class="text-center">
            <h3 class="font-Roboto weight-700 nomargin"><?php echo $rsConfig['Titulo'] ?></h3>
            <p class="font-lato weight-300 lead nomargin-top"> </p>
            <h6>
                <?php echo $rsConfig['Endereco'] ?>
                <br>
                <?php echo $rsConfig['Email'] ?>
                <br>
                <?php echo $rsConfig['Telefone'] ?>
            </h6>
            <h5></h5>
            <p></p>
        </div>
    </div>



</section>

<div class="container">
<div class="info-bar info-bar-color info-bar-bordered">
    <div class="container">

        <div class="row">

            <div class="col-sm-4">
                <i class="glyphicon glyphicon-globe"></i>
                <h3>NFS-e</h3>
                <p>Nota Fiscal de Serviço eletrônica</p>
            </div>

            <div class="col-sm-4">
                <i class="glyphicon glyphicon-usd"></i>
                <h3>IPTU</h3>
                <p>Imposto Predial e Territorial Urbano.</p>
            </div>

            <div class="col-sm-4">
                <i class="glyphicon glyphicon-flag"></i>
                <h3>EDITAIS</h3>
                <p>Concursos, Decretos, Seletivos e Convocações.</p>
            </div>

        </div>

    </div>
</div>
    </div>

