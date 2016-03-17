<?php
include ("conexao.php");
include ("funcao.php");


if(!isset($_POST['txtCPF'])) die("N&atilde;o recebi nenhum par&acitc;metro. Por favor volte ao formulario.html antes");

$CPF = $_POST['txtCPF'];
$sqlPagina = mysql_query("SELECT * FROM admin WHERE CPF = '".$CPF."'");
$rsPagina = mysql_fetch_array($sqlPagina);

$DtAtualizacao = date('Y-m-d H:i:s');
$senha = geraSenha(6, false, true);

$query = "UPDATE admin SET";
$query = $query . " Senha = '" . md5($senha) . "',";
$query = $query . " DtAtualizacao = '" . $DtAtualizacao . "'";
$query = $query . " WHERE";
$query = $query . " CdUsuario = '".$rsPagina['CdUsuario']."'";

$verifica = mysql_query($query);
/* Medida preventiva para evitar que outros dom�nios sejam remetente da sua mensagem. */
if (eregi('minhaprefeitura.com.br$', $_SERVER[HTTP_HOST])) {
        $emailsender='nao-responda@minhaprefeitura.com.br';
} else {
        $emailsender = "nao-responda@" . $_SERVER[HTTP_HOST];
        //    Na linha acima estamos for�ando que o remetente seja 'webmaster@seudominio',
        // voc� pode alterar para que o remetente seja, por exemplo, 'contato@seudominio'.
}

/* Verifica qual � o sistema operacional do servidor para ajustar o cabe�alho de forma correta. N�o alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");

// Passando os dados obtidos pelo formul�rio para as vari�veis abaixo
$nomeremetente     = "Minha Prefeitura";
$emailremetente    = $emailsender;
$emaildestinatario = trim($rsPagina['Email']);
$comcopia          = trim($_POST['comcopia']);
$comcopiaoculta    = trim($_POST['comcopiaoculta']);
$assunto           = "Nova Senha";
$mensagem          = $_POST['mensagem'];


/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<P>Esse email &eacute; um teste enviado no formato HTML via PHP mail();!</P>
<P>Aqui est&aacute; a mensagem postada por voc&ecirc; formatada em HTML:</P>
<p><b><i>'.$senha.'</i></b></p>
<hr>';


/* Montando o cabe�alho da mensagem */
$headers = "MIME-Version: 1.1".$quebra_linha;
$headers .= "Content-type: text/html; charset=iso-8859-1".$quebra_linha;
// Perceba que a linha acima cont�m "text/html", sem essa linha, a mensagem n�o chegar� formatada.
$headers .= "From: ".$emailsender.$quebra_linha;
$headers .= "Return-Path: " . $emailsender . $quebra_linha;
// Esses dois "if's" abaixo s�o porque o Postfix obriga que se um cabe�alho for especificado, dever� haver um valor.
// Se n�o houver um valor, o item n�o dever� ser especificado.
// if(strlen($comcopia) > 0) $headers .= "Cc: ".$comcopia.$quebra_linha;
// if(strlen($comcopiaoculta) > 0) $headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
// Note que o e-mail do remetente ser� usado no campo Reply-To (Responder Para)

/* Enviando a mensagem */
mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);

/* Mostrando na tela as informa��es enviadas por e-mail */
print "Mensagem <b>$assunto</b> enviada com sucesso!<br><br>
De: $emailsender<br>
Para: $emaildestinatario<br>
// Com c&oacute;pia: $comcopia<br>
// Com c&oacute;pia Oculta: $comcopiaoculta<br>
<p><a href='".$_SERVER["HTTP_REFERER"]."'>Voltar</a></p>"
?>
