<section class="page-title">
  <div class="container">
    <header>
      <ul class="breadcrumb dontPrint">
        <li><a class="inline" href="">Início</a></li>
        <li><a class="inline" href="">Informativos</a></li>
        <li class="active">Notícias</li>
      </ul>
      <h1>Notícias</h1>
    </header>
  </div>
</section>

<div class="pt60 pb60">
<div class="container">

    <div id="vizualizar" class="col-md-9 col-sm-9">
        <?php
        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

        //$cmd = "select *, concat(DtCadastro, ' ', HrCadastro) as dthr from site_noticias WHERE Acao = 'Publicado' ORDER BY dthr DESC";
        $cmd = "select * from vw_noticias WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY DtCadastro DESC";

        $produtos = mysql_query($cmd);

        $total = mysql_num_rows($produtos);

        $registros = 50;

        $numPaginas = ceil($total/$registros);

        $inicio = ($registros*$pagina)-$registros;


        $cmd = "select * from vw_noticias WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY DtCadastro DESC limit $inicio,$registros";
        $produtos = mysql_query($cmd);
        $total = mysql_num_rows($produtos);



        while ($produto = mysql_fetch_array($produtos)) {
            ?>


            <div class="row">
              <?php
              if($produto['Imagem'] != "") {
                $classeTm = "9";
                  ?>
                <div class="col-md-3">

                        <img class="img-responsive" alt="<?php echo $produto['Titulo'];?>" src="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'] ?>/noticias/<?php echo $produto['Imagem']; ?>">

                </div>
                <?php
                }else{
                  $classeTm = "12";
                }
                ?>
                <div class="col-md-<?php echo $classeTm;?>">
                    <a href="<?php echo $UrlAmigavel ?>?Pages=lerNoticias&noticia=<?php echo $produto['CdNoticia'];?>">
                        <h4 class="margin-bottom-10"><?php echo $produto['Categoria'];?></h4>
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
                    echo "<li><a href='?Pages=noticias&pagina=$i'>" . $i . "</a></li></a> ";
                }
            }
            ?>

        </ul>
    </div>
<div class="col-md-3 col-sm-3 dontPrint" role="complementary"><?php include 'lateral.php';?></div>
</div>
</div>
