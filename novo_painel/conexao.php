 <?php
/**
 * Created by PhpStorm.
 * User: serginho cacique
 * Date: 25/08/14
 * Time: 09:19
 */
 ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/www/temp/sessions'));
 //session_save_path('/www/temp/sessions');
ini_set('session.gc_probability', 1);

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Manaus');

 $online = "sim";

//online
//$dbhost="mysql05.hstbr.net"; //nome do servidor que hospeda o banco de dados
//$dbuser="transp_teste";   // usuario do banco de dados
//$dbpasswd="dY3squugbC";   // senha usada para entrar no banco de dados
//$dbname="db_transp_teste";  // nome que você deu ao seu banco de dados

 if ($online == "sim") {
     $dbhost = "servicos.boavista.rr.gov.br"; //nome do servidor que hospeda o banco de dados
     $dbuser = "root";   // usuario do banco de dados
     $dbpasswd = "Pfilho567";   // senha usada para entrar no banco de dados
     $dbname = "db_transparencia";  // nome que você deu ao seu banco de dados
 }else {
//local
     $dbhost = "localhost"; //nome do servidor que hospeda o banco de dados
     $dbuser = "root";   // usuario do banco de dados
     $dbpasswd = "root";   // senha usada para entrar no banco de dados
     $dbname = "db_transparencia";  // nome que você deu ao seu banco de dados
 }
$conexao = @mysql_pconnect($dbhost, $dbuser, $dbpasswd) or die ("Não foi possível conectar-se ao servidor MySQL");
$db = @mysql_select_db($dbname) or die ("Não foi possível selecionar o banco de dados <b>$dbname</b>");
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');


//$UrlAmigavel = "http://".$_SERVER['HTTP_HOST']."/";
$UrlAmigavel = "http://".$_SERVER['HTTP_HOST']."/tras/novo/";
$Pasta = "portal/";

session_start();

?>
