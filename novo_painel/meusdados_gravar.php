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

    $Nome = addslashes($_POST['nome']);
    $DtAntiga = addslashes($_POST['DtNascimento']);
    $DtNascimento = implode("-",array_reverse(explode("/",$DtAntiga)));
    $Email = addslashes($_POST['email']);
    $Senha = addslashes($_POST['senha']);

    $DtAtualizacao = date('Y-m-d H:i:s');


        $query = "UPDATE admin SET";
        $query = $query . " Nome = '" . $Nome . "',";
        $query = $query . " DtNascimento = '" . $DtNascimento . "',";
        $query = $query . " Email = '".$Email."',";
        if ($Senha != "") {
          $query = $query . " Senha = '".md5($Senha)."',";
        }
        $query = $query . " DtAtualizacao = '".$DtAtualizacao."'";

        $query = $query . " WHERE ";

        $query = $query . " CdUsuario = '".$_SESSION['UsuarioID']."'";
        $verifica = mysql_query($query);


header('Location: meusdados.php'); exit;

?>
