<?php
include ("conexao.php");
include ("funcao.php");
$ano = (string) $_POST['ano'];
$CdPrefeitura = (string) $_POST['prefeitura'];


$sqlLinha = mysql_query("SELECT * FROM receitas WHERE (tipo = 'prevista') AND (CdPrefeitura = '".$CdPrefeitura."') AND (ano = '".$ano."')");
$rsLinha = mysql_fetch_array($sqlLinha);
?>

<section class="texto-simples">
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 pull-left">
                <h2 class="title title-d"> <strong></strong> <?php echo $rsLinha['ano']; ?></h2>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-4 pull-left">
                <div id="atualiza" class="pull-right hidden-xs">
                    <div class="btn-group">
                        <button type="button" id="dashboardRange" class="btn type-d dropdown-toggle" data-toggle="dropdown">
                            <span>BUSCAR RECEITAS</span>
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php
                            $sql3 = "SELECT * FROM receitas WHERE (Categoria = 'arrecadada') AND (Acao = 'Publicado') AND (CdPrefeitura = '".$CdPrefeitura."') GROUP BY Ano, Mes ORDER BY Ano DESC, Mes DESC";
                            $sqlAnos = mysql_query($sql3);
                            $Anos = mysql_num_rows($sqlAnos);

                            for ($y = 0; $y < $Anos; $y++){
                                $verAnos = mysql_fetch_array($sqlAnos);
                                ?>
                                <li><a href="javascript:void(0)" onclick="carregaMesAnoArrecadada(<?php echo $verAnos['Mes'];?>,<?php echo $verAnos['Ano'];?>,<?php echo $verAnos['CdPrefeitura']?>)"><?php echo retorna_mes_extenso($verAnos['Mes']);?> / <?php echo $verAnos['Ano'];?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="ver" class="texto-simples container">
    <div class="row">
        <table class="table table-afiliados" summary="Despesas com pessoal">
            <thead>
            <tr>
                <th>DATA</th>
                <th>DOCUMENTO</th>
                <th>CÓDIGO</th>
                <th>ESPECIFICAÇÃO</th>
                <th>ARRECADADO (R$)</th>
            </tr>
            </thead>
            <tbody>
        <?php
        $sqlLeis = mysql_query("SELECT * FROM receitas WHERE (Categoria = 'arrecadada') AND (Acao = 'Publicado') AND (CdPrefeitura = '".$CdPrefeitura."') AND (Ano = '".$ano."') ORDER BY DtCadastro DESC");
        $Leis = mysql_num_rows($sqlLeis);

        for ($y = 0; $y < $Leis; $y++){
            $verLeis = mysql_fetch_array($sqlLeis);
            ?>
            <tr>
                <td><?php echo date('d/m/Y', strtotime($verLeis['DtCadastro']));?></td>
                <td><?php echo $verLeis['documento'];?></td>
                <td><?php echo $verLeis['codigo'];?></td>
                <td><?php echo $verLeis['especificacao'];?></td>
                <td><?php echo number_format($verLeis['arrecadado'], 2, ',', '.');?></td>
            </tr>
        <?php
        }
        ?>
            </tbody>
            </table>
    </div>
</section>
