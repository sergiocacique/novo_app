<?php
$diahoje = date('d');
$meshoje = date('m');
$anohoje = date('Y');
$semanahoje = date('w');

if (isset($_POST['ano']) and ($_POST['ano'] != ''))
{
    $SelAno = $_POST['ano'];
    $SelAno = mysql_real_escape_string($SelAno);
}else{
    $SelAno = date('Y');
}

if (isset($_POST['mes']) and ($_POST['mes'] != ''))
{
    $SelMes = $_POST['mes'];
    $SelMes = mysql_real_escape_string($SelMes);
}else{
    $SelMes = date('n');
}

$MesSelecionado = $SelMes;
$AnoSeleciona = $SelAno;



$mesSeguinte = ($MesSelecionado+1);
$anoSeguinte = ($AnoSeleciona);

if($mesSeguinte > 12){
    $mesSeguinte = 1;
    $anoSeguinte = ($AnoSeleciona+1);
}


$mesAnterior = ($MesSelecionado-1);
$anoAnterior = ($AnoSeleciona);

if($mesAnterior == 0){
    $mesAnterior = 12;
    $anoAnterior = ($AnoSeleciona-1);
}

function retorna_mes($MES){
    switch ($MES) {
        case 1 : $MES='Jan'; break;
        case 2 : $MES='Fev';    break;
        case 3 : $MES='Mar';    break;
        case 4 : $MES='Abr';    break;
        case 5 : $MES='Mai';    break;
        case 6 : $MES='Jun';    break;
        case 7 : $MES='Jul';    break;
        case 8 : $MES='Ago';    break;
        case 9 : $MES='Set'; break;
        case 10 : $MES='Out'; break;
        case 11 : $MES='Nov';    break;
        case 12 : $MES='Dez'; break;
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

function formata_data($data)
{
    $data = explode('-', $data);
    $data = $data[2].' de '.retorna_mes_extenso($data[1]).' de '.$data[0];
    return $data;
}

function semana($semana){
    switch ($semana) {

        case 0: $semana = "DOMINGO"; break;
        case 1: $semana = "SEGUNDA FEIRA"; break;
        case 2: $semana = "TERÇA-FEIRA"; break;
        case 3: $semana = "QUARTA-FEIRA"; break;
        case 4: $semana = "QUINTA-FEIRA"; break;
        case 5: $semana = "SEXTA-FEIRA"; break;
        case 6: $semana = "SÁBADO"; break;

    }
    return $semana;
}

function mask($val, $mask)
{
    $maskared = '';
    $k = 0;
    for($i = 0; $i<=strlen($mask)-1; $i++)
    {
        if($mask[$i] == '*')
        {
            $k++;
        }
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


/***
 * Função para remover acentos de uma string
 *
 * @autor Thiago Belem <contato@thiagobelem.net>
 */
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

?>
