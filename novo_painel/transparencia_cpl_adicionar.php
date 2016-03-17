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

    $Secretaria = $_POST['secretaria'];
    $Processo = $_POST['processo'];
    $Valor_contrato = moeda($_POST['valor_contrato']);
    $Situacao = $_POST['situacao'];
    $DtAberturaAntiga = $_POST['dtAbertura'];
    $DtAbertura = implode("-",array_reverse(explode("/",$DtAberturaAntiga)));

    $Publicado = $_POST['publicado'];
    $DtPublicacaoAntiga = $_POST['DtPublicacao'];
    $DtPublicacao = implode("-",array_reverse(explode("/",$DtPublicacaoAntiga)));

    $NumDoc = addslashes($_POST['numDoc']);
    $Finalidade = (isset($_POST['finalidade']))? $_POST['finalidade'] : '';
    $Modalidade = (isset($_POST['modalidade']))? $_POST['modalidade'] : '';

    $Tipo = (isset($_POST['tipo']))? $_POST['tipo'] : '';
    $Objeto = (isset($_POST['objeto']))? $_POST['objeto'] : '';
    $Acao = $_POST['acao'];
    $Protocolo = $_POST['protocolo'];
    $DtAtualizacao = date('Y-m-d H:i:s');



        $query = "INSERT INTO cpl";
        $query = $query . " ( CdPrefeitura,";
        $query = $query . " CdUsuario,";
        $query = $query . " Protocolo,";
        $query = $query . " Orgao,";
        $query = $query . " NumeroProcesso,";
        $query = $query . " valor_licitacao,";
        $query = $query . " Situacao,";
        $query = $query . " DtAbertura,";
        $query = $query . " Veiculo,";
        $query = $query . " DtPublicacao,";
        $query = $query . " numeroDOM,";
        $query = $query . " Finalidade,";
        $query = $query . " Modalidade,";
        $query = $query . " Tipo,";
        $query = $query . " Descricao,";
        $query = $query . " Acao,";
        $query = $query . " DtCadastro)";

        $query = $query . " VALUES";

        $query = $query . " ( '" . $_SESSION['PrefeituraID'] . "',";
        $query = $query . " '" . $_SESSION['UsuarioID'] . "',";
        $query = $query . " '" . $Protocolo . "',";
        $query = $query . " '" . $Secretaria . "',";
        $query = $query . " '" . $Processo . "',";
        $query = $query . " '" . $Valor_contrato . "',";
        $query = $query . " '" . $Situacao . "',";
        $query = $query . " '" . $DtAbertura . "',";
        $query = $query . " '" . $Publicado . "',";
        $query = $query . " '" . $DtPublicacao . "',";
        $query = $query . " '" . $NumDoc . "',";
        $query = $query . " '" . $Finalidade . "',";
        $query = $query . " '" . $Modalidade . "',";
        $query = $query . " '" . $Tipo . "',";
        $query = $query . " '" . $Objeto . "',";
        $query = $query . " '" . $Acao . "',";
        $query = $query . " '" . $DtAtualizacao . "')";

        $verifica = mysql_query($query);


        if($Acao == "Excluido"){
          header('Location: transparencia_cpl.php'); exit;
      }else{
        header("Location: transparencia_cpl_editar.php?protocolo=".$Protocolo.""); exit;
      }
?>
