<script>
    function receitaArrecadada(ano,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>receita_arrecadada.php", { ano: ano, prefeitura: prefeitura },
            function(data){
                $('#ver').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    function receitaExtra(ano,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>receita_extra.php", { ano: ano, prefeitura: prefeitura },
            function(data){
                $('#ver').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    function receitaPrevista(ano,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>receita_prevista.php", { ano: ano, prefeitura: prefeitura },
            function(data){
                $('#ver').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }


    function carregaMesAnoPrevista(mes,ano,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>receita_prevista_mes_ano.php", { mes: mes, ano: ano, prefeitura: prefeitura },
            function(data){
                $('#ver').html(data);
                $('html, body').animate({scrollTop:0}, 'slow');
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }
    function carregaMesAnoExtra(mes,ano,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>receita_extra_mes_ano.php", { mes: mes, ano: ano, prefeitura: prefeitura },
            function(data){
                $('#ver').html(data);
                $('html, body').animate({scrollTop:0}, 'slow');
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }
    function carregaMesAnoArrecadada(mes,ano,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>receita_arrecadada_mes_ano.php", { mes: mes, ano: ano, prefeitura: prefeitura },
            function(data){
                $('#ver').html(data);
                $('html, body').animate({scrollTop:0}, 'slow');
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }




</script>

<section class="texto-simples">
    <div class="container">
        <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
        <h2 class="title title-d">RECEITAS <strong></strong></h2>
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

        $sqlReceita1 = mysql_query("SELECT * FROM receitas WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Categoria = 'arrecadada' AND Acao = 'Publicado' GROUP BY Ano, Mes ORDER BY Ano DESC, Mes DESC LIMIT 1");
        $rsRece1 = mysql_fetch_array($sqlReceita1);
        $ContaReceita1 = mysql_num_rows($sqlReceita1);

        $sqlReceita2 = mysql_query("SELECT * FROM receitas WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Categoria = 'extra' AND Acao = 'Publicado' GROUP BY Ano, Mes ORDER BY Ano DESC, Mes DESC LIMIT 1");
        $rsRece2 = mysql_fetch_array($sqlReceita2);
        $ContaReceita2 = mysql_num_rows($sqlReceita2);

        $sqlReceita3 = mysql_query("SELECT * FROM receitas WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Categoria = 'prevista' AND Acao = 'Publicado' GROUP BY Ano, Mes ORDER BY Ano DESC, Mes DESC LIMIT 1");
        $rsRece3 = mysql_fetch_array($sqlReceita3);
        $ContaReceita3 = mysql_num_rows($sqlReceita3);

        ?>

            <div class="col-xs-4 col-md-4 ">
                <div class="item-para-download">
                    <div class="descricao">
                        <h3 class="text-center"> Receitas Orçamentária Arrecadada  </h3>
                    </div>
                    <div class="link-de-download">
                        <p class="text-center">
                            <a class="btn type-d" title="" href="javascript:void(0)" onclick="carregaMesAnoArrecadada(<?php echo $rsRece1['Mes']?>,<?php echo $rsRece1['Ano']?>,<?php echo $rsPrefeitura['CdPrefeitura'];?>)">SAIBA MAIS</a>
                        </p>
                    </div>
                </div>
            </div>

        <div class="col-xs-4 col-md-4 ">
            <div class="item-para-download">
                <div class="descricao">
                    <h3 class="text-center"> Receitas Extra-Orçamentária  </h3>
                </div>
                <div class="link-de-download">
                    <p class="text-center">
                        <a class="btn type-d" title="" href="javascript:void(0)" onclick="carregaMesAnoExtra(<?php echo $rsRece2['Mes']?>,<?php echo $rsRece2['Ano']?>,<?php echo $rsPrefeitura['CdPrefeitura'];?>)">SAIBA MAIS</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-xs-4 col-md-4 ">
            <div class="item-para-download">
                <div class="descricao">
                    <h3 class="text-center"> Receitas Prevista e Arrecadada  </h3>
                </div>
                <div class="link-de-download">
                    <p class="text-center">
                        <a class="btn type-d" title="" href="javascript:void(0)" onclick="carregaMesAnoPrevista(<?php echo $rsRece3['Mes']?>,<?php echo $rsRece3['Ano']?>,<?php echo $rsPrefeitura['CdPrefeitura'];?>)">SAIBA MAIS</a>
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
