<?php
include ("conexao.php");
include ("funcao.php");
$id = (string) $_POST['id'];
$CdPrefeitura = (string) $_POST['prefeitura'];


$sqlLinha = mysql_query("SELECT * FROM convenios WHERE id = '".$id."'");
$rsLinha = mysql_fetch_array($sqlLinha);
?>


<section id="ver" class="texto-simples container">
    <div class="row">

        <table class="table table-afiliados" summary="Despesas com pessoal">
            <thead>
            <tr>
                <th class="col-sm-8"><span class="texto-amarelo"><?php echo $rsLinha['nunSIAFI']?> - <?php echo $rsLinha['objeto']?></span></th>
            </tr>
            </thead>


        </table>

        <table class="table table-bordered table-striped">
            <colgroup>
                <col class="col-xs-1">
                <col class="col-xs-7">
            </colgroup>

            <tbody>
            <tr>
                <td>SIAFI</td>
                <td><a href="https://www.convenios.gov.br/siconv/ConsultarProposta/ResultadoDaConsultaDeConvenioSelecionarConvenio.do?sequencialConvenio=<?php echo $rsLinha['nunSIAFI']?>&Usr=guest&Pwd=guest" target="_blank"> <?php echo $rsLinha['nunSIAFI']?></a>
                    <small><span class="text-muted">(Redireciona para o Portal Convênios – SICONV)</span></small></td>
            </tr>
            <tr>
                <td>Orgão</td>
                <td><?php echo $rsLinha['orgao']?></td>
            </tr>
            <tr>
                <td>Objeto</td>
                <td><?php echo $rsLinha['objeto']?></td>
            </tr>
            <tr class="info">
                <td colspan="2">

                    <table class="table table-bordered table-striped">
                        <colgroup>
                            <col class="col-xs-6">
                            <col class="col-xs-6">
                        </colgroup>

                        <tbody>
                        <tr>
                            <td colspan="2">Concedente</td>
                        </tr>
                        <tr>
                            <td>Aprovado</td>
                            <td>Liberado</td>
                        </tr>
                        <tr>
                            <td><?php echo number_format($rsLinha['aprovado'], 2, ',', '.'); ?></td>
                            <td><?php echo number_format($rsLinha['liberado'], 2, ',', '.'); ?></td>
                        </tr>

                        </tbody>
                    </table>

                </td>
            </tr>
            <tr>
                <td>Início da Vigência</td>
                <td><?php
                    if($rsLinha['InicioVigencia'] != "") {
                        echo date('d/m/Y', strtotime($rsLinha['InicioVigencia']));
                    }else{
                        echo "**";
                    }?></td>
            </tr>
            <tr>
                <td>Fim da Vigência</td>
                <td><?php
                    if($rsLinha['FimVigencia'] != "") {
                        echo date('d/m/Y', strtotime($rsLinha['FimVigencia']));
                    }else{
                        echo "**";
                    }?></td>
            </tr>
            <tr>
                <td>Publicação</td>
                <td><?php
                    if($rsLinha['Publicacao'] != "") {
                        echo date('d/m/Y', strtotime($rsLinha['Publicacao']));
                    }else{
                        echo "**";
                    }?></td>
            </tr>
            <tr>
                <td>Contrapartida</td>
                <td><?php echo number_format($rsLinha['Contrapartida'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Prorrogação solicitada</td>
                <td><?php echo $rsLinha['prorrogacao']?></td>
            </tr>

            <tr>
                <td>Execução</td>
                <td><?php echo $rsLinha['execucao']?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?php echo $rsLinha['estatus']?></td>
            </tr>
            <tr>
                <td>Obs</td>
                <td><?php echo $rsLinha['observacao']?></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="col-md-8 mar-20">
        <a class="btn type-d" title="voltar" href="javascript:void(0)" onclick="carregaMesAno(<?php echo $rsLinha['mes']?>,<?php echo $rsLinha['ano'];?>,<?php echo $rsLinha['CdPrefeitura'];?>)">VOLTAR</a>
    </div>

</section>

