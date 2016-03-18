<?php

include ("conexao.php");
include('funcoes.php');

$CdItens = $_POST['CdItens'];

$sqlPagina = mysql_query("SELECT * FROM site_editais_categoria WHERE id = '".$CdItens."'");
$rsPagina = mysql_fetch_array($sqlPagina);
?>
<h3><?php echo $rsPagina['Nome']; ?></h3>

<?php
$sqlverDiario = mysql_query("SELECT * FROM site_editais WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' AND CdCategoria = ".$rsPagina['id']." ORDER BY DtCadastro DESC") or die(mysql_error());
$DiarioOficial = mysql_num_rows($sqlverDiario);
for ($y = 0; $y < $DiarioOficial; $y++){
    $verDiario = mysql_fetch_array($sqlverDiario);
    ?>
    <div class="col-xs-12 col-sm-5 col-md-5">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="panel-actions">
                    <li>
                        <a href="<?php echo $UrlAmigavel ?>arquivosDinamicos/editais/<?php echo $verDiario["Arquivo"]?>" target="_blank">
                            <i class="fa fa-spin-2x fa-2x fa-file-pdf-o text-danger"></i>
                        </a>
                    </li>
                </ul>
                <p class="text-muted"><?php echo $verDiario["Titulo"]?></p>

            </div>
        </div>
    </div>
<?php
}
?>