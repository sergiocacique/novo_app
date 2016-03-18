<?php
include ("conexao.php");
include ("funcao.php");
$id = (string) $_POST['id'];
$CdPrefeitura = (string) $_POST['prefeitura'];


$sqlLinha = mysql_query("SELECT * FROM cpl WHERE id = '".$id."'");
$rsLinha = mysql_fetch_array($sqlLinha);
?>


<section id="ver" class="texto-simples container">

    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 pull-left">
                <h2 class="title title-d"> <strong></strong> </h2>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-4 pull-left">
                <div id="atualiza" class="pull-right hidden-xs">
                    <div class="btn-group">
                        <button type="button" id="dashboardRange" class="btn type-d dropdown-toggle" data-toggle="dropdown">
                            <span>BUSCAR CONTRATOS E LICITAÇÕES</span>
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php
                            $sqlAnos = mysql_query("SELECT * FROM cpl WHERE (CdPrefeitura = ".$CdPrefeitura.") AND Acao = 'Publicado' GROUP BY ano, mes ORDER BY ano DESC, mes DESC ");
                            $Anos = mysql_num_rows($sqlAnos);

                            for ($y = 0; $y < $Anos; $y++){
                                $verAnos = mysql_fetch_array($sqlAnos);
                                ?>
                                <li><a href="javascript:void(0)" onclick="carregaMesAno(<?php echo $verAnos['mes'];?>,<?php echo $verAnos['ano'];?>,<?php echo $verAnos['CdPrefeitura']?>)"><?php echo retorna_mes_extenso($verAnos['mes']);?> / <?php echo $verAnos['ano'];?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <br clear="all">
        </div>
    </div>

    <div class="row">

        <table class="table table-bordered table-striped">
            <colgroup>
                <col class="col-xs-1">
                <col class="col-xs-7">
            </colgroup>

            <tbody>
            <tr>
                <td>Data de Entrada</td>
                <td><?php echo date('d/m/Y', strtotime($rsLinha['DtEntrada']))?></td>
            </tr>
            <tr>
                <td>Número do Processo</td>
                <td><?php echo $rsLinha['Processo']?></td>
            </tr>
            <tr>
                <td>Unidade</td>
                <td><?php echo $rsLinha['Unidade']?></td>
            </tr>
            <tr>
                <td>Fonte</td>
                <td><?php echo $rsLinha['Fonte']?></td>
            </tr>
            <tr>
                <td>Modalidade</td>
                <td><?php echo $rsLinha['Modalidade']?></td>
            </tr>
            <tr>
                <td>Objeto</td>
                <td><?php echo $rsLinha['Objeto']?></td>
            </tr>
            <tr>
                <td>Publicação Diário Oficial</td>
                <td><?php echo  date('d/m/Y', strtotime($rsLinha['DtDOM']))?></td>
            </tr>
            <tr>
                <td>Vencedora</td>
                <td><?php echo $rsLinha['Vencedor']?></td>
            </tr>
            <tr>
                <td>CPNJ / CPF Vencedora</td>
                <td><?php echo $rsLinha['CNPJ']?></td>
            </tr>
            <tr>
                <td>Valor (R$)</td>
                <td><?php echo number_format($rsLinha['Valor'], 2, ',', '.'); ?></td>
            </tr>




            </tbody>
        </table>
    </div>

    <div class="row">

        <table class="table table-bordered table-striped">
            <colgroup>
                <col class="col-xs-7">
            </colgroup>

            <tbody>
            <tr>
                <td colspan="2">EMPRESAS PARTICIPANTES</td>
            </tr>
            <?php
            $sql3 = "SELECT * FROM cpl_empresas WHERE (CdPrefeitura = '".$CdPrefeitura."') AND (Acao = 'Publicado') AND (Processo = '".$rsLinha['Processo']."')";
            $sqlLeis = mysql_query($sql3);


            $Leis = mysql_num_rows($sqlLeis);

            for ($t = 0; $t < $Leis; $t++) {
                $verLeis = mysql_fetch_array($sqlLeis);
            ?>
            <tr>
                <td><?php echo $verLeis['Empresa'];?> <?php echo $verLeis['CNPJ'];?></td>
            </tr>
            <?php
            }
            ?>

            </tbody>
        </table>
    </div>

    <div class="row">

        <table class="table table-bordered table-striped">
            <colgroup>
                <col class="col-xs-3">
            </colgroup>

            <tbody>
            <tr>
                <td colspan="2">ANEXOS</td>
            </tr>

                <tr>
                    <?php
                    $sql4 = "SELECT * FROM cpl_anexo WHERE (CdPrefeitura = '".$CdPrefeitura."') AND (Acao = 'Publicado') AND (Processo = '".$rsLinha['Processo']."')";
                    $sqlLeis1 = mysql_query($sql4);


                    $Leis1 = mysql_num_rows($sqlLeis1);

                    for ($t1 = 0; $t1 < $Leis1; $t1++) {
                    $verLeis1 = mysql_fetch_array($sqlLeis1);
                    ?>
                    <td><a class="btn type-d" title="" href="http://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/pacaraima/processos/<?php echo $verLeis1['Arquivo'];?>" target="_blank"><?php echo $verLeis1['Tipo'];?></a></td>
                    <?php
                    }
                    ?>
                </tr>


            </tbody>
        </table>
    </div>

</section>

