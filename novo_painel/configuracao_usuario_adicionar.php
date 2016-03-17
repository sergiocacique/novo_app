<?php

include ("conexao.php");
include ("funcao.php");

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();


// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: login.php"); exit;
}

$sqlAdmin = mysql_query("SELECT * FROM vw_prefeitura WHERE CdPrefeitura = ".$_SESSION['PrefeituraID']." ");
$verAdmin = mysql_fetch_array($sqlAdmin);

    $Nome = $_POST['nome'];
    $Perfil = $_POST['perfil'];
    $DtAntiga1 = $_POST['DtNascimento'];
    $DtNascimento = implode("-",array_reverse(explode("/",$DtAntiga1)));
    $CPF = $_POST['cpf'];
    $Email = addslashes($_POST['email']);

    $Senha = addslashes($_POST['senha']);
    $Acao = $_POST['acao'];
    $DtAtualizacao = date('Y-m-d H:i:s');



        $query = "INSERT INTO admin (Perfil,Email,Senha,Nome,CPF,DtNascimento,DtCadastro,Acao) VALUES ('".$Perfil."','" . $Email . "','" . md5($Senha) . "','" . $Nome . "','" . $CPF . "','" . $DtNascimento . "','" . $DtAtualizacao . "','" . $Acao . "')";
        $verifica = mysql_query($query);

        $verifica = mysql_query("SELECT * FROM admin WHERE CPF = '".$CPF."'");
        $mostra = mysql_num_rows($verifica);
        $verDados = mysql_fetch_array($verifica);

        $query2 = "INSERT INTO admin_prefeitura (CdUsuario,CdPrefeitura) VALUES ('".$verDados['CdUsuario']."','" . $_SESSION['PrefeituraID'] . "')";
        $verifica2 = mysql_query($query2);

        $sqlPagina2 = mysql_query("SELECT * FROM vw_admin WHERE CdUsuario = '".$verDados['CdUsuario']."'");
        $rsPagina2 = mysql_fetch_array($sqlPagina2);

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
			<td valign="top" width="100%">
			<table align="center" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" class="deviceWidth" style="min-width:550px;" width="550">
				<tbody>
					<tr>
						<td valign="top">&nbsp;</td>
					</tr>
				</tbody>
			</table>

			<table align="center" border="0" cellpadding="0" cellspacing="0" class="mobile-content-size" style="min-width:550px;" width="550">
				<tbody>
					<tr>
						<td bgcolor="#ffffff" class="story-one" height="622" style="min-width:550px;" valign="top" width="550">
						<div>
						<table align="center" border="0" cellpadding="0" cellspacing="0" class="mobile-content-size" style="min-width:550px" width="550">
							<tbody>
								<tr>
									<td class="story-one-body-copy" style="vertical-align: top; font-size: 20px; color: rgb(34, 34, 34); font-weight: normal; font-family: &quot;Open Sans&quot;,helvetica,MotoSans,Verdana,Arial,sans-serif; line-height: 22px; padding: 0px 83px;" width="550">
									<p>&nbsp;</p>

									<p>&nbsp;</p>

									<p style="text-align: center;"><br />
									OL&Aacute; <span style="color:#A52A2A;">'.$Nome.'</span><br />
									Bem vindo ao portal '.$rsPagina2['Fantasia'].' ,</p>

									<p>&nbsp;</p>
									</td>
								</tr>
								<tr>
									<td class="story-one-body-copy" style="vertical-align: top; font-size: 20px; color: rgb(34, 34, 34); font-weight: normal; font-family: &quot;Open Sans&quot;,helvetica,MotoSans,Verdana,Arial,sans-serif; line-height: 22px; padding: 0px 83px;" width="550">Segue abaixo seus dados de acesso ao portal.<br />
									<br />
									seu login: <strong>'.$Email.'</strong><br />
									sua senha: <strong>'.$Senha.'</strong><br />
									&nbsp;</td>
								</tr>
							</tbody>
						</table>

						<table align="center" border="0" cellpadding="0" cellspacing="0" class="mobile-content-size" style="min-width:550px" width="550">
							<tbody>
								<tr>
									<td align="center" class="story-one-body-copy" style="text-align: center; vertical-align: middle; font-size: 12px; color: #000000; font-weight:700; font-family:&quot;Open Sans&quot;, helvetica, MotoSans,Verdana, Arial, sans-serif; line-height: 28px; padding:0px 0px 0px 85px;letter-spacing: 0px;" width="275">Acesse o endere&ccedil;o abaixo para acessar o painel de administrativo<br />
									<a href="http://app.minhaprefeitura.com.br" target="_blank" title="">http://app.minhaprefeitura.com.br</a></td>
								</tr>
							</tbody>
						</table>
						</div>
						</td>
					</tr>
				</tbody>
			</table>
			<!-- end story --></td>
		</tr>
	</tbody>
</table>';


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


        $mensagem= "Fulano adicionou novo usuário no municipio tal";
        salvaLog($mensagem);

header('Location: configuracao_usuario.php'); exit;
?>
