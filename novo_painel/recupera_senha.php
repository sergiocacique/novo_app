<?php
include ("conexao.php");
include ("funcao.php");


if(!isset($_POST['txtCPF'])) die("N&atilde;o recebi nenhum par&acitc;metro. Por favor volte ao formulario.html antes");

$CPF = $_POST['txtCPF'];
$sqlPagina = mysql_query("SELECT * FROM admin WHERE CPF = '".$CPF."'");
$rsPagina = mysql_fetch_array($sqlPagina);


$sqlPagina2 = mysql_query("SELECT * FROM vw_admin WHERE CdUsuario = '".$rsPagina['CdUsuario']."'");
$rsPagina2 = mysql_fetch_array($sqlPagina2);

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
$nomeremetente     = $rsPagina2['Fantasia'];
$emailremetente    = $emailsender;
$emaildestinatario = trim($rsPagina['Email']);
$comcopia          = trim($_POST['comcopia']);
$comcopiaoculta    = trim($_POST['comcopiaoculta']);
$assunto           = $rsPagina2['Fantasia']." - Alteração de Senha";
$mensagem          = $_POST['mensagem'];


/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<meta content="NOINDEX, NOFOLLOW" name="ROBOTS" />
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<meta content="True" name="HandheldFriendly" />
<title></title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" type="text/css" />
<style type="text/css">body { width: 100%; background-color:#f1f1f1; margin:0; padding:0; -webkit-text-size-adjust: 100%;-ms-text-size-adjust:100%; }
		html { width: 100%; }
		table, td { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
		img{ border:0 none; height:auto;line-height:100%;outline:none;text-decoration:none; }
		a img{ border:0 none;}
		.imageFix{ display:block;}
		#outlook a{ padding:0; }
		.ExternalClass{ width:100%; }
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{ line-height: 100%; }
		.applelinks a { text-decoration:none; color:#4d4d4d; }
		.applelinks-legal a { text-decoration:none; color:#8d8f95; }

		@import url(http://fonts.googleapis.com/css?family=Open+Sans);

		.cta-show-them-table:hover, .cta-show-them-table-light:hover { border-radius:3px; background-color:#273780!important;color:#ffffff!important; -webkit-transition: all .17s !important; transition: all .17s !important; }
		a.cta-show-them:hover, a.cta-show-them-light:hover { border-radius:3px; background-color:#273780!important; color:#ffffff!important; -webkit-transition: all .17s !important; transition: all .17s !important; }
</style>
<table align="center" bgcolor="#f1f1f1" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr>
			<td>
			<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 550px;">
				<tbody>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF">
						<table align="center" bgcolor="#FFFFFF" border="0" cellpadding="5" cellspacing="5" class="deviceWidth" style="min-width:550px;" width="550">
							<tbody>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td style="text-align: center;"><img height="45" src="https://www.minhaprefeitura.com.br/console/imagens/brasao/'.$rsPagina2['Pasta'].'.png" style="font-family:&quot;Open Sans&quot;,arial, verdana, sans-serif; font-size:14px; color:#FFFFFF; border:0;" width="45" /></td>
								</tr>
								<tr class="story-one-body-copy" style="vertical-align: top; font-size: 20px; color: rgb(34, 34, 34); font-weight: normal; font-family: &quot;Open Sans&quot;,helvetica,MotoSans,Verdana,Arial,sans-serif; line-height: 22px; padding: 0px 83px;" width="550">
									<td><br />
									<span style="color: rgb(34, 34, 34); font-family: &quot;Open Sans&quot;, helvetica, MotoSans, Verdana, Arial, sans-serif; font-size: 20px; line-height: 22px;">Ol&aacute;&nbsp;</span><span style="font-family: &quot;Open Sans&quot;, helvetica, MotoSans, Verdana, Arial, sans-serif; font-size: 20px; line-height: 22px; color: rgb(165, 42, 42);">'.$rsPagina2['Nome'].'</span><span style="color: rgb(34, 34, 34); font-family: &quot;Open Sans&quot;, helvetica, MotoSans, Verdana, Arial, sans-serif; font-size: 20px; line-height: 22px;">,<br />
									<br />
									voc&ecirc; solicitou uma nova senha de acesso em '.date('d/m/Y', strtotime($rsPagina2['DtAtualizacao'])).'.<br />
									sua nova senha:&nbsp;</span><strong style="color: rgb(34, 34, 34); font-family: &quot;Open Sans&quot;, helvetica, MotoSans, Verdana, Arial, sans-serif; font-size: 20px; line-height: 22px;">'.$senha.'</strong><br />
									&nbsp;<br />
									&nbsp;</td>
								</tr>
								<tr>
									<td><span style="line-height: 20.8px; text-align: center;">Acesse o endere&ccedil;o abaixo para acessar o painel de administrativo</span><br style="line-height: 20.8px; text-align: center;" />
									<a href="http://app.minhaprefeitura.com.br" style="line-height: 20.8px; text-align: center;" target="_blank" title="">http://app.minhaprefeitura.com.br</a></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</tbody>
			</table>

			<p>&nbsp;</p>
			</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>
';


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

header('Location: senha_enviada.php'); exit;

/* Mostrando na tela as informa��es enviadas por e-mail */
print "Mensagem <b>$assunto</b> enviada com sucesso!<br><br>
De: $emailsender<br>
Para: $emaildestinatario<br>
// Com c&oacute;pia: $comcopia<br>
// Com c&oacute;pia Oculta: $comcopiaoculta<br>
<p><a href='".$_SERVER["HTTP_REFERER"]."'>Voltar</a></p>"
?>
