    <div id="breadcrumb">
        <div id="breadcrumb_primeiro"><span>+ Transparência</span></div>
        <div id="breadcrumb_ultima"><span>Perguntas Frequentes</span></div>
    </div>
    <div id="estrutura">
    <?php
    $sqlEstrutura = mysql_query("SELECT * FROM perguntas_frequentes_categoria ORDER BY Nome ASC") or die(mysql_error());
    $contador = mysql_num_rows($sqlEstrutura);
    for ($i = 0; $i < $contador; $i++){
        $linha = mysql_fetch_array($sqlEstrutura);

        if ($i > 0){
            $classServ = "false";
        }else{
            $classServ = "true";
        }

        ?>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading<?php echo $i; ?>">
                <h4 class="panel-title">
                    <a class="collapsed" href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=perguntas_frequentes&categoria=<?php echo $linha['CdCategoria'];?>" aria-expanded="" aria-controls="collapse<?php echo $i; ?>">
                        <?php echo $linha['Nome'];?>
                    </a>
                </h4>
            </div>
        </div>



    <?php } ?>
</div>