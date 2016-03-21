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

    $IDAnalytics = addslashes($_POST['IDAnalytics']);
    $facebook = addslashes($_POST['facebook']);
    $youtube = addslashes($_POST['youtube']);
    $Instagram = addslashes($_POST['Instagram']);
    $Twitter = addslashes($_POST['Twitter']);


        $query = "UPDATE prefeitura_config SET";
        $query = $query . " IDAnalytics = '" . $IDAnalytics . "',";
        $query = $query . " facebook = '" . $facebook . "',";
        $query = $query . " youtube = '" . $youtube . "',";
        $query = $query . " Instagram = '" . $Instagram . "',";
        $query = $query . " Twitter = '" . $Twitter . "'";

        $query = $query . " WHERE CdPrefeitura = '".$_SESSION['PrefeituraID']."'";
        $verifica = mysql_query($query);



header('Location: configuracoes_info_sociais.php'); exit;

?>
