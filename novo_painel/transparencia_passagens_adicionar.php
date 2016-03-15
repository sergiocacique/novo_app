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

    $Mes = $_POST['mes'];
    $Ano = $_POST['ano'];
    $DtAntiga = $_POST['DtIda'];
    $DtIda = implode("-",array_reverse(explode("/",$DtAntiga)));

    $DtAntiga1 = $_POST['DtVolta'];
    $DtVolta = implode("-",array_reverse(explode("/",$DtAntiga1)));

    $Nome = addslashes($_POST['Nome']);
    $Destino = (isset($_POST['Destino']))? $_POST['Destino'] : '';
    $Valor = moeda($_POST['Valor']);
    $Objetivo = addslashes($_POST['objetivo']);
    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');



        $query = "INSERT INTO passagens (CdPrefeitura,CdUsuario,Nome,DtIda,DtVolta,Destino,Objetivo,valor,mes,ano,Acao,DtCadastro) VALUES ('".$_SESSION['PrefeituraID']."','" . $_SESSION['UsuarioID'] . "','" . $Nome . "','" . $DtIda . "','" . $DtVolta . "','" . $Destino . "','" . $Objetivo . "','" . $Valor . "','" . $Mes . "','" . $Ano . "','" . $Acao . "','" . $DtAtualizacao . "')";
        $verifica = mysql_query($query);


header('Location: transparencia_passagens.php'); exit;
?>
