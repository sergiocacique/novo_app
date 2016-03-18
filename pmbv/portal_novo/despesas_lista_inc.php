<?php
include ("../conexao.php");
include('funcoes.php');
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
        $.post("despesas_lista_inc.php", { mes: mes, ano: ano },
            function(data){
                $('#resultado').html(data);
            });
    }


</script>

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
    <?php

    $sql = "SELECT * FROM Despesas_historico H INNER JOIN Despesas D ON H.Empenho = D.Empenho WHERE (H.Lixo = 'nao') AND (H.Ativo = 'sim') AND (YEAR(H.DtCadastro) = ".$SelAno.") AND (MONTH(H.DtCadastro) = ".$SelMes.") AND Tipo <> 'Empenho' GROUP BY H.Empenho";


    $sqlGlossario = mysql_query($sql);
    $Glossario = mysql_num_rows($sqlGlossario);

    $total = 0;
    for ($y = 0; $y < $Glossario; $y++){
    $verGlossario = mysql_fetch_array($sqlGlossario);

     $valor = $verGlossario['Valor'];
        $total = $total + $valor;

        if ($verGlossario['Tipo'] == "Liquidacao"){
            $valorCss = "btn-success";
            $txtTipo = "Liquidação";
            $txtTipo3 = "Liquidado";
        }elseif ($verGlossario['Tipo']  == "Pagamento"){
            $valorCss = "btn-info";
            $txtTipo = "Pagamento";
            $txtTipo3 = "Pago";
        }elseif ($verGlossario['Tipo']  == "Empenho"){
            $valorCss = "btn-warning";
            $txtTipo = "Empenho";
            $txtTipo3 = "Empenhado";
        }

        if ($verGlossario['Acao'] == "Realizado"){
            $valorCss2 = "btn-silc";
            $txtTipo2 = "Realizado";
        }
    ?>
    <div id="convenio_table">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading<?php echo $y; ?>">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $y; ?>" aria-expanded="true" aria-controls="collapse<?php echo $y; ?>">
                            <span class="esquerda"><?php echo $verGlossario['Documento'];?> - <?php echo $verGlossario['Credor'];?></span>
                            <span class="direita">R$ <?php echo number_format($verGlossario['Valor'], 2, ',', '.');?></span>
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
                                            <h3 class="timeline-title"><?php echo $txtTipo;?> feita em  <?php echo date('d/m/Y', strtotime($verGlossario['DtCadastro']));?> <small>Documento <?php echo $verGlossario['Documento'];?></small></h3>
                                        </div><!-- /.timeline-heading -->

                                        <div class="timeline-content">
                                            <span>Valor <?php echo $txtTipo3;?> R$ <?php echo number_format($verGlossario['Valor'], 2, ',', '.');?></span>
                                            <hr>
                                            <div class="acao">
                                                <span class="btn <?php echo $valorCss;?>"><?php echo $txtTipo;?></span>
                                                <span class="btn <?php echo $valorCss2;?>"><?php echo $txtTipo2;?></span>
                                            </div>
                                        </div><!-- /.timeline-content -->



                                    </div><!-- /.timeline-panel -->
                                </li><!-- /.timeline-item -->

                                <li class="timeline-item block">
                                    <div class="timeline-badge"><a rel="tooltip" title="block highlight" data-context="inverse" data-container="body" class="border-silc" href="#"></a></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h3 class="timeline-title">Dados do empenho número <?php echo $verGlossario['Empenho']?> <small>Empenho feito em <?php echo date('d/m/Y', strtotime($verGlossario['DtEmpenho']));?></small></h3>
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
                                                <?php
                                                if ($verGlossario['CNPJ'] != ''){
                                                ?>
                                                <tr>
                                                    <td>CNPJ:</td>
                                                    <td><strong><?php echo $verGlossario['CNPJ']?></strong></td>
                                                </tr>
                                                <?php }?>
                                                <?php
                                                if ($verGlossario['CPF'] != ''){
                                                    ?>
                                                    <tr>
                                                        <td>CPF:</td>
                                                        <td><strong><?php echo $verGlossario['CPF']?></strong></td>
                                                    </tr>
                                                <?php }?>
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
                                                </tbody>
                                            </table>
                                        </div><!-- /.timeline-content -->



                                    </div><!-- /.timeline-panel -->
                                </li><!-- /.timeline-item -->
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