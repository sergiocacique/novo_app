<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 29/08/14
 * Hora: 10:20
 * Página: Servidor
 *
 */

if (isset($_GET['lotacao']) and ($_GET['lotacao'] != ''))
{
    $bSecretaria = $_GET['lotacao'];
    $bSecretaria = mysql_real_escape_string($bSecretaria);
}


if (isset($_POST['cargo']) and ($_POST['cargo'] != '')){
    $bCargo = $_POST['cargo'];
    $bCargo = mysql_real_escape_string($bCargo);
}elseif (isset($_GET['cargo']) and ($_GET['cargo'] != '')){
    $bCargo = $_GET['cargo'];
    $bCargo = mysql_real_escape_string($bCargo);
}


if (isset($_GET['Orgao']) and ($_GET['Orgao'] != ''))
{
    $bOrgao = $_GET['Orgao'];
    $bOrgao = mysql_real_escape_string($bOrgao);
}



if (isset($_POST['txtNome']) and ($_POST['txtNome'] != '')){
    $bNome = $_POST['txtNome'];
    $bNome = mysql_real_escape_string($bNome);
}elseif (isset($_GET['txtNome']) and ($_GET['txtNome'] != '')){
    $bNome = $_GET['txtNome'];
    $bNome = mysql_real_escape_string($bNome);
}


if (isset($_POST['txtAno']) and ($_POST['txtAno'] != '')){
    $bAno = $_POST['txtAno'];
    $bAno = mysql_real_escape_string($bAno);
}elseif (isset($_GET['txtAno']) and ($_GET['txtAno'] != '')){
    $bAno = $_GET['txtAno'];
    $bAno = mysql_real_escape_string($bAno);
}

if (isset($_POST['txtMes']) and ($_POST['txtMes'] != '')){
    $bmes = $_POST['txtMes'];
    $bmes = mysql_real_escape_string($bmes);
}elseif (isset($_GET['txtMes']) and ($_GET['txtMes'] != '')){
    $bmes = $_GET['txtMes'];
    $bmes = mysql_real_escape_string($bmes);
}



$sql = "SELECT DISTINCT CPF, Nome FROM servidor WHERE (Disponivel = 'sim') AND (Aprovado = 'sim')";

if (isset($bSecretaria) AND $bSecretaria  != ''){
    $sql =$sql . " AND (Secretaria LIKE '%".$bSecretaria."%')";
}

if (isset($bCargo) AND $bCargo  != ''){
    $sql =$sql . " AND (Cargo LIKE '%".$bCargo."%')";
}

//if ($bmes != ''){
//    $sql =$sql . " AND (DATE_FORMAT(Mes, '%c') = ".$bmes.")";
//}

if (isset($bmes) AND $bmes != ''){
    $sql =$sql . " AND ( Mes = ".$bmes.")";
}

if (isset($bAno) AND $bAno != ''){
    $sql =$sql . " AND (Ano = ".$bAno.")";
}
if (isset($bNome) AND $bNome  != ''){
    $bNome = str_replace(" ","%", $bNome);
    $sql =$sql . " AND (Nome LIKE '%".$bNome."%') OR (CPF LIKE '%".$bNome."%')";
}


$sql = $sql . " ORDER BY Nome ASC, Mes DESC, Ano DESC";

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


    <div id="breadcrumb">
        <div id="breadcrumb_primeiro"><span>Despesas Pessoal</span></div>
        <div id="breadcrumb_ultima"><span>Servidor</span></div>
    </div>


    <div id="box_pesquisa">
        <form method="post" action="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor" role="form">
            <h4 class="pesquisa_titulo">Pesquisa por Servidor</h4>
            <div id="box_nome">
                <div class="form-group">
                    <label for="Nome">Nome ou CPF</label>
                    <input type="text" class="form-control" id="txtNome" name="txtNome">
                </div>
            </div>

            <div id="box_botao">
                <input type="submit"  value="BUSCAR" class="btn btn-default"></div>
        </form>


    </div>
