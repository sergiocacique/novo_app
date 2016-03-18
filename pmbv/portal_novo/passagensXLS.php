<?php

include ("../conexao.php");
include('funcoes.php');

$SelAno = $_GET['ano'];
$SelMes = $_GET['mes'];
$extensao = $_GET['extensao'];
$Atual = date('d/m/Y H:i:s a', strtotime(date('Y-m-d H:i:s a')));

$sql = "SELECT * FROM passagens WHERE Acao = 'Publicado' AND  DATE_FORMAT(DtViagem, '%Y') = ".$SelAno." AND  DATE_FORMAT(DtViagem, '%m') = ".$SelMes." ";

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

    $html .= '<td align="center"><b>Nome</b></td>';
    $html .= '<td align="center"><b>Destino</b></td>';
    $html .= '<td align="center"><b>Objetivo</b></td>';
    $html .= '<td align="center"><b>Valor (R$)</b></td>';
    $html .= '<td align="center"><b>Data da Viagem</b></td>';
    $html .= '<td align="center"><b>Data da Volta</b></td>';
    $html .= '<td align="center"><b>Secretaria</b></td>';


    $html .= '</tr>';

for ($y = 0; $y < $Glossario; $y++){
    $verGlossario = mysql_fetch_array($sqlGlossario);


    $SIAFI =  $verGlossario["Nome"];
    $orgao =  $verGlossario["Destino"];
    $objeto =  $verGlossario["Objetivo"];
    $aprovado =  $verGlossario["valor"];
    $liberado =  $verGlossario["DtViagem"];
    $InicioVigencia =  $verGlossario["DtVolta"];

    $sqlLinha2 = mysql_query("SELECT * FROM estrutura WHERE CdEstrutura = '".$verGlossario['CdSecretaria']."'");
    $rsLinha2 = mysql_fetch_array($sqlLinha2);

    $unidade =  $rsLinha2["Nome"];

    // INFORMAMOS CADA LINHA DE REGISTRO ENCONTRADO
    $html .= '<tr>';

    $html .= '<td align="center">'.$SIAFI.'</td>';
    $html .= '<td align="center">'.$orgao.'</td>';
    $html .= '<td align="center">'.$objeto.'</td>';
    $html .= '<td align="center">'.number_format($aprovado , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.date('d/m/Y', strtotime($liberado)).'</td>';
    $html .= '<td align="center">'.date('d/m/Y', strtotime($InicioVigencia)).'</td>';
    $html .= '<td align="center">'.$unidade.'</td>';


    $html .= '</tr>';

}

// Definimos o nome do arquivo que será exportado
    $arquivo = 'passagens.'.$extensao;

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