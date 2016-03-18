<?php
include ("conexao.php");
include ("funcao.php");
$id = (string) $_POST['id'];
$CdPrefeitura = (string) $_POST['prefeitura'];


$sqlLinha = mysql_query("SELECT * FROM passagens WHERE id = '".$id."'");
$rsLinha = mysql_fetch_array($sqlLinha);
?>


<section id="ver" class="texto-simples container">
    <div class="row">

        <table class="table table-afiliados" summary="Despesas com pessoal">
            <thead>
            <tr>
                <th class="col-sm-8"><span class="texto-amarelo"><?php echo $rsLinha['Nome']?> - <?php echo $rsLinha['Destino']?></span></th>
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
                <td><?php echo $rsLinha['Nome']?></td>
            </tr>
            <tr>
                <td>Destino</td>
                <td><?php echo $rsLinha['Destino']?></td>
            </tr>
            <tr>
                <td>Objetivo</td>
                <td><?php echo $rsLinha['Objetivo']?></td>
            </tr>
            <tr>
                <td>Valor (R$)</td>
                <td><?php echo number_format($rsLinha['valor'], 2, ',', '.'); ?></td>
            </tr>
            <tr>

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
                <th>VALOR (R$)</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sqlGlossario = mysql_query("SELECT * FROM passagens WHERE CdPrefeitura = '".$CdPrefeitura."' AND Acao = 'Publicado' AND ( ano = ".$rsLinha['ano'].") AND ( mes = ".$rsLinha['mes'].")");
            $Glossario = mysql_num_rows($sqlGlossario);

            for ($y = 0; $y < $Glossario; $y++){
                $verGlossario = mysql_fetch_array($sqlGlossario);
                ?>
                <tr onclick="carregaProjeto(<?php echo $verGlossario['id']; ?>,<?php echo $CdPrefeitura; ?>)">
                    <td>
                        <small><?php echo $verGlossario['Nome']; ?></small>
                    </td>
                    <td>
                        <small><?php echo $verGlossario['Destino']; ?></small>
                    </td>
                    <td>
                        <small><?php echo number_format($verGlossario['valor'], 2, ',', '.'); ?></small>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</section>