<?php
include ("conexao.php");
include ("funcoes.php");
$CdServidor = (string) $_POST['id'];


$sqlSalario = mysql_query("SELECT * FROM servidor WHERE CdServidor = '".$CdServidor."' AND (Acao = 'Publicado') ORDER BY Ano DESC, Mes DESC");
$rsSalario = mysql_fetch_array($sqlSalario);
?>

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
