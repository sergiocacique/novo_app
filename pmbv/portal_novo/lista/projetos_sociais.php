<?php

include ("../../conexao.php");

$id = $_GET['id'];

$verifica = mysql_query("SELECT * FROM projetos_sociais WHERE id = '".$id."'") or die("erro ao selecionar");
$verDados = mysql_fetch_array($verifica);


$array_glossario = array(

    "id" => $verDados['id'],
    "numero" => $verDados['numero'],
    "servico" => $verDados['servico'],
    "publico" => $verDados['publico'],
    "bolsista_qtd" => $verDados['bolsista_qtd'],
    "bolsista_valor" => number_format($verDados['bolsista_valor'], 2, ',', '.'),
    "outras_despesas" => number_format($verDados['outras_despesas'], 2, ',', '.'),
    "convenio" => number_format($verDados['convenio'], 2, ',', '.'),
    "FNAS" => number_format($verDados['FNAS'], 2, ',', '.'),
    "recurso_proprio" => number_format($verDados['recurso_proprio'], 2, ',', '.'),
    "total" => "R$ ".number_format($verDados['total'], 2, ',', '.'),
    "obs" => " ".$verDados['obs'],
    "mes" => $verDados['mes'],
    "ano" => $verDados['ano']
);
$safe = array_map('htmlentities',$array_glossario);
echo json_encode($array_glossario);
?>


