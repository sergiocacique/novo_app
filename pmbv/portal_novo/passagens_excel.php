<?php
include ("../conexao.php");
include('funcoes.php');


$sql = "SELECT * FROM passagens WHERE (Acao = 'Publicado') AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")";
$query = mysql_query($sql);
    $passagens = mysql_fetch_assoc($query);
    $totalPassagens = mysql_num_rows($query);



// INICIAMOS A CRIAÇÃO DA TABELA
$html = '';
$html .= '<table border="1">';
$html .= '<tr>';

$html .= '<td align="center"><b>CÓDIGO</b></td>';
$html .= '<td align="center"><b>NOME</b></td>';
$html .= '<td align="center"><b>EMAIL</b></td>';

$html .= '</tr>';

// INICIAMOS O NOSSO LOOP
do {

// DADOS DO USUÁRIO
    $codigo =  $users["ID"];
    $nome =  $users["NOME"];
    $email =  $users["EMAIL"];

// INFORMAMOS CADA LINHA DE REGISTRO ENCONTRADO
    $html .= '<tr>';

    $html .= '<td align="center">'.$codigo.'</td>';
    $html .= '<td align="center">'.$nome.'</td>';
    $html .= '<td align="center">'.$email.'</td>';

    $html .= '</tr>';

} while ($pedidos = mysql_fetch_array($result));


// Definimos o nome do arquivo que será exportado
$arquivo = 'pedidos.xls';

// Criamos uma tabela HTML com o formato da planilha

$html .= '</table>';

// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );

// Envia o conteúdo do arquivo
echo $html;
exit;
?>