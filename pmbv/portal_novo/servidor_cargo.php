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
$bAno =  $_POST['txtAno'];
$bMes =  $_POST['txtMes'];

$bNome = mysql_real_escape_string($bNome);
$bAno = mysql_real_escape_string($bAno);
$bMes = mysql_real_escape_string($bMes);

$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

$rs_servidor = ("SELECT DISTINCT Cargo FROM servidor WHERE (Cargo LIKE '%".$bNome."%')  ORDER BY Cargo ASC");
$servidor = mysql_query($rs_servidor);

$total = mysql_num_rows($servidor);
//quantidade de itens por pagina
$registros = 15;

//calcula o número de páginas
$numPaginas = ceil($total/$registros);

$inicio = ($registros*$pagina)-$registros;
$rs_servidor = ("SELECT DISTINCT Cargo FROM servidor WHERE (Cargo LIKE '%".$bNome."%') ORDER BY Cargo ASC limit $inicio,$registros");
$servidor = mysql_query($rs_servidor);
$total = mysql_num_rows($servidor);
}else{
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

    $rs_servidor = ("SELECT DISTINCT Cargo FROM servidor  ORDER BY Cargo ASC");
    $servidor = mysql_query($rs_servidor);

    $total = mysql_num_rows($servidor);
//quantidade de itens por pagina
    $registros = 15;

//calcula o número de páginas
    $numPaginas = ceil($total/$registros);

    $inicio = ($registros*$pagina)-$registros;
    $rs_servidor = ("SELECT DISTINCT Cargo FROM servidor  ORDER BY Cargo ASC limit $inicio,$registros");
    $servidor = mysql_query($rs_servidor);
    $total = mysql_num_rows($servidor);
}

?>


    <div id="breadcrumb">
        <div id="breadcrumb_primeiro"><span>Consultas</span></div>
        <div id="breadcrumb_primeiro"><span>Servidor</span></div>
        <div id="breadcrumb_ultima"><span>Função ou Cargo</span></div>
    </div>

    <div id="titulo_pesquisa">
        <span class="nome">CARGO</span>
        <span class="nome">SECRETARIA</span>
    </div>


    <?php
    $i = 1;
    while ($listar = mysql_fetch_array($servidor)){
    ?>


        <div id="listagem">

            <span class="nome"><a href="<?php echo $UrlAmigavel ?>transparencia/?Pages=servidor&cargo=<?php echo $listar['Cargo'];?>"><?php echo $listar['Cargo'];?></a></span>
            <span class="nome"><a href="<?php echo $UrlAmigavel ?>transparencia/?Pages=servidor&lotacao=<?php echo $listar['Secretaria'];?>"><?php echo $listar['Secretaria'];?></a></span>
    </div>
        <?php
        $i ++;
    }
//endwhile; ?>

<ul class="pagination">
    <?php for ($i = 1; $i < $numPaginas + 1; $i++) { ?>
    <li><a href="<?php echo $UrlAmigavel ?>transparencia/?Pages=servidor_cargo&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
    <?php }?>
</ul>