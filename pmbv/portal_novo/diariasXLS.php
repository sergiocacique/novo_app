<?php

include ("../conexao.php");
include('funcoes.php');

$SelAno = $_GET['ano'];
$SelMes = $_GET['mes'];
$extensao = $_GET['extensao'];
$Atual = date('d/m/Y H:i:s a', strtotime(date('Y-m-d H:i:s a')));

$sql = "SELECT * FROM diarias WHERE Acao = 'Publicado' AND  ano = ".$SelAno." AND  mes = ".$SelMes." ";

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
    $html .= '<td colspan="11" align="center"><b>BOA VISTA - RR</b><br>PREFEITURA MUNICIPAL DE BOA VISTA<br><br>Periodo:'. retorna_mes_extenso($SelMes).'/'. $SelAno.'</td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td colspan="11">Gerado em :'. $Atual.' </td>';
    $html .= '</tr>';

    $html .= '<tr>';

    $html .= '<td align="center"><b>Nome</b></td>';
    $html .= '<td align="center"><b>Cargo</b></td>';
    $html .= '<td align="center"><b>Destino</b></td>';
    $html .= '<td align="center"><b>Objetivo</b></td>';
    $html .= '<td align="center"><b>Periodo</b></td>';
    $html .= '<td align="center"><b>Dias</b></td>';
    $html .= '<td align="center"><b>Valor diária (R$)</b></td>';
    $html .= '<td align="center"><b>Valor Bruto (R$)</b></td>';
    $html .= '<td align="center"><b>INSS (R$)</b></td>';
    $html .= '<td align="center"><b>IRRF (R$)</b></td>';
    $html .= '<td align="center"><b>Valor Liquido (R$)</b></td>';
    $html .= '<td align="center"><b>Secretaria</b></td>';

    $html .= '</tr>';

for ($y = 0; $y < $Glossario; $y++){
    $verGlossario = mysql_fetch_array($sqlGlossario);


    $Nome =  $verGlossario["Nome"];
    $Cargo =  $verGlossario["Destino"];
    $Destino =  $verGlossario["Objetivo"];
    $Objetivo =  $verGlossario["valor"];
    $Periodo =  $verGlossario["DtViagem"];
    $Dias =  $verGlossario["DtVolta"];
    $ValDiaria =  $verGlossario["DtVolta"];
    $ValBruto =  $verGlossario["DtVolta"];
    $INSS =  $verGlossario["DtVolta"];
    $IRRF =  $verGlossario["DtVolta"];
    $ValLiquido =  $verGlossario["DtVolta"];
    $Secretaria =  $verGlossario["DtVolta"];


    // INFORMAMOS CADA LINHA DE REGISTRO ENCONTRADO
    $html .= '<tr>';

    $html .= '<td align="center">'.$Nome.'</td>';
    $html .= '<td align="center">'.$Cargo.'</td>';
    $html .= '<td align="center">'.$Destino.'</td>';
    $html .= '<td align="center">'.$Objetivo.'</td>';
    $html .= '<td align="center">'.$Periodo.'</td>';
    $html .= '<td align="center">'.$Dias.'</td>';
    $html .= '<td align="center">'.number_format($ValDiaria , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.number_format($ValBruto , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.number_format($INSS , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.number_format($IRRF , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.number_format($ValLiquido , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.$Secretaria.'</td>';


    $html .= '</tr>';

}

// Definimos o nome do arquivo que será exportado
    $arquivo = 'diarias.'.$extensao;

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