<?php

include ("conexao.php");



session_start();
$usuario = $_POST['email'];
$senha = $_POST['senha'];
$prefeitura = $_POST['prefeitura'];

$UrlAmigavel = "http://transparencia.minhaprefeitura.com.br/";

$dominio = $prefeitura;

$legal = $UrlAmigavel."".$dominio."/";


$verifica = mysql_query("SELECT * FROM sic_usuario WHERE Email = '".$usuario."' AND Senha = '".md5($senha)."'") or die("erro ao selecionar");
$mostra = mysql_num_rows($verifica);
$verDados = mysql_fetch_array($verifica);


if ($mostra > 0) {

    // session_start inicia a sessão

    $_SESSION['ID_SIC'] = $verDados['id'];
    $_SESSION['CdPrefeitura'] = $verDados['CdPrefeitura'];
    $atual = date('Y-m-d H:i:s');
    $IP = $_SERVER["REMOTE_ADDR"];
    $acessos = mysql_query("INSERT INTO sic_acessos (CdUsuario,DtCadastro,IP,CdPrefeitura) VALUES ('".$_SESSION['ID_SIC']."','".$atual."','".$IP."','".$_SESSION['CdPrefeitura']."')");


    header('Location: '.$legal.'esic_protocolos'); exit;


}

//Caso contrário redireciona para a página de autenticação
else {
    //Destrói
    session_destroy();

    //Redireciona para a página de autenticação
    header('Location: '.$legal.'esic_consulta'); exit;

}
?>