<?php

include ("../../conexao.php");

$Email = trim(strtolower($_POST['tipMAIL']));

$verifica = mysql_query("SELECT * FROM sic_usuario WHERE Email = '".$Email."'");
$verDados = mysql_fetch_array($verifica);
$num = mysql_num_rows($verifica);

echo $num;

?>


