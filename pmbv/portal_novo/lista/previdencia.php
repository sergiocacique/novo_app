<?php

include ("../../conexao.php");

$id = $_GET['id'];

$verifica = mysql_query("SELECT * FROM previdencia WHERE id = '".$id."'") or die("erro ao selecionar");
$verDados = mysql_fetch_array($verifica);


$array_glossario = array(

    "id" => $verDados['id'],
    "Banco" => $verDados['Banco'],
    "Agencia" => $verDados['Agencia'],
    "Conta" => $verDados['Conta'],
    "Nome" => $verDados['Nome'],
    "Tipo" => $verDados['Tipo'],
    "SaldoAnterior" => "R$ ".number_format($verDados['SaldoAnterior'], 2, ',', '.'),
    "Aplicacoes" => "R$ ".number_format($verDados['Aplicacoes'], 2, ',', '.'),
    "Resgate" => "R$ ".number_format($verDados['Resgate'], 2, ',', '.'),
    "Rendimento" => "R$ ".number_format($verDados['Rendimento'], 2, ',', '.'),
    "Saldo" => "R$ ".number_format($verDados['Saldo'], 2, ',', '.')
);
$safe = array_map('htmlentities',$array_glossario);
echo json_encode($array_glossario);
?>


