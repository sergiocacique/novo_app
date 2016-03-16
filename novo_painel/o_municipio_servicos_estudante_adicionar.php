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
    $CdCategoria = $_POST['departamento'];
    $Descricao = (isset($_POST['editor1']))? $_POST['editor1'] : '';
    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');

        $query = "INSERT INTO servicos";
        $query = $query . " (CdPrefeitura,";
        $query = $query . " CdUsuario,";
        $query = $query . " CdDepartamento,";
        $query = $query . " Tipo,";
        $query = $query . " Titulo,";
        $query = $query . " Descricao,";
        $query = $query . " Acao,";
        $query = $query . " DtCadastro)";
        $query = $query . " VALUES";
        $query = $query . " ('".$_SESSION['PrefeituraID']."',";
        $query = $query . " '" . $_SESSION['UsuarioID'] . "',";
        $query = $query . " 'estudante',";
        $query = $query . " '" . $Titulo . "',";
        $query = $query . " '" . $Descricao . "',";
        $query = $query . " '" . $Acao . "',";
        $query = $query . " '" . $DtAtualizacao . "'";
        $verifica = mysql_query($query);


header('Location: o_municipio_servicos_estudante.php'); exit;
?>
