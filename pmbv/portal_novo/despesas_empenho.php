<?php
if (isset($_POST['ano']) and ($_POST['ano'] != ''))
{
    $SelAno = $_POST['ano'];
    $SelAno = mysql_real_escape_string($SelAno);
}else{
    $SelAno = date('Y');
}

if (isset($_POST['mes']) and ($_POST['mes'] != ''))
{
    $SelMes = $_POST['mes'];
    $SelMes = mysql_real_escape_string($SelMes);
}else{
    $SelMes = date('n');
}
$MesSelecionado = $SelMes;
$AnoSeleciona = $SelAno;



$mesSeguinte = ($MesSelecionado+1);
$anoSeguinte = ($AnoSeleciona);

if($mesSeguinte > 12){
    $mesSeguinte = 1;
    $anoSeguinte = ($AnoSeleciona+1);
}


$mesAnterior = ($MesSelecionado-1);
$anoAnterior = ($AnoSeleciona);

if($mesAnterior == 0){
    $mesAnterior = 1;
    $anoAnterior = ($AnoSeleciona-1);
}

?>
<script>

    function buscaMes(mes,ano){
        $('#resultado').html("Pesquisando...");
        $.post("despesas_empenho_inc.php", { mes: mes, ano: ano },
            function(data){
                $('#resultado').html(data);
            });
    }

    jQuery('#formulario_adicionar').submit(function(){
        var dados = jQuery( this ).serialize();

            $.post("despesas_empenho_inc.php", { mes: mes, ano: ano },
                function(data){
                    $('#resultado').html(data);
                    $('#pesquisa').modal('hide');
                });

    });

