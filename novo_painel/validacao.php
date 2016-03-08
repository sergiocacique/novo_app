<?php

include ("conexao.php");
include ("funcao.php");


$usuario = $_POST['txUsuario'];
$senha = $_POST['txSenha'];


$verifica = mysql_query("SELECT * FROM admin WHERE Email = '".$usuario."' AND Senha = '".md5($senha)."'") or die("erro ao selecionar");
$mostra = mysql_num_rows($verifica);
$verDados = mysql_fetch_array($verifica);

if ($mostra > 0) {

    // session_start inicia a sessão

    $pref = mysql_query("SELECT * FROM adm_pref WHERE CdUsuario = ".$verDados['CdUsuario']." ");
    $soma = mysql_num_rows($pref);
    $verAcesso = mysql_fetch_array($pref);



    $_SESSION['UsuarioID'] = $verDados['CdUsuario'];
    $_SESSION['Usuario'] = $verDados['Usuario'];
    $_SESSION['Nivel'] = $verDados['Nivel'];
    $_SESSION['Grupo'] = $verDados['Perfil'];
    $atual = date('Y-m-d H:i:s');
    $expira = date('Y-m-d H:i:s', strtotime('+1 min'));
    $IP = $_SERVER["REMOTE_ADDR"];

    $update = mysql_query("UPDATE admin SET Horario = '".$atual."', Limite = '".$expira."' WHERE CdUsuario = '".$verDados['CdUsuario']."'");
    $acessos = mysql_query("INSERT INTO acessos (CdUsuario,CdGrupo,DtCadastro,IP) VALUES ('".$_SESSION['UsuarioID']."','".$_SESSION['Grupo']."','".$atual."','".$IP."')");

//    if ($soma == 1){
//        $_SESSION['PrefeituraID'] = $verAcesso['CdPrefeitura'];
//    }else{
//        $_SESSION['PrefeituraID'] = "0";
//    }

    $_SESSION['PrefeituraID'] = "1";
    if ($verDados['atualizado'] == 'nao'){
        //header('Location: meus_dados.php'); exit;
        header('Location: index.php'); exit;
    }else{
        header('Location: index.php'); exit;
    }



}

//Caso contrário redireciona para a página de autenticação
else {
    //Destrói
    session_destroy();

    //Redireciona para a página de autenticação
    header('Location: login.php'); exit;

}
?>