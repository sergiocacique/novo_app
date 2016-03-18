<?php

include ("../conexao.php");
include('funcoes.php');

$SelAno = $_GET['ano'];
$SelMes = $_GET['mes'];
$extensao = $_GET['extensao'];
$Atual = date('d/m/Y H:i:s a', strtotime(date('Y-m-d H:i:s a')));

$sql = "SELECT * FROM cpl WHERE (Acao = 'Publicado') AND DATE_FORMAT(DtAbertura, '%m') = ".$SelMes." AND DATE_FORMAT(DtAbertura, '%Y') = ".$SelAno."";

$sqlGlossario = mysql_query($sql);
$Glossario = mysql_num_rows($sqlGlossario);

$total = 0;

//
//$sql = "SELECT * FROM obras WHERE (Acao = 'Publicado') AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")";
//$query = mysql_query($sql);
//$users = mysql_fetch_assoc($query);
//$rows_users = mysql_num_rows($query);


// INICIAMOS A CRIAÇÃO DA TABELA
    $html = '';
    $html .= '<table border="1">';

    $html .= '<tr>';
    $html .= '<td colspan="13" align="center"><b>BOA VISTA - RR</b><br>PREFEITURA MUNICIPAL DE BOA VISTA<br><br>Periodo: '. retorna_mes_extenso($SelMes).'/'. $SelAno.'</td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td colspan="13">Gerado em :'. $Atual.' </td>';
    $html .= '</tr>';

    $html .= '<tr>';

    $html .= '<td align="center"><b>Processo</b></td>';
    $html .= '<td align="center"><b>Objeto</b></td>';
    $html .= '<td align="center"><b>Dt Entrada</b></td>';
    $html .= '<td align="center"><b>Unidade</b></td>';
    $html .= '<td align="center"><b>Fonte</b></td>';
    $html .= '<td align="center"><b>Modalidade</b></td>';
    $html .= '<td align="center"><b>Dt Abertura</b></td>';
    $html .= '<td align="center"><b>Dt Publicação</b></td>';
    $html .= '<td align="center"><b>Veiculo Publicado</b></td>';
    $html .= '<td align="center"><b>Numero DOM</b></td>';
    $html .= '<td align="center"><b>Situação</b></td>';
    $html .= '<td align="center"><b>Valor (R$)</b></td>';
    $html .= '<td align="center"><b>Empresas Participantes</b></td>';

    $html .= '</tr>';

for ($y = 0; $y < $Glossario; $y++){
    $verGlossario = mysql_fetch_array($sqlGlossario);

    $sqlLinha2 = mysql_query("SELECT * FROM estrutura WHERE CdEstrutura = '".$verGlossario['Orgao']."'");
    $rsLinha2 = mysql_fetch_array($sqlLinha2);

    $sqlModa = mysql_query("SELECT * FROM cpl_modalidade WHERE id = '".$verGlossario['Modalidade']."'");
    $rsModalidade = mysql_fetch_array($sqlModa);

    $sqlSituacao = mysql_query("SELECT * FROM cpl_situacao WHERE id = '".$verGlossario['Situacao']."'");
    $rsSituacao = mysql_fetch_array($sqlSituacao);


    $NumeroProcesso =  $verGlossario["NumeroProcesso"];
    $Descricao =  $verGlossario["Descricao"];
    $DtAbertura =  $verGlossario["DtAbertura"];
    $unidade =  $rsLinha2["Nome"];

    $sql3 = "SELECT * FROM cpl_recursos WHERE (CdCPL = ".$verGlossario['CdCPL'].")";
    $sqlRecurso = mysql_query($sql3);
    $Recurso = mysql_num_rows($sqlRecurso);

    for ($x = 0; $x < $Recurso; $x++){
        $verRecurso = mysql_fetch_array($sqlRecurso);
        $sqlRec = mysql_query("SELECT * FROM cpl_recurso WHERE id = '".$verRecurso['CdRecurso']."'");
        $rsRec = mysql_fetch_array($sqlRec);

        $Recurso = $rsRec['nome']; if ($verGlossario['Descricao'] != ""){ echo "  " .$verGlossario['Descricao']; }
        }

    $Modalidade =  $rsModalidade['nome'];
    $DtAbertura = $verGlossario['DtAbertura'];
    $DtPublicacao = $verGlossario['DtPublicacao'];
    $Veiculo = $verGlossario['Veiculo'];
    $numeroDOM = $verGlossario['numeroDOM'];
    $DtPublicacao = $verGlossario['DtPublicacao'];
    $numeroDOM = $verGlossario['numeroDOM'];
    $situacao = $rsSituacao['nome'];
    $valor_licitacao = $verGlossario['valor_licitacao'];

    $sql2 = "SELECT * FROM cpl_empresa WHERE (CdCPL = ".$verGlossario['CdCPL'].") AND (Acao = 'Publicado')";
    $sqlEmpresa = mysql_query($sql2);
    $Empresa = mysql_num_rows($sqlEmpresa);

    for ($x = 0; $x < $Empresa; $x++) {
        $verEmpresa = mysql_fetch_array($sqlEmpresa);

        $empresas = $verEmpresa['Nome'] . " - " . $verEmpresa['CPFCNPJ'];
    }
    // INFORMAMOS CADA LINHA DE REGISTRO ENCONTRADO
    $html .= '<tr>';

    $html .= '<td align="center">'.$NumeroProcesso.'</td>';
    $html .= '<td align="center">'.$Descricao.'</td>';
    $html .= '<td align="center">'.date('d/m/Y', strtotime($DtAbertura)).'</td>';
    $html .= '<td align="center">'.$unidade.'</td>';
    $html .= '<td align="center">'.$Recurso.'</td>';
    $html .= '<td align="center">'.$Modalidade.'</td>';




    $html .= '<td align="center">'.date('d/m/Y', strtotime($DtAbertura)).'</td>';
    $html .= '<td align="center">'.date('d/m/Y', strtotime($DtPublicacao)).'</td>';
    $html .= '<td align="center">'.$Veiculo.'</td>';
    $html .= '<td align="center">'.$numeroDOM.'</td>';
    $html .= '<td align="center">'.$situacao.'</td>';
    $html .= '<td align="center">'.number_format($valor_licitacao , 2, ',', '.').'</td>';
    $html .= '<td align="center">'.$empresas.'</td>';

    $html .= '</tr>';

}

// Definimos o nome do arquivo que será exportado
    $arquivo = 'contratos_e_licitacoes.'.$extensao;

    // Criamos uma tabela HTML com o formato da planilha

    $html .= '</table>';

    // Configurações header para forçar o download
    header('Content-Description: File Transfer');
    header ("Expires: Mon, 26 Jul 2020 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-type:   application/x-msexcel; charset=utf-8");
    header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
    header ("Content-Description: PHP Generated Data" );
    header ('Content-type: application/force-download');

    // Envia o conteúdo do arquivo
    echo ($html);
    exit;
?>