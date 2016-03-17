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
    $CdCPL = $_POST['CdCPL'];
    $DtAtualizacao = date('Y-m-d H:i:s');



        $query = "UPDATE cpl SET";

        $query = $query . " Orgao = '" . $Secretaria . "',";
        $query = $query . " NumeroProcesso = '" . $Processo . "',";
        $query = $query . " valor_licitacao = '" . $Valor_contrato . "',";
        $query = $query . " Situacao = '" . $Situacao . "',";
        $query = $query . " DtAbertura = '" . $DtAbertura . "',";
        $query = $query . " Veiculo = '" . $Publicado . "',";
        $query = $query . " DtPublicacao = '" . $DtPublicacao . "',";
        $query = $query . " numeroDOM = '" . $NumDoc . "',";
        $query = $query . " Finalidade = '" . $Finalidade . "',";
        $query = $query . " Modalidade = '" . $Modalidade . "',";
        $query = $query . " Tipo = '" . $Tipo . "',";
        $query = $query . " Descricao  ='" . $Objeto . "',";
        $query = $query . " Acao = '" . $Acao . "',";
        $query = $query . " DtAtualizacao = '" . $DtAtualizacao . "'";

        $query = $query . " WHERE";

        $query = $query . " CdCPL = '" . $CdCPL . "'";

        $verifica = mysql_query($query);


        if($Acao == "Excluido"){
          header('Location: transparencia_cpl.php'); exit;
      }else{
        header("Location: transparencia_cpl_editar.php?contrato=".$CdCPL.""); exit;
      }
?>
