<?php

include ("../../conexao.php");

$id = $_GET['id'];

$verifica = mysql_query("SELECT * FROM convenios WHERE id = '".$id."'") or die("erro ao selecionar");
$verDados = mysql_fetch_array($verifica);


$array_glossario = array(

    "id" => $verDados['id'],
    "nunSIAFI" => $verDados['nunSIAFI'],
    "orgao" => $verDados['orgao'],
    "objeto" => $verDados['objeto'],
    "aprovado" => "R$ ".number_format($verDados['aprovado'], 2, ',', '.'),
    "liberado" => "R$ ".number_format($verDados['liberado'], 2, ',', '.'),
    "vigencia" => date('d/m/Y', strtotime($verDados['vigencia'])),
    "prorrogacao" => $verDados['prorrogacao'],
    "execucao" => $verDados['execucao']." %",
    "observacao" => $verDados['observacao'],
    "estatus" => $verDados['estatus']
);
$safe = array_map('htmlentities',$array_glossario);
echo json_encode($array_glossario);
?>


