<?php
include ("conexao.php");
include ("funcoes.php");
$ano = (string) $_POST['ano'];
$CdPrefeitura = (string) $_POST['prefeitura'];


$Prefi = mysql_query("SELECT * FROM prefeitura WHERE CdPrefeitura = '".$CdPrefeitura."'");
$verPrefi = mysql_fetch_array($Prefi);


//$sqlLinha = mysql_query("SELECT * FROM receita WHERE (tipo = 'arrecadada') AND (CdPrefeitura = '".$CdPrefeitura."') AND (mes = '".$mes."') AND (ano = '".$ano."')");
//$rsLinha = mysql_fetch_array($sqlLinha);
?>

<section class="texto-simples">
    <div class="container">
        <div class="row">


            <section class="container faq mar-60" rel="Despesas com pessoal">


                <div class="container">
                    <div class="row">
                        <div class="col-xs-8 col-sm-8 col-md-8 pull-left">
                            <h2 class="title title-d"> <strong>EMPENHO </strong></h2>
                        </div>
<br>
                        <div class="col-xs-4 col-sm-4 col-md-4 pull-left">
                            <div id="atualiza" class="pull-right hidden-xs">
                                <div class="btn-group">
                                    <button type="button" id="dashboardRange" class="btn type-d dropdown-toggle" data-toggle="dropdown">
                                        <span>OUTROS ANOS</span>
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <?php
                                        $sqlAnos = mysql_query("SELECT * FROM despesas WHERE Categoria = 'Empenho' AND (CdPrefeitura = ".$CdPrefeitura.") GROUP BY Ano ORDER BY Ano DESC");
                                        $Anos = mysql_num_rows($sqlAnos);

                                        for ($y = 0; $y < $Anos; $y++){
                                            $verAnos = mysql_fetch_array($sqlAnos);
                                            ?>
                                            <li><a href="javascript:void(0)" onclick="carregaAnoEmpenho(<?php echo $verAnos['Ano'];?>,<?php echo $verAnos['CdPrefeitura']?>)"><?php echo $verAnos['Ano'];?></a></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clear"></div>
            </section>


        </div>
    </div>
</section>

<section id="ver" class="texto-simples container">
    <div class="row">
        <?php
        $sqlLeis = mysql_query("SELECT * FROM despesas WHERE Categoria = 'Empenho' AND CdPrefeitura = '".$CdPrefeitura."' AND Ano = '" .$ano. "'");
        $Leis = mysql_num_rows($sqlLeis);

        for ($y = 0; $y < $Leis; $y++){
            $verLeis = mysql_fetch_array($sqlLeis);
            ?>
            <div class="col-xs-6 col-md-4 ">
                <div class="item-para-download">
                    <div class="descricao">
                        <h3 class="text-center"><?php echo retorna_mes_extenso($verLeis['Mes']);?> </h3>
                    </div>
                    <div class="link-de-download">
                        <p class="text-center">
                            <a class="btn type-d" title="" href="http://arquivo.minhaprefeitura.com.br/municipio/<?php echo $verPrefi['Pasta'];?>/empenho/<?php echo $verLeis['Arquivo'];?>" target="_blank">VIZUALIZAR</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>
