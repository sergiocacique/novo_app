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
    $Url = addslashes($_POST['url']);
    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');


        $query = "UPDATE link_uteis SET NomeLink = '" . $Titulo . "', Link = '" . $Url . "', Acao = '" . $Acao . "', DtAtualizacao = '".$DtAtualizacao."' WHERE id = '".$id."'";
        $verifica = mysql_query($query);


header('Location: informativos_links_uteis.php'); exit;

?>
