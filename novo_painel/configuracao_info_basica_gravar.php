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

    $Endereco = addslashes($_POST['endereco']);
    $Bairro = addslashes($_POST['bairro']);
    $Cidade = addslashes($_POST['cidade']);
    $Estado = addslashes($_POST['estado']);
    $CEP = addslashes($_POST['CEP']);
    $RazaoSocial = addslashes($_POST['RazaoSocial']);
    $CNPJ = addslashes($_POST['CNPJ']);
    $Telefone = addslashes($_POST['Telefone']);
    $Email = addslashes($_POST['email']);
    $Dias = addslashes($_POST['Dias']);
    $Horario = addslashes($_POST['HorarioFuncionamento']);


        $query = "UPDATE prefeitura_config SET";
        $query = $query . " Endereco = '" . $Endereco . "',";
        $query = $query . " Bairro = '" . $Bairro . "',";
        $query = $query . " Cidade = '" . $Cidade . "',";
        $query = $query . " Estado = '" . $Estado . "',";
        $query = $query . " CEP = '" . $CEP . "',";
        $query = $query . " RazaoSocial = '" . $RazaoSocial . "',";
        $query = $query . " CNPJ = '" . $CNPJ . "',";
        $query = $query . " Telefone = '" . $Telefone . "',";
        $query = $query . " Email = '" . $Email . "',";
        $query = $query . " Dias = '" . $Dias . "',";
        $query = $query . " HorarioFuncionamento = '" . $Horario . "'";

        $query = $query . " WHERE CdPrefeitura = '".$_SESSION['PrefeituraID']."'";
        $verifica = mysql_query($query);



header('Location: configuracoes_info_basico.php'); exit;

?>
