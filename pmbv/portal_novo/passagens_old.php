
<script>

    function buscaMes(mes,ano){
        $('#resultado').html("Pesquisando...");
        $.post("passagens_inc.php", { mes: mes, ano: ano },
            function(data){
                $('#resultado').html(data);
            });
    }

    jQuery('#formulario_adicionar').submit(function(){
        var dados = jQuery( this ).serialize();

            $.post("passagens_inc.php", { mes: mes, ano: ano },
                function(data){
                    $('#resultado').html(data);
                    $('#pesquisa').modal('hide');
                });

    });

</script>
<div id="breadcrumb">
    <div id="breadcrumb_primeiro"><span>Despesas Pessoal</span></div>
    <div id="breadcrumb_ultima"><span>Passagens</span></div>
</div>

<?php
$sqlUlt = mysql_query("SELECT * FROM passagens WHERE (Acao = 'Publicado') GROUP BY ano, mes ORDER BY ano DESC, mes DESC LIMIT 1");
$rsLinha2 = mysql_fetch_array($sqlUlt);


$MesSelecionado = $rsLinha2['mes'];
$AnoSeleciona = $rsLinha2['ano'];



$mesSeguinte = ($MesSelecionado+1);
$anoSeguinte = ($AnoSeleciona);

if($mesSeguinte > 12){
    $mesSeguinte = 1;
    $anoSeguinte = ($AnoSeleciona+1);
}


$mesAnterior = ($MesSelecionado-1);
$anoAnterior = ($AnoSeleciona);

if($mesAnterior == 0){
    $mesAnterior = 12;
    $anoAnterior = ($AnoSeleciona-1);
}

$anoSeguinteRREO = ($AnoSeleciona+1);
$anoAnteriorRREO = ($AnoSeleciona-1);
?>
<!-- modalSmall -->
<div class="modal fade" id="pesquisa" tabindex="-1" role="dialog" aria-labelledby="modalSmallLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modalSmallLabel">Selecione o periodo</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="" id="formulario_adicionar">

                    <div class="form-group">
                        <label for="ano" class="preto">Exercício</label>
                        <select class="form-control" name="ano" id="ano">
                            <?php foreach( range(date('Y'), 2013) as $ano){?>
                                <option value="<?php echo $ano?>"><?php echo $ano?></option>
                            <?php }?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="mes" class="preto">Mês</label>
                        <select class="form-control" name="mes" id="mes">
                            <?php foreach( range(1, 12) as $mes){?>
                                <option value="<?php echo $mes?>"><?php echo retorna_mes_extenso($mes)?></option>
                            <?php }?>
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="$('#formulario_adicionar').submit()">Pesquisar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="resultado">

<div class="pull-left">
    <p class="btn-group">
        <a title="Anterior" href="javascript:void(0)" onclick="buscaMes(<?php echo $mesAno = $mesAnterior.",".$anoAnterior?>)" class="btn btn-silc">
            <i class="tamFont fa fa-arrow-left"></i>
        </a>


        <a title="Escolher Período" href="javascript:void(0)" class="ConvMes btn btn-silc" data-toggle="modal" data-target="#pesquisa"><?php echo retorna_mes_extenso($MesSelecionado);?> de <?php echo $AnoSeleciona;?></a>
        <a title="Posterior" href="javascript:void(0)" onclick="buscaMes(<?php echo $mesAno = $mesSeguinte.",".$anoSeguinte?>)" class="btn btn-silc"><i class="tamFont fa fa-arrow-right"></i></a>
    </p>
</div>

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

        $sql = "SELECT * FROM passagens WHERE (Acao = 'Publicado') AND ( ano = ".$rsLinha2['ano'].") AND ( mes = ".$rsLinha2['mes'].")";


        $sqlGlossario = mysql_query($sql);
        $Glossario = mysql_num_rows($sqlGlossario);

        $total = 0;
        for ($y = 0; $y < $Glossario; $y++){
            $verGlossario = mysql_fetch_array($sqlGlossario);

            $valor = $verGlossario['valor'];
            $total = $total + $valor;

            ?>

            <tr class='clickable-row' data-href='janelaVizualizarCliente(<?php echo $verGlossario['id'];?>,<?php echo $SelMes;?>,<?php echo $SelAno;?>)'  >
                <td><?php echo $verGlossario['Nome'];?></td>
                <td><?php echo $verGlossario['Destino'];?></td>
                <td>R$ <?php echo number_format($verGlossario['valor'], 2, ',', '.');?></td>
            </tr>
        <?php
        }
        ?>


        </tbody>
    </table>
</div>
</div>

