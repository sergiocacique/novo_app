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



        $query = "UPDATE obras SET";
        $query = $query . " numero_processo = '" . $Processo . "',";
        $query = $query . " objeto = '" . $Objeto . "',";
        $query = $query . " convenio = '" . $Convenio . "',";
        $query = $query . " recurso_proprio = '" . $Recurso_Proprio . "',";
        $query = $query . " total = '" . $Valor_Total . "',";
        $query = $query . " fisico = '" . $Fisico . "',";
        $query = $query . " valor_realizado = '" . $Valor_Realizado . "',";
        $query = $query . " observacao = '" . $Observacao . "',";
        $query = $query . " estatus = '" . $Estatus . "',";
        $query = $query . " mes = '" . $Mes . "',";
        $query = $query . " ano = '" . $Ano . "',";
        $query = $query . " Acao = '" . $Acao . "',";
        $query = $query . " DtAtualizacao = '" . $DtAtualizacao . "'";
        $query = $query . " WHERE";
        $query = $query . " id = '".$id."'";

        $verifica = mysql_query($query);

        if($Acao == "Excluido"){
          header('Location: transparencia_obras.php'); exit;
      }else{
        header("Location: transparencia_obra_ver.php?mes=".$Mes."&ano=".$Ano.""); exit;
      }
?>
