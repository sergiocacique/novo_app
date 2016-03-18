<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 29/08/14
 * Hora: 10:20
 * Página: Servidor
 *
 */


//include ("../conexao.php");
?>


    <div id="breadcrumb">
        <div id="breadcrumb_primeiro"><span>+ Transparência</span></div>
        <div id="breadcrumb_ultima"><span>Glossário</span></div>
    </div>

    <div id="estrutura">

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
                        $sqlGlossario = mysql_query("SELECT * FROM glossario WHERE Titulo LIKE '".$i."%' AND Lixo = 'nao' AND Ativo = 'sim'");
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


