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
    $Processo = addslashes($_POST['numero_processo']);
    $Objeto = addslashes($_POST['objeto']);

    $Observacao = addslashes($_POST['observacao']);
    $Estatus = (isset($_POST['estatus']))? $_POST['estatus'] : '';
    $Convenio = moeda($_POST['convenio']);

    $Recurso_Proprio = moeda($_POST['recurso_proprio']);
    $Fisico = moeda($_POST['fisico']);
    $Valor_Realizado = moeda($_POST['valor_realizado']);
    $Valor_Total = moeda($_POST['total']);

    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');



        $query = "INSERT INTO obras";
        $query = $query . " (CdPrefeitura,";
        $query = $query . " CdUsuario,";
        $query = $query . " numero_processo,";
        $query = $query . " objeto,";
        $query = $query . " convenio,";
        $query = $query . " recurso_proprio,";
        $query = $query . " total,";
        $query = $query . " fisico,";
        $query = $query . " valor_realizado,";
        $query = $query . " observacao,";
        $query = $query . " estatus,";
        $query = $query . " mes,";
        $query = $query . " ano,";
        $query = $query . " Acao,";
        $query = $query . " DtCadastro)";
        $query = $query . " VALUES";
        $query = $query . " ('" . $_SESSION['PrefeituraID'] . "',";
        $query = $query . " '" . $_SESSION['UsuarioID'] . "',";
        $query = $query . " '" . $Processo . "',";
        $query = $query . " '" . $Objeto . "',";
        $query = $query . " '" . $Convenio . "',";
        $query = $query . " '" . $Recurso_Proprio . "',";
        $query = $query . " '" . $Valor_Total . "',";
        $query = $query . " '" . $Fisico . "',";
        $query = $query . " '" . $Valor_Realizado . "',";
        $query = $query . " '" . $Observacao . "',";
        $query = $query . " '" . $Estatus . "',";
        $query = $query . " '" . $Mes . "',";
        $query = $query . " '" . $Ano . "',";
        $query = $query . " '" . $Acao . "',";
        $query = $query . " '" . $DtAtualizacao . "')";

        $verifica = mysql_query($query);

        if($Acao == "Excluido"){
          header('Location: transparencia_obras.php'); exit;
      }else{
        header("Location: transparencia_obra_ver.php?mes=".$Mes."&ano=".$Ano.""); exit;
      }
?>
