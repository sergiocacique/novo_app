<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 29/08/14
 * Hora: 10:20
 * Página: Servidor
 *
 */

if (isset($_GET['txtNome']) and ($_GET['txtNome'] != ''))
{
    $bnome = $_GET['txtNome'];
    $bnome = mysql_real_escape_string($bnome);
}



$sql = "SELECT * FROM entidade_impedidas WHERE (Disponivel = 'sim') AND (Aprovado = 'sim')";

if (isset ($bNome) and $bNome  != ''){
    $bNome = str_replace(" ","%", $bNome);
    $sql =$sql . " AND (nome LIKE '%".$bNome."%') OR (CNPJ LIKE '%".$bNome."%')";
}

$sql = $sql . " ORDER BY nome ASC";

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
        <div id="breadcrumb_primeiro"><span>Consultas</span></div>
        <div id="breadcrumb_ultima"><span>Entidades Impedidas</span></div>
    </div>

    <div class="texto">
        <p>
            O Cadastro de Entidades Privadas Sem Fins Lucrativos Impedidas – CEPIM é um banco de informações mantido
            pela Controladoria-Geral da União, a partir de dados fornecidos pelos órgãos e entidades da administração
            pública federal, que tem por objetivo consolidar e divulgar relação das entidades privadas sem fins
            lucrativos que estão impedidas de celebrar convênios, contratos de repasse ou termos de parceria com
            a administração pública federal, nos termos do Decreto n.º 7.592, de 28 de outubro de 2011
        </p>
    </div>
    <div id="box_pesquisa">
        <form method="post" action="<?php echo $UrlAmigavel ?>transparencia/?Pages=servidor" role="form">
            <h4 class="pesquisa_titulo">Cadastro de Entidades Privadas Sem Fins Lucrativos Impedidas</h4>
            <div id="box_nome">
                <div class="form-group">
                    <label for="Nome">Nome ou CNPJ</label>
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

        $CNPJ = $listar['CNPJ'];
        $CNPJs = $CNPJ;
        //$CPFs = explode(".", $CPF);
    ?>



            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading<?php echo $i; ?>">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                            <span class="cpf">
                            <?php echo $CNPJs[0];?><?php echo $CNPJs[1];?>.<?php echo $CNPJs[2];?><?php echo $CNPJs[3];?><?php echo $CNPJs[4];?>.<?php echo $CNPJs[5];?><?php echo $CNPJs[6];?><?php echo $CNPJs[7];?>/<?php echo $CNPJs[8];?><?php echo $CNPJs[9];?><?php echo $CNPJs[10];?><?php echo $CNPJs[11];?>-<?php echo $CNPJs[12];?><?php echo $CNPJs[13];?>
                                &nbsp&nbsp&nbsp
                            <?php echo $listar['nome'];?></span>
                        </a>
                    </h4>
                </div>
                <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                    <div class="cepim">


                        <div id="servidor_remuneracao_eventual">
                            <div id="remuneracao_lista">
                                <span class="servidor_remuneracao_eventual12">Numero</span>
                                <span class="servidor_remuneracao_eventual22"><?php echo $listar['numero'];?></span>
                            </div>
                            <div id="remuneracao_lista">
                                <span class="servidor_remuneracao_eventual12">Orgao Concedente</span>
                                <span class="servidor_remuneracao_eventual22"><?php echo $listar['orgaoConcedente'];?></span>
                            </div>
                            <div id="remuneracao_lista">
                                <span class="servidor_remuneracao_eventual12">Motivo</span>
                                <span class="servidor_remuneracao_eventual22"><?php echo $listar['motivo'];?></span>
                            </div>
                            <div id="remuneracao_lista">
                                <span class="servidor_remuneracao_eventual12">Situacao</span>
                                <span class="servidor_remuneracao_eventual22"><?php echo $listar['situacao'];?></span>
                            </div>
                            <div id="remuneracao_lista">
                                <span class="servidor_remuneracao_eventual12">Objetivo Convenio</span>
                                <span class="servidor_remuneracao_eventual22"><?php echo $listar['objetivoConvenio'];?></span>
                            </div>
                            <div id="remuneracao_lista">
                                <span class="servidor_remuneracao_eventual12">Valor</span>
                                <span class="servidor_remuneracao_eventual22"><?php echo number_format($listar['valor'], 2, ',', '.');?></span>
                            </div>
                            <div id="remuneracao_lista">
                                <span class="servidor_remuneracao_eventual12">Valor Liberado</span>
                                <span class="servidor_remuneracao_eventual22"><?php echo number_format($listar['valorLiberado'], 2, ',', '.');?></span>
                            </div>
                            <div id="remuneracao_lista">
                                <span class="servidor_remuneracao_eventual12">Data Publicado</span>
                                <span class="servidor_remuneracao_eventual22"><?php echo date('d/m/Y', strtotime($listar['dataPublicadao']));?></span>
                            </div>
                            <div id="remuneracao_lista">
                                <span class="servidor_remuneracao_eventual12">Inicio</span>
                                <span class="servidor_remuneracao_eventual22"><?php echo date('d/m/Y', strtotime($listar['dataInicio']));?></span>
                            </div>
                            <div id="remuneracao_lista">
                                <span class="servidor_remuneracao_eventual12">Final</span>
                                <span class="servidor_remuneracao_eventual22"><?php echo date('d/m/Y', strtotime($listar['dataFim']));?></span>
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