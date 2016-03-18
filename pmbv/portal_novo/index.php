<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 25/08/14
 * Hora: 09:18
 */

include ("../conexao.php");
include('funcoes.php');
?>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />

    <title>Portal da Transparência | Prefeitura de Boa Vista </title>
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlAmigavel.$Pasta ?>estilo.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlAmigavel ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $UrlAmigavel?>css/wrapkit.min.css">
    <link rel="stylesheet" href="<?php echo $UrlAmigavel?>css/wrapkit-skins-all.min.css">
    <link rel="stylesheet" href="<?php echo $UrlAmigavel?>css/font-awesome.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo $UrlAmigavel?>css/morris.css">
    <link href="<?php echo $UrlAmigavel?>css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo $UrlAmigavel?>css/owl.theme.css" rel="stylesheet">


    <script src="<?php echo $UrlAmigavel ?>js/jquery.1.11.1.min.js"></script>
    <script src="<?php echo $UrlAmigavel ?>js/owl.carousel.js"></script>
    <script language="javascript" src="<?php echo $UrlAmigavel ?>js/ajax.js"></script>
    <script language="javascript" src="<?php echo $UrlAmigavel ?>js/instrucao.js"></script>
    <script src="<?php echo $UrlAmigavel ?>js/bootstrap.js"></script>
    <script src="<?php echo $UrlAmigavel ?>js/jquery.mask.js"></script>
    <script src="<?php echo $UrlAmigavel ?>js/jquery.nicescroll.min.js"></script>

    <script src="<?php echo $UrlAmigavel ?>js/raphael.min.js"></script>
    <script src="<?php echo $UrlAmigavel ?>js/morris.js"></script>
    <!-- DEPENDENCIES -->

    <!-- END DEPENDENCIES -->

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

        $(document).ready(function(){
            $('.menu-anchor').on('click touchstart', function(e){
                $('#lateral1').toggleClass('menu-active');
                $('body').toggleClass('active');
                e.preventDefault();
            });
        })


    </script>

</head>


<!--<div class="modal fade" id="despesas" tabindex="-1" role="dialog" aria-labelledby="despesas" aria-hidden="true">-->
<!--    <div class="modal-dialog modal-full">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
<!--                <h4 class="modal-title" id="fullWidthLabel">Despesas</h4>-->
<!--            </div>-->
<!---->
<!--            <div class="modal-body">-->
<!--                <iframe width='100%' height='80%' frameborder='0' src='http://www.gdip.com.br/transparencia/despesas/7023490'></iframe>-->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!---->
<!--<div class="modal fade" id="receita" tabindex="-1" role="dialog" aria-labelledby="receita" aria-hidden="true">-->
<!--    <div class="modal-dialog modal-full">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
<!--                <h4 class="modal-title" id="fullWidthLabel">Receitas</h4>-->
<!--            </div>-->
<!---->
<!--            <div class="modal-body">-->
<!--                <iframe width='100%' height='80%' frameborder='0' src='http://www.gdip.com.br/transparencia/receitas/7023490'></iframe>-->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<body>
<?php
$Manutencao = mysql_query("SELECT * FROM config WHERE Nome = 'Manutencao'") or die("erro ao selecionar");
$VerManutencao = mysql_fetch_array($Manutencao);

if ($VerManutencao['Valor'] == 'sim'){
?>
<div id="manutencao2">
    <div class="manutencao">
        <p><i class="fa fa-spin fa-spin-2x fa-4x fa-refresh fa-fw text-primary"></i></p>
        <p>o Portal da transparência está sendo atualizado tente novamente em alguns minutos</p>
    </div>
</div>
<?php }?>
<?php


if (isset ($_GET['Pages'])){
    $Pages = $_GET['Pages'];
    }
//if ($Pages == "servidor") {
//    $Manutencao2 = mysql_query("SELECT * FROM config WHERE Nome = 'Manutencao_servidor'") or die("erro ao selecionar");
//    $VerManutencao2 = mysql_fetch_array($Manutencao2);
//
//    if ($VerManutencao2['Valor'] == 'sim') {
        ?>

