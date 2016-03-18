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
if (isset($_GET['lotacao']) and ($_GET['lotacao'] != ''))
{
    $bSecretaria = $_GET['lotacao'];
    $bSecretaria = mysql_real_escape_string($bSecretaria);

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $bNome = $_POST['txtNome'];
        $bAno =  $_POST['txtAno'];
        $bMes =  $_POST['txtMes'];

        $bNome = mysql_real_escape_string($bNome);
        $bAno = mysql_real_escape_string($bAno);
        $bMes = mysql_real_escape_string($bMes);

        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

        $rs_servidor = ("SELECT * FROM servidor WHERE (Disponivel = 'sim') AND (Aprovado = 'sim') AND (Secretaria LIKE '%".$bSecretaria."%') AND (DATE_FORMAT(DtDisponivel, '%c') = ".$bMes.") AND (DATE_FORMAT(DtDisponivel, '%Y') = ".$bAno.") AND (Nome LIKE '%".$bNome."%') OR (CPF LIKE '%".$bNome."%') ORDER BY Nome ASC");
        $servidor = mysql_query($rs_servidor);

        $total = mysql_num_rows($servidor);
//quantidade de itens por pagina
        $registros = 50;

//calcula o número de páginas
        $numPaginas = ceil($total/$registros);

        $inicio = ($registros*$pagina)-$registros;
        $rs_servidor = ("SELECT * FROM servidor WHERE (Disponivel = 'sim') AND (Aprovado = 'sim') AND (Secretaria LIKE '%".$bSecretaria."%') AND (DATE_FORMAT(DtDisponivel, '%c') = ".$bMes.") AND (DATE_FORMAT(DtDisponivel, '%Y') = ".$bAno.") AND (Nome LIKE '%".$bNome."%') OR (CPF LIKE '%".$bNome."%') ORDER BY Nome ASC limit $inicio,$registros");
        $servidor = mysql_query($rs_servidor);
        $total = mysql_num_rows($servidor);
    }else{
        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

        $rs_servidor = ("SELECT * FROM servidor WHERE (Disponivel = 'sim') AND (Aprovado = 'sim') AND (Secretaria LIKE '%".$bSecretaria."%') AND (DATE_FORMAT(DtDisponivel, '%c') = ".$meshoje.") AND (DATE_FORMAT(DtDisponivel, '%Y') = ".$anohoje.") ORDER BY Nome ASC");
        $servidor = mysql_query($rs_servidor);

        $total = mysql_num_rows($servidor);
//quantidade de itens por pagina
        $registros = 50;

//calcula o número de páginas
        $numPaginas = ceil($total/$registros);

        $inicio = ($registros*$pagina)-$registros;
        $rs_servidor = ("SELECT * FROM servidor WHERE (Disponivel = 'sim') AND (Aprovado = 'sim') AND (Secretaria LIKE '%".$bSecretaria."%') AND (DATE_FORMAT(DtDisponivel, '%c') = ".$meshoje.") AND (DATE_FORMAT(DtDisponivel, '%Y') = ".$anohoje.") ORDER BY Nome ASC limit $inicio,$registros");
        $servidor = mysql_query($rs_servidor);
        $total = mysql_num_rows($servidor);

        echo $bSecretaria;
        echo $rs_servidor;
    }





}elseif (isset($_GET['cargo']) and ($_GET['cargo'] != ''))
{

    $bCargo = $_GET['cargo'];
    $bCargo = mysql_real_escape_string($bCargo);

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $bNome = $_POST['txtNome'];
        $bAno =  $_POST['txtAno'];
        $bMes =  $_POST['txtMes'];

        $bNome = mysql_real_escape_string($bNome);
        $bAno = mysql_real_escape_string($bAno);
        $bMes = mysql_real_escape_string($bMes);

        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

        $rs_servidor = ("SELECT * FROM servidor WHERE (Disponivel = 'sim') AND (Aprovado = 'sim') AND (DATE_FORMAT(DtDisponivel, '%c') = ".$bMes.") AND (DATE_FORMAT(DtDisponivel, '%Y') = ".$bAno.") AND (Cargo LIKE '%".$bCargo."%') AND (Nome LIKE '%".$bNome."%') OR (CPF LIKE '%".$bNome."%') ORDER BY Nome ASC");
        $servidor = mysql_query($rs_servidor);

        $total = mysql_num_rows($servidor);
//quantidade de itens por pagina
        $registros = 50;

//calcula o número de páginas
        $numPaginas = ceil($total/$registros);

        $inicio = ($registros*$pagina)-$registros;
        $rs_servidor = ("SELECT * FROM servidor WHERE (Disponivel = 'sim') AND (Aprovado = 'sim') AND (DATE_FORMAT(DtDisponivel, '%c') = ".$bMes.") AND (DATE_FORMAT(DtDisponivel, '%Y') = ".$bAno.") AND (Cargo LIKE '%".$bCargo."%') AND (Nome LIKE '%".$bNome."%') OR (CPF LIKE '%".$bNome."%') ORDER BY Nome ASC limit $inicio,$registros");
        $servidor = mysql_query($rs_servidor);
        $total = mysql_num_rows($servidor);
    }else{
        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

        $rs_servidor = ("SELECT * FROM servidor WHERE (Disponivel = 'sim') AND (Aprovado = 'sim') AND (Cargo LIKE '%".$bCargo."%') AND (DATE_FORMAT(DtDisponivel, '%c') = ".$meshoje.") AND (DATE_FORMAT(DtDisponivel, '%Y') = ".$anohoje.") ORDER BY Nome ASC");
        $servidor = mysql_query($rs_servidor);

        $total = mysql_num_rows($servidor);
//quantidade de itens por pagina
        $registros = 50;

//calcula o número de páginas
        $numPaginas = ceil($total/$registros);

        $inicio = ($registros*$pagina)-$registros;
        $rs_servidor = ("SELECT * FROM servidor WHERE (Disponivel = 'sim') AND (Aprovado = 'sim') AND (Cargo LIKE '%".$bCargo."%') AND (DATE_FORMAT(DtDisponivel, '%c') = ".$meshoje.") AND (DATE_FORMAT(DtDisponivel, '%Y') = ".$anohoje.") ORDER BY Nome ASC limit $inicio,$registros");
        $servidor = mysql_query($rs_servidor);
        $total = mysql_num_rows($servidor);
    }


}else{

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $bNome = $_POST['txtNome'];
        $bAno =  $_POST['txtAno'];
        $bMes =  $_POST['txtMes'];

        $bNome = mysql_real_escape_string($bNome);
        $bAno = mysql_real_escape_string($bAno);
        $bMes = mysql_real_escape_string($bMes);

        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

        $rs_servidor = ("SELECT * FROM servidor WHERE (Disponivel = 'sim') AND (Aprovado = 'sim') AND (DATE_FORMAT(DtDisponivel, '%c') = ".$bMes.") AND (DATE_FORMAT(DtDisponivel, '%Y') = ".$bAno.") AND (Nome LIKE '%".$bNome."%') OR (CPF LIKE '%".$bNome."%') ORDER BY Nome ASC");
        $servidor = mysql_query($rs_servidor);

        $total = mysql_num_rows($servidor);
//quantidade de itens por pagina
        $registros = 50;

//calcula o número de páginas
        $numPaginas = ceil($total/$registros);

        $inicio = ($registros*$pagina)-$registros;
        $rs_servidor = ("SELECT * FROM servidor WHERE (Disponivel = 'sim') AND (Aprovado = 'sim') AND (DATE_FORMAT(DtDisponivel, '%c') = ".$bMes.") AND (DATE_FORMAT(DtDisponivel, '%Y') = ".$bAno.") AND (Nome LIKE '%".$bNome."%') OR (CPF LIKE '%".$bNome."%') ORDER BY Nome ASC limit $inicio,$registros");
        $servidor = mysql_query($rs_servidor);
        $total = mysql_num_rows($servidor);
    }else{
        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

        $rs_servidor = ("SELECT * FROM servidor WHERE (Disponivel = 'sim') AND (Aprovado = 'sim') AND (DATE_FORMAT(DtDisponivel, '%c') = ".$meshoje.") AND (DATE_FORMAT(DtDisponivel, '%Y') = ".$anohoje.") ORDER BY Nome ASC");
        $servidor = mysql_query($rs_servidor);

        $total = mysql_num_rows($servidor);
//quantidade de itens por pagina
        $registros = 50;

//calcula o número de páginas
        $numPaginas = ceil($total/$registros);

        $inicio = ($registros*$pagina)-$registros;
        $rs_servidor = ("SELECT * FROM servidor WHERE (Disponivel = 'sim') AND (Aprovado = 'sim') AND (DATE_FORMAT(DtDisponivel, '%c') = ".$meshoje.") AND (DATE_FORMAT(DtDisponivel, '%Y') = ".$anohoje.") ORDER BY Nome ASC limit $inicio,$registros");
        $servidor = mysql_query($rs_servidor);
        $total = mysql_num_rows($servidor);
    }
}
$max_links = 5;



