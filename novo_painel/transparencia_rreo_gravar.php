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


    $id = $_POST['id'];
    $Bimestre = $_POST['bimestre'];
    $Ano = $_POST['ano'];

    $Nome = addslashes($_POST['titulo']);
    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');

        $query = "UPDATE rreo SET";
        $query = $query . " Bimestre = '" . $Bimestre . "',";
        $query = $query . " Ano = '" . $Ano . "',";
        $query = $query . " Nome = '" . $Nome . "',";
        $query = $query . " Acao = '" . $Acao . "',";
        $query = $query . " DtAtualizado = '" . $DtAtualizacao . "'";
        $query = $query . " WHERE";
        $query = $query . " id = '".$id."'";
        $verifica = mysql_query($query);


header('Location: transparencia_rreo.php'); exit;

?>
