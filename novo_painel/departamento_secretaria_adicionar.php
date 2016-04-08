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

    $NomeDepartamento = $_POST['NomeDepartamento'];
    $Cargo = $_POST['Cargo'];
    $NomeSecretario = addslashes($_POST['NomeSecretario']);
    $Tipo = (isset($_POST['Tipo']))? $_POST['Tipo'] : '';
    $Sobre = addslashes($_POST['editor1']);
    $Telefones = (isset($_POST['Telefones']))? $_POST['Telefones'] : '';
    $Endereco = (isset($_POST['Endereco']))? $_POST['Endereco'] : '';
    $Horario = (isset($_POST['Horario']))? $_POST['Horario'] : '';
    $Email = (isset($_POST['Email']))? $_POST['Email'] : '';

    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');



        $query = "INSERT INTO departamento (";
        $query = $query . " CdPrefeitura,";
        $query = $query . " NomeDepartamento,";
        $query = $query . " NomeSecretario,";
        $query = $query . " Cargo,";
        $query = $query . " Tipo,";
        $query = $query . " Sobre,";
        $query = $query . " Telefones,";
        $query = $query . " Endereco,";
        $query = $query . " Email,";
        $query = $query . " Horario,";
        $query = $query . " Acao,";
        $query = $query . " DtCadastro";

        $query = $query . " ) VALUES (";

        $query = $query . " '".$_SESSION['PrefeituraID']."',";
        $query = $query . " '" . $NomeDepartamento . "',";
        $query = $query . " '" . $NomeSecretario . "',";
        $query = $query . " '" . $Cargo . "',";
        $query = $query . " '" . $Tipo . "',";
        $query = $query . " '" . $Sobre . "',";
        $query = $query . " '" . $Telefones . "',";
        $query = $query . " '" . $Endereco . "',";
        $query = $query . " '" . $Email . "',";
        $query = $query . " '" . $Horario . "',";
        $query = $query . " '" . $Acao . "',";
        $query = $query . " '" . $DtAtualizacao . "'";
        $query = $query . " )";
        $verifica = mysql_query($query);



header('Location: departamento_secreatrias.php'); exit;
?>