<!--        <div id="manutencao2">-->
<!--            <div class="manutencao">-->
<!--                <p><i class="fa fa-spin fa-spin-2x fa-4x fa-refresh fa-fw text-primary"></i></p>-->
<!---->
<!--                <p>o Portal da transparência está sendo atualizado tente novamente em alguns minutos</p>-->
<!--            </div>-->
<!--        </div>-->
    <?php //}
//}?>
<div id="topo">
    <div id="barra">
    </div>
    <div class="menu_topo col-md-offset-4">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">CONSULTAS <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a data-toggle="modal" data-target="#despesas" href="javascript:void(0)">Despesas</a></li>
                    <li><a data-toggle="modal" data-target="#receita" href="javascript:void(0)">Receitas</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=ceis">Empresas Sancionadas</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=passagens">Passagens</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=diarias">Diárias</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=convenios">Convênios</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=projetos_sociais">Projetos Sociais</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=obras">Obras</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=previdencia">Previdência</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=cpl">Contratos e Licitações</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=rreo">RREO / RGF</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">SERVIDORES <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor_comissionado">Comissionados</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor_estatutario">Estatutarios</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor_seletivo">Seletivos</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor_cedidos">Cedidos</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor_aposentados">Aposentados</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor_orgao">Orgão</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor_secretaria">Secretarias</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">e-SIC <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=esic_primeiro_acesso">Primeiro acesso</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=esic_dica_pedido">Dicas para fazer o pedido</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=esic_acesso">Acesso ao sistema</a></li>
                    <?php if (isset($_SESSION['IDSIC']) != ""){?>
                    <li class="divider"></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=esic_registrar_pedido">Fazer uma Solicitação</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=esic_protocolo">Minhas Solicitação</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=esic_meus_dados">Meus Dados</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=esic_sair">SAIR</a></li>
                    <?php }?>
                </ul>
            </li>


            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">INFORMAÇÕES <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=sobre">Sobre o Portal</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=estrutura_organizacional">Estrutura Organizacional</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=legislacao">Legislação</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">+ TRANSPARÊNCIA <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=perguntas_frequentes_categoria">Perguntas Frequentes</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=glossario">Glossário</a></li>
                    <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=links">Links</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)">Contato</a></li>
                </ul>
            </li>

        </ul><!--/navbar-nav-->
    </div>
    <div id="central_topo">
        <div id="topo_campo_logo">
            <div class="logo"><a href="<?php echo $UrlAmigavel.$Pasta ?>"></a> </div>
        </div>
        <div class="titulo_portal">Portal da <span class="titulo_portal_bold">Transparência</span></div>
    </div>
    <div id="topo_titulo"></div>
    <div id="transparencia">
        <span class="menu-anchor"></span>
    </div>
</div>

