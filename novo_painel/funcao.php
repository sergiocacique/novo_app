<?php
$diahoje = date('d');
$meshoje = date('m');
$anohoje = date('Y');
$semanahoje = date('w');

// Função de porcentagem: Quanto é X% de N?
function porcentagem_xn ( $porcentagem, $total ) {
    return ( $porcentagem / 100 ) * $total;
}

// Função de porcentagem: N é X% de N
function porcentagem_nx ( $valor, $total ) {
    return ( $valor * 100 ) / $total;
}

// Função de porcentagem: N é N% de X
function porcentagem_nnx ( $parcial, $porcentagem ) {
    return ( $parcial / $porcentagem ) * 100;
}

function retorna_mes($MES){
    switch ($MES) {
        case 1 : $MES='Janeiro'; break;
        case 2 : $MES='Fevereiro';    break;
        case 3 : $MES='Março';    break;
        case 4 : $MES='Abril';    break;
        case 5 : $MES='Maio';    break;
        case 6 : $MES='Junho';    break;
        case 7 : $MES='Julho';    break;
        case 8 : $MES='Agosto';    break;
        case 9 : $MES='Setembro'; break;
        case 10 : $MES='Outubro'; break;
        case 11 : $MES='Novembro';    break;
        case 12 : $MES='Dezembro'; break;
    }
    return $MES;
}

function retorna_mes_extenso($MES){
    switch ($MES) {
        case 1 : $MES='Janeiro'; break;
        case 2 : $MES='Fevereiro';    break;
        case 3 : $MES='Março';    break;
        case 4 : $MES='Abril';    break;
        case 5 : $MES='Maio';    break;
        case 6 : $MES='Junho';    break;
        case 7 : $MES='Julho';    break;
        case 8 : $MES='Agosto';    break;
        case 9 : $MES='Setembro'; break;
        case 10 : $MES='Outubro'; break;
        case 11 : $MES='Novembro';    break;
        case 12 : $MES='Dezembro'; break;
    }
    return $MES;
}

function mask($val, $mask)
{
    $maskared = '';
    $k = 0;
    for($i = 0; $i<=strlen($mask)-1; $i++)
    {
        if($mask[$i] == '#')
        {
            if(isset($val[$k]))
                $maskared .= $val[$k++];
        }
        else
        {
            if(isset($mask[$i]))
                $maskared .= $mask[$i];
        }
    }
    return $maskared;
}

function auditoria($request,$acao){
    $Usuario = $_SESSION['Usuario'];
    $IP = $_SERVER["REMOTE_ADDR"];
    $DtCadastro = date('Y-m-d H:i:s');
    $NomeArquivo = $_SERVER['REQUEST_URI'];
    $Parametro = json_encode($request);

    $salvar = mysql_query("INSERT INTO auditoria (Usuario,Descricao,IP,DtCadastro,NomeArquivo,Parametro) VALUES ('".$Usuario."','".$acao."','".$IP."','".$DtCadastro."','".$NomeArquivo."','".$Parametro."')") or die("erro ao selecionar");
}

function notificacao($grupo,$titulo,$descricao,$usuario,$acao){
    $DtCadastro = date('Y-m-d H:i:s');

    $salvar = mysql_query("INSERT INTO notificacao (DtCadastro,Titulo,Descricao,Usuario) VALUES ('".$DtCadastro."','".$titulo."','".$descricao."','".$usuario."')") or die("erro ao selecionar");


    $sqlLinha = mysql_query("SELECT * FROM notificacao WHERE DtCadastro = '".$DtCadastro."'");
    $rsLinha2 = mysql_fetch_array($sqlLinha);



    $sqlEstrutura = mysql_query("SELECT * FROM grupo_relacao WHERE grupo1 = '".$grupo."' AND acao = '".$acao."'") or die(mysql_error());
    $contador = mysql_num_rows($sqlEstrutura);
    for ($i = 0; $i < $contador; $i++){
        $linhas = mysql_fetch_array($sqlEstrutura);

        $sqlEstrutura2 = mysql_query("SELECT * FROM admin WHERE CdGrupo = '".$linhas['grupo2']."'") or die(mysql_error());
        $contador2 = mysql_num_rows($sqlEstrutura2);
        for ($x = 0; $x < $contador2; $x++) {
            $linhas3 = mysql_fetch_array($sqlEstrutura2);
            $salvar2 = mysql_query("INSERT INTO notificacao_usuario (CdUsuario,CdNotificacao,Lido) VALUES ('" . $linhas3['CdUsuario'] . "','" . $rsLinha2['id'] . "','nao')") or die("erro ao selecionar");
        }
    }

    $sqlEstrutura = mysql_query("SELECT * FROM admin WHERE CdGrupo = '".$grupo."'") or die(mysql_error());
    $contador = mysql_num_rows($sqlEstrutura);
    for ($i = 0; $i < $contador; $i++){
        $linhas = mysql_fetch_array($sqlEstrutura);
        $salvar2 = mysql_query("INSERT INTO notificacao_usuario (CdUsuario,CdNotificacao,Lido) VALUES ('".$linhas['CdUsuario']."','".$rsLinha2['id']."','nao')") or die("erro ao selecionar");
    }
}


