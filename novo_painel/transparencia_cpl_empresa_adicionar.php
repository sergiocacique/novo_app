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
    $CdPrefeitura = $_SESSION['PrefeituraID'];
    $CdUsuario = $_SESSION['UsuarioID'];
    $Nome = $_POST['empresa'];
    $CPFCNPJ = $_POST['cnpjcpf'];
    $Situacao = $_POST['situacao'];
    $DtCadastro = date('Y-m-d H:i:s');



        $query = "INSERT INTO cpl_empresa";
        $query = $query . " ( CdCPL,";
        $query = $query . " CdPrefeitura,";
        $query = $query . " CdUsuario,";
        $query = $query . " Nome,";
        $query = $query . " CPFCNPJ,";
        $query = $query . " DtCadastro,";
        $query = $query . " Acao,";
        $query = $query . " Situacao)";

        $query = $query . " VALUES";

        $query = $query . " ( '" . $CdCPL . "',";
        $query = $query . " '" . $CdPrefeitura . "',";
        $query = $query . " '" . $CdUsuario . "',";
        $query = $query . " '" . $Nome . "',";
        $query = $query . " '" . $CPFCNPJ . "',";
        $query = $query . " '" . $DtCadastro . "',";
        $query = $query . " 'Publicado',";
        $query = $query . " '" . $Situacao . "')";

        $verifica = mysql_query($query);

        header("Location: transparencia_cpl_empresa.php?contrato=".$CdCPL.""); exit;

?>
