<?php
include ("conexao.php");
include('funcoes.php');

//$UrlAmigavel = "http://".$_SERVER['HTTP_HOST']."/site_prev/";
$UrlAmigavel = "http://portal.minhaprefeitura.com.br/";
$online = 'sim';
$dominio = $_GET['dominio'];

$legal = $UrlAmigavel."".$dominio."/";

$sqlPrefeitura = mysql_query("SELECT * FROM prefeitura WHERE Pasta = '".$dominio."'");
$rsPrefeitura = mysql_fetch_array($sqlPrefeitura);

$sqlConfig = mysql_query("SELECT * FROM prefeitura_config WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."'");
$rsConfig = mysql_fetch_array($sqlConfig);


if ($rsPrefeitura['Acao'] == 'Bloqueado'){
    header('Location: bloqueado'); exit;
}

if($online =='sim') {
    $link_site = $UrlAmigavel."?Pages=";
}else {
    $link_site = "?dominio=" . $rsPrefeitura['Pasta'] . "&Pages=";
}
?>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $rsConfig['Titulo'] ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlAmigavel ?>municipio/<?php echo $rsPrefeitura['Pasta'] ?>/estilo.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlAmigavel ?>css/bootstrap.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo $UrlAmigavel?>css/wrapkit.min.css">
    <link rel="stylesheet" href="<?php echo $UrlAmigavel?>css/wrapkit-skins-all.min.css">
    <link rel="stylesheet" href="<?php echo $UrlAmigavel?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $UrlAmigavel?>css/timeline.css">
    <link rel="stylesheet" href="<?php echo $UrlAmigavel?>css/modern-business.css">
    <link rel="stylesheet" href="<?php echo $UrlAmigavel?>css/owl.carousel.css">



    <script src="<?php echo $UrlAmigavel ?>js/jquery.1.11.1.min.js"></script>
    <script language="javascript" src="<?php echo $UrlAmigavel ?>js/ajax.js"></script>
    <script language="javascript" src="<?php echo $UrlAmigavel ?>js/instrucao.js"></script>
    <script src="<?php echo $UrlAmigavel ?>js/bootstrap.min.js"></script>


    <script>
        $('.carousel').carousel({
            interval: 5000 //changes the speed
        })
    </script>

    <script type="text/javascript" charset="utf-8">

        function loadImages() {
            if (document.getElementById) {  // DOM3 = IE5, NS6
                document.getElementById('loading').style.visibility = 'hidden';
            }
            else {
                if (document.layers) {  // Netscape 4
                    document.hidepage.visibility = 'hidden';
                }
                else {  // IE 4
                    document.all.hidepage.style.visibility = 'hidden';
                }
            }
        }

        $(window).load(function() {
            // Animate loader off screen
            $("#loading2").delay(200).fadeOut("slow");
        });



//        $(window).scroll(function(){
//            if  ($(window).scrollTop() >= 142){
//                $('#transparencia').css({position:'fixed',top:0,margin:'0 0 0 0',display:'block', zIndex:999});
//                $('#corpo').css({margin:'50px auto'});
//                $('.logop').css({display:'block'});
//            } else {
//                $('#transparencia').css({position:'relative'});
//                $('#corpo').css({margin:'0 auto'});
//                $('.logop').css({display:'none'});
//            }
//        });

    </script>
    <script>

        function LerNews(CdNoticia){
            $('#loading2').css('visibility','visible');
            $.post("http://portal.minhaprefeitura.com.br/lerNoticias.php", { CdNoticia: CdNoticia, CdPrefeitura: <?php echo $rsPrefeitura['CdPrefeitura']?> },
                function(data){
                    $('#conteudo').html(data);
                    $('html, body').animate({scrollTop:0}, 'slow');
                }).done(function() {
                    $('#loading2').css('visibility','hidden');
                });
        }



        function CategoriaNews(CdCategoria){
            $('#loading2').css('visibility','visible');
            $.post("CatNoticias.php", { CdCategoria: CdCategoria, CdPrefeitura: <?php echo $rsPrefeitura['CdPrefeitura']?> },
                function(data){
                    $('#conteudo').html(data);
                    $('html, body').animate({scrollTop:0}, 'slow');
                }).done(function() {
                    $('#loading2').css('visibility','hidden');
                });
        }

    </script>
</head>


<body>
<div id="loading2" >
    <div id="loading">
        <p><i class="fa fa-spin fa-spin-2x fa-4x fa-refresh fa-fw text-success"></i></p>
    </div>
</div>

<div id="topo">

    <div id="central_topo" class="container">
        <div id="topo_campo_logo">
            <div class="logo"><a href="<?php echo $UrlAmigavel ?><?php echo $rsPrefeitura['Pasta'] ?>"><img src="<?php echo $UrlAmigavel ?>municipio/<?php echo $rsPrefeitura['Pasta'] ?>/logo.png"> </a> </div>
        </div>
    </div>

    <div id="topo_titulo"></div>
    <div id="barra"></div>

    <div id="transparencia">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="<?php echo $UrlAmigavel ?><?php echo $rsPrefeitura['Pasta'] ?>">INICIO</a>
                        </li>
                        <?php
                        $sqlEstrutura = mysql_query("SELECT * FROM site_pagina WHERE Acao = 'Publicado' AND CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' ORDER BY Posicao ASC") or die(mysql_error());
                        $contador = mysql_num_rows($sqlEstrutura);
                        for ($i = 0; $i < $contador; $i++){
                            $linha = mysql_fetch_array($sqlEstrutura);

                            if ($linha['Tipo'] == "externo") {
                                $link = $linha['Link'];
                            }elseif($linha['Tipo'] == "servidor"){
                                $link = "http://".$linha['Link'].".minhaprefeitura.com.br/".$rsPrefeitura['Pasta'];
                            }else{
                                $link = $UrlAmigavel.$rsPrefeitura['Pasta']."/".$linha['Link'];
                            }

                            ?>
                            <li>
                                <a href="<?php echo $link;?>"><?php echo $linha['Titulo'];?></a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
    </div>
</div>



        <?php

        //echo $Pages;
        if (isset ($_GET['Pages'])){
            $Pages = $_GET['Pages'];
            if ($Pages == "servidor"){
                include 'servidor.php';
            }

            elseif ($Pages == "governo_municipal"){
                include 'governo_municipal.php';
            }
            elseif ($Pages == "servicos"){
                include 'servicos.php';
            }
            elseif ($Pages == "contato"){
                include 'contato.php';
            }
            // Notícias
            elseif ($Pages == "noticias"){
                include 'noticias.php';
            }
            elseif ($Pages == "CatNoticias"){
                include 'CatNoticias.php';
            }
            elseif ($Pages == "lerNoticias"){
                include 'lerNoticias.php';
            }
            elseif ($Pages == "editais"){
                include 'editais.php';
            }

            // Diário Oficial
            elseif ($Pages == "diario_oficial"){
                include 'diario_oficial.php';
            }

            elseif ($Pages == "interna"){
                include 'interno.php';
            }
        }else{
            include 'inicio.php';
        }

        ?>

    <br clear="all">
<section class="container line-100 type-a line-extra mar-60">
    <div class="container"></div>
</section>
<div id="rodape">
    <div id="transparencia">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="<?php echo $UrlAmigavel ?>">INICIO</a>
                        </li>
                        <?php
                        $sqlEstrutura = mysql_query("SELECT * FROM site_pagina WHERE Acao = 'Publicado' AND CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' ORDER BY Posicao ASC") or die(mysql_error());
                        $contador = mysql_num_rows($sqlEstrutura);
                        for ($i = 0; $i < $contador; $i++){
                            $linha = mysql_fetch_array($sqlEstrutura);


                            if ($linha['Tipo'] == "externo") {
                                $link = $linha['Link'];
                            }elseif($linha['Tipo'] == "servidor"){
                                $link = "http://".$linha['Link'].".minhaprefeitura.com.br/".$rsPrefeitura['Pasta'];
                            }else{
                                $link = $UrlAmigavel.$rsPrefeitura['Pasta']."/".$linha['Link'];
                            }

                            ?>
                            <li>
                                <a href="<?php echo $link;?>"><?php echo $linha['Titulo'];?></a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
    </div>

    <div id="rodape_central" class="container">

        <span class="texto_rodape fonte-11 maiusculo texto-preto">Copyright © 2015. Todos os Direitos Reservados<br>ORGULHOSAMENTE DESENVOLVIDO EM RORAIMA</span>
        <br clear="all">
    </div>
</div>