<script>
    function carregaProjeto(id,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>diarias_ver.php", { id: id, prefeitura: prefeitura },
            function(data){
                $('#ver').html(data);
                $('html, body').animate({scrollTop:0}, 'slow');
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    function carregaMesAno(mes,ano,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>diarias_mes_ano.php", { mes: mes, ano: ano, prefeitura: prefeitura },
            function(data){
                $('#resultado').html(data);
                $('html, body').animate({scrollTop:0}, 'slow');
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }
</script>

<section class="texto-simples mar-top-30">
    <div id="resultado">
        <?php
        $sqlDespesa = mysql_query("SELECT * FROM diarias WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' GROUP BY ano ORDER BY ano DESC, mes DESC LIMIT 1");
        $rsDespe = mysql_fetch_array($sqlDespesa);
        $ContaDespe = mysql_num_rows($sqlDespesa);
        ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 pull-left">
                    <h2 class="title title-d"> <strong>DIÁRIAS </strong></h2>
                </div>

                <div class="col-xs-4 col-sm-4 col-md-4 pull-left">
                    <div id="atualiza" class="pull-right hidden-xs">
                        <div class="btn-group">
                            <button type="button" id="dashboardRange" class="btn type-d dropdown-toggle" data-toggle="dropdown">
                                <span>BUSCAR DIÁRIAS</span>
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <?php
                                $sqlAnos = mysql_query("SELECT * FROM diarias WHERE (CdPrefeitura = ".$rsPrefeitura['CdPrefeitura'].") GROUP BY ano, mes ORDER BY ano DESC, mes DESC ");
                                $Anos = mysql_num_rows($sqlAnos);

                                for ($y = 0; $y < $Anos; $y++){
                                    $verAnos = mysql_fetch_array($sqlAnos);
                                    ?>
                                    <li><a href="javascript:void(0)" onclick="carregaMesAno(<?php echo $verAnos['mes'];?>,<?php echo $verAnos['ano'];?>,<?php echo $rsPrefeitura['CdPrefeitura']?>)"><?php echo retorna_mes_extenso($verAnos['mes']);?> / <?php echo $verAnos['ano'];?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<section id="ver" class="texto-simples">
    <div class="container">
    <table class="table table-afiliados" summary="Passagens">
        <thead>
        <tr>
            <th><span class="texto-amarelo">DATA</span></th>
            <th><span class="texto-amarelo">NOME</span></th>
            <th><span class="texto-amarelo">DESTINO</span></th>
            <th><span class="texto-amarelo">SECRETÁRIA</span></th>
            <th><span class="texto-amarelo">VALOR (R$)</span></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sqlDespesa = mysql_query("SELECT * FROM diarias WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND acao = 'Publicado' GROUP BY ano, mes ORDER BY ano DESC, mes DESC LIMIT 1");
        $rsDespe = mysql_fetch_array($sqlDespesa);
        $ContaDespe = mysql_num_rows($sqlDespesa);

        if ($ContaDespe == 0) {?>

            <tr>
                <td colspan="4">
                    <small>Nenhum registro encontrado no periodo selecionado</small>
                </td>
            </tr>
        <?php

        }else{

        $sqlGlossario = mysql_query("SELECT * FROM diarias WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND acao = 'Publicado' AND ( ano = ".$rsDespe['ano'].") AND ( mes = ".$rsDespe['mes'].")");
        $Glossario = mysql_num_rows($sqlGlossario);

        for ($y = 0; $y < $Glossario; $y++) {
            $verGlossario = mysql_fetch_array($sqlGlossario);
            ?>
            <tr onclick="carregaProjeto(<?php echo $verGlossario['id']; ?>,<?php echo $rsPrefeitura['CdPrefeitura']; ?>)" style="cursor: pointer">
                <td>
                    <small><?php echo retorna_mes_extenso($verGlossario['mes']);?>/<?php echo $verGlossario['ano']; ?></small>
                </td>
                <td>
                    <small><?php echo $verGlossario['nome']; ?></small>
                </td>
                <td>
                    <small><?php echo $verGlossario['destino']; ?></small>
                </td>
                <td>
                    <small><?php echo $verGlossario['secretaria']; ?></small>
                </td>
                <td>
                    <small><?php echo number_format($verGlossario['valor_liquido'], 2, ',', '.'); ?></small>
                </td>
            </tr>
        <?php
        }
        }
        ?>
        </tbody>
    </table>
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