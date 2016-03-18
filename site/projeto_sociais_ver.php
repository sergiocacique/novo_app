<?php
include ("conexao.php");
include ("funcao.php");
$id = (string) $_POST['id'];
$CdPrefeitura = (string) $_POST['prefeitura'];


$sqlLinha = mysql_query("SELECT * FROM projetos_sociais WHERE id = '".$id."'");
$rsLinha = mysql_fetch_array($sqlLinha);
?>


<section id="ver" class="texto-simples container">
    <div class="row">

        <table class="table table-afiliados" summary="Despesas com pessoal">
            <thead>
            <tr>
                <th class="col-sm-1"><span class="texto-amarelo">Nome</span></th>
                <th class="col-sm-8"><span class="texto-amarelo"><?php echo $rsLinha['servico']?></span></th>
            </tr>
            </thead>


        </table>

        <table class="table table-bordered table-striped">
            <colgroup>
                <col class="col-xs-6">
                <col class="col-xs-6">
            </colgroup>

            <tbody>
            <tr>
                <td>SERVIÇOS SOCIOASSISTENCIAIS</td>
                <td><?php echo $rsLinha['servico']?></td>
            </tr>
            <tr>
                <td>PÚBLICO BENEFICIADO/ REFERENCIADO</td>
                <td><?php echo $rsLinha['publico']?></td>
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
                            <td colspan="2">BOLSISTAS</td>
                        </tr>
                        <tr>
                            <td>QUANT.</td>
                            <td>VALOR (R$)</td>
                        </tr>
                        <tr>
                            <td><?php echo $rsLinha['bolsista_qtd']?></td>
                            <td><?php echo number_format($rsLinha['bolsista_valor'], 2, ',', '.')?></td>
                        </tr>

                        </tbody>
                    </table>

                </td>
            </tr>
            <tr>
                <td>OUTRAS DESPESAS (R$)</td>
                <td><?php echo number_format($rsLinha['outras_despesas'], 2, ',', '.')?></td>
            </tr>
            <tr class="info">
                <td colspan="2">

                    <table class="table table-bordered table-striped">
                        <colgroup>
                            <col class="col-xs-4">
                            <col class="col-xs-4">
                            <col class="col-xs-4">
                        </colgroup>

                        <tbody>
                        <tr>
                            <td colspan="3">FONTE FINANCIAMENTO</td>
                        </tr>
                        <tr>
                            <td>CONVÊNIO (R$)</td>
                            <td>FNAS (R$)</td>
                            <td>RECURSO PRÓPRIO (R$)</td>
                        </tr>
                        <tr>
                            <td><?php echo number_format($rsLinha['convenio'], 2, ',', '.')?></td>
                            <td><?php echo number_format($rsLinha['FNAS'], 2, ',', '.')?></td>
                            <td><?php echo number_format($rsLinha['recurso_proprio'], 2, ',', '.')?></td>
                        </tr>

                        </tbody>
                    </table>

                </td>
            </tr>
            <tr>
                <td>TOTAL (R$)</td>
                <td><?php echo number_format($rsLinha['total'], 2, ',', '.')?></td>
            </tr>

            <tr>
                <td>OBSERVAÇÃO</td>
                <td><?php echo $rsLinha['obs']?></td>
            </tr>
            </tbody>
        </table>
    </div>
</section>

<section id="ver" class="texto-simples">
    <div class="container">
        <table class="table table-afiliados" summary="Despesas com pessoal">

            <tbody>
            <?php
            $sqlGlossario = mysql_query("SELECT * FROM projetos_sociais WHERE CdPrefeitura = '".$CdPrefeitura."' AND Acao = 'Publicado'");
            $Glossario = mysql_num_rows($sqlGlossario);

            for ($y = 0; $y < $Glossario; $y++){
                $verGlossario = mysql_fetch_array($sqlGlossario);
                ?>
                <tr onclick="carregaProjeto(<?php echo $verGlossario['id'];?>,<?php echo $verGlossario['CdPrefeitura'];?>)" style="cursor: pointer">
                    <td>
                        <small><?php echo $verGlossario['servico'];?></small>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</section>