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
    $Mes = $_POST['mes'];
    $Ano = $_POST['ano'];

    $Titulo = addslashes($_POST['titulo']);
    $Categoria = (isset($_POST['categoria']))? $_POST['categoria'] : '';
    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');


        $query = "UPDATE despesas SET Titulo = '" . $Titulo . "', Mes = '" . $Mes . "', Ano = '" . $Ano . "', Acao = '" . $Acao . "', Categoria = '" . $Categoria . "', DtAtualizacao = '" . $DtAtualizacao . "' WHERE id = '".$id."'";
        $verifica = mysql_query($query);


header('Location: transparencia_despesas.php'); exit;

?>
