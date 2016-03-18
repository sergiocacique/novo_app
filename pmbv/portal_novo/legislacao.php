<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 29/08/14
 * Hora: 10:20
 * Página: Servidor
 *
 */


?>
<div id="inicio">
    <?php
    $sqlGlossario = mysql_query("SELECT * FROM Leis_categoria");
    $Glossario = mysql_num_rows($sqlGlossario);

    for ($y = 0; $y < $Glossario; $y++){
    $verGlossario = mysql_fetch_array($sqlGlossario);
    ?>
        <div id="btn_inicio"><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=leis&categoria=<?php echo $verGlossario['CdCategoria'];?>" class="btn_inicio"><?php echo $verGlossario['Categoria'];?></a></div>
    <?php
    }
    ?>
    </div>



