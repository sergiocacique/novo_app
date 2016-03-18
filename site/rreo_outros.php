<?php
include ("conexao.php");
include ("funcao.php");


    $CdPrefeitura = $_POST['prefeitura'];
    $Ano = $_POST['Ano'];
    $Pasta = $_POST['Pasta'];


    $sqlDespesa = mysql_query("SELECT * FROM rreo WHERE CdPrefeitura = '".$CdPrefeitura."' AND ( Ano = ".$Ano.") AND ( Bim = '".$Pasta."')  AND Acao = 'Publicado'");
    $rsDespe = mysql_fetch_array($sqlDespesa);
    $ContaDespe = mysql_num_rows($sqlDespesa);

$Prefi = mysql_query("SELECT * FROM prefeitura WHERE CdPrefeitura = '".$CdPrefeitura."'");
$verPrefi = mysql_fetch_array($Prefi);

?>
<div class="container">
    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8 pull-left">
            <h2 class="title title-d"> <strong><?php echo ($rsDespe['Bimestre']); ?></strong> <?php echo $rsDespe['Ano']; ?></h2>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 pull-left">
            <div id="atualiza" class="pull-right hidden-xs">
                <div class="btn-group">
                    <button type="button" id="dashboardRange" class="btn type-d dropdown-toggle" data-toggle="dropdown">
                        <span>BUSCAR RREO / RGF</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        $sqlAnos = mysql_query("SELECT * FROM rreo WHERE (CdPrefeitura = ".$CdPrefeitura.") GROUP BY Ano, Bimestre ORDER BY Ano DESC, Bimestre DESC ");
                        $Anos = mysql_num_rows($sqlAnos);

                        for ($y = 0; $y < $Anos; $y++){
                            $verAnos = mysql_fetch_array($sqlAnos);
                            ?>
                            <li><a href="javascript:void(0)" onclick="carregaRREO(<?php echo $verAnos['Bim'];?>,<?php echo $verAnos['Ano'];?>,<?php echo $CdPrefeitura?>)"><?php echo ($verAnos['Bimestre']);?> / <?php echo $verAnos['Ano'];?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php
    $sql = "SELECT * FROM rreo WHERE CdPrefeitura = '".$CdPrefeitura."' AND Acao = 'Publicado' AND ( Ano = ".$Ano.") AND ( Bim = '".$Pasta."')";
    $sqlLeis = mysql_query($sql);
    $Leis = mysql_num_rows($sqlLeis);

    for ($y = 0; $y < $Leis; $y++){
        $verLeis = mysql_fetch_array($sqlLeis);
        ?>
        <div class="col-xs-6 col-md-4 ">
            <div class="item-para-download">
                <div class="descricao">
                    <h3 class="text-center"><?php echo $verLeis['Nome'];?> </h3>
                </div>
                <div class="link-de-download">
                    <p class="text-center">
                        <a class="btn type-d" title="" href="http://arquivo.minhaprefeitura.com.br/municipio/<?php echo $verPrefi['Pasta'];?>/anexo/rreo/<?php echo $verLeis['Ano'];?>/<?php echo $verLeis['Pasta'];?>/<?php echo $verLeis['Arquivo'];?>" target="_blank">VISUALIZAR</a>
                    </p>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>