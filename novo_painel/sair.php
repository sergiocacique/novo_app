<?php

include ("conexao.php");
include ("funcao.php");

session_destroy();

//Redireciona para a página de autenticação
header('Location: index.php'); exit;

?>
