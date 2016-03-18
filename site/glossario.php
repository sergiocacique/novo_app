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
        <h2 class="title title-d"> <strong>GLOSSÁRIO</strong></h2>
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
            <div class="panel-body">
                <ul class="nav nav-tabs nav-tabs-alt" id="demo-tabs1">
                    <?php
                    for ( $i = 'A'; $i != 'AA'; $i++ ){
                        ?>
                        <li <?php if ($i == 'A'){?>class="active"<?php }else { }?>><a href="#botabs<?php echo $i;?>" data-toggle="tab"><?php echo $i;?></a></li>
                    <?php } ?>

                </ul>
                <div class="tab-content" style="padding-top:15px">
                    <?php
                    for ( $i = 'A'; $i != 'AA'; $i++ ){
                        ?>
                        <div class="tab-pane fade<?php if ($i == 'A'){?> in active<?php }else { }?>" id="botabs<?php echo $i;?>">
                            <?php
                            $sqlGlossario = mysql_query("SELECT * FROM glossario WHERE Titulo LIKE '".$i."%' AND Acao = 'Publicado'");
                            $Glossario = mysql_num_rows($sqlGlossario);

                            for ($y = 0; $y < $Glossario; $y++){
                                $verGlossario = mysql_fetch_array($sqlGlossario);
                                ?>
                                <div id="listagem">
                                    <span class="glossario_titulo"><?php echo $verGlossario['Titulo'];?></span>
                                    <span class="glossario_texto"><?php echo $verGlossario['Descricao'];?> <?php echo $verGlossario['Fonte'];?></span>
                                </div>
                            <?php
                            }
                            ?>
                        </div>

                    <?php } ?>

                </div><!-- /tab-content -->
            </div><!-- /panel-body -->
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