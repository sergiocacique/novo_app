<?php
include ("conexao.php");
include('funcoes.php');


$online = 'sim';


$legal = $UrlAmigavel."".$dominio."/";

$sqlPrefeitura = mysql_query("SELECT * FROM prefeitura WHERE Pasta = '".$dominio."'");
$rsPrefeitura = mysql_fetch_array($sqlPrefeitura);

$sqlPortal = mysql_query("SELECT * FROM config_capa WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."'");
$rsPortal = mysql_fetch_array($sqlPortal);

$sqlConfig = mysql_query("SELECT * FROM prefeitura_config WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."'");
$rsConfig = mysql_fetch_array($sqlConfig);


if ($rsPrefeitura['Acao'] == 'Bloqueado'){
    header("Location: 'http://www.minhaprefeitura.com.br/bloqueado'"); exit;
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
    <!-- <link rel="stylesheet" type="text/css" href="http://www.minhaprefeitura.com.br/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/estilo.css" media="screen"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlAmigavel ?>css/estilo.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlAmigavel ?>css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlAmigavel ?>css/rodape.css">
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
    <script src="<?php echo $UrlAmigavel ?>js/owl.carousel.js"></script>
    <script>


        $(document).ready(function() {

            $("#owl-gabinete").owlCarousel({

                autoPlay: 3000, //Set AutoPlay to 3 seconds

                items : 1,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3]

            });

            $("#owl-demo").owlCarousel({

                autoPlay: 3000, //Set AutoPlay to 3 seconds

                items : 5,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3]

            });

            $("#owl-carousel").owlCarousel({

                autoPlay: 5000, //Set AutoPlay to 3 seconds

                items : 3,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3]

            });

            $("#owl-destaque").owlCarousel({

                autoPlay: 8000, //Set AutoPlay to 3 seconds

                items : 1,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3]

            });


        });


    </script>


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

</head>


<body>
<div id="loading2" >
    <div id="loading">
        <p><i class="fa fa-spin fa-spin-2x fa-4x fa-refresh fa-fw text-success"></i></p>
    </div>
</div>

<div id="topo">
  <div id="central_topo" class="container">
    <div id="topo_campo_logo"><img src="http://www.minhaprefeitura.com.br/arquivosDinamicos/logos/<?php echo $rsPrefeitura['Pasta']; ?>.png"></div>
  </div>

  <div id="transparencia">
      <?php include 'menu.php';?>
  </div>
</div>

<div id="conteudo">
<?php

//echo $Pages;
if (isset ($_GET['Pages'])){
    $Pages = $_GET['Pages'];
    if ($Pages == "servidor"){
        include 'servidor.php';
    }
    // O Município
    elseif ($Pages == "o_municipio_historia"){
        include 'o_municipio_historia.php';
    }
    elseif ($Pages == "o_municipio_dados"){
        include 'o_municipio_dados.php';
    }
    elseif ($Pages == "o_municipio_simbolo"){
        include 'o_municipio_simbolo.php';
    }
    elseif ($Pages == "o_municipio_projeto"){
        include 'o_municipio_projeto.php';
    }
    elseif ($Pages == "ver_projeto"){
        include 'ver_projeto.php';
    }

    // Turismo
    elseif ($Pages == "o_municipio_turismo"){
        include 'o_municipio_turismo.php';
    }
    elseif ($Pages == "ver_turismo"){
        include 'ver_turismo.php';
    }

    // Serviços
    elseif ($Pages == "o_municipio_servico_ao_cidadao"){
        include 'o_municipio_servico_ao_cidadao.php';
    }
    elseif ($Pages == "o_municipio_servico_ao_empreendedor"){
        include 'o_municipio_servico_ao_empreendedor.php';
    }
    elseif ($Pages == "o_municipio_servico_ao_estudante"){
        include 'o_municipio_servico_ao_estudante.php';
    }
    elseif ($Pages == "o_municipio_servico_ao_servidor_publico"){
        include 'o_municipio_servico_ao_servidor_publico.php';
    }
    elseif ($Pages == "o_municipio_servico_ver"){
        include 'o_municipio_servico_ver.php';
    }

    // Departamento
    elseif ($Pages == "departamento_prefeito"){
        include 'departamento_prefeito.php';
    }
    elseif ($Pages == "departamento_vice_prefeito"){
        include 'departamento_vice_prefeito.php';
    }
    elseif ($Pages == "departamento"){
        include 'departamento.php';
    }


    // Notícias
    elseif ($Pages == "noticia"){
        include 'noticias.php';
    }
    elseif ($Pages == "CatNoticias"){
        include 'CatNoticias.php';
    }
    elseif ($Pages == "lerNoticias"){
        include 'lerNoticias.php';
    }
    elseif ($Pages == "eventos"){
        include 'eventos.php';
    }

    // Diário Oficial
    elseif ($Pages == "diario_oficial"){
        include 'diario_oficial.php';
    }

    // Transparencia

    elseif ($Pages == "receitas"){
        include 'receitas.php';
    }
    elseif ($Pages == "despesas"){
        include 'despesas.php';
    }
    elseif ($Pages == "servidor"){
        include 'servidor.php';
    }
    elseif ($Pages == "passagens"){
        include 'passagens.php';
    }
    elseif ($Pages == "diarias"){
        include 'diarias.php';
    }
    elseif ($Pages == "convenios"){
        include 'convenios.php';
    }
    elseif ($Pages == "projetos_sociais"){
        include 'projetos_sociais.php';
    }
    elseif ($Pages == "obras"){
        include 'obras.php';
    }
    elseif ($Pages == "contrato_e_licitacao"){
        include 'contrato_licitacao.php';
    }
    elseif ($Pages == "rreo"){
        include 'rreo.php';
    }
    elseif ($Pages == "esic_consulta"){
        include 'esic_consulta.php';
    }
    elseif ($Pages == "esic_solicitar"){
        include 'esic_solicitar.php';
    }
    elseif ($Pages == "pergunta_frequentes"){
        include 'perguntas_frequentes.php';
    }
    elseif ($Pages == "glossario"){
        include 'glossario.php';
    }




    elseif ($Pages == "interna"){
        include 'interno.php';
    }
}else{
    include 'inicio.php';
}

?>
</div>
<?php include 'rodape.php';?>
