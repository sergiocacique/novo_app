<?php

include ("../../conexao.php");

$id = $_GET['id'];

$verifica = mysql_query("SELECT * FROM cpl WHERE id = '".$id."'") or die("erro ao selecionar");
$verDados = mysql_fetch_array($verifica);


$array_glossario = array(

    "id" => $verDados['id'],
    "DtEntrada" => date('d/m/Y', strtotime($verDados['DtEntrada'])),
    "Processo" => $verDados['Processo'],
    "Unidade" => $verDados['Unidade'],
    "Fonte" => $verDados['Fonte'],
    "Modalidade" => $verDados['Modalidade'],
    "Objeto" => $verDados['Objeto'],
    "DtDOM" => date('d/m/Y', strtotime($verDados['DtDOM'])),
    "Vencedor" => $verDados['Vencedor'],
    "Valor" => "R$ ".number_format($verDados['Valor'], 2, ',', '.')
);
$safe = array_map('htmlentities',$array_glossario);
echo json_encode($array_glossario);
?>


