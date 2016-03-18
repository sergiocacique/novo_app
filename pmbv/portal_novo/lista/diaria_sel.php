<?php

include ("../../conexao.php");

$id = $_GET['id'];

$verifica = mysql_query("SELECT * FROM diarias WHERE id = '".$id."'") or die("erro ao selecionar");
$verDados = mysql_fetch_array($verifica);


$array_glossario = array(

    "id" => $verDados['id'],
    "nome" => $verDados['nome'],
    "cargo" => $verDados['cargo'],
    "destino" => $verDados['destino'],
    "objetivo" => $verDados['objetivo'],
    "periodo" => $verDados['periodo'],
    "dias" => $verDados['dias'],
    "valor_diaria" => "R$ ".number_format($verDados['valor_diaria'], 2, ',', '.'),
    "valor_bruto" => "R$ ".number_format($verDados['valor_bruto'], 2, ',', '.'),
    "inss" => "R$ ".number_format($verDados['inss'], 2, ',', '.'),
    "irff" => "R$ ".number_format($verDados['irff'], 2, ',', '.'),
    "valor_liquido" => "R$ ".number_format($verDados['valor_liquido'], 2, ',', '.'),
    "secretaria" => $verDados['secretaria']
);
$safe = array_map('htmlentities',$array_glossario);
echo json_encode($array_glossario);
?>


