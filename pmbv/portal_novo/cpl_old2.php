
<script>
    var base_url = "<?php echo $UrlAmigavel.$Pasta ?>";
    function buscaMes(mes,ano){
        $('#loading2').css('visibility','visible');
        $.post("cpl_inc.php", { mes: mes, ano: ano },
            function(data){
                $('#resultado').html(data);
                $('html, body').animate({scrollTop:0}, 'slow');
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    function seleciona(id){
        $('#loading2').css('visibility','visible');
        $.post("cpl_detalhe.php", { id: id },
            function(data){
                $('#resultado').html(data);
                $('html, body').animate({scrollTop:0}, 'slow');
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }


    jQuery('#formulario_adicionar').submit(function(){
        var dados = jQuery( this ).serialize();
            $('#loading2').css('visibility','visible');
            $.post("cpl_inc.php", { mes: mes, ano: ano },
                function(data){
                    $('#resultado').html(data);
                    $('#pesquisa').modal('hide');
                    $('html, body').animate({scrollTop:0}, 'slow');
                }).done(function() {
                    $('#loading2').css('visibility','hidden');
                });

    });

    function carregaDadosClienteJSon(id){
        $.get(base_url+'lista/cpl.php', {
            id: id
        }, function (data){
            $('#DtEntrada').text(data.DtEntrada);
            $('#Processo').text(data.Processo);
            $('#Unidade').text(data.Unidade);
            $('#Fonte').text(data.Fonte);
            $('#Modalidade').text(data.Modalidade);
            $('#Objeto').text(data.Objeto);
            $('#DtDOM').text(data.DtDOM);
            $('#Vencedor').text(data.Vencedor);
            $('#Valor').text(data.Valor);
            $('#id').text(data.id);//aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente.
        }, 'json');
    }

    function AbreModal(id){

        //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
        carregaDadosClienteJSon(id);

        $('#modalEditarCliente').modal('show');
    }
</script>

<section class="content-wrapper content-midwet">
<div class="content-header">
    <div class="pull-right">
        <ol class="breadcrumb">
            <li>
                <a href="#">Inicio</a>
            </li>
            <li class="active">Licitações e Contratos</li>
        </ol>
    </div>
    <h1 class="content-title">
        Licitações e Contratos
    </h1>
</div>

<?php
$sql2 = "SELECT * FROM cpl WHERE Acao = 'Publicado' GROUP BY DATE_FORMAT(DtPublicacao, '%Y'), DATE_FORMAT(DtPublicacao, '%c') ORDER BY DATE_FORMAT(DtPublicacao, '%Y') DESC, DATE_FORMAT(DtPublicacao, '%c') DESC LIMIT 1";
$sqlUlt = mysql_query($sql2);
$rsLinha2 = mysql_fetch_array($sqlUlt);


$MesSelecionado = date('m', strtotime($rsLinha2['DtPublicacao']));
$AnoSeleciona = date('Y', strtotime($rsLinha2['DtPublicacao']));



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
                        <select class="form-control" name="ano" id="ano">
                            <?php foreach( range(date('Y'), 2013) as $ano){?>
                                <option value="<?php echo $ano?>"><?php echo $ano?></option>
                            <?php }?>
                        </select>
                    </div>



                    <div class="form-group">
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
            <th>Processo</th>
            <th>Vencedor</th>
            <th>Valor</th>
        </tr>
        </thead>
        <tbody>
        <?php



        $sql = "SELECT * FROM cpl WHERE (Acao = 'Publicado') AND ( DATE_FORMAT(DtPublicacao, '%Y') = " . date('Y', strtotime($rsLinha2['DtPublicacao'])) . ") AND ( DATE_FORMAT(DtPublicacao, '%c') = " . date('m', strtotime($rsLinha2['DtPublicacao'])) . ")";


        $sqlGlossario = mysql_query($sql);
        $Glossario = mysql_num_rows($sqlGlossario);

        $total = 0;
        for ($y = 0; $y < $Glossario; $y++){
            $verGlossario = mysql_fetch_array($sqlGlossario);

            $valor = $verGlossario['valor_licitacao'];
            $total = $total + $valor;

            $sql2 = "SELECT * FROM cpl_empresa WHERE (CdCPL = ".$verGlossario['CdCPL'].") AND (Acao = 'Publicado') AND (Situacao = 'Ganhadora')";
            $sqlEmpresa = mysql_query($sql2);
            $Empresa = mysql_num_rows($sqlEmpresa);

            ?>

            <tr class='clickable-row' onclick="seleciona(<?php echo $verGlossario['CdCPL'];?>)">
                <td><?php echo $verGlossario['NumeroProcesso'];?></td>
                <td>
                    <?php
                    for ($x = 0; $x < $Empresa; $x++){
                        $verEmpresa = mysql_fetch_array($sqlEmpresa);

                        echo $verEmpresa['Nome']."<br>";
                    }
                    ?>
                </td>
                <td><?php echo 'R$' . number_format($verGlossario['valor_licitacao'], 2, ',', '.');?></td>
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
                        <col class="col-xs-3">
                        <col class="col-xs-7">
                    </colgroup>

                    <tbody>
                    <tr>
                        <td>Data da entrada</td>
                        <td><p id="DtEntrada"></p></td>
                    </tr>
                    <tr>
                        <td>Número do Processo</td>
                        <td><p id="Processo"></p></td>
                    </tr>
                    <tr>
                        <td>unidade</td>
                        <td><p id="Unidade"></p></td>
                    </tr>
                    <tr>
                        <td>Fonte</td>
                        <td><p id="Fonte"></p></td>
                    </tr>
                    <tr>
                        <td>Modalidade</td>
                        <td><p id="Modalidade"></p></td>
                    </tr>

                    <tr>
                        <td>Objeto</td>
                        <td><p id="Objeto"></p></td>
                    </tr>
                    <tr>
                        <td>Publicação Diário Oficial</td>
                        <td><p id="DtDOM"></p></td>
                    </tr>
                    <tr>
                        <td>Empresa vencedora</td>
                        <td class="txtResumido"><p id="Vencedor"></p></td>
                    </tr>
                    <tr>
                        <td>Valor R$</td>
                        <td><p id="Valor"></p></td>
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
</section>