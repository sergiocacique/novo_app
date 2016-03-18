<script>
    function carregaProjeto(id,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>obras_ver.php", { id: id, prefeitura: prefeitura },
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
        <h2 class="title title-d"> <strong>PERGUNTAS</strong> FREQUENTES</h2>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="divisor divisor-c">
            <span> </span>
        </div>
    </div>
            </div>
        </div>
</section>


<section id="ver" class="texto-simples mar-top-30">

    <div class="container">
        <div class="row">
            <table class="table table-afiliados" summary="Despesas com pessoal">

                <tbody>
                <?php
                $sqlGlossario = mysql_query("SELECT * FROM perguntas_frequentes WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado'");
                $Glossario = mysql_num_rows($sqlGlossario);

                for ($y = 0; $y < $Glossario; $y++){
                    $verGlossario = mysql_fetch_array($sqlGlossario);
                    ?>
                    <tr>
                        <td>
                            <p class="lead">
                                <?php echo $verGlossario['Titulo'];?>
                            </p>

                            <div class="callout callout-info callout-right">
                                <p><?php echo $verGlossario['Descricao'];?></p>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
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