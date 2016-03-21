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

    $Categoria = $_POST['CdCategoria'];
    $Titulo = $_POST['titulo'];
    $Subcategoria = addslashes($_POST['Subcategoria']);
    $Descricao = addslashes($_POST['Descricao']);
    $DtAbertura = $_POST['dtAbertura'];
    $Acao = (isset($_POST['acao']))? $_POST['acao'] : '';
    $DtAtualizacao = date('Y-m-d H:i:s');


        $dir = '../arquivosDinamicos/municipio/'.$verAdmin['Pasta'].'/anexo/';

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

            $query = "INSERT INTO publicacoes_oficiais";
            $query = $query . " (CdPrefeitura,";
            $query = $query . "  CdUsuario,";
            $query = $query . "  CdCategoria,";
            $query = $query . "  CdSubCategoria,";
            $query = $query . "  Titulo,";
            $query = $query . "  Arquivo,";
            $query = $query . "  Descricao,";
            $query = $query . "  DtAbertura,";
            $query = $query . "  DtCadastro,";
            $query = $query . "  Acao)";

            $query = $query . "  VALUES";

            $query = $query . "  ('".$_SESSION['PrefeituraID']."',";
            $query = $query . "  '".$_SESSION['UsuarioID']."',";
            $query = $query . "  '" . $Categoria . "',";
            $query = $query . "  '" . $Subcategoria . "',";
            $query = $query . "  '" . $Titulo . "',";
            $query = $query . "  '" . $nome_final . "',";
            $query = $query . "  '" . $Descricao . "',";
            $query = $query . "  '" . $DtAbertura . "',";
            $query = $query . "  '" . $DtAtualizacao . "',";
            $query = $query . "  '" . $Acao . "')";

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


header("Location: publicacoes_oficiais_ver.php?id=".$Categoria); exit;
?>
