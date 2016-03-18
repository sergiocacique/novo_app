

<section class="content-wrapper content-midwet">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <div class="row">
                            <div class="clearfix"></div>
                            <br>
                            <div class="col-xs-12">
                                <h4>LINKS</h4>
                            </div>
                            <div class="col-md-12">
                                <?php
                                $sqlEstrutura = mysql_query("") or die(mysql_error());
                                $contador = mysql_num_rows($sqlEstrutura);
                                for ($i = 0; $i < $contador; $i++){
                                    $linha = mysql_fetch_array($sqlEstrutura);

                                    if ($i > 0){
                                        $classServ = "false";
                                    }else{
                                        $classServ = "true";
                                    }

                                    ?>
                                    <div class="col-xs-6 col-md-4 ">
                                        <div class="item-para-download">
                                            <div class="descricao">
                                                <h3 class="text-center"><?php echo $linha['Titulo'];?> </h3>
                                            </div>
                                            <div class="link-de-download">
                                                <p class="text-center">
                                                    <a class="btn type-d" title="" href="http://<?php echo $linha['url'];?>" target="_blank">SAIBA MAIS</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>