</script>
<div id="breadcrumb">
    <div id="breadcrumb_primeiro"><span>Consultas</span></div>
    <div id="breadcrumb_segundo"><span>Despesas</span></div>
    <div id="breadcrumb_ultima"><span>Empenho</span></div>
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
    <?php

    //$sql = "SELECT * FROM convenios WHERE (Lixo = 'nao') AND (Ativo = 'sim') AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")";
    $sql = "SELECT * FROM Despesas WHERE (Lixo = 'nao') AND (Ativo = 'sim') AND (YEAR(DtEmpenho) = ".$SelAno.") AND (MONTH(DtEmpenho) = ".$SelMes.")";

    $sqlGlossario = mysql_query($sql);
    $Glossario = mysql_num_rows($sqlGlossario);

    $total = 0;
    for ($y = 0; $y < $Glossario; $y++){
    $verGlossario = mysql_fetch_array($sqlGlossario);

     $valor = $verGlossario['ValorEmpenho'];
        $total = $total + $valor;
    ?>
    <div id="convenio_table">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading<?php echo $y; ?>">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $y; ?>" aria-expanded="true" aria-controls="collapse<?php echo $y; ?>">
                            <span class="esquerda"><?php echo $verGlossario['Empenho'];?> - <?php echo $verGlossario['Credor'];?></span>
                            <span class="direita">R$ <?php echo number_format($verGlossario['ValorEmpenho'], 2, ',', '.');?></span>
                        </a>
                    </h4>
                </div>
                <div id="collapse<?php echo $y; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $y; ?>">
                    <div class="panel-body">
                        <div role="tabpanel">
                            <ul class="timeline">
                                <li class="timeline-line"></li>

                                <li class="timeline-item block">
                                    <div class="timeline-badge"><a rel="tooltip" title="block highlight" data-context="inverse" data-container="body" class="border-silc" href="#"></a></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h3 class="timeline-title">Dados do empenho número <?php echo $verGlossario['Empenho']?> <small>Empenho feito em <?php echo date('d/m/Y', strtotime($verGlossario['DtEmpenho']))?></small></h3>
                                        </div><!-- /.timeline-heading -->

                                        <div class="timeline-content">
                                            <hr>
                                            <table class="table table-bordered table-striped">
                                                <colgroup>
                                                    <col class="col-xs-4">
                                                    <col class="col-xs-8">
                                                </colgroup>

                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><?php echo $verGlossario['Credor']?></td>
                                                </tr>
                                                <tr>
                                                    <td>CNPJ:</td>
                                                    <td><strong><?php echo $verGlossario['CNPJ']?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Modalidade da Licitação</td>
                                                    <td><strong><?php echo $verGlossario['Modalidade']?></strong></td>
                                                </tr>

                                                <tr>
                                                    <td>Unidade Orçamentária</td>
                                                    <td><strong><?php echo $verGlossario['UnidadeOrcamentaria']?></strong></td>
                                                </tr>

                                                <tr>
                                                    <td>Função</td>
                                                    <td><strong><?php echo $verGlossario['Funcao']?></strong></td>
                                                </tr>

                                                <tr>
                                                    <td>Subfunção</td>
                                                    <td><strong><?php echo $verGlossario['SubFuncao']?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Programa de governo</td>
                                                    <td><strong><?php echo $verGlossario['ProgramaPgto']?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Projeto / Atividade</td>
                                                    <td><strong><?php echo $verGlossario['ProjetoAtividade']?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Natureza da despesa</td>
                                                    <td><strong><?php echo $verGlossario['Natureza']?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Fonte de recurso</td>
                                                    <td><strong><?php echo $verGlossario['FonteRecurso']?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><?php echo $verGlossario['Historico']?></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div><!-- /.timeline-content -->



                                    </div><!-- /.timeline-panel -->
                                </li><!-- /.timeline-item -->

                                <!-- TIMELINE
                                ================================================== -->

                                <?php
                                $sqlEmpenho = mysql_query("SELECT * FROM Despesas_historico WHERE Empenho = '".$verGlossario['Empenho']."' ORDER BY DtCadastro DESC");
                                $Empenho = mysql_num_rows($sqlEmpenho);

                                for ($x = 0; $x < $Empenho; $x++){
                                    $VerEmpenho = mysql_fetch_array($sqlEmpenho);



                                    if ($VerEmpenho['Tipo'] == "Liquidacao"){
                                        $valorCss = "btn-success";
                                        $txtTipo = "Liquidação";
                                    }elseif ($VerEmpenho['Tipo']  == "Pagamento"){
                                        $valorCss = "btn-info";
                                        $txtTipo = "Pagamento";
                                    }elseif ($VerEmpenho['Tipo']  == "Empenho"){
                                        $valorCss = "btn-warning";
                                        $txtTipo = "Empenho";
                                    }

                                    if ($VerEmpenho['Acao'] == "Realizado"){
                                        $valorCss2 = "btn-silc";
                                        $txtTipo2 = "Realizado";
                                    }


                                    if ($VerEmpenho['Tipo'] == 'Empenho') {
                                        ?>
                                        <li class="timeline-item block">
                                            <div class="timeline-badge"><a rel="tooltip" title="block highlight" data-context="inverse" data-container="body" class="border-silc" href="#"></a></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h3 class="timeline-title">Documento <?php echo $VerEmpenho['Documento']?> valor igual a R$ <?php echo number_format($VerEmpenho['Valor'], 2, ',', '.')?> <small>Movimento realizado em <?php echo date('d/m/Y', strtotime($VerEmpenho['DtCadastro']));?></small></h3>
                                                </div><!-- /.timeline-heading -->

                                                <div class="timeline-content">
                                                    <hr>
                                                    <div class="acao">
                                                        <span class="btn <?php echo $valorCss;?>"><?php echo $txtTipo;?></span>
                                                        <span class="btn <?php echo $valorCss2;?>"><?php echo $txtTipo2;?></span>
                                                    </div>
                                                </div><!-- /.timeline-content -->



                                            </div><!-- /.timeline-panel -->
                                        </li><!-- /.timeline-item -->

                                    <?php
                                    }else {
                                        ?>
                                        <li class="timeline-item">
                                            <div class="timeline-badge">
                                                <a rel="tooltip" title="status"
                                                   data-context="inverse" data-container="body"
                                                   class="border-pomeal" href="#"></a></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h3 class="timeline-title">Documento <?php echo $VerEmpenho['Documento']?> <br>valor igual a R$
                                                        <?php echo number_format($VerEmpenho['Valor'], 2, ',', '.')?>
                                                        <small>Movimento realizado em <?php echo date('d/m/Y', strtotime($VerEmpenho['DtCadastro']));?></small>
                                                    </h3>
                                                </div>

                                                <div class="timeline-content">
                                                    <hr>
                                                    <div class="acao">
                                                        <span class="btn <?php echo $valorCss;?>"><?php echo $txtTipo;?></span>
                                                        <span class="btn <?php echo $valorCss2;?>"><?php echo $txtTipo2;?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
<!--    <div class="callout callout-warning" id="resultados">R$ --><?php //echo number_format($total, 2, ',', '.');?><!--</div>-->
</div>
</div>