<?php
include ("conexao.php");
include ("funcoes.php");
$id = $_POST['id'];

$totalCaracter = strlen($id);

if ($totalCaracter == 11){
    $CPF = $id;
}elseif ($totalCaracter == 10){
    $CPF = "0".$id;
}elseif ($totalCaracter == 9){
    $CPF = "00".$id;
}elseif ($totalCaracter == 8){
    $CPF = "000".$id;
}elseif ($totalCaracter == 7){
    $CPF = "0000".$id;
}elseif ($totalCaracter == 6){
    $CPF = "00000".$id;
}

$sqlLinha = mysql_query("SELECT * FROM servidor WHERE CdServidor = '".$id."'");
$rsLinha = mysql_fetch_array($sqlLinha);
?>

<section id="ver" class="texto-simples">
    <div class="container">
        <div class="row col-xs-12 col-sm-12 col-md-12">
            <table class="table table-afiliados" summary="Despesas com pessoal">
                <thead>
                <tr>
                    <th class="col-sm-1"><span class="texto-amarelo">Nome</span></th>
                    <th class="col-sm-8"><span class="texto-amarelo"><?php echo $rsLinha['Nome']?></span></th>
                </tr>
                </thead>

                <tbody>

                    <tr>
                        <td><small>CPF</small></td>
                        <td><small><?php echo mask($rsLinha['CPF'],'***.###.###-**')?></small></td>
                    </tr>

                    <tr>
                        <td colspan="2">

                            <small><?php echo $rsLinha['Secretaria']?> - <?php echo $rsLinha['Cargo']?> (<?php echo $rsLinha['CargoComissao']?>)</small>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="texto-simples">
    <div class="container">
        <div class="row col-xs-12 col-sm-12 col-md-12">
            <?php
            $sqlEstrutura1 = "SELECT * FROM servidor WHERE CdPrefeitura = '".$rsLinha['CdPrefeitura']."' AND CPF = '".$rsLinha['CPF']."' AND (Acao = 'Publicado') ORDER BY Ano DESC, Mes DESC LIMIT 12";
            $sqlEstrutura = mysql_query($sqlEstrutura1) or die(mysql_error());
            $contador = mysql_num_rows($sqlEstrutura);
            $linha2 = array();

            for ($x = 0; $x < $contador; $x++){
            $linha = mysql_fetch_array($sqlEstrutura);

            array_push($linha2,$linha);

            ?>
            <a class="btn type-d" onclick="carregaSalario(<?php echo $linha['CdServidor']; ?>)" title="<?php echo retorna_mes_extenso($linha['Mes']);?>/<?php echo $linha['Ano']; ?>" href="javascript:void(0)"><?php echo retorna_mes_extenso($linha['Mes']);?>/<?php echo $linha['Ano']; ?></a>
            <?php } ?>

        </div>
    </div>
</section>

<?php
$sqlSalario = mysql_query("SELECT * FROM servidor WHERE CdPrefeitura = '".$rsLinha['CdPrefeitura']."' AND CPF = '".$rsLinha['CPF']."' AND (Acao = 'Publicado') ORDER BY Ano DESC, Mes DESC");
$rsSalario = mysql_fetch_array($sqlSalario);
?>

<section id="visualizar" class="texto-simples">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
            <h2 class="title title-d"><?php echo retorna_mes_extenso($rsSalario['Mes']);?> <strong><?php echo $rsSalario['Ano']; ?></strong></h2>
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
                <th colspan="2"><span class="texto-amarelo">Remuneração</span></th>
            </tr>
            </thead>

            <tbody>

            <tr>
                <td class="col-sm-8"><small>Remuneração básica bruta</small></td>
                <td class="col-sm-4"><small><?php echo number_format($rsSalario['RemuneracaoBasica'], 2, ',', '.')?></small></td>
            </tr>

            </tbody>

            <thead>
            <tr>
                <th colspan="2"><span class="texto-amarelo">Remuneração eventual</span></th>
            </tr>
            </thead>

            <tbody>

            <tr>
                <td class="col-sm-8"><small>13º Antecipado</small></td>
                <td class="col-sm-4"><small><?php echo number_format($rsSalario['DecimoAdto'], 2, ',', '.')?></small></td>
            </tr>

            <tr>
                <td class="col-sm-8"><small>Férias</small></td>
                <td class="col-sm-4"><small><?php echo number_format($rsSalario['Ferias'], 2, ',', '.')?></small></td>
            </tr>

            <tr>
                <td class="col-sm-8"><small>Outras remunerações eventuais</small></td>
                <td class="col-sm-4"><small>0,00</small></td>
            </tr>

            </tbody>

            <thead>
            <tr class="danger">
                <th colspan="2"><span class="texto-vermelho">Dedução obrigatórias (-)</span></th>
            </tr>
            </thead>

            <tbody>

            <tr>
                <td class="col-sm-8"><small class="texto-vermelho">IRRF (Imposto de Renta Retido na Fonte)</small></td>
                <td class="col-sm-4"><small class="texto-vermelho"> - <?php echo number_format($rsSalario['IRRF'], 2, ',', '.')?></small></td>
            </tr>

            <tr>
                <td class="col-sm-8"><small class="texto-vermelho">INSS (Previdência Oficial)</small></td>
                <td class="col-sm-4"><small class="texto-vermelho"> - <?php echo number_format($rsSalario['INSS'], 2, ',', '.')?></small></td>
            </tr>

            </tbody>

            <?php
            $v1 = $rsSalario['RemuneracaoBasica'];
            $v2 = $rsSalario['DecimoAdto'];
            $v3 = $rsSalario['Ferias'];

            // Desconto
            $v5 = $rsSalario['IRRF'];
            $v6 = $rsSalario['INSS'];
            $v7 = $rsSalario['DecimoINSS'];
            $v8 = $rsSalario['DecimoIRRF'];

            $valGanho = $v1+$v2+$v3;
            $valDesconto = $v5+$v6+$v7+$v8;
            $valTotal = $valGanho-$valDesconto;
            ?>

            <thead>
            <tr class="success">
                <th><span>Total da Remuneração após dedução </span></th>
                <th><span><?php echo number_format($valTotal, 2, ',', '.')?> </span></th>
            </tr>
            </thead>
        </table>
            </div>
    </div>
</section>
