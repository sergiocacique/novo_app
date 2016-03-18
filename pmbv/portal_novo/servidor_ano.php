
<?php
include ("../conexao.php");
include('funcoes.php');

$CdServidor = $_POST['CdServidor'];
$ano = $_POST['ano'];


$sql = "SELECT * FROM servidor WHERE Acao = 'Publicado' AND CdServidor = '".$CdServidor."' ORDER BY Ano DESC, Mes DESC";

$sqlUlt = mysql_query($sql);
$rsLinha2 = mysql_fetch_array($sqlUlt);

?>

    <div class="text-right col-md-2">
        <div class="btn-group">
            <button type="button" id="dashboardRange" class="btn btn-3d btn-black pull-right dropdown-toggle" data-toggle="dropdown">
                <span><?php echo $ano;?></span>
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="text-left dropdown-menu" role="menu">
                <?php
                $sqlAnos = mysql_query("SELECT * FROM servidor WHERE CPF = '".$rsLinha2['CPF']."' AND (Acao = 'Publicado') GROUP BY Ano ORDER BY Ano DESC");
                $Anos = mysql_num_rows($sqlAnos);

                for ($y = 0; $y < $Anos; $y++){
                    $verAnos = mysql_fetch_array($sqlAnos);
                    ?>
                    <li><a href="javascript:void(0)" onclick="carregaAno(<?php echo $verAnos['Ano'];?>,<?php echo $verAnos['CdServidor'];?>)"><?php echo $verAnos['Ano'];?></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="col-md-10">
    <?php
    $sqlEstrutura = mysql_query("SELECT * FROM servidor WHERE Ano = ".$ano." AND CPF = '".$rsLinha2['CPF']."' AND (Acao = 'Publicado') ORDER BY Ano DESC, Mes DESC");
    $contador = mysql_num_rows($sqlEstrutura);
    $linha2 = array();
    for ($x = 0; $x < $contador; $x++){
    $linha = mysql_fetch_array($sqlEstrutura);

    array_push($linha2,$linha);

    ?>

    <?PHP
        if ($linha['DecimoFinal'] != '0.00'){

            $decimo1 = " - 2º parc. 13º";
        }elseif ($linha['DecimoAdto'] == '0.00'){
            $decimo1 = "";
        }else{
            $decimo1 = " - 1º parc. 13º";
        }


    ?>
    <a class="btn btn-primary" type="button" onclick="salario(<?php echo $linha['CdServidor'];?>)"><?php echo retorna_mes_extenso($linha['Mes']);?> <?php echo $decimo1 ?></a>
    <?php } ?>
    </div>
