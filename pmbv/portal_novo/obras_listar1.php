
<?php
include ("../conexao.php");
include('funcoes.php');

$objeto = $_POST['objeto'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];

$sqlUlt = mysql_query("SELECT * FROM obras WHERE Acao = 'Publicado' GROUP BY ano, mes ORDER BY ano DESC, mes DESC LIMIT 1");
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
                <th>Nº Processo</th>
                <th>Obra</th>
                <th>Andamento</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php



            $sql = "SELECT * FROM obras WHERE (Acao = 'Publicado') AND ( ano = ".$rsLinha2['ano'].") AND ( mes = ".$rsLinha2['mes'].")";

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
</div>

<div class="modal fade bs-example-modal-lg" id="modalVizualizar" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title"><p id="numero_processo_titulo"></p> </h4>
            </div>
            <div class="modal-body">

                sssss

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-nephem" data-dismiss="modal">Fechar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->