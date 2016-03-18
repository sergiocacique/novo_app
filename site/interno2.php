<?php
include ("conexao.php");
include('funcoes.php');

$CdPagina = $_POST['CdItens'];

$sqlPagina = mysql_query("SELECT * FROM site_itens_pagina WHERE id = '".$CdPagina."'");
$rsPagina = mysql_fetch_array($sqlPagina);

?>
<div class="col-lg-12 visible-phone">
    <h2 class="page-header"></h2>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $rsPagina['Nome']?></h3>
    </div>
<?php
$sqlInterna = mysql_query("SELECT * FROM site_conteudo WHERE CdItens = '".$CdPagina."' AND Acao = 'Publicado'");
$Interna = mysql_num_rows($sqlInterna);

for ($y = 0; $y < $Interna; $y++){
$verInterna = mysql_fetch_array($sqlInterna);

    if ($y > 0){
        $classServ = "false";
    }else{
        $classServ = "true";
    }
?>
<div class="panel-body <?php echo $classServ == "true" ? 'bordered-bottom':'';?>">
    <h3><?php echo $verInterna['Titulo'];?></h3>
    <div style="text-align: justify"><?php echo $verInterna['texto'];?></div>
</div>
<?php
}
?>
</div>