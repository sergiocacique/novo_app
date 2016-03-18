<?php
include ("../conexao.php");
include('funcoes.php');
?>


<div id="box_convenios">

</div>

<div class="pull-left">
    <p class="btn-group">
        <a title="Anterior" href="javascript:void(0)" onclick="buscaMes(<?php echo $mesAno = $mesAnterior.",".$anoAnterior?>)" class="btn btn-silc">
            <i class="tamFont fa fa-arrow-left"></i>
        </a>

        <a title="Escolher Período" href="javascript:void(0)" class="ConvMes btn btn-silc" data-toggle="modal" data-target="#pesquisa"><?php echo retorna_mes_extenso($MesSelecionado);?> de <?php echo $AnoSeleciona;?></a>
        <a title="Posterior" href="javascript:void(0)" onclick="buscaMes(<?php echo $mesAno = $mesSeguinte.",".$anoSeguinte?>)" class="btn btn-silc">
            <i class="tamFont fa fa-arrow-right"></i></a>
    </p>
</div>

<!--<div class="col-md-6">-->
<!--    <button class="btn btn-icon btn-info">-->
<!--        <i class="fa fa-file-excel-o"></i>-->
<!--        salvar em excel-->
<!--    </button>-->
<!---->
<!--    <button class="btn btn-icon btn-info">-->
<!--        <i class="fa fa-file-pdf-o"></i>-->
<!--        salvar em PDF-->
<!--    </button>-->
<!--</div>-->

<div id="corpo_servidor">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Destino</th>
            <th>Valor</th>
        </tr>
        </thead>
        <tbody>
    <?php

    $sql = "SELECT * FROM passagens WHERE (Acao = 'Publicado') AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")";


    $sqlGlossario = mysql_query($sql);
    $Glossario = mysql_num_rows($sqlGlossario);


    $total = 0;

    if ($Glossario == 0) {
        echo "<tr>";
        echo "        <td colspan='3'>Não houve emissão de passagens no periodo</td>";
        echo "    </tr>";
    }else {


        for ($y = 0; $y < $Glossario; $y++) {
            $verGlossario = mysql_fetch_array($sqlGlossario);

            $valor = $verGlossario['valor'];
            $total = $total + $valor;



            ?>

            <?php

            ?>

            <tr class='clickable-row'
                data-href='janelaVizualizarCliente(<?php echo $verGlossario['id']; ?>,<?php echo $SelMes; ?>,<?php echo $SelAno; ?>)'>
                <td><?php echo $verGlossario['Nome']; ?></td>
                <td><?php echo $verGlossario['Destino']; ?></td>
                <td>R$ <?php echo number_format($verGlossario['valor'], 2, ',', '.'); ?></td>
            </tr>
        <?php
        }
    }
    ?>
        

        </tbody>
    </table>
</div>

