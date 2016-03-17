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

    $CdCPL = $_POST['CdCPL'];
    $Recurso = $_POST['recurso'];
    $CdPrefeitura = $_SESSION['PrefeituraID'];
    $CdUsuario = $_SESSION['UsuarioID'];
    $Descricao = $_POST['descricao'];

    $DtCadastro = date('Y-m-d H:i:s');



        $query = "INSERT INTO cpl_recursos";
        $query = $query . " ( CdPrefeitura,";
        $query = $query . " CdUsuario,";
        $query = $query . " CdCPL,";
        $query = $query . " CdRecurso,";
        $query = $query . " Descricao,";
        $query = $query . " Acao,";
        $query = $query . " DtCadastro)";

        $query = $query . " VALUES";

        $query = $query . " ( '" . $CdPrefeitura . "',";
        $query = $query . " '" . $CdUsuario . "',";
        $query = $query . " '" . $CdCPL . "',";
        $query = $query . " '" . $Recurso . "',";
        $query = $query . " '" . $Descricao . "',";
        $query = $query . " 'Publicado',";
        $query = $query . " '" . $DtCadastro . "')";

        $verifica = mysql_query($query);

        header("Location: transparencia_cpl_recursos.php?contrato=".$CdCPL.""); exit;

?>
