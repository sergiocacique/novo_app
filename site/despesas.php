<script>
    function empenho(ano,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>empenho.php", { ano: ano, prefeitura: prefeitura },
            function(data){
                $('#ver').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }


    function carregaAnoLiquidacao(ano,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>empenho_liquidacao.php", { ano: ano, prefeitura: prefeitura },
            function(data){
                $('#ver').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    function carregaAnoEmpenho(ano,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>empenho.php", { ano: ano, prefeitura: prefeitura },
            function(data){
                $('#ver').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }


    function liquidacao(ano,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>empenho_liquidacao.php", { ano: ano, prefeitura: prefeitura },
            function(data){
                $('#ver').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    function verEmpenho(id){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>empenho_visualizar.php", { id: id },
            function(data){
                $('#ver').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }
</script>

<section class="texto-simples">
    <div class="container">
        <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
        <h2 class="title title-d">DESPESAS <strong></strong></h2>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="divisor divisor-c">
            <span> </span>
        </div>
    </div>
            </div>
        </div>
</section>


<section id="ver" class="container texto-simples">
    <div class="row">
            <?php
            $sqlDespesa = mysql_query("SELECT * FROM despesas WHERE Categoria = 'Empenho' AND CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' GROUP BY Ano ORDER BY Ano DESC LIMIT 1");
            $rsDespe = mysql_fetch_array($sqlDespesa);
            $ContaDespe = mysql_num_rows($sqlDespesa);
            ?>
            <div class="col-xs-6 col-md-6 ">
                <div class="item-para-download">
                    <div class="descricao">
                        <h3 class="text-center">EMPENHO </h3>
                    </div>
                    <div class="link-de-download">
                        <p class="text-center">
                            <a class="btn type-d" title="" href="javascript:void(0)" onclick="empenho(<?php echo $rsDespe["Ano"]?>,<?php echo $rsPrefeitura['CdPrefeitura'];?>)">SAIBA MAIS</a>
                        </p>
                    </div>
                </div>
            </div>

        <?php

        $sqlDespesa2 = mysql_query("SELECT * FROM despesas WHERE Categoria = 'Liquidação' AND CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY Ano DESC, Mes DESC LIMIT 1");
        $rsDespe2 = mysql_fetch_array($sqlDespesa2);
        $ContaDespe2 = mysql_num_rows($sqlDespesa2);
        ?>

        <div class="col-xs-6 col-md-6 ">
            <div class="item-para-download">
                <div class="descricao">
                    <h3 class="text-center">LIQUIDAÇÃO DE EMPENHO </h3>
                </div>
                <div class="link-de-download">
                    <p class="text-center">
                        <a class="btn type-d" title="" href="javascript:void(0)" onclick="liquidacao(<?php echo $rsDespe2["Ano"]?>,<?php echo $rsPrefeitura['CdPrefeitura'];?>)">SAIBA MAIS</a>
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
