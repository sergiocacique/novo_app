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

    $Nome = $_POST['nome'];
    $Perfil = $_POST['perfil'];
    $DtAntiga1 = $_POST['DtNascimento'];
    $DtNascimento = implode("-",array_reverse(explode("/",$DtAntiga1)));
    $CPF = $_POST['cpf'];
    $Email = addslashes($_POST['email']);

    $Senha = addslashes($_POST['senha']);
    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');



        $query = "INSERT INTO admin (Perfil,Email,Senha,Nome,CPF,DtNascimento,DtCadastro,Acao) VALUES ('".$Perfil."','" . $Email . "','" . md5($Senha) . "','" . $Nome . "','" . $CPF . "','" . $DtNascimento . "','" . $DtAtualizacao . "','" . $Acao . "')";
        $verifica = mysql_query($query);

        $verifica = mysql_query("SELECT * FROM admin WHERE CPF = '".$CPF."'");
        $mostra = mysql_num_rows($verifica);
        $verDados = mysql_fetch_array($verifica);

        $query2 = "INSERT INTO admin_prefeitura (CdUsuario,CdPrefeitura) VALUES ('".$verDados['CdUsuario']."','" . $_SESSION['PrefeituraID'] . "')";
        $verifica2 = mysql_query($query2);


header('Location: configuracao_usuario.php'); exit;
?>
