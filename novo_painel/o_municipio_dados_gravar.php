<?php

include ("conexao.php");
include ("funcao.php");

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();


// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: login.php"); exit;
}

$sqlAdmin = mysql_query("SELECT * FROM vw_prefeitura WHERE CdPrefeitura = ".$_SESSION['PrefeituraID']." ");
$verAdmin = mysql_fetch_array($sqlAdmin);

    $Materia = addslashes($_POST['editor1']);

        $query = "UPDATE prefeitura SET Dados = '" . $Materia . "' WHERE CdPrefeitura = '".$_SESSION['PrefeituraID']."'";
        $verifica = mysql_query($query);


header('Location: o_municipio_dados.php'); exit;

?>
