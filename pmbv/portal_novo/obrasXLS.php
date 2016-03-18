<?php

include ("../conexao.php");
include('funcoes.php');

$SelAno = $_GET['ano'];
$SelMes = $_GET['mes'];
$extensao = $_GET['extensao'];
$Atual = date('d/m/Y H:i:s a', strtotime(date('Y-m-d H:i:s a')));

$sql = "SELECT * FROM obras WHERE (Acao = 'Publicado') AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")";

$sqlGlossario = mysql_query($sql);
$Glossario = mysql_num_rows($sqlGlossario);

$total = 0;

//
//$sql = "SELECT * FROM obras WHERE (Acao = 'Publicado') AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")";
//$query = mysql_query($sql);
//$users = mysql_fetch_assoc($query);
//$rows_users = mysql_num_rows($query);


// INICIAMOS A CRIAÇÃO DA TABELA
    $html = '';
    $html .= '<table border="1">';

    $html .= '<tr>';
    $html .= '<td colspan="11" align="center"><b>BOA VISTA - RR</b><br>PREFEITURA MUNICIPAL DE BOA VISTA<br><br>Período:'. retorna_mes_extenso($SelMes).'/'. $SelAno.'</td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td colspan="11">Gerado em :'. $Atual.' </td>';
    $html .= '</tr>';

    $html .= '<tr>';

    $html .= '<td align="center"><b>Número do processo</b></td>';
    $html .= '<td align="center"><b>Objeto</b></td>';
    $html .= '<td align="center"><b>Convênio (R$)</b></td>';
    $html .= '<td align="center"><b>Recurso Próprio (R$)</b></td>';
    $html .= '<td align="center"><b>Total (R$)</b></td>';
    $html .= '<td align="center"><b>Andamento (%)</b></td>';
    $html .= '<td align="center"><b>Valor Gasto (R$)</b></td>';
    $html .= '<td align="center"><b>Status</b></td>';
    $html .= '<td align="center"><b>Mês</b></td>';
    $html .= '<td align="center"><b>Ano</b></td>';
    $html .= '<td align="center"><b>Observacao</b></td>';

    $html .= '</tr>';

for ($y = 0; $y < $Glossario; $y++){
    $verGlossario = mysql_fetch_array($sqlGlossario);

    $valor = $verGlossario['total'];
    $total = $total + $valor;

    $numero_processo =  $verGlossario["numero_processo"];
    $objeto =  $verGlossario["objeto"];
    $convenio =  $verGlossario["convenio"];
    $recurso_proprio =  $verGlossario["recurso_proprio"];
    $total =  $verGlossario["total"];
    $fisico =  $verGlossario["fisico"];
    $valor_realizado =  $verGlossario["valor_realizado"];
    $estatus =  $verGlossario["estatus"];
    $mes =  $verGlossario["mes"];
    $ano =  $verGlossario["ano"];
    $observacao =  $verGlossario["observacao"];
    // INFORMAMOS CADA LINHA DE REGISTRO ENCONTRADO
    $html .= '<tr>';

    $html .= '<td align="center">'.$numero_processo.'</td>';
    $html .= '<td align="center">'.$objeto.'</td>';
    $html .= '<td align="center">'.number_format($convenio , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.number_format($recurso_proprio , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.number_format($total , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.$fisico.'</td>';
    $html .= '<td align="center">'.number_format($valor_realizado , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.$estatus.'</td>';
    $html .= '<td align="center">'.retorna_mes_extenso($mes).'</td>';
    $html .= '<td align="center">'.$ano.'</td>';
    $html .= '<td align="center">'.$observacao.'</td>';

    $html .= '</tr>';

}

// Definimos o nome do arquivo que será exportado
    $arquivo = 'obras.'.$extensao;

    // Criamos uma tabela HTML com o formato da planilha

    $html .= '</table>';

    // Configurações header para forçar o download
    header('Content-Description: File Transfer');
    header ("Expires: Mon, 26 Jul 2020 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-type:   application/x-msexcel; charset=utf-8");
    header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
    header ("Content-Description: PHP Generated Data" );
    header ('Content-type: application/force-download');

    // Envia o conteúdo do arquivo
    echo ($html);
    exit;
?>