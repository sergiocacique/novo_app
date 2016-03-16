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

    $ID = addslashes($_POST['id']);
    $Titulo = addslashes($_POST['titulo']);
    $CdCategoria = $_POST['departamento'];
    $Descricao = (isset($_POST['editor1']))? $_POST['editor1'] : '';
    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');

        $query = "UPDATE servicos SET";
        $query = $query . " Titulo = '" . $Titulo . "',";
        $query = $query . " CdDepartamento = '" . $CdCategoria . "',";
        $query = $query . " Descricao = '" . $Descricao . "',";
        $query = $query . " Acao = '" . $Acao . "',";
        $query = $query . " DtAtualizacao = '" . $DtAtualizacao . "')";
        $query = $query . " WHERE";
        $query = $query . " id = '" . $ID . "'";
        $verifica = mysql_query($query);


header('Location: o_municipio_servicos_cidadao.php'); exit;
?>
