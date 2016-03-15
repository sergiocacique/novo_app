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



        $query = "UPDATE diarias SET";
        $query = $query . " nome = '" . $Nome . "',";
        $query = $query . " cargo = '" . $Cargo . "',";
        $query = $query . " destino = '" . $Destino . "',";
        $query = $query . " objetivo = '" . $Objetivo . "',";
        $query = $query . " periodo = '" . $Periodo . "',";
        $query = $query . " dias = '" . $Dias . "',";
        $query = $query . " valor_diaria = '" . $Valor_Diaria . "',";
        $query = $query . " valor_bruto = '" . $Valor_Bruto . "',";
        $query = $query . " inss = '" . $INSS . "',";
        $query = $query . " irff = '" . $IRRF . "',";
        $query = $query . " valor_liquido = '" . $Valor_Liquido . "',";
        $query = $query . " mes = '" . $Mes . "',";
        $query = $query . " ano = '" . $Ano . "',";
        $query = $query . " secretaria = '" . $Ano . "',";
        $query = $query . " Acao = '" . $Acao . "',";
        $query = $query . " DtAtualizacao = '" . $DtAtualizacao . "'";
        $query = $query . " WHERE";
        $query = $query . " id = '".$id."'";

        $verifica = mysql_query($query);

        if($Acao == "Excluido"){
          header('Location: transparencia_diarias.php'); exit;
      }else{
        header("Location: transparencia_diarias_ver.php?mes=".$Mes."&ano=".$Ano.""); exit;
      }
?>
