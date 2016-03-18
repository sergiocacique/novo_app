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


<section class="content-wrapper content-midwet">
    <div class="content">
        <div class="row">
            <br clear="all">

            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <h4>
                            LINKS
                        </h4>
                        <?php
                        $sqlEstrutura = mysql_query("SELECT * FROM links WHERE Ativo = 'sim' AND Lixo = 'nao' ORDER BY Titulo ASC") or die(mysql_error());
                        $contador = mysql_num_rows($sqlEstrutura);
                        for ($i = 0; $i < $contador; $i++){
                        $linha = mysql_fetch_array($sqlEstrutura);

                        if ($i > 0){
                            $classServ = "false";
                        }else{
                            $classServ = "true";
                        }

                        ?>
                            <hr>
                        <div class="media">
                            <div class="media-body">
                                <?php
                                    if ($linha['img'] != "") {
                                ?>
                                <div class="profile-avatar kit-avatar kit-avatar-128 border-transparent pull-left">
                                    <img alt="<?php echo $linha['Titulo']; ?>" src="<?php echo $UrlAmigavel ?>dinamico/img/<?php echo $linha['img']; ?>">
                                </div>
                                <?php }?>
                                <h5 class="media-heading">
                                    <a href="#"><?php echo $linha['Titulo']; ?></a>
                                </h5>
                                <div class="text-muted">
                                    <small>
                                        <i class="fa fa-user fa-fw"></i>
                                        <a href="http://<?php echo $linha['url']; ?>" target="_blank"><?php echo $linha['url']; ?></a>
                                    </small>
                                </div>
                            </div>
                        </div>

                        <?php } ?>
                    </div>
                </div>
        </div>
    </div>
</section>
