<?php
include ("conexao.php");
include('funcoes.php');


$CdPrefeitura = $_POST['CdPrefeitura'];

$sqlPrefeitura = mysql_query("SELECT * FROM prefeitura WHERE CdPrefeitura = '".$CdPrefeitura."'");
$rsPrefeitura = mysql_fetch_array($sqlPrefeitura);
?>
<div class="container">
    <div class="page-header">
        <h3>Notícias</h3>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3 hidden-phone">
        <ul class="nav nav-pills nav-stacked" style="max-width: 100%">
            <?php
            $id = (isset($_POST['CdCategoria']))? $_POST['CdCategoria'] : 1;

            $sqlGlossario = mysql_query("SELECT site_noticias_categoria.CdCategoria, site_noticias_categoria.Categoria, site_noticias.Acao FROM site_noticias_categoria INNER JOIN site_noticias ON site_noticias_categoria.CdCategoria = site_noticias.CdCategoria WHERE site_noticias.Acao = 'Publicado' GROUP BY site_noticias_categoria.Categoria");
            $Glossario = mysql_num_rows($sqlGlossario);

            for ($y = 0; $y < $Glossario; $y++){
                $verGlossario = mysql_fetch_array($sqlGlossario);

                if ($id == $verGlossario['CdCategoria']){
            ?>
            <li class="active">
                        <a href="javascript:void(0)" onclick="CategoriaNews(<?php echo $verGlossario['CdCategoria']; ?>)"><?php echo $verGlossario['Categoria']; ?></a>
            </li>
              <?php
                }else {
                    ?>
                    <li>
                        <a href="javascript:void(0)" onclick="CategoriaNews(<?php echo $verGlossario['CdCategoria']; ?>)"><?php echo $verGlossario['Categoria']; ?></a>
                    </li>
                <?php
                }
            }
            ?>

        </ul>
    </div>
    <div id="vizualizar" class="col-xs-12 col-sm-8 col-md-9">
        <?php
        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

        $cmd = "select * from site_noticias WHERE CdPrefeitura = '".$CdPrefeitura."' AND Acao = 'Publicado' AND CdCategoria = ".$id." ORDER BY DtCadastro DESC";
        $produtos = mysql_query($cmd);

        $total = mysql_num_rows($produtos);

        $registros = 10;

        $numPaginas = ceil($total/$registros);

        $inicio = ($registros*$pagina)-$registros;


        $cmd = "select * from site_noticias WHERE CdPrefeitura = '".$CdPrefeitura."' AND Acao = 'Publicado' AND CdCategoria = ".$id." ORDER BY DtCadastro DESC limit $inicio,$registros";
        $produtos = mysql_query($cmd);
        $total = mysql_num_rows($produtos);



        while ($produto = mysql_fetch_array($produtos)) {

            $sqlLinha = mysql_query("SELECT * FROM site_noticias_categoria WHERE CdCategoria = '".$produto['CdCategoria']."'");
            $rsLinha = mysql_fetch_array($sqlLinha);
            ?>
        <div class="row">
            <div class="col-md-2">
                <?php
                if($linha['Imagem'] != "") {
                ?>
                <img class="img-responsive" alt="<?php echo $produto['Titulo'];?>" src="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/noticias/<?php echo $produto['Imagem']; ?>">
                <?php
                }else{?>
                    <img class="img-responsive" alt="<?php echo $produto['Titulo'];?>" src="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/noticias/sem-noticia.jpg">

                <?php
                }
                ?>
            </div>
            <div class="col-md-10">
                <a href="<?php echo $UrlAmigavel ?><?php echo $rsPrefeitura['Pasta'] ?>/lerNoticias/<?php echo $produto['CdNoticia'];?>/<?php echo removeAcentos($produto['Titulo'], '-');?>">
                <h4 class="margin-bottom-10"><?php echo $rsLinha['Categoria'];?></h4>
                <p><?php echo $produto['Titulo'];?></p>
                <p><?php echo $produto['Legenda'];?></p>
                    </a>
            </div>





        </div>
            <hr>
        <?php
        }
        ?>
        <ul class="pagination pagination-rounded">
            <?php
            //exibe a paginação
            for($i = 1; $i < $numPaginas + 1; $i++) {
                if($pagina == $i){
                    echo "<li class='active'><a href='javascript:void(0)'>" . $i . "</a></li></a> ";
                }else {
                    echo "<li><a href='?Pages=CatNoticias&id=".$id."&pagina=$i'>" . $i . "</a></li></a> ";
                }
            }
            ?>

        </ul>
    </div>
</div>

