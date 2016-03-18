<?php
include ("../conexao.php");
include ("funcoes.php");

$CPF = trim(strtolower($_POST['tipCPF']));
$Senha = trim(strtolower($_POST['tipSenha']));
$CEP = trim(strtolower($_POST['tipCep']));
$Endereco = trim(strtolower($_POST['tipEndereco']));
$Bairro = trim(strtolower($_POST['tipBairro']));
$Cidade = trim(strtolower($_POST['tipCidade']));
$Estado = trim(strtolower($_POST['tipEstado']));
$Telefone = trim(strtolower($_POST['tipTelefone']));
$DtNascimento = formatarData(trim(strtolower($_POST['tipDtNasc'])));
$DtAtualizacao = date('Y-m-d H:i:s');

$sql = "UPDATE sic_usuario SET DtAtualizacao = '" . $DtAtualizacao . "'";

if($Senha <> "") {
    $sql = $sql . ",Senha = '" . md5($Senha) . "'";
}
if ($CPF <> "") {
    $sql = $sql . ",CPF = '" . $CPF . "'";
}
$sql = $sql . ",CEP = '" . $CEP . "'";
$sql = $sql . ",Endereco = '" . $Endereco . "'";
$sql = $sql . ",Bairro = '" . $Bairro . "'";
$sql = $sql . ",Cidade = '" . $Cidade . "'";
$sql = $sql . ",Estado = '" . $Estado . "'";
$sql = $sql . ",Telefone = '" . $Telefone . "'";

if($DtNascimento <> "") {
    $sql = $sql . ",DtNascimento = '" . $DtNascimento . "'";
}
$sql = $sql . " WHERE id = '" . $_SESSION['IDSIC'] . "'";


$verifica2 = mysql_query($sql);


header('Location: index.php?Pages=esic_protocolo'); exit;

//header('Location: admin_permissao.php?id='.$CdUsuario.''); exit;

?>


