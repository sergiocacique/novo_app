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

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

$bNome = $_POST['txtNome'];

$bNome = mysql_real_escape_string($bNome);

$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

$rs_servidor = ("SELECT DISTINCT Secretaria FROM servidor WHERE (Secretaria LIKE '%".$bNome."%') ORDER BY Secretaria ASC");
$servidor = mysql_query($rs_servidor);

$total = mysql_num_rows($servidor);
//quantidade de itens por pagina
$registros = 15;

//calcula o número de páginas
$numPaginas = ceil($total/$registros);

$inicio = ($registros*$pagina)-$registros;
$rs_servidor = ("SELECT DISTINCT Secretaria FROM servidor WHERE (Secretaria LIKE '%".$bNome."%') ORDER BY Secretaria ASC limit $inicio,$registros");
$servidor = mysql_query($rs_servidor);
$total = mysql_num_rows($servidor);
}else{
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

    $rs_servidor = ("SELECT DISTINCT Secretaria FROM servidor  ORDER BY Secretaria ASC");
    $servidor = mysql_query($rs_servidor);

    $total = mysql_num_rows($servidor);
//quantidade de itens por pagina
    $registros = 15;

//calcula o número de páginas
    $numPaginas = ceil($total/$registros);

    $inicio = ($registros*$pagina)-$registros;
    $rs_servidor = ("SELECT DISTINCT Secretaria FROM servidor  ORDER BY Secretaria ASC limit $inicio,$registros");
    $servidor = mysql_query($rs_servidor);
    $total = mysql_num_rows($servidor);
}

?>


    <div id="breadcrumb">
        <div id="breadcrumb_primeiro"><span>Consultas</span></div>
        <div id="breadcrumb_primeiro"><span>Servidor</span></div>
        <div id="breadcrumb_ultima"><span>Orgão de Lotação</span></div>
    </div>

    <div id="titulo_pesquisa">
        <span class="nome">ÓRGÃO DE LOTAçÃO</span>
    </div>

    <?php
    $i = 1;
    while ($listar = mysql_fetch_array($servidor)){
    ?>


        <div id="listagem">
        <a href="<?php echo $UrlAmigavel ?>transparencia/?Pages=servidor&lotacao=<?php echo $listar['Secretaria'];?>">
        <span class="nome"><?php echo $listar['Secretaria'];?></span>
        </a>
    </div>
        <?php
        $i ++;
    }
//endwhile; ?>

<ul class="pagination">
    <?php for ($i = 1; $i < $numPaginas + 1; $i++) { ?>
    <li><a href="<?php echo $UrlAmigavel ?>transparencia/?Pages=servidor_lotacao&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
    <?php }?>
</ul>