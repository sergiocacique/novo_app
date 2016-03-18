<?php
include ("conexao.php");
include ("funcao.php");
$mes = (string) $_POST['mes'];
$ano = (string) $_POST['ano'];
$CdPrefeitura = (string) $_POST['prefeitura'];


//$sqlLinha = mysql_query("SELECT * FROM receita WHERE (tipo = 'arrecadada') AND (CdPrefeitura = '".$CdPrefeitura."') AND (mes = '".$mes."') AND (ano = '".$ano."')");
//$rsLinha = mysql_fetch_array($sqlLinha);
?>

<section class="texto-simples">
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 pull-left">
                <h2 class="title title-d"> <strong></strong> <?php echo $rsLinha['Ano']; ?></h2>
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
                            $sql3 = "SELECT * FROM receitas WHERE (Categoria = 'prevista') AND (Acao = 'Publicado') AND (CdPrefeitura = '".$CdPrefeitura."') GROUP BY Ano, Mes ORDER BY Ano DESC, Mes DESC";
                            $sqlAnos = mysql_query($sql3);
                            $Anos = mysql_num_rows($sqlAnos);

                            for ($y = 0; $y < $Anos; $y++){
                                $verAnos = mysql_fetch_array($sqlAnos);
                                ?>
                                <li><a href="javascript:void(0)" onclick="carregaMesAnoExtra(<?php echo $verAnos['Mes'];?>,<?php echo $verAnos['Ano'];?>,<?php echo $verAnos['CdPrefeitura']?>)"><?php echo retorna_mes_extenso($verAnos['Mes']);?> / <?php echo $verAnos['Ano'];?></a></li>
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
                <th>SUBCONTA</th>
                <th>NOME DA SUBCONTA</th>
                <th>CONTRIBUINTE</th>
                <th>ARRECADADO</th>
            </tr>
            </thead>
            <tbody>
        <?php
        $sqlLeis = mysql_query("SELECT * FROM receitas WHERE (Categoria = 'extra') AND (CdPrefeitura = '".$CdPrefeitura."') AND  (Ano = '".$ano."')");
        $Leis = mysql_num_rows($sqlLeis);

        for ($y = 0; $y < $Leis; $y++){
            $verLeis = mysql_fetch_array($sqlLeis);
            ?>
            <tr>
                <td><?php echo date('d/m/Y', strtotime($verLeis['data']));?></td>
                <td><?php echo $verLeis['subconta'];?></td>
                <td><?php echo $verLeis['nomeSubConta'];?></td>
                <td><?php echo $verLeis['contribuinte'];?></td>
                <td><?php echo number_format($verLeis['arrecadado'], 2, ',', '.');?></td>
            </tr>
        <?php
        }
        ?>
            </tbody>
            </table>
    </div>
</section>
