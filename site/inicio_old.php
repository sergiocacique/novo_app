

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


            <div class="col-md-9 col-sm-9">
                <div class="item">
                    <div class="col-md-4">
                        <img class="img-responsive max-height360" alt="Prefeitura será premiada com selo digital por transparência na prestação de contas" src="http://demo.i-prefeituras.com.br/uploads/noticia/16027/maior_tetee.png">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb10 lineh32">
                            <a href="http://demo.i-prefeituras.com.br/noticia/visualizar/id/158/?prefeitura-sera-premiada-com-selo-digital-por-transparencia-na-prestacao-de-contas.html" title="Prefeitura será premiada com selo digital por transparência na prestação de contas"> Prefeitura será premiada com selo digital por transparência na prestação de contas </a>
                        </h2>
                        <p>A Prefeitura será premiada com o Selo de Boas Práticas de Transparência na Internet, oferecido pelo TCE-RS. Esta é uma informação fictícia utilizada para ilustrar o site.</p>
                    </div>
                </div>
            </div>



        <div class="col-md-3 col-sm-3">

        </div>

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

