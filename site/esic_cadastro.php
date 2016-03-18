<?php

include ("conexao.php");

$Email = $_POST['email'];
$Senha = $_POST['senha'];
$Nome = $_POST['nome'];
$CPF = $_POST['CPF'];
$CEP = $_POST['CEP'];
$Endereco = $_POST['endereco'];
$Bairro = $_POST['bairro'];
$Cidade = $_POST['cidade'];
$Estado = $_POST['estado'];
$Telefone = $_POST['telefone'];
$acao = "ativo";
$prefeitura = $_POST['prefeitura'];
$CdPrefeitura = $_POST['CdPrefeitura'];




$acessos = mysql_query("INSERT INTO sic_usuario (CdPrefeitura,Nome,Email,Senha,CPF,CEP,Endereco,Bairro,Cidade,Estado,Telefone,acao) VALUES ('".$CdPrefeitura."','".$Nome."','".$Email."','".md5($Senha)."','".$CPF."','".$CEP."','".$Endereco."','".$Bairro."','".$Cidade."','".$Estado."','".$Telefone."','".$acao."')");


$verifica = mysql_query("SELECT * FROM sic_usuario WHERE Email = '".$Email."' AND Senha = '".md5($Senha)."'") or die("erro ao selecionar");
$mostra = mysql_num_rows($verifica);
$verDados = mysql_fetch_array($verifica);


$UrlAmigavel = "http://transparencia.minhaprefeitura.com.br/";

$dominio = $prefeitura;

$legal = $UrlAmigavel."".$dominio."/";

header('Location: '.$legal.'esic_protocolos'); exit;

?>