<div id="corpo">


        <?php

        //echo $Pages;
        if (isset ($_GET['Pages'])){
            $Pages = $_GET['Pages'];
            if ($Pages == "servidor"){
                include 'servidor.php';
            }

            //servidores inicio

            elseif ($Pages == "servidor_comissionado"){
                include 'servidor_comissionado.php';
            }
            elseif ($Pages == "servidor_estatutario"){
                include 'servidor_estatutario.php';
            }
            elseif ($Pages == "servidor_seletivo"){
                include 'servidor_seletivo.php';
            }
            elseif ($Pages == "servidor_cedidos"){
                include 'servidor_cedidos.php';
            }
            elseif ($Pages == "servidor_aposentados"){
                include 'servidor_aposentados.php';
            }
            elseif ($Pages == "servidor_aposentados"){
                include 'servidor_aposentados.php';
            }
            elseif ($Pages == "servidor_aposentados"){
                include 'servidor_aposentados.php';
            }

            //servidores fim


            elseif ($Pages == "servidor_secretaria"){
                include 'servidor_secretaria.php';
            }
            elseif ($Pages == "servidor_orgao"){
                include 'servidor_orgao.php';
            }
            elseif ($Pages == "servidor_cargo"){
                include 'servidor_cargo.php';
            }
            elseif ($Pages == "contato"){
                include 'contato.php';
            }
            elseif ($Pages == "estrutura_organizacional"){
                include 'estrutura_organizacional.php';
            }
            elseif ($Pages == "glossario"){
                include 'glossario.php';
            }
            elseif ($Pages == "perguntas_frequentes"){
                include 'perguntas_frequentes.php';
            }
            elseif ($Pages == "perguntas_frequentes_categoria"){
                include 'perguntas_frequentes_categoria.php';
            }
            elseif ($Pages == "links"){
                include 'links.php';
            }
            elseif ($Pages == "sobre"){
                include 'sobre.php';
            }
            elseif ($Pages == "esic_primeiro_acesso"){
                include 'esic_primeiro_acesso.php';
            }
            elseif ($Pages == "esic_dica_pedido"){
                include 'esic_dica_pedido.php';
            }
            elseif ($Pages == "esic_acesso"){
                include 'esic_acesso.php';
            }
            // e-SIC
            elseif ($Pages == "esic_registrar_pedido"){
                include 'esic_registrar_pedido.php';
            }
            elseif ($Pages == "esic_protocolo"){
                include 'esic_protocolo.php';
            }
            elseif ($Pages == "esic_meus_dados"){
                include 'esic_meus_dados.php';
            }
            elseif ($Pages == "esic_sair"){
                include 'esic_sair.php';
            }
            elseif ($Pages == "esic_cadastro"){
                include 'esic_cadastro.php';
            }
            elseif ($Pages == "esic_protocolo_ver"){
                include 'esic_protocolo_ver.php';
            }

            //

            elseif ($Pages == "sic"){
                include 'sic.php';
            }
            elseif ($Pages == "sic_como_pedir"){
                include 'sic_como_pedir.php';
            }
            elseif ($Pages == "sic_como_acompanhar"){
                include 'sic_como_acompanhar.php';
            }
            elseif ($Pages == "sic_como_entrar_recurso"){
                include 'sic_como_entrar_recurso.php';
            }
            elseif ($Pages == "legislacao"){
                include 'legislacao.php';
            }
            elseif ($Pages == "leis"){
                include 'leis.php';
            }
            elseif ($Pages == "verLei"){
                include 'verLei.php';
            }
            elseif ($Pages == "ceis"){
                include 'ceis.php';
            }
            elseif ($Pages == "cepim"){
                include 'cepim.php';
            }
            elseif ($Pages == "cpl"){
                include 'cpl.php';
            }
            elseif ($Pages == "convenios"){
                include 'convenios.php';
            }
            elseif ($Pages == "projetos_sociais"){
                include 'projetos_sociais.php';
            }
            // Despesas
            elseif ($Pages == "despesas"){
                include 'despesas.php';
            }
            elseif ($Pages == "despesas_empenho"){
                include 'despesas_empenho.php';
            }
            elseif ($Pages == "despesas_lista"){
                include 'despesas_lista.php';
            }
            elseif ($Pages == "passagens"){
                include 'passagens.php';
            }
            elseif ($Pages == "obras"){
                include 'obras.php';
            }
            elseif ($Pages == "diarias"){
                include 'diarias.php';
            }
            elseif ($Pages == "previdencia"){
                include 'previdencia.php';
            }
            elseif ($Pages == "rreo"){
                include 'rreo.php';
            }

            // Receita
            elseif ($Pages == "receitas"){
                include 'receitas.php';
            }
        }else{
            include 'inicio.php';
        }

        ?>

    <br clear="all">
</div>



<div id="rodape">
    <div id="rodape_barra">

    </div>
    <div id="rodape_central">
        <div id="logo_rodape"></div>
        <span class="texto_rodape"><strong>Prefeitura Municipal de Boa Vista</strong><br>Palácio 9 de Julho | Rua General Penha Brasil, 1011 - São Francisco | CEP: 69305-130 FONE: 156 | Boa Vista - Roraima - Brasil</span>
        <br clear="all">
    </div>
</div>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-41087416-1', 'auto');
    ga('send', 'pageview');

</script>