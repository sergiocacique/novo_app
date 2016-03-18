<script>
    function carregaAno(id){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>servidor_ver.php", { id: id },
            function(data){
                $('#ver').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    function carregaSalario(id){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>servidor_salario.php", { id: id },
            function(data){
                $('#visualizar').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }
</script>
<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 29/08/14
 * Hora: 10:20
 * Página: Servidor
 *
 */


if (isset($_POST['txtNome']) and ($_POST['txtNome'] != '')){
    $bNome = $_POST['txtNome'];
    $bNome = mysql_real_escape_string($bNome);
}elseif (isset($_GET['txtNome']) and ($_GET['txtNome'] != '')){
    $bNome = $_GET['txtNome'];
    $bNome = mysql_real_escape_string($bNome);
}


//$sql = "SELECT DISTINCT CPF, Nome, Secretaria, Cargo, CargoComissao FROM servidor WHERE (Acao = 'Publicado') AND CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."'";
$sql = "SELECT * FROM servidor WHERE (Acao = 'Publicado') AND CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."'";

if (isset($bNome) AND $bNome  != ''){
    $bNome = str_replace(" ","%", $bNome);
    $sql =$sql . " AND (Nome LIKE '%".$bNome."%')";
}


$sql = $sql . " GROUP BY CPF ORDER BY Nome ASC, Mes DESC, Ano DESC";

//echo "sql=".$sql;
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

$rs_servidor = ($sql);
$servidor = mysql_query($rs_servidor);

$total = mysql_num_rows($servidor);
//quantidade de itens por pagina
$registros = 50;

//calcula o número de páginas
$numPaginas = ceil($total/$registros);

$inicio = ($registros*$pagina)-$registros;
$rs_servidor = ($sql." limit $inicio,$registros");
$servidor = mysql_query($rs_servidor);
$total = mysql_num_rows($servidor);

$max_links = 5;

//echo $sql;
?>
<section class="texto-simples">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
                <h2 class="title title-d">DESPESAS COM <strong>PESSOAL</strong></h2>
            </div>
            <div class="mar-40 col-xs-12 col-sm-12 col-md-12">
                <div class="divisor divisor-c">
                    <span> </span>
                </div>
            </div>
            <section class="container faq mar-60" rel="Despesas com pessoal">


                <div class="col-xs-6 col-sm-6 col-md-6">
                    <p class="text text-c"> Use a pesquisa para obter informações sobre cargo, função e remuneração dos servidores, bem como dos agentes públicos do Poder Executivo Munícipal.  </p>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <form method="post" action="<?php echo $legal ?>servidor" role="form">
                    <div id="filtergeral" class="control-form filter-policies">
                        <label class="label" for="filter-input">Digite aqui o CPF ou o nome para filtrar sua busca</label>
                        <input type="text" id="txtNome" name="txtNome" class="input-text" value="">
                        <div class="aux-shadow"></div>
                        <input id="filter-btn" class="btn-new type-two yellow" type="submit" name="" value="Buscar">
                        <div class="control-return" style="display: none;"></div>
                    </div>
                        </form>

                </div>
                <div class="clear"></div>
            </section>
        </div>
    </div>
</section>


<section id="ver" class="texto-simples">
    <div class="container">
        <div class="row">
    <table class="table table-afiliados" summary="Despesas com pessoal">
        <thead>
        <tr>
            <th class="col-sm-1"><span class="texto-amarelo">CPF</span></th>
            <th class="col-sm-3"><span class="texto-amarelo">Nome</span></th>
            <th class="col-sm-3">Cargo</th>
            <th class="col-sm-1">
                <small>Tipo de Contratação</small>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        while ($listar = mysql_fetch_array($servidor)){

        $CPF = $listar['CPF'];
        $CPFs = $CPF;
        //$CPFs = explode(".", $CPF);
        ?>
        <tr onclick="carregaAno(<?php echo $listar['CdServidor']?>)" style="cursor: pointer">
            <td>
                <small><?php echo mask($CPF,'***.###.###-**');?></small>
            </td>
            <td>
                    <small><?php echo $listar['Nome'];?></small>
            </td>
            <td>
                <small><?php echo $listar['Cargo'];?></small>
            </td>
            <td>
                <small><?php echo $listar['CargoComissao'];?></small>
            </td>
        </tr>
            <?php
            $i ++;
        }
        //endwhile; ?>
        </tbody>
    </table>

            <?php
            if (isset($_GET['lotacao']) and ($_GET['lotacao'] != ''))
            {
                ?>
                <ul class="pagination">
                    <?php for ($i = 1; $i < $numPaginas + 1; $i++) { ?>
                        <li><a href="<?php echo $legal ?>servidor&lotacao=<?php echo $_GET['lotacao']; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php }?>
                </ul>
            <?php
            }elseif (isset($_GET['cargo']) and ($_GET['cargo'] != '')){
                ?>
                <ul class="pagination">
                    <?php for ($i = 1; $i < $numPaginas + 1; $i++) { ?>
                        <li><a href="<?php echo $legal ?>servidor&cargo=<?php echo $_GET['cargo']; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php }?>
                </ul>
            <?php
            }else{
                ?>
                <ul class="pagination">
                    <?php
                    //echo "pagina 1";
                    for($i = $pagina-$max_links; $i <= $pagina-1; $i++) {
                        if($i <=0) {
                        } else {
                            ?>

                            <li><a href="<?php echo $legal ?>servidor&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php
                        } }
                    ?>
                    <li class="active"><a href="#"> <?php echo $pagina ?></a></li>
                    <?php

                    for($i = $pagina+1; $i <= $pagina+$max_links; $i++) {
                        if($i > $numPaginas) {
                        }
                        else {
                            ?>
                            <li><a href="<?php echo $legal ?>servidor&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php
                        } }
                    //echo "";
                    ?>
                </ul>
            <?php
            }

            ?>
        </div>
        </div>
</section>


<section class="line-100 type-c line-advantages">
    <div class="container">
        <div class="grid-12 pull-left">
            <h4 class="title title-d">
                <strong>ACESSO À </strong>INFORMAÇÃO
            </h4>
        </div>
        <div class="col-md-8 mar-20">
            <div class="divisor divisor-b">
                <span> </span>
            </div>
        </div>
        <div class="col-md-8 mar-10">
            <p class="text text-c"> O objetivo do e-SIC é facilitar o exercício do direito fundamental de acesso às informações públicas. Por meio deste sistema, você faz o seu pedido e acompanha todo o trâmite. </p>
        </div>
        <div class="clear"> </div>
        <div class="col-md-8 mar-20">
            <a class="btn type-d" title="saiba mais sobre as vantagens kinghost" href="<?php echo $legal ?>esic">SAIBA MAIS</a>
        </div>
    </div>
</section>