function moeda($get_valor) {
    $source = array('.', ',');
    $replace = array('', '.');
    $valor = str_replace($source, $replace, $get_valor);
    return $valor;
}

function dump($objeto){
    echo "<pre>";
    var_dump($objeto);
    echo "</pre>";
}

function formatarData($data){
    $rData = implode("-", array_reverse(explode("/", trim($data))));
    return $rData;
}

function formatarData2($data){
    $rData = implode("/", array_reverse(explode("-", trim($data))));
    return $rData;
}

function removeAcentos($string, $slug = false) {
    $string = strtolower($string);

    // Código ASCII das vogais
    $ascii['a'] = range(224, 230);
    $ascii['e'] = range(232, 235);
    $ascii['i'] = range(236, 239);
    $ascii['o'] = array_merge(range(242, 246), array(240, 248));
    $ascii['u'] = range(249, 252);

    // Código ASCII dos outros caracteres
    $ascii['b'] = array(223);
    $ascii['c'] = array(231);
    $ascii['d'] = array(208);
    $ascii['n'] = array(241);
    $ascii['y'] = array(253, 255);

    foreach ($ascii as $key=>$item) {
        $acentos = '';
        foreach ($item AS $codigo) $acentos .= chr($codigo);
        $troca[$key] = '/['.$acentos.']/i';
    }

    $string = preg_replace(array_values($troca), array_keys($troca), $string);

    // Slug?
    if ($slug) {
        // Troca tudo que não for letra ou número por um caractere ($slug)
        $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
        // Tira os caracteres ($slug) repetidos
        $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
        $string = trim($string, $slug);
    }

    return $string;
}


/**
 * Função para gerar senhas aleatórias
 *
 * @param integer $tamanho Tamanho da senha a ser gerada
 * @param boolean $maiusculas Se terá letras maiúsculas
 * @param boolean $numeros Se terá números
 * @param boolean $simbolos Se terá símbolos
 *
 * @return string A senha gerada
 * // Gera uma senha com 10 carecteres: letras (min e mai), números
 *   $senha = geraSenha(10);
 * //  gfUgF3e5m7

 * // Gera uma senha com 9 carecteres: letras (min e mai)
 *  $senha = geraSenha(9, true, false);
 * // BJnCYupsN

 * // Gera uma senha com 6 carecteres: letras minúsculas e números
 *  $senha = geraSenha(6, false, true);
 * // sowz0g

 * // Gera uma senha com 15 carecteres de números, letras e símbolos
 *  $senha = geraSenha(15, true, true, true);
 * // fnwX@dGO7P0!iWM
 */
function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
    $lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%*-';
    $retorno = '';
    $caracteres = '';

    $caracteres .= $lmin;
    if ($maiusculas) $caracteres .= $lmai;
    if ($numeros) $caracteres .= $num;
    if ($simbolos) $caracteres .= $simb;

    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
        $rand = mt_rand(1, $len);
        $retorno .= $caracteres[$rand-1];
    }
    return $retorno;
}

function twitter_time($a) {
    //get current timestampt
    $b = strtotime("now");
    //get timestamp when tweet created
    $c = strtotime($a);
    //get difference
    $d = $b - $c;
    //calculate different time values
    $minute = 60;
    $hour = $minute * 60;
    $day = $hour * 24;
    $week = $day * 7;

    if(is_numeric($d) && $d > 0) {
        //if less then 3 seconds
        if($d < 3) return "agora mesmo";
        //if less then minute
        if($d < $minute) return floor($d) . " segundos atrás";
        //if less then 2 minutes
        if($d < $minute * 2) return "1 minuto atrás";
        //if less then hour
        if($d < $hour) return floor($d / $minute) . " minutos atrás";
        //if less then 2 hours
        if($d < $hour * 2) return "1 hora atrás";
        //if less then day
        if($d < $day) return floor($d / $hour) . " horas atrás";
        //if more then day, but less then 2 days
        if($d > $day && $d < $day * 2) return "ontem";
        //if less then year
        if($d < $day * 365) return floor($d / $day) . " dias atrás";
        //else return more than a year
        return "mais de um ano atrás";
    }
}