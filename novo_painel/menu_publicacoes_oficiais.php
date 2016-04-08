<div class="pane">
    <header class=" hide_when_collapsed">
        <h1>PÚBLICAÇÕES OFICIAIS</h1>
    </header>
    <div class=" hide_when_collapsed scroll_content">

        <div class="section">

            <ul class="filters">
              <?php
              $sqlGlossario = mysql_query("SELECT * FROM publicacoes_oficiais_categoria ORDER BY Nome ASC");
              $Glossario = mysql_num_rows($sqlGlossario);

              for ($y = 0; $y < $Glossario; $y++){
                  $verGlossario = mysql_fetch_array($sqlGlossario);

                  ?>
                <li>
                    <a href="publicacoes_oficiais_ver.php?id=<?php echo $verGlossario['CdCategoria']; ?>">
                        <?php echo $verGlossario['Nome']; ?>
                    </a>
                </li>
                <?php
                }
                ?>
                <li>
                    <a href="publicacoes_oficiais_diario_oficia.php">
                        Diário Oficial
                    </a>
                </li>
            </ul>
        </div>




    </div>
</div>
