<?php

include ("../conexao.php");


$usuario = $_POST['email'];
$senha = $_POST['passwd'];


$verifica = mysql_query("SELECT * FROM sic_usuario WHERE Email = '".$usuario."' AND Senha = '".md5($senha)."'") or die("erro ao selecionar");
$mostra = mysql_num_rows($verifica);
$verDados = mysql_fetch_array($verifica);


if ($mostra > 0) {

    // session_start inicia a sessão

    $_SESSION['IDSIC'] = $verDados['id'];
    $_SESSION['UserSIC'] = $verDados['Email'];


        header('Location: index.php?Pages=esic_protocolo'); exit;


}

//Caso contrário redireciona para a página de autenticação
else {
    //Destrói
    session_destroy();

    //Redireciona para a página de autenticação
    header('Location: index.php?Pages=esic_acesso'); exit;

}
?>