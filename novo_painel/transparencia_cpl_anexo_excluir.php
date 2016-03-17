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

    $id = $_GET['id'];
    $CdCPL = $_GET['CdCPL'];
    $DtAtualizacao = date('Y-m-d H:i:s');



        $query = "UPDATE cpl_anexo SET";

        $query = $query . " DtAtualizacao = '" . $DtAtualizacao . "',";
        $query = $query . " Acao = 'Excluido'";

        $query = $query . " WHERE";

        $query = $query . " id = '" . $id . "'";

        $verifica = mysql_query($query);

        header("Location: transparencia_cpl_anexo.php?contrato=".$CdCPL.""); exit;
?>
