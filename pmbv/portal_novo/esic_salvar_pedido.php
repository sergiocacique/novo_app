<?php

include ("../conexao.php");

$CdUsuario = $_SESSION['IDSIC'];

$DtCadastro = date("Y-m-d");
$DtFinal = date('Y-m-d', strtotime('+20 days'));

$Orgao = $_POST['tipOrgao'];
$Recebimento = trim(strtolower($_POST['tipFormaResposta']));
$Assunto = trim(strtolower($_POST['tipDescricao']));
$Autorizacao = trim(strtolower($_POST['optionsRadios']));
$Acao = "Novo";

$Protocolo = date('Y')."".date('m').date('d')."".date('H').date('i').date('s');


$sql = "INSERT INTO sic_ticket (CdUsuario,DtCadastro,DtFinal,Orgao,DtAtualizacao,Protocolo,Assunto,Acao,Autorizacao,Recebimento) VALUES ('".$CdUsuario."','".$DtCadastro."','".$DtFinal."','".$Orgao."','".$DtCadastro."','".$Protocolo."','".$Assunto."','".$Acao."','".$Autorizacao."','".$Recebimento."')";
$verifica2 = mysql_query($sql);


header('Location: index.php?Pages=esic_protocolo'); exit;

//header('Location: admin_permissao.php?id='.$CdUsuario.''); exit;

?>


