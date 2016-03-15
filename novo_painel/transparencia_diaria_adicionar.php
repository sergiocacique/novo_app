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
    $Destino = $_POST['Destino'];
    $Nome = $_POST['Nome'];
    $CdUsuario = $_SESSION['UsuarioID'];
    $CdPrefeitura = $_SESSION['PrefeituraID'];

    $Cargo = addslashes($_POST['Cargo']);
    $Secretaria = (isset($_POST['secretaria']))? $_POST['secretaria'] : '';
    $Periodo = (isset($_POST['Periodo']))? $_POST['Periodo'] : '';

    $Objetivo = (isset($_POST['objetivo']))? $_POST['objetivo'] : '';
    $Dias = (isset($_POST['dias']))? $_POST['dias'] : '';
    $Valor_Diaria = moeda($_POST['valor_diaria']);
    $Valor_Bruto = moeda($_POST['valor_bruto']);
    $INSS = moeda(_POST['inss']);
    $IRRF = moeda($_POST['irrf']);
    $Valor_Liquido = moeda($_POST['valor_liquido']);

    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');



        $query = "INSET INTO diarias";
        $query = $query . " ( CdUsuario,";
        $query = $query . " CdPrefeitura,";
        $query = $query . " nome,";
        $query = $query . " cargo,";
        $query = $query . " destino,";
        $query = $query . " objetivo,";
        $query = $query . " periodo,";
        $query = $query . " dias,";
        $query = $query . " valor_diaria,";
        $query = $query . " valor_bruto,";
        $query = $query . " inss,";
        $query = $query . " irff,";
        $query = $query . " valor_liquido,";
        $query = $query . " mes,";
        $query = $query . " ano,";
        $query = $query . " secretaria,";
        $query = $query . " Acao,";
        $query = $query . " DtCadastro)";
        $query = $query . " VALUES";
        $query = $query . " ( '" . $Nome . "',";
        $query = $query . " '" . $Nome . "',";
        $query = $query . " '" . $Nome . "',";
        $query = $query . " '" . $Cargo . "',";
        $query = $query . " '" . $Destino . "',";
        $query = $query . " '" . $Objetivo . "',";
        $query = $query . " '" . $Periodo . "',";
        $query = $query . " '" . $Dias . "',";
        $query = $query . " '" . $Valor_Diaria . "',";
        $query = $query . " '" . $Valor_Bruto . "',";
        $query = $query . " '" . $INSS . "',";
        $query = $query . " '" . $IRRF . "',";
        $query = $query . " '" . $Valor_Liquido . "',";
        $query = $query . " '" . $Mes . "',";
        $query = $query . " '" . $Ano . "',";
        $query = $query . " '" . $Ano . "',";
        $query = $query . " '" . $Acao . "',";
        $query = $query . " '" . $DtAtualizacao . "')";

        $verifica = mysql_query($query);

        if($Acao == "Excluido"){
          header('Location: transparencia_diarias.php'); exit;
      }else{
        header("Location: transparencia_diarias_ver.php?mes=".$Mes."&ano=".$Ano.""); exit;
      }
?>
