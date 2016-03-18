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
$CdCategoria = $_GET['categoria'];

$sqlLinha = mysql_query("SELECT * FROM Leis_categoria WHERE CdCategoria = '".$CdCategoria."'");
$rsLinha = mysql_fetch_array($sqlLinha);
?>


    <div id="breadcrumb">
        <div id="breadcrumb_primeiro"><span>Informações</span></div>
        <div id="breadcrumb_segundo"><span>Legislação</span></div>
        <div id="breadcrumb_ultima"><span><?php echo $rsLinha['Categoria']?></span></div>
    </div>

    <div id="estrutura">

        <div class="panel-body">
            <h3><?php echo $rsLinha['Categoria']?></h3>
            <p class="sobre"><?php echo $rsLinha['Descricao']?></p>

                    <?php
                        $sqlGlossario = mysql_query("SELECT * FROM Leis WHERE Acao = 'Publicado' AND CdCategoria = '".$CdCategoria."'");
                        $Glossario = mysql_num_rows($sqlGlossario);

                        for ($y = 0; $y < $Glossario; $y++){
                            $verGlossario = mysql_fetch_array($sqlGlossario);
                            ?>
                            <div id="listagem">
                                <a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=verLei&lei=<?php echo $verGlossario['CdLeis'];?>">
                                <span class="glossario_titulo"><?php echo $verGlossario['Titulo'];?></span>
                                <span class="glossario_texto"><?php echo $verGlossario['NumLeis'];?> - <?php echo $verGlossario['DtPub'];?></span>
                                </a>
                            </div>
                        <?php
                        }
                    ?>


        </div><!-- /panel-body -->

    </div>


