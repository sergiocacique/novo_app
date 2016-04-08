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

function csv2array($csv = array(),  $delimiter = ';'){
    return str_getcsv($csv, $delimiter);
}


function vinculo($key){
    $vinculado = array();
    $orgao = 0;

}
//------------

//Transferir o arquivo


    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<div id='aviso'>Arquivo <strong>{$_FILES['filename']['name']}</strong> transferido com sucesso. </div>";
    }

    $data = date('Y-m-d H:i:s');
    $sql = "INSERT INTO folha (CdPrefeitura,CPF,CdUsuario, Mes, Ano, CodigoEvento, Valor, Cargo, DtCadastro) VALUES ";
    $saldo = 0;
    $saldo2 = 0;
    $csv = array_map('csv2array', file($_FILES['filename']['tmp_name']));

    echo "<div id='mostrar_salva'>";
    foreach ($csv as $key => $dados) {
        if($key > 0){

          //  var_dump($csv);
          //  exit;

            $CdPrefeitura = $_SESSION['PrefeituraID'];
            $CdUsuario = $_SESSION['UsuarioID'];
            $Protocolo = $_POST['protocolo'];
            $CPF1 = $dados[1];


            $totalCaracter = strlen($CPF1);

            if ($totalCaracter == 11){
                $CPF = $CPF1;
            }elseif ($totalCaracter == 10){
                $CPF = "0".$CPF1;
            }elseif ($totalCaracter == 9){
                $CPF = "00".$CPF1;
            }elseif ($totalCaracter == 8){
                $CPF = "000".$CPF1;
            }elseif ($totalCaracter == 7){
                $CPF = "0000".$CPF1;
            }elseif ($totalCaracter == 6){
                $CPF = "00000".$CPF1;
            }elseif ($totalCaracter == 5){
                $CPF = "000000".$CPF1;
            }elseif ($totalCaracter == 4){
                $CPF = "0000000".$CPF1;
            }elseif ($totalCaracter == 3){
                $CPF = "00000000".$CPF1;
            }

            $Mes = $dados[2];
            $Ano = $dados[3];
            $CodigoEvento = $dados[4];
            $Valor = moeda($dados[5]);
            $Cargo = moeda($dados[6]);


            $DtCadastro = date('Y-m-d H:i:s');

            if ($Mes == "01"){
                $Mes = "1";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "02"){
                $Mes = "2";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "03"){
                $Mes = "3";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "04"){
                $Mes = "4";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "05"){
                $Mes = "5";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "06"){
                $Mes = "6";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "07"){
                $Mes = "7";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "08"){
                $Mes = "8";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "09"){
                $Mes = "9";
            }else{
                $Mes = $Mes;
            }


            $sql = $sql.($key == 1? '': ',')."('$CdPrefeitura','$CPF','$CdUsuario','$Mes','$Ano','$CodigoEvento','$Valor','$Cargo','$DtCadastro')";

        }
    }

    mysql_query($sql) or die("Error: ".mysql_error());

    echo "</div>";
    //echo "<div id='saldo'>R$ ".number_format($saldo,2,',','.')." </div>";
//    echo "<div id='botoes'>";
//    echo "<div id='btnCancelar'><a href='convenio.php'>Cancelar envio</a></div>";
//    echo "<div id='btnSalvar'><a href='convenio_salvar.php'>Confirmar envio</a></div>";
//    echo "</div>";



header('Location: contra-cheque-arquivo.php'); exit;
?>
