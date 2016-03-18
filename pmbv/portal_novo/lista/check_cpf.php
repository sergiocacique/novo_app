<?php

include ("../../conexao.php");

$Email = trim(strtolower($_POST['tipCPF']));

$verifica = mysql_query("SELECT * FROM sic_usuario WHERE CPF = '".$Email."'");
$verDados = mysql_fetch_array($verifica);
$num = mysql_num_rows($verifica);

echo $num;

?>


