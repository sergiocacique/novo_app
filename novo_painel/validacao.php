<?php

include ("conexao.php");
include ("funcao.php");


$usuario = $_POST['txUsuario'];
$senha = $_POST['txSenha'];


$verifica = mysql_query("SELECT * FROM vw_admin WHERE Email = '".$usuario."' AND Senha = '".md5($senha)."' AND Acao = 'Publicado'") or die("erro ao selecionar");
$mostra = mysql_num_rows($verifica);
$verDados = mysql_fetch_array($verifica);

if ($mostra > 0) {

    $_SESSION['UsuarioID'] = $verDados['CdUsuario'];
    $atual = date('Y-m-d H:i:s');
    $expira = date('Y-m-d H:i:s', strtotime('+1 min'));
    $IP = $_SERVER["REMOTE_ADDR"];

    $update = mysql_query("UPDATE admin SET Horario = '".$atual."', Limite = '".$expira."' WHERE CdUsuario = '".$verDados['CdUsuario']."'");
    $acessos = mysql_query("INSERT INTO acessos (CdUsuario,DtCadastro,IP) VALUES ('".$_SESSION['UsuarioID']."','".$atual."','".$IP."')");

    $pref = mysql_query("SELECT * FROM admin_prefeitura WHERE CdUsuario = ".$verDados['CdUsuario']." ");
    $soma = mysql_num_rows($pref);
    $verAcesso = mysql_fetch_array($pref);

   if ($soma == 1){
       $_SESSION['PrefeituraID'] = $verAcesso['CdPrefeitura'];
       header('Location: index.php'); exit;
   }else{
       $_SESSION['PrefeituraID'] = "0";
       header('Location: prefeitura.php'); exit;
   }

    //$_SESSION['PrefeituraID'] = "5";
    // if ($verDados['atualizado'] == 'nao'){
    //     //header('Location: meus_dados.php'); exit;
    //     header('Location: index.php'); exit;
    // }else{
    //     header('Location: index.php'); exit;
    // }



}

//Caso contrário redireciona para a página de autenticação
else {
    //Destrói
    session_destroy();

    //Redireciona para a página de autenticação
    header('Location: login.php'); exit;

}
?>
