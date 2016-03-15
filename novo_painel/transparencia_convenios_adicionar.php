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



    $query = "INSERT INTO convenios";
    $query = $query . " (CdPrefeitura,";
    $query = $query . " CdUsuario,";
    $query = $query . " Tipo,";
    $query = $query . " nunSIAFI,";
    $query = $query . " orgao,";
    $query = $query . " objeto,";
    $query = $query . " aprovado,";
    $query = $query . " liberado,";
    $query = $query . " InicioVigencia,";
    $query = $query . " FimVigencia,";
    $query = $query . " Publicacao,";
    $query = $query . " Contrapartida,";
    $query = $query . " prorrogacao,";
    $query = $query . " execucao,";
    $query = $query . " observacao,";
    $query = $query . " mes,";
    $query = $query . " ano,";
    $query = $query . " Acao,";
    $query = $query . " estatus,";
    $query = $query . " DtCadastro)";
    $query = $query . " VALUES";
    $query = $query . " ('".$_SESSION['PrefeituraID']."',";
    $query = $query . " '" . $_SESSION['UsuarioID'] . "',";
    $query = $query . " '" . $Tipo . "',";
    $query = $query . " '" . $SIAFI . "',";
    $query = $query . " '" . $Orgao . "',";
    $query = $query . " '" . $Objeto . "',";
    $query = $query . " '" . $ValAprovado . "',";
    $query = $query . " '" . $ValLiberado . "',";
    $query = $query . " '" . $InicioVigencia . "',";
    $query = $query . " '" . $FimVigencia . "',";
    $query = $query . " '" . $DataPublicacao . "',";
    $query = $query . " '" . $ValContrapartida . "',";
    $query = $query . " '" . $Prorrogacao . "',";
    $query = $query . " '" . $Execucao . "',";
    $query = $query . " '" . $Observacao . "',";
    $query = $query . " '" . $Mes . "',";
    $query = $query . " '" . $Ano . "',";
    $query = $query . " '" . $Acao . "',";
    $query = $query . " '" . $StatusConvenio . "',";
    $query = $query . " '" . $DtAtualizacao . "')";

    $verifica = mysql_query($query);

        if($Acao == "Excluido"){
          header('Location: transparencia_convenios.php'); exit;
      }else{
        header("Location: transparencia_convenios_ver.php?mes=".$Mes."&ano=".$Ano.""); exit;
      }
?>
