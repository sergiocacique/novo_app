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

<div id="corpo_servidor">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Nº Processo</th>
            <th>Obra</th>
            <th>Andamento</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
    <?php

    $sql = "SELECT * FROM obras WHERE (Acao = 'Publicado') AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")";


    $sqlGlossario = mysql_query($sql);
    $Glossario = mysql_num_rows($sqlGlossario);

    $total = 0;
    for ($y = 0; $y < $Glossario; $y++){
    $verGlossario = mysql_fetch_array($sqlGlossario);

     $valor = $verGlossario['total'];
        $total = $total + $valor;


        if ($verGlossario['fisico'] < 20){
            $valorCss = "progress-bar progress-bar-danger";
        }elseif ($verGlossario['fisico'] < 40){
            $valorCss = "progress-bar progress-bar-warning";
        }elseif ($verGlossario['fisico'] < 60){
            $valorCss = "progress-bar progress-bar-info";
        }elseif ($verGlossario['fisico'] < 75){
            $valorCss = "progress-bar";
        }elseif ($verGlossario['fisico'] < 100){
            $valorCss = "progress-bar progress-bar-success";
        }elseif ($verGlossario['fisico'] > 98){
            $valorCss = "progress-bar progress-bar-success";
        }


        ?>
        <tr class='clickable-row' onclick="Mudarestado(<?php echo $verGlossario['id'];?>)"  >
            <td><?php echo $verGlossario['numero_processo'];?></td>
            <td><?php echo $verGlossario['objeto'];?></td>
            <td>
                <div class="progress progress-striped">
                    <div class="<?php echo $valorCss;?>" role="progressbar" aria-valuenow="<?php echo $verGlossario['fisico'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $verGlossario['fisico'];?>%">
                        <span class="sr-only"><?php echo $verGlossario['fisico'];?>% Complete</span>
                        <div class="progress-text"><?php echo $verGlossario['fisico'];?>%</div>
                    </div>
                </div>
            </td>
            <td>R$ <?php echo number_format($verGlossario['total'], 2, ',', '.');?></td>
        </tr>


    <?php
    }
    ?>



        </tbody>
    </table>
</div>

