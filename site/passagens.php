<script>
    function carregaProjeto(id,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>passagens_ver.php", { id: id, prefeitura: prefeitura },
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
        <h2 class="title title-d"> <strong>PASSAGENS</strong></h2>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="divisor divisor-c">
            <span> </span>
        </div>
    </div>
            </div>
        </div>
</section>


<section id="ver" class="texto-simples">
    <div class="container">
    <table class="table table-afiliados" summary="Passagens">
        <thead>
        <tr>
            <th><span class="texto-amarelo">NOME</span></th>
            <th><span class="texto-amarelo">DESTINO</span></th>
            <th>VALOR (R$)</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sqlDespesa = mysql_query("SELECT * FROM passagens WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' GROUP BY ano, mes ORDER BY ano DESC, mes DESC LIMIT 1");
        $rsDespe = mysql_fetch_array($sqlDespesa);
        $ContaDespe = mysql_num_rows($sqlDespesa);

        if ($ContaDespe == 0) {?>

            <tr>
                <td colspan="3">
                    <small>Nenhum registro encontrado no periodo selecionado</small>
                </td>
            </tr>
        <?php

        }else{

        $sqlGlossario = mysql_query("SELECT * FROM passagens WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' AND ( ano = ".$rsDespe['ano'].") AND ( mes = ".$rsDespe['mes'].")");
        $Glossario = mysql_num_rows($sqlGlossario);

        for ($y = 0; $y < $Glossario; $y++) {
            $verGlossario = mysql_fetch_array($sqlGlossario);
            ?>
            <tr onclick="carregaProjeto(<?php echo $verGlossario['id']; ?>,<?php echo $rsPrefeitura['CdPrefeitura']; ?>)" style="cursor: pointer">
                <td>
                    <small><?php echo $verGlossario['Nome']; ?></small>
                </td>
                <td>
                    <small><?php echo $verGlossario['Destino']; ?></small>
                </td>
                <td>
                    <small><?php echo number_format($verGlossario['valor'], 2, ',', '.'); ?></small>
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