?>


    <div id="breadcrumb">
        <div id="breadcrumb_primeiro"><span>Consultas</span></div>
        <div id="breadcrumb_ultima"><span>Servidor</span></div>
    </div>

    <div id="titulo_pesquisa">
        <span class="cpf">CPF</span>
        <span class="nome">NOME</span>
        <span class="orgao">ÓRGÃO DE EXERCÍCIO</span>
    </div>

    <div id="box_pesquisa">
        <form method="post" action="<?php echo $UrlAmigavel ?>transparencia/?Pages=servidor" role="form">
            <h4 class="pesquisa_titulo">Pesquisa por Servidor</h4>
            <div id="box_nome">
                <div class="form-group">
                    <label for="Nome">Nome ou CPF</label>
                    <input type="text" class="form-control" id="txtNome" name="txtNome">
                </div>
            </div>
            <div id="box_ano">
                <label for="txtAno">Ano</label>
                <select id="txtAno" name="txtAno" class="form-control">
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                </select>
            </div>
            <div id="box_mes">
                <label for="txtMes">Mês</label>
                <select id="txtMes" name="txtMes" class="form-control">
                    <option value="01">JANEIRO</option>
                    <option value="02">FEVEREIRO</option>
                    <option value="03">MARCO</option>
                    <option value="04">ABRIL</option>
                    <option value="05">MAIO</option>
                    <option value="06">JUNHO</option>
                    <option value="07">JULHO</option>
                    <option value="08">AGOSTO</option>
                    <option value="09">SETEMBRO</option>
                    <option value="10">OUTUBRO</option>
                    <option value="11">NOVEMBRO</option>
                    <option value="12">DEZEMBRO</option>
                </select>
            </div>
            <div id="box_botao">
                <input type="submit"  value="BUSCAR" class="btn btn-default"></div>
        </form>


    </div>
    <?php
    $i = 1;
    while ($listar = mysql_fetch_array($servidor)){

        $CPF = $listar['CPF'];
        $CPFs = $CPF;
        //$CPFs = explode(".", $CPF);
    ?>

        <!-- Modal -->
        <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $listar['Nome'];?></h4>
                        <h5 class=""><?php echo $CPFs[0];?><?php echo $CPFs[1];?><?php echo $CPFs[2];?>.***.***-**</h5>
                        <h6 class=""><?php echo $listar['Secretaria'];?> <br><?php echo $listar['Cargo'];?>  <?php if (isset($listar['CargoComissao']) != '') {?>(<?php echo $listar['CargoComissao'];?>)<?php }?></h6>
                    </div>
                    <div class="modal-body">

                        <div id="servidor_remuneracao">
                            <h4 class="titulo1">REMUNERAÇÃO</h4>
                            <span class="servidor_remuneracao1">Remuneração básica bruta</span>
                            <span class="servidor_remuneracao2"><?php echo number_format($listar['RemuneracaoBasica'], 2, ',', '.');?></span>
                        </div>

                        <div id="servidor_remuneracao_eventual">
                            <h4 class="titulo1">Remuneração eventual</h4>
                            <div id="remuneracao_lista">
                                <span class="servidor_remuneracao_eventual1">13º Antecipado</span>
                                <span class="servidor_remuneracao_eventual2"><?php echo number_format($listar['DecimoAnt'], 2, ',', '.');?></span>
                            </div>
                            <div id="remuneracao_lista">
                                <span class="servidor_remuneracao_eventual1">Férias</span>
                                <span class="servidor_remuneracao_eventual2"><?php echo number_format($listar['Ferias'], 2, ',', '.');?></span>
                            </div>
                            <div id="remuneracao_lista">
                                <span class="servidor_remuneracao_eventual1">Outras remunerações eventuais</span>
                                <span class="servidor_remuneracao_eventual2"><?php echo number_format($listar['Gratificacao'], 2, ',', '.');?></span>
                            </div>
                        </div>

                        <div id="servidor_deducao">
                            <h4 class="titulo2">Dedução obrigatórias (-)</h4>
                            <div id="remuneracao_lista">
                                <span class="servidor_deducao1">IRRF (Imposto de Renta Retido na Fonte)</span>
                                <span class="servidor_deducao2">-<?php echo number_format($listar['IRRS'], 2, ',', '.');?></span>
                            </div>
                            <div id="remuneracao_lista">
                                <span class="servidor_deducao1">PSS / RPGS (Previdência Oficial)</span>
                                <span class="servidor_deducao2">-<?php echo number_format($listar['PSS'], 2, ',', '.');?></span>
                            </div>
                        </div>
                        <?php
                        $v1 = $listar['RemuneracaoBasica'];
                        $v2 = $listar['DecimoAnt'];
                        $v3 = $listar['Ferias'];
                        $v4 = $listar['Gratificacao'];

                        // Desconto
                        $v5 = $listar['IRRS'];
                        $v6 = $listar['PSS'];
                        $v7 = $listar['DecimoAntPrev'];

                        $valGanho = $v1+$v2+$v3+$v4;
                        $valDesconto = $v5+$v6+$v7;
                        $valTotal = $valGanho-$valDesconto;

                        ?>

                        <div id="servidor_remuneracao_total">
                            <h4 class="titulo1">Total da Remuneração após dedução <span class="servidor_remuneracao2"><?php echo number_format($valTotal, 2, ',', '.');?></span></h4>
                        </div>
                        <br clear="all>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>


        <div id="listagem">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal<?php echo $i; ?>">
        <span class="cpf"><?php echo $CPFs[0];?><?php echo $CPFs[1];?><?php echo $CPFs[2];?>.***.***-**</span>
        <span class="nome"><?php echo $listar['Nome'];?></span>
        <span class="orgao"><?php echo $listar['Secretaria'];?></span>
        </a>
    </div>
        <?php
        $i ++;
    }
//endwhile; ?>
<?php
if (isset($_GET['lotacao']) and ($_GET['lotacao'] != ''))
{
    ?>
    <ul class="pagination">
        <?php for ($i = 1; $i < $numPaginas + 1; $i++) { ?>
            <li><a href="<?php echo $UrlAmigavel ?>transparencia/?Pages=servidor&lotacao=<?php echo $_GET['lotacao']; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php }?>
    </ul>
    <?php
}elseif (isset($_GET['cargo']) and ($_GET['cargo'] != '')){
    ?>
    <ul class="pagination">
        <?php for ($i = 1; $i < $numPaginas + 1; $i++) { ?>
            <li><a href="<?php echo $UrlAmigavel ?>transparencia/?Pages=servidor&cargo=<?php echo $_GET['cargo']; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
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

            <li><a href="<?php echo $UrlAmigavel ?>transparencia/?Pages=servidor&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
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
            <li><a href="<?php echo $UrlAmigavel ?>transparencia/?Pages=servidor&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php
             } }
    //echo "";
      ?>
    </ul>
    <?php
}

?>