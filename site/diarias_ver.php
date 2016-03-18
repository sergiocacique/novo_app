<?php
include ("conexao.php");
include ("funcao.php");
$id = (string) $_POST['id'];
$CdPrefeitura = (string) $_POST['prefeitura'];


$sqlLinha = mysql_query("SELECT * FROM diarias WHERE id = '".$id."'");
$rsLinha = mysql_fetch_array($sqlLinha);
?>


<section id="ver" class="texto-simples container">
    <div class="row">

        <table class="table table-afiliados" summary="Despesas com pessoal">
            <thead>
            <tr>
                <th class="col-sm-8"><span class="texto-amarelo"><?php echo $rsLinha['nome']?></span></th>
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
                <td>Nome</td>
                <td><?php echo $rsLinha['nome']?></td>
            </tr>
            <tr>
                <td>Cargo</td>
                <td><?php echo $rsLinha['cargo']?></td>
            </tr>
            <tr>
                <td>Secretária</td>
                <td><?php echo $rsLinha['secretaria']?></td>
            </tr>
            <tr>
                <td>Destino</td>
                <td><?php echo $rsLinha['destino']?></td>
            </tr>
            <tr>
                <td>Objetivo</td>
                <td><p id="objetivo"><?php echo $rsLinha['objetivo']?></p></td>
            </tr>
            <tr>
                <td>Periodo</td>
                <td><p id="periodo"><?php echo $rsLinha['periodo']?></p></td>
            </tr>
            <tr class="info">
                <td colspan="2">

                    <table class="table table-bordered table-striped">
                        <colgroup>
                            <col class="col-xs-2">
                            <col class="col-xs-2">
                            <col class="col-xs-2">
                            <col class="col-xs-2">
                            <col class="col-xs-2">
                        </colgroup>

                        <tbody>
                        <tr>
                            <td colspan="5">Concedente</td>
                        </tr>
                        <tr>
                            <td>Dias</td>
                            <td>Valor Diária</td>
                            <td>Valor Bruto</td>
                            <td>INSS</td>
                            <td>IRF</td>
                        </tr>
                        <tr>
                            <td><p id="dias"><?php echo $rsLinha['dias']?></p></td>
                            <td><p id="valor_diaria"><?php echo number_format($rsLinha['valor_diaria'], 2, ',', '.');?></p></td>
                            <td><p id="valor_bruto"><?php echo number_format($rsLinha['valor_bruto'], 2, ',', '.');?></p></td>
                            <td><p id="inss"><?php echo number_format($rsLinha['inss'], 2, ',', '.');?></p></td>
                            <td><p id="irff"><?php echo number_format($rsLinha['irff'], 2, ',', '.');?></p></td>
                        </tr>

                        <tr>
                            <td colspan="2">Valor Liquido</td>
                            <td colspan="3"><p id="valor_liquido"><?php echo number_format($rsLinha['valor_liquido'], 2, ',', '.');?></p></td>

                        </tr>

                        </tbody>
                    </table>

                </td>
            </tr>

            </tbody>
        </table>
    </div>
</section>

<section id="ver" class="texto-simples">
    <div class="container">
        <table class="table table-afiliados" summary="Despesas com pessoal">
            <thead>
            <tr>
                <th><span class="texto-amarelo">NOME</span></th>
                <th><span class="texto-amarelo">DESTINO</span></th>
                <th><span class="texto-amarelo">SECRETÁRIA</span></th>
                <th><span class="texto-amarelo">VALOR (R$)</span></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sqlGlossario = mysql_query("SELECT * FROM diarias WHERE CdPrefeitura = '".$CdPrefeitura."' AND acao = 'Publicado' AND ( ano = ".$rsLinha['ano'].") AND ( mes = ".$rsLinha['mes'].")");
            $Glossario = mysql_num_rows($sqlGlossario);

            for ($y = 0; $y < $Glossario; $y++){
                $verGlossario = mysql_fetch_array($sqlGlossario);
                ?>
                <tr onclick="carregaProjeto(<?php echo $verGlossario['id']; ?>,<?php echo $CdPrefeitura; ?>)" style="cursor: pointer">
                    <td>
                        <small><?php echo $verGlossario['nome']; ?></small>
                    </td>
                    <td>
                        <small><?php echo $verGlossario['destino']; ?></small>
                    </td>
                    <td>
                        <small><?php echo $verGlossario['secretaria']; ?></small>
                    </td>
                    <td>
                        <small><?php echo number_format($verGlossario['valor_liquido'], 2, ',', '.'); ?></small>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</section>