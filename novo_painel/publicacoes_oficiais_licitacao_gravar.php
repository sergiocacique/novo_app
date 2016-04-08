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

    $Titulo = addslashes($_POST['titulo']);
    $CdSubCategoria = addslashes($_POST['Subcategoria']);
    $CdCategoria = addslashes($_POST['Categoria']);
    $Descricao = addslashes($_POST['Descricao']);
    $DtAntiga = $_POST['dtAbertura'];
    $DtAbertura = implode("-",array_reverse(explode("/",$DtAntiga)));

    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');


        $query = "UPDATE publicacoes_oficiais SET Titulo = '" . $Titulo . "', CdSubCategoria = '" . $CdSubCategoria . "', Descricao = '" . $Descricao . "', DtAbertura = '" . $DtAbertura . "', Acao = '" . $Acao . "', DtAtualizacao = '".$DtAtualizacao."' WHERE id = '".$id."'";
        $verifica = mysql_query($query);


header("Location: publicacoes_oficiais_ver.php?id=".$CdCategoria.""); exit;

?>
