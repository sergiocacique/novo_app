<script>
    function carregaProjeto(id,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>convenio_ver.php", { id: id, prefeitura: prefeitura },
            function(data){
                $('#ver').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    function carregaRREO(Pasta,Ano,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>rreo_outros.php", { Pasta: Pasta, Ano: Ano, prefeitura: prefeitura },
            function(data){
                $('#resultado').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }
</script>

<section class="texto-simples">
    <div class="container">
        <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
        <h2 class="title title-d"> <strong>REEO / RGF</strong></h2>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="divisor divisor-c">
            <span> </span>
        </div>
    </div>
            </div>
        </div>
</section>


<section class="texto-simples mar-top-30">
    <div id="resultado">
<?php
$sqlDespesa = mysql_query("SELECT * FROM rreo WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' GROUP BY Ano, Bimestre ORDER BY Ano DESC, Bimestre DESC LIMIT 1");
$rsDespe = mysql_fetch_array($sqlDespesa);
$ContaDespe = mysql_num_rows($sqlDespesa);

$Prefi = mysql_query("SELECT * FROM prefeitura WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."'");
$verPrefi = mysql_fetch_array($Prefi);
?>
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 pull-left">
                <h2 class="title title-d"> <strong><?php echo ($rsDespe['Bimestre']); ?></strong> <?php echo $rsDespe['Ano']; ?></h2>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-4 pull-left">
                <div id="atualiza" class="pull-right hidden-xs">
                    <div class="btn-group">
                        <button type="button" id="dashboardRange" class="btn type-d dropdown-toggle" data-toggle="dropdown">
                            <span>BUSCAR RREO / RGF</span>
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php
                            $sqlAnos = mysql_query("SELECT * FROM rreo WHERE (CdPrefeitura = ".$rsPrefeitura['CdPrefeitura'].") GROUP BY Ano, Bimestre ORDER BY Ano DESC, Bimestre DESC ");
                            $Anos = mysql_num_rows($sqlAnos);

                            for ($y = 0; $y < $Anos; $y++){
                                $verAnos = mysql_fetch_array($sqlAnos);
                                ?>
                                <li><a href="javascript:void(0)" onclick="carregaRREO(<?php echo $verAnos['Bim'];?>,<?php echo $verAnos['Ano'];?>,<?php echo $rsPrefeitura['CdPrefeitura']?>)"><?php echo ($verAnos['Bimestre']);?> / <?php echo $verAnos['Ano'];?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>

    <div class="container">
        <?php

        if ($ContaDespe == 0){

        }else {
            $sql = "SELECT * FROM rreo WHERE CdPrefeitura = '" . $rsPrefeitura['CdPrefeitura'] . "' AND Acao = 'Publicado' AND ( Ano = " . $rsDespe['Ano'] . ") AND ( Pasta = '" . $rsDespe['Pasta'] . "')";
            $sqlLeis = mysql_query($sql);

            //var_dump($sql);
            $Leis = mysql_num_rows($sqlLeis);

            for ($y = 0; $y < $Leis; $y++) {
                $verLeis = mysql_fetch_array($sqlLeis);
                ?>
                <div class="col-xs-6 col-md-4 ">
                    <div class="item-para-download">
                        <div class="descricao">
                            <h3 class="text-center"><?php echo $verLeis['Nome']; ?> </h3>
                        </div>
                        <div class="link-de-download">
                            <p class="text-center">
                                <a class="btn type-d" title="" href="http://arquivo.minhaprefeitura.com.br/municipio/<?php echo $verPrefi['Pasta'];?>/anexo/rreo/<?php echo $verLeis['Ano'];?>/<?php echo $verLeis['Pasta'];?>/<?php echo $verLeis['Arquivo'];?>" target="_blank">VISUALIZAR</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php
            }
        }
        ?>
        </div>
    </div>
</section>


<section class="line-100 type-c line-advantages">
    <div class="container">
        <div class="grid-12 pull-left">
            <h4 class="title title-d">
                <strong>ACESSO À </strong>INFORMAÇÃO
            </h4>
        </div>
        <div class="col-md-8 mar-20">
            <div class="divisor divisor-b">
                <span> </span>
            </div>
        </div>
        <div class="col-md-8 mar-10">
            <p class="text text-c"> O objetivo do e-SIC é facilitar o exercício do direito fundamental de acesso às informações públicas. Por meio deste sistema, você faz o seu pedido e acompanha todo o trâmite. </p>
        </div>
        <div class="clear"> </div>
        <div class="col-md-8 mar-20">
            <a class="btn type-d" title="saiba mais sobre o e-SIC" href="<?php echo $legal ?>esic">SAIBA MAIS</a>
        </div>
    </div>
</section>