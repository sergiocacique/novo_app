<?php
$sqlUlt = mysql_query("SELECT * FROM previdencia WHERE Acao = 'Publicado' GROUP BY Ano, Mes ORDER BY Ano DESC, Mes DESC LIMIT 1");
$rsLinha2 = mysql_fetch_array($sqlUlt);


$MesSelecionado = $rsLinha2['Mes'];
$AnoSeleciona = $rsLinha2['Ano'];



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
<script>
    var base_url = "<?php echo $UrlAmigavel.$Pasta ?>";
    function buscaMes(mes,ano){
        $('#loading2').css('visibility','visible');
        $.post("previdencia_inc.php", { mes: mes, ano: ano },
            function(data){
                $('#resultado').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    jQuery('#formulario_adicionar').submit(function(){
        var dados = jQuery( this ).serialize();
            $('#loading2').css('visibility','visible');
            $.post("previdencia_inc.php", { mes: mes, ano: ano },
                function(data){
                    $('#resultado').html(data);
                    $('#pesquisa').modal('hide');
                }).done(function() {
                    $('#loading2').css('visibility','hidden');
                });

    });

    function carregaDadosClienteJSon(id){
        $.get(base_url+'lista/previdencia.php', {
            id: id
        }, function (data){
            $('#Banco').text(data.Banco);
            $('#Agencia').text(data.Agencia);
            $('#Conta').text(data.Conta);
            $('#Nome').text(data.Nome);
            $('#Tipo').text(data.Tipo);
            $('#SaldoAnterior').text(data.SaldoAnterior);
            $('#Aplicacoes').text(data.Aplicacoes);
            $('#Resgate').text(data.Resgate);
            $('#Rendimento').text(data.Rendimento);
            $('#Saldo').text(data.Saldo);
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
    <div id="breadcrumb_primeiro"><span>Consultas</span></div>
    <div id="breadcrumb_ultima"><span>DEMONSTRATIVODOS FUNDOS DE INVESTIMENTO</span></div>
</div>
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
            <th></th>
            <th></th>
            <th>Saldo Anterior</th>
            <th>Saldo Atual</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $sql = "SELECT * FROM previdencia WHERE (Acao = 'Publicado') AND ( ano = ".$rsLinha2['Ano'].") AND ( mes = ".$rsLinha2['Mes'].")";


        $sqlGlossario = mysql_query($sql);
        $Glossario = mysql_num_rows($sqlGlossario);

        $total = 0;
        for ($y = 0; $y < $Glossario; $y++){
            $verGlossario = mysql_fetch_array($sqlGlossario);

            $valor = $verGlossario['Saldo'];
            $total = $total + $valor;

            ?>

            <tr class='clickable-row' onclick="AbreModal(<?php echo $verGlossario['id'];?>)"  >
                <td><?php echo $verGlossario['Nome'];?></td>
                <td><?php echo $verGlossario['Tipo'];?></td>
                <td>R$ <?php echo number_format($verGlossario['SaldoAnterior'], 2, ',', '.');?></td>
                <td>R$ <?php echo number_format($verGlossario['Saldo'], 2, ',', '.');?></td>
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
                        <td>Banco</td>
                        <td><p id="Banco"></p></td>
                    </tr>
                    <tr>
                        <td>Agencia</td>
                        <td><p id="Agencia"></p></td>
                    </tr>
                    <tr>
                        <td>Conta</td>
                        <td><p id="Conta"></p></td>
                    </tr>
                    <tr>
                        <td>Aplicação</td>
                        <td><p id="Nome"></p></td>
                    </tr>
                    <tr>
                        <td>Tipo</td>
                        <td><p id="Tipo"></p></td>
                    </tr>
                    <tr class="info">
                        <td colspan="2">

                            <table class="table table-bordered table-striped">
                                <colgroup>
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
                                    <td>Saldo Anterior</td>
                                    <td>Aplicações (+)</td>
                                    <td>Resgates (-)</td>
                                    <td>Rendimento Líquido</td>
                                </tr>
                                <tr>
                                    <td><p id="SaldoAnterior"></p></td>
                                    <td><p id="Aplicacoes"></p></td>
                                    <td><p id="Resgate"></p></td>
                                    <td><p id="Rendimento"></p></td>
                                </tr>

                                <tr>
                                    <td colspan="2">Saldo Atual</td>
                                    <td colspan="2"><p id="Saldo"></p></td>

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
