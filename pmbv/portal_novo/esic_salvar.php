<?php
include ("../conexao.php");
include ("funcoes.php");

$Nome = trim(strtolower($_POST['tipNome']));
$Email = trim(strtolower($_POST['tipMAIL']));
$CPF = trim(strtolower($_POST['tipCPF']));
$Senha = trim(strtolower($_POST['tipSenha']));
$CEP = trim(strtolower($_POST['tipCep']));
$Endereco = trim(strtolower($_POST['tipEndereco']));
$Bairro = trim(strtolower($_POST['tipBairro']));
$Cidade = trim(strtolower($_POST['tipCidade']));
$Estado = trim(strtolower($_POST['tipEstado']));
$Telefone = trim(strtolower($_POST['tipTelefone']));
$DtNascimento = formatarData(trim(strtolower($_POST['tipDtNasc'])));



$acao = "ativo";
$DtCadastro = date('Y-m-d H:i:s');

$sql = "INSERT INTO sic_usuario (Nome,Email,Senha,CPF,CEP,Endereco,Bairro,Cidade,Estado,Telefone,acao,DtCadastro,DtNascimento) VALUES ('".$Nome."','".$Email."','".md5($Senha)."','".$CPF."','".$CEP."','".$Endereco."','".$Bairro."','".$Cidade."','".$Estado."','".$Telefone."','".$acao."','".$DtCadastro."','".$DtNascimento."')";
$verifica2 = mysql_query($sql);


$verifica = mysql_query("SELECT * FROM sic_usuario WHERE Email = '".$Email."' AND Senha = '".md5($Senha)."'");
$mostra = mysql_num_rows($verifica);
$verDados = mysql_fetch_array($verifica);

$_SESSION['IDSIC'] = $verDados['id'];
$_SESSION['UserSIC'] = $verDados['Email'];


header('Location: index.php?Pages=esic_protocolo'); exit;

//header('Location: admin_permissao.php?id='.$CdUsuario.''); exit;

?>


