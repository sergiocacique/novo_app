<?php

include ("../conexao.php");
include('funcoes.php');

$SelAno = $_GET['ano'];
$SelMes = $_GET['mes'];
$extensao = $_GET['extensao'];
$Atual = date('d/m/Y H:i:s a', strtotime(date('Y-m-d H:i:s a')));

$sql = "SELECT * FROM convenios WHERE (Acao = 'Publicado') AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")";

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

    $html .= '<td align="center"><b>SIAFI</b></td>';
    $html .= '<td align="center"><b>Orgão</b></td>';
    $html .= '<td align="center"><b>Objeto</b></td>';
    $html .= '<td align="center"><b>Valor Aprovado (R$)</b></td>';
    $html .= '<td align="center"><b>Valor Liberado (R$)</b></td>';
    $html .= '<td align="center"><b>Inicio da Vigencia</b></td>';
    $html .= '<td align="center"><b>Fim da Vigencia</b></td>';
    $html .= '<td align="center"><b>Publicação</b></td>';
    $html .= '<td align="center"><b>Data da última liberação</b></td>';
    $html .= '<td align="center"><b>Último valor liberado</b></td>';
    $html .= '<td align="center"><b>Contrapartida</b></td>';
    $html .= '<td align="center"><b>Observação</b></td>';
    $html .= '<td align="center"><b>Status</b></td>';

    $html .= '</tr>';

for ($y = 0; $y < $Glossario; $y++){
    $verGlossario = mysql_fetch_array($sqlGlossario);

    $valor = $verGlossario['total'];
    $total = $total + $valor;

    $SIAFI =  $verGlossario["nunSIAFI"];
    $orgao =  $verGlossario["orgao"];
    $objeto =  $verGlossario["objeto"];
    $aprovado =  $verGlossario["aprovado"];
    $liberado =  $verGlossario["liberado"];
    $InicioVigencia =  $verGlossario["InicioVigencia"];
    $FimVigencia =  $verGlossario["FimVigencia"];
    $Publicacao =  $verGlossario["Publicacao"];
    $DtUltLiberacao =  $verGlossario["DtUltLiberacao"];
    $VlUltLiberacao =  $verGlossario["VlUltLiberacao"];
    $Contrapartida =  $verGlossario["Contrapartida"];
    $observacao =  $verGlossario["observacao"];
    $estatus =  $verGlossario["estatus"];
    // INFORMAMOS CADA LINHA DE REGISTRO ENCONTRADO
    $html .= '<tr>';

    $html .= '<td align="center">'.$SIAFI.'</td>';
    $html .= '<td align="center">'.$orgao.'</td>';
    $html .= '<td align="center">'.$objeto.'</td>';
    $html .= '<td align="center">'.number_format($aprovado , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.number_format($liberado , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.date('d/m/Y', strtotime($InicioVigencia)).'</td>';
    $html .= '<td align="center">'.number_format($FimVigencia , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.date('d/m/Y', strtotime($Publicacao)).'</td>';
    $html .= '<td align="center">'.date('d/m/Y', strtotime($DtUltLiberacao)).'</td>';
    $html .= '<td align="center">'.number_format($VlUltLiberacao , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.number_format($Contrapartida , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.$observacao.'</td>';
    $html .= '<td align="center">'.$estatus.'</td>';

    $html .= '</tr>';

}

// Definimos o nome do arquivo que será exportado
    $arquivo = 'convenios.'.$extensao;

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