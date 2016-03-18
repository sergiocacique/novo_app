
<script>
    var base_url = "<?php echo $UrlAmigavel.$Pasta ?>";
    function buscaMes(mes,ano){
        $('#loading2').css('visibility','visible');
        $.post("diarias_inc.php", { mes: mes, ano: ano },
            function(data){
                $('#resultado').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    jQuery('#formulario_adicionar').submit(function(){
        var dados = jQuery( this ).serialize();
            $('#loading2').css('visibility','visible');
            $.post("diarias_inc.php", { mes: mes, ano: ano },
                function(data){
                    $('#resultado').html(data);
                    $('#pesquisa').modal('hide');
                }).done(function() {
                    $('#loading2').css('visibility','hidden');
                });

    });

    function carregaDadosClienteJSon(id){
        $.get(base_url+'lista/diaria_sel.php', {
            id: id
        }, function (data){
            $('#nome').text(data.nome);
            $('#cargo').text(data.cargo);
            $('#destino').text(data.destino);
            $('#objetivo').text(data.objetivo);
            $('#periodo').text(data.periodo);
            $('#dias').text(data.dias);
            $('#valor_diaria').text(data.valor_diaria);
            $('#valor_bruto').text(data.valor_bruto);
            $('#inss').text(data.inss);
            $('#irff').text(data.irff);
            $('#valor_liquido').text(data.valor_liquido);
            $('#secretaria').text(data.secretaria);
            $('#id').text(data.id);//aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente.
        }, 'json');
    }

    function AbreModal(id){

        //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
        carregaDadosClienteJSon(id);

        $('#modalEditarCliente').modal('show');
    }

</script>
<div id="breadcrumb">
    <div id="breadcrumb_primeiro"><span>Despesas Pessoal</span></div>
    <div id="breadcrumb_ultima"><span>Diárias</span></div>
</div>
<?php
$sqlUlt = mysql_query("SELECT * FROM diarias WHERE (acao = 'Publicado') GROUP BY ano, mes ORDER BY ano DESC, mes DESC LIMIT 1");
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
            <th>Periodo</th>
            <th>Valor</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $sql = "SELECT * FROM diarias WHERE (acao = 'Publicado') AND ( ano = ".$rsLinha2['ano'].") AND ( mes = ".$rsLinha2['mes'].")";


        $sqlGlossario = mysql_query($sql);
        $Glossario = mysql_num_rows($sqlGlossario);

        $total = 0;
        $totalliberado = 0;
        for ($y = 0; $y < $Glossario; $y++){
            $verGlossario = mysql_fetch_array($sqlGlossario);

            $valor = $verGlossario['valor_liquido'];
            $total = $total + $valor;

            ?>

            <tr class='clickable-row' onclick="AbreModal(<?php echo $verGlossario['id'];?>)"  >
                <td><?php echo $verGlossario['nome'];?></td>
                <td><?php echo $verGlossario['destino'];?></td>
                <td><?php echo $verGlossario['periodo'];?></td>
                <td>R$ <?php echo number_format($verGlossario['valor_liquido'], 2, ',', '.');?></td>
            </tr>
        <?php
        }
        ?>


        </tbody>
    </table>
</div>
</div>

<div class="modal fade bs-example-modal-lg" id="modalEditarCliente" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title">Detalhes </h4>
            </div>
            <div class="modal-body">

                <table class="table table-bordered table-striped">
                    <colgroup>
                        <col class="col-xs-1">
                        <col class="col-xs-7">
                    </colgroup>

                    <tbody>
                    <tr>
                        <td>Nome</td>
                        <td><p id="nome"></p></td>
                    </tr>
                    <tr>
                        <td>Cargo</td>
                        <td><p id="cargo"></p></td>
                    </tr>
                    <tr>
                        <td>Destino</td>
                        <td><p id="destino"></p></td>
                    </tr>
                    <tr>
                        <td>Objetivo</td>
                        <td><p id="objetivo"></p></td>
                    </tr>
                    <tr>
                        <td>Periodo</td>
                        <td><p id="periodo"></p></td>
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
                                    <td><p id="dias"></p></td>
                                    <td><p id="valor_diaria"></p></td>
                                    <td><p id="valor_bruto"></p></td>
                                    <td><p id="inss"></p></td>
                                    <td><p id="irff"></p></td>
                                </tr>

                                <tr>
                                    <td colspan="2">Valor Liquido</td>
                                    <td colspan="3"><p id="valor_liquido"></p></td>

                                </tr>

                                </tbody>
                            </table>

                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-nephem" data-dismiss="modal">Fechar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