<div id="corpo_servidor">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <?php
    $i = 1;
    while ($listar = mysql_fetch_array($servidor)){

        $CPF = $listar['CPF'];
        $CPFs = $CPF;
        //$CPFs = explode(".", $CPF);
    ?>



            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading<?php echo $i; ?>">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                            <span class="cpf">
                            <?php echo mask($CPF,'***.###.###-**');?>&nbsp&nbsp&nbsp
                            <?php echo $listar['Nome'];?></span>
                        </a>
                    </h4>
                </div>
                <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                    <h4 class="h4_titulo" id="myModalLabel"><?php echo $listar['Nome'];?></h4>
                    <h5 class="h5_titulo"><?php echo mask($CPF,'***.###.###-**');?></h5>
                    <h6 class="h6_titulo"><?php echo $listar['Secretaria'];?> <br><?php echo $listar['Cargo'];?> - <?php if (isset($listar['CargoComissao']) != '') {?>(<?php echo $listar['CargoComissao'];?>)<?php }?></h6>
                    <div class="panel-body">
                        <div role="tabpanel">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <?php
                                $sqlEstrutura = mysql_query("SELECT * FROM servidor WHERE CPF = '".$listar['CPF']."' AND (Disponivel = 'sim') AND (Aprovado = 'sim') ORDER BY Ano DESC, Mes DESC LIMIT 12") or die(mysql_error());
                                $contador = mysql_num_rows($sqlEstrutura);
                                $linha2 = array();
                                for ($x = 0; $x < $contador; $x++){
                                    $linha = mysql_fetch_array($sqlEstrutura);

                                   array_push($linha2,$linha);

                                    ?>

                                    <?PHP
                                    if ($linha['PSS'] == '0.00'){
                                        $decimo1 = " - 13º";
                                    }else{
                                        $decimo1 = "";
                                    }
                                    ?>

                                <li role="presentation" <?php if ($x > 0){ }else {?>class="active" <?php }?>>
                                        <a href="#<?php echo $i; ?><?php echo $x; ?>" aria-controls="<?php echo $i; ?><?php echo $x; ?>" role="tab" data-toggle="tab">
                                            <?php echo retorna_mes($linha['Mes']);?>/<?php echo $linha['Ano']; ?> <?php echo $decimo1 ?>
                                        </a>
                                </li>
                                <?php } ?>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <?php

                                for ($x = 0; $x < $contador; $x++){
                                    $linha = $linha2[$x];

                                    ?>
                                <div role="tabpanel" class="tab-pane <?php if ($x > 0){ }else {?>active<?php }?>" id="<?php echo $i; ?><?php echo $x; ?>">

                                    <div id="servidor_remuneracao">
                                        <h4 class="titulo1">REMUNERAÇÃO</h4>
                                        <span class="servidor_remuneracao1">Remuneração básica bruta</span>
                                        <span class="servidor_remuneracao2"><?php echo number_format($linha['RemuneracaoBasica'], 2, ',', '.');?></span>
                                    </div>

                                    <div id="servidor_remuneracao_eventual">
                                        <h4 class="titulo1">Remuneração eventual</h4>
                                        <div id="remuneracao_lista">
                                            <span class="servidor_remuneracao_eventual1">13º Antecipado</span>
                                            <span class="servidor_remuneracao_eventual2"><?php echo number_format($linha['DecimoFinal'], 2, ',', '.');?></span>
                                        </div>
                                        <div id="remuneracao_lista">
                                            <span class="servidor_remuneracao_eventual1">Férias</span>
                                            <span class="servidor_remuneracao_eventual2"><?php echo number_format($linha['Ferias'], 2, ',', '.');?></span>
                                        </div>
                                        <div id="remuneracao_lista">
                                            <span class="servidor_remuneracao_eventual1">Outras remunerações eventuais</span>
                                            <span class="servidor_remuneracao_eventual2"><?php echo number_format($linha['Gratificacao'], 2, ',', '.');?></span>
                                        </div>
                                    </div>

                                    <?PHP
                                    if ($linha['PSS'] == '0.00'){
                                        $PSS = number_format($linha['DecimoPSS'], 2, ',', '.');
                                    }else{
                                        $PSS = number_format($linha['PSS'], 2, ',', '.');
                                    }

                                    if ($linha['IRRF'] == '0.00'){
                                        $IRRF = number_format($linha['DecimoIRRF'], 2, ',', '.');
                                    }else{
                                        $IRRF = number_format($linha['IRRF'], 2, ',', '.');
                                    }
                                    ?>
                                    <div id="servidor_deducao">
                                        <h4 class="titulo2">Dedução obrigatórias (-)</h4>
                                        <div id="remuneracao_lista">
                                            <span class="servidor_deducao1">IRRF (Imposto de Renta Retido na Fonte)</span>
                                            <span class="servidor_deducao2">-<?php echo $IRRF;?></span>
                                        </div>
                                        <div id="remuneracao_lista">
                                            <span class="servidor_deducao1">PSS / RPGS (Previdência Oficial)</span>
                                            <span class="servidor_deducao2">-<?php echo $PSS;?></span>
                                        </div>

                                    </div>
                                    <?php
                                    $v1 = $linha['RemuneracaoBasica'];
                                    $v2 = $linha['DecimoAnt'];
                                    $v3 = $linha['Ferias'];
                                    $v4 = $linha['Gratificacao'];

                                    // Desconto
                                    $v5 = $linha['IRRF'];
                                    $v6 = $linha['PSS'];
                                    $v7 = $linha['DecimoAdto'];
                                    $v8 = $linha['DecimoFinal'];
                                    $v9 = $linha['DecimoPSS'];
                                    $v10 = $linha['DecimoIRRF'];

                                    $valGanho = $v1;
                                    $valDesconto = $v5+$v6+$v7+$v8+$v9+$v10;
                                    $valTotal = $valGanho-$valDesconto;

                                    $dataDisponivel = $linha['DtDisponivel'];

                                    list($ano, $mes, $dia) = explode("-", $dataDisponivel);

                                    ?>

                                    <div id="servidor_remuneracao_total">
                                        <h4 class="titulo1">Total da Remuneração após dedução <span class="servidor_remuneracao2"><?php echo number_format($valTotal, 2, ',', '.');?></span></h4>
                                    </div>

                                </div>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        <?php
        $i ++;
    }
//endwhile; ?>
</div>
</div>
<?php
if (isset($_GET['lotacao']) and ($_GET['lotacao'] != ''))
{
    ?>
    <ul class="pagination">
        <?php for ($i = 1; $i < $numPaginas + 1; $i++) { ?>
            <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor&lotacao=<?php echo $_GET['lotacao']; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php }?>
    </ul>
    <?php
}elseif (isset($_GET['cargo']) and ($_GET['cargo'] != '')){
    ?>
    <ul class="pagination">
        <?php for ($i = 1; $i < $numPaginas + 1; $i++) { ?>
            <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor&cargo=<?php echo $_GET['cargo']; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
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

            <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
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
            <li><a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php
             } }
    //echo "";
      ?>
    </ul>
    <?php
}

?>