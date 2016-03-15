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

    $Execucao = (isset($_POST['execucao']))? $_POST['execucao'] : '';
    $Tipo = (isset($_POST['Tipo']))? $_POST['Tipo'] : '';
    $SIAFI = (isset($_POST['SIAFI']))? $_POST['SIAFI'] : '';
    $Orgao = (isset($_POST['orgao']))? $_POST['orgao'] : '';
    $Objeto = (isset($_POST['objeto']))? $_POST['objeto'] : '';

    $ValAprovado = moeda($_POST['val_aprovado']);
    $ValLiberado = moeda($_POST['val_liberado']);
    $ValContrapartida = moeda($_POST['val_contrapartida']);

    $AntInicioVigencia = (isset($_POST['inicio_vigencia']))? $_POST['inicio_vigencia'] : '';
    $InicioVigencia = implode("-",array_reverse(explode("/",$AntInicioVigencia)));

    $AntFimVigencia = (isset($_POST['fim_vigencia']))? $_POST['fim_vigencia'] : '';
    $FimVigencia = implode("-",array_reverse(explode("/",$AntFimVigencia)));

    $AntDataPublicacao = (isset($_POST['data_publicacao']))? $_POST['data_publicacao'] : '';
    $DataPublicacao = implode("-",array_reverse(explode("/",$AntDataPublicacao)));

    $AntProrrogacao = (isset($_POST['prorrogacao']))? $_POST['prorrogacao'] : '';
    $Prorrogacao = implode("-",array_reverse(explode("/",$AntProrrogacao)));

    $StatusConvenio = (isset($_POST['status_convenio']))? $_POST['status_convenio'] : '';
    $Observacao = (isset($_POST['observacao']))? $_POST['observacao'] : '';

    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');



    $query = "UPDATE convenios SET";
    $query = $query . " Tipo = '" . $Tipo . "',";
    $query = $query . " nunSIAFI = '" . $SIAFI . "',";
    $query = $query . " orgao = '" . $Orgao . "',";
    $query = $query . " objeto = '" . $Objeto . "',";
    $query = $query . " aprovado = '" . $ValAprovado . "',";
    $query = $query . " liberado = '" . $ValLiberado . "',";
    $query = $query . " InicioVigencia = '" . $InicioVigencia . "',";
    $query = $query . " FimVigencia = '" . $FimVigencia . "',";
    $query = $query . " Publicacao = '" . $DataPublicacao . "',";
    $query = $query . " Contrapartida = '" . $ValContrapartida . "',";
    $query = $query . " prorrogacao = '" . $Prorrogacao . "',";
    $query = $query . " execucao = '" . $Execucao . "',";
    $query = $query . " observacao = '" . $Observacao . "',";
    $query = $query . " mes = '" . $Mes . "',";
    $query = $query . " ano = '" . $Ano . "',";
    $query = $query . " Acao = '" . $Acao . "',";
    $query = $query . " estatus = '" . $StatusConvenio . "',";
    $query = $query . " DtAtualizado = '" . $DtAtualizacao . "'";
    $query = $query . " WHERE";
    $query = $query . " id = '".$id."'";

    $verifica = mysql_query($query);

        if($Acao == "Excluido"){
          header('Location: transparencia_convenios.php'); exit;
      }else{
        header("Location: transparencia_convenios_ver.php?mes=".$Mes."&ano=".$Ano.""); exit;
      }
?>
