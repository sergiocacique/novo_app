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

    $DtAntiga = $_POST['dtInicio'];
    $DtInicio = implode("-",array_reverse(explode("/",$DtAntiga)));

    $DtAntiga1 = $_POST['dtFim'];
    $DtFim = implode("-",array_reverse(explode("/",$DtAntiga1)));

    $Titulo = addslashes($_POST['titulo']);
    $CdSecretaria = (isset($_POST['departamento']))? $_POST['departamento'] : '';
    $Materia = addslashes($_POST['editor1']);
    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');



        $query = "INSERT INTO eventos (CdPrefeitura,CdDepartamento,DtInicio,DtFim,Titulo,Descricao,Acao,DtCadastro) VALUES ('".$_SESSION['PrefeituraID']."','" . $CdSecretaria . "','" . $DtInicio . "','" . $DtFim . "','" . $Titulo . "','" . $Materia . "','" . $Acao . "','" . $DtAtualizacao . "')";
        $verifica = mysql_query($query);


header('Location: informativos_eventos.php'); exit;
?>
