<?php

include ("conexao.php");
include ("funcao.php");

$CdPrefeitura = $_GET['prefeitura'];
$_SESSION['PrefeituraID'] = $CdPrefeitura;
header('Location: index.php'); exit;
?>
