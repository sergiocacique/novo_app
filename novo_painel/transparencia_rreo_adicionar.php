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

    $Bimestre = $_POST['bimestre'];
    $Ano = $_POST['ano'];
    $Titulo = addslashes($_POST['titulo']);
    $Acao = (isset($_POST['acao']))? $_POST['acao'] : '';
    $DtAtualizacao = date('Y-m-d H:i:s');

    if ($Bimestre == '1º BIMESTRE'){
        $Pasta = '1_bim';
        $Bim = '1';
    }elseif ($Bimestre == '2º BIMESTRE 1º QUADRIMESTRE'){
        $Pasta = '2_bim';
        $Bim = '2';
    }elseif ($Bimestre == '3º BIMESTRE'){
        $Pasta = '3_bim';
        $Bim = '3';
    }elseif ($Bimestre == '4º BIMESTRE 2º QUADRIMESTRE'){
        $Pasta = '4_bim';
        $Bim = '4';
    }elseif ($Bimestre == '5º BIMESTRE'){
        $Pasta = '5_bim';
        $Bim = '5';
    }elseif ($Bimestre == '6º BIMESTRE 3º QUADRIMESTRE'){
        $Pasta = '6_bim';
        $Bim = '6';
    }


        $dir = '../arquivosDinamicos/municipio/'.$verAdmin['Pasta'].'/anexo/'.$Ano.'/'.$Pasta.'/';

        if (is_dir($dir)) {
        } else {
            mkdir($dir, 0777, true); // Cria uma nova pasta dentro do diretório atual
        }

        // Tamanho máximo do arquivo (em Bytes)
        $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb

        // Array com as extensões permitidas
        $_UP['extensoes'] = array('pdf');

        // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
        $_UP['renomeia'] = true;

        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do SERVIDOR';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

        // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
        if ($_FILES['arquivo']['error'] != 0) {
            echo "<script>";
            echo "$('#loading2').css('visibility','hidden');";
            echo "</script>";
            echo "<div class='callout callout-warning'>";
            echo "<h4>Arquivo Muito Grande</h4>";
            echo "<p>" . die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]) . "</p>";
            echo "</div>";
            echo " <div class='col-xs-5 col-sm-5 col-md-5'>";
            echo "<a href='noticia_cadastro.php' title='Enviar Arquivo' id='add-datatables1' class='btn upl_btn datatables1-actions' role='button'>";
            echo "<i class='fa fa-arrow-left'></i> Voltar";
            echo "</a>";
            echo "</div>";

            exit; // Para a execução do script
        }


        // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

        // Faz a verificação da extensão do arquivo
        $arquivos = explode('.', $_FILES['arquivo']['name']);

        $extensao = strtolower($arquivos[count($arquivos) - 1]);

        if (array_search($extensao, $_UP['extensoes']) === false) {
            echo "<div class='callout callout-warning'>";
            echo "<h4>Arquivo Errado</h4>";
            echo "<p>Por favor, envie arquivos com a seguinte extensão: pdf</p>";
            echo "</div>";
            echo " <div class='col-xs-5 col-sm-5 col-md-5'>";
            echo "<a href='noticia_cadastro.php' title='Enviar Arquivo' id='add-datatables1' class='btn upl_btn datatables1-actions' role='button'>";
            echo "<i class='fa fa-arrow-left'></i> Voltar";
            echo "</a>";
            echo "</div>";
            echo "<script>";
            echo "$('#loading2').css('visibility','hidden');";
            echo "</script>";
            exit;
        }

        // Faz a verificação do tamanho do arquivo
        if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
            echo "<div class='callout callout-warning'>";
            echo "<h4>Arquivo muito grande</h4>";
            echo "<p>O arquivo enviado é muito grande, envie arquivos de até 2Mb.</p>";
            echo "</div>";
            echo " <div class='col-xs-5 col-sm-5 col-md-5'>";
            echo "<a href='noticia_cadastro.php' title='Enviar Arquivo' id='add-datatables1' class='btn upl_btn datatables1-actions' role='button'>";
            echo "<i class='fa fa-arrow-left'></i> Voltar";
            echo "</a>";
            echo "</div>";
            echo "<script>";
            echo "$('#loading2').css('visibility','hidden');";
            echo "</script>";
            exit;
        }


        // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta

        // Primeiro verifica se deve trocar o nome do arquivo
        if ($_UP['renomeia'] == true) {
            // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
            $nome_final = md5(time()) . '.pdf';
        } else {
            // Mantém o nome original do arquivo
            $nome_final = $_FILES['arquivo']['name'];
        }

        // Depois verifica se é possível mover o arquivo para a pasta escolhida
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir . $nome_final)) {
            // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
            echo "<div class='callout callout-success'>";
            echo "<h4>Notícia cadastrada com sucesso!</h4>";
            echo "</div>";

            $query = "INSERT INTO rreo (CdPrefeitura,CdUsuario,Bimestre,Ano,Bim,Nome,Pasta,Arquivo,Acao,DtCadastro) VALUES ('".$_SESSION['PrefeituraID']."','".$_SESSION['UsuarioID']."','" . $Bimestre . "','" . $Ano . "','" . $Bim . "','" . $Titulo . "','" . $Pasta . "','" . $nome_final . "','" . $Acao . "','" . $DtAtualizacao . "')";
            $verifica = mysql_query($query);

            var_dump($query);

            //auditoria($_POST,$_SESSION['Usuario'].' Adicionou RREO/RGF : '.$Nome.'');

        } else {
            // Não foi possível fazer o upload, provavelmente a pasta está incorreta
            echo "<div class='callout callout-danger'>";
            echo "<h4>NEGADO</h4>";
            echo "<p>Não foi possível enviar o arquivo, tente novamente</p>";
            echo "</div>";
            echo " <div class='col-xs-5 col-sm-5 col-md-5'>";
            echo "<a href='noticia_cadastro.php' title='Enviar Arquivo' id='add-datatables1' class='btn upl_btn datatables1-actions' role='button'>";
            echo "<i class='fa fa-arrow-left'></i> Voltar";
            echo "</a>";
            echo "</div>";
            echo "<script>";
            echo "$('#loading2').css('visibility','hidden');";
            echo "</script>";
        }


header('Location: transparencia_rreo.php'); exit;
?>
