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

$anoSeguinteRREO = ($AnoSeleciona+1);
$anoAnteriorRREO = ($AnoSeleciona-1);

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
        case 1 : $MES='JANEIRO'; break;
        case 2 : $MES='FEVEREIRO';    break;
        case 3 : $MES='MARÇO';    break;
        case 4 : $MES='ABRIL';    break;
        case 5 : $MES='MAIO';    break;
        case 6 : $MES='JUNHO';    break;
        case 7 : $MES='JULHO';    break;
        case 8 : $MES='AGOSTO';    break;
        case 9 : $MES='SETEMBRO'; break;
        case 10 : $MES='OUTUBRO'; break;
        case 11 : $MES='NOVEMBRO';    break;
        case 12 : $MES='DEZEMBRO'; break;
    }
    return $MES;
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


function formatarData($data){
    $rData = implode("-", array_reverse(explode("/", trim($data))));
    return $rData;
}

function formatarData2($data){
    $rData = implode("/", array_reverse(explode("-", trim($data))));
    return $rData;
}

function validar_cpf($cpf)
{
    $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
    // Valida tamanho
    if (strlen($cpf) != 11)
        return false;
    // Calcula e confere primeiro dígito verificador
    for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
        $soma += $cpf{$i} * $j;
    $resto = $soma % 11;
    if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
        return false;
    // Calcula e confere segundo dígito verificador
    for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
        $soma += $cpf{$i} * $j;
    $resto = $soma % 11;
    return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
}
?>