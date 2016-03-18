<?php

include ("conexao.php");
include('funcoes.php');

$mesSel = $_POST['mes'];
$anoSel = $_POST['ano'];
$CdPrefeitura = $_POST['CdPrefeitura'];


$sqlPrefeitura = mysql_query("SELECT * FROM prefeitura WHERE CdPrefeitura = '".$CdPrefeitura."'");
$rsPrefeitura = mysql_fetch_array($sqlPrefeitura);

$sqlConfig = mysql_query("SELECT * FROM prefeitura_config WHERE CdPrefeitura = '".$CdPrefeitura."'");
$rsConfig = mysql_fetch_array($sqlConfig);
if (strlen($mesSel) < 2)
{
    $mesSel = "0".$mesSel;
}
?>
<h3><?php echo retorna_mes_extenso($mesSel); ?> <span class="classh3"> <?php echo $anoSel; ?></span></span></h3>

<?php
$sqlverDiario = mysql_query("SELECT * FROM diario_oficial WHERE DATE_FORMAT(DtCadastro, '%m') = ".$mesSel." AND DATE_FORMAT(DtCadastro, '%Y') = ".$anoSel." AND Acao = 'Publicado' ORDER BY DtCadastro DESC") or die(mysql_error());
$DiarioOficial = mysql_num_rows($sqlverDiario);
for ($y = 0; $y < $DiarioOficial; $y++){
    $verDiario = mysql_fetch_array($sqlverDiario);
    ?>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="panel-actions">
                    <li>
                        <a href="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura["Pasta"]?>/diario/<?php echo $verDiario["Texto"]?>" target="_blank">
                            <i class="fa fa-spin-2x fa-2x fa-file-pdf-o text-danger"></i>
                        </a>
                    </li>
                </ul>
                <p class="text-muted">Diário Oficial de <?php echo $rsConfig['Titulo'] ?> <br> nº <?php echo $verDiario["NumDiario"]?></p>
                <p>
                    <small>
                        <span class="text-muted"><?php echo date('d/m/Y', strtotime($verDiario["DtCadastro"])); ?></span>
                    </small>
                </p>
            </div>
        </div>
    </div>
<?php
}
?>
