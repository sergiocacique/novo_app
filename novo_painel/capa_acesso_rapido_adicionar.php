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

    $Titulo = addslashes($_POST['titulo']);
    $Link = addslashes($_POST['link']);
    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');



        $query = "INSERT INTO site_acesso_rapido (CdPrefeitura,CdUsuario,Nome,Link,Acao,DtCadastro) VALUES ('".$_SESSION['PrefeituraID']."','" . $_SESSION['UsuarioID'] . "','" . $Titulo . "','".$Link."','" . $Acao . "','" . $DtAtualizacao . "')";
        $verifica = mysql_query($query);


header('Location: capa_acesso_rapido.php'); exit;
?>
