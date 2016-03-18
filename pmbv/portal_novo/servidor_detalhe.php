
<?php
include ("../conexao.php");
include('funcoes.php');

$CdServidor = $_POST['id'];


if (isset($ano) and ($ano != '')){
    $ano = mysql_real_escape_string($ano);
}elseif (isset($mes) and ($mes != '')){
    $mes = mysql_real_escape_string($mes);
}elseif (isset($objeto) and ($objeto != '')){
    $objeto = mysql_real_escape_string($objeto);
}


$sql = "SELECT * FROM servidor WHERE Acao = 'Publicado' AND CdServidor = '".$CdServidor."' ORDER BY Ano DESC, Mes DESC";


$sqlUlt = mysql_query($sql);
$rsLinha2 = mysql_fetch_array($sqlUlt);
$conta = mysql_num_rows($sqlUlt);

$sqlLinha5 = mysql_query("SELECT * FROM servidor WHERE Acao = 'Publicado' AND CPF = '".$rsLinha2['CPF']."' ORDER BY Ano DESC, Mes DESC");
$rsLinha5 = mysql_fetch_array($sqlLinha5);
?>
<div id="resultado" class="help-block text-center">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php if ($conta != '0'){ ?>
                    <div class="profile-header clearfix text-left">
                        <div class="profile-avatar kit-avatar kit-avatar-128 border-transparent pull-left">
                        </div>
                        <h4 class="content-title text-primary"><?php echo $rsLinha2['Nome'];?> - <small><?php echo mask($rsLinha2['CPF'],'***.###.###-**');?></small></h4>
                        <div class="profile-data">
                            <?php echo $rsLinha2['Secretaria'];?>
                            <br>
                            <?php echo $rsLinha2['Cargo'];?> (<?php echo $rsLinha2['CargoComissao'];?>)<br>
                            <small><?php echo $rsLinha2['Orgao'];?></small>

                        </div>
                        <hr>
                        <div id="anos" class="col-md-12">

                            <div class="text-right col-md-2">
                                <div class="btn-group">
                                    <button type="button" id="dashboardRange" class="btn btn-3d btn-black pull-right dropdown-toggle" data-toggle="dropdown">
                                        <span>ANO</span>
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
                            $sqlEstrutura = mysql_query("SELECT * FROM servidor WHERE Ano = ".$rsLinha5['Ano']." AND CPF = '".$rsLinha2['CPF']."' AND (Acao = 'Publicado') ORDER BY Ano DESC, Mes DESC");
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
                        </div>
                        <hr>
                        <section id="visualizar" class="texto-simples">
                            <div class="container">
                                <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
                                    <h2 class="title title-d">
                                        <?php echo retorna_mes_extenso($rsLinha5['Mes']);?>
                                        <strong><?php echo $rsLinha5['Ano'];?></strong>
                                    </h2>
                                </div>
                                <div class="mar-40 col-xs-12 col-sm-12 col-md-12">
                                    <div class="divisor divisor-c">
                                        <span> </span>
                                    </div>
                                </div>
                                <div class="mar-40 col-xs-9 col-sm-9 col-md-9">
                                    <table class="table table-afiliados" summary="Despesas com pessoal">
                                        <thead>
                                        <tr>
                                            <th colspan="2">
                                                <span class="texto-amarelo">Remuneração</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="col-sm-8">
                                                <small>Remuneração básica bruta</small>
                                            </td>
                                            <td class="col-sm-4">
                                                <small><?php echo number_format($rsLinha5['RemuneracaoBasica'], 2, ',', '.');?></small>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <thead>
                                        <tr>
                                            <th colspan="2">
                                                <span class="texto-amarelo">Remuneração eventual</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="col-sm-8">
                                                <small>13º Antecipado</small>
                                            </td>
                                            <td class="col-sm-4">
                                                <small><?php echo number_format($rsLinha5['DecimoAdto'], 2, ',', '.');?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-8">
                                                <small>Férias</small>
                                            </td>
                                            <td class="col-sm-4">
                                                <small><?php echo number_format($rsLinha5['Ferias'], 2, ',', '.');?></small>
                                            </td>
                                        </tr>

                                        </tbody>
                                        <thead>
                                        <tr class="danger">
                                            <th colspan="2">
                                                <span class="texto-vermelho">Dedução obrigatórias (-)</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="col-sm-8">
                                                <small class="texto-vermelho">IRRF (Imposto de Renta Retido na Fonte)</small>
                                            </td>
                                            <td class="col-sm-4">
                                                <small class="texto-vermelho"> - <?php echo number_format($rsLinha5['IRRF'], 2, ',', '.');?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-8">
                                                <small class="texto-vermelho">INSS (Previdência Oficial)</small>
                                            </td>
                                            <td class="col-sm-4">
                                                <small class="texto-vermelho"> - <?php echo number_format($rsLinha5['INSS'], 2, ',', '.');?></small>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <thead>
                                        <?php
                                        $v1 = $rsLinha5['RemuneracaoBasica'];
                                        $v2 = $rsLinha5['DecimoAdto'];
                                        $v3 = $rsLinha5['Ferias'];

                                        // Desconto
                                        $v5 = $rsLinha5['IRRF'];
                                        $v6 = $rsLinha5['INSS'];
                                        $v8 = $rsLinha5['DecimoFinal'];
                                        $v9 = $rsLinha5['DecimoINSS'];
                                        $v10 = $rsLinha5['DecimoIRRF'];

                                        $valGanho = $v1;
                                        $valDesconto = $v5+$v6+$v8+$v9+$v10;
                                        $valTotal = $valGanho-$valDesconto;

                                        $dataDisponivel = $rsLinha5['DtAtualizacao'];

                                        //list($ano, $mes, $dia) = explode("-", $dataDisponivel);

                                        ?>
                                        <tr class="success">
                                            <th>
                                                <span>Total da Remuneração após dedução </span>
                                            </th>
                                            <th>
                                                <span><?php echo number_format($valTotal, 2, ',', '.');?> </span>
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                        </section>
                    </div>

                <?php
                }else{?>
                    <div class="callout callout-warning">
                        <h4>Servidor Não foi encontrado</h4>
                        <p>
                            <code></code>

                        </p>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>