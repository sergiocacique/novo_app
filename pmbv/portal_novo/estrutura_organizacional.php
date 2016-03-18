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
                            Estrutura Organizacional
                        </h4>
                        <?php
                        $sqlEstrutura = mysql_query("SELECT * FROM estrutura WHERE Acao = 'Publicado' ORDER BY CdEstrutura ASC") or die(mysql_error());
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
                                <h5 class="media-heading">
                                    <a href="#"><?php echo $linha['Nome']; ?></a>
                                </h5>
                                <div class="text-muted">
                                    <small>
                                        <i class="fa fa-user fa-fw"></i>
                                        <?php echo $linha['Secretario']; ?>
                                    </small>
                                    <small>
                                        <i class="fa fa-envelope fa-fw"></i>
                                        <?php echo $linha['Email']; ?>
                                    </small>
                                    <br>
                                    <small>
                                        <i class="fa fa-location-arrow fa-fw"></i>
                                        <?php echo $linha['Endereco']; ?>
                                    </small><br><br>
                                    <small>
                                        <i class="fa fa-clock-o fa-fw"></i>
                                        <?php echo $linha['Horario']; ?>
                                    </small><br>
                                    <small>
                                        <i class="fa fa-phone fa-fw"></i>
                                        <?php echo $linha['Telefones']; ?>
                                    </small>

                                    <p class="text-left text-info"><?php echo $linha['Sobre']; ?></p>
                                </div>
                            </div>
                        </div>

                        <?php } ?>
                    </div>
                </div>
        </div>
    </div>
</section>
