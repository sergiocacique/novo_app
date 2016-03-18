
<?php
include ("../conexao.php");
include('funcoes.php');

$objeto = $_POST['objeto'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];

if (isset($ano) and ($ano != '')){
    $ano = mysql_real_escape_string($ano);
}elseif (isset($mes) and ($mes != '')){
    $mes = mysql_real_escape_string($mes);
}elseif (isset($objeto) and ($objeto != '')){
    $objeto = mysql_real_escape_string($objeto);
}


$sql = "SELECT * FROM projetos_sociais WHERE Acao = 'Publicado'";

if (isset($ano) and $ano != ''){
    $sql =$sql . " AND ano = " . $ano . "";
}

if (isset($mes) and $mes != ''){
    $sql =$sql . " AND mes = " . $mes . "";
}

if (isset($objeto) and $objeto != ''){
    $sql =$sql . " AND servico LIKE '%" . $objeto . "%'";
}

$sql =$sql ." ORDER BY DtAtualizacao ASC";

$sqlUlt = mysql_query($sql);
$rsLinha2 = mysql_fetch_array($sqlUlt);
$conta = mysql_num_rows($sqlUlt);

if ($mes == ""){
    $mes = $rsLinha2['mes'];
}else{
    $mes = $mes;
}

if ($ano == ""){
    $ano = $rsLinha2['ano'];
}else{
    $ano = $ano;
}
?>
<div id="resultado" class="help-block text-center">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php if ($conta != '0'){ ?>
                <h4>
                    PROJETOS SOCIAIS DE <?php echo retorna_mes_extenso($mes);?> / <?php echo $ano;?>
                    <br>
                    <small class="text-muted">atualizado em <?php echo date('d/m/Y H:i:s a', strtotime($rsLinha2['DtAtualizacao']))?></small>
                </h4>
                    <div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" type="button">

                            <i class="fa fa-arrow-down"></i>
                        </button>
                        <ul class="dropdown-menu text-left" role="menu">
                            <li>
                                <a href="javascript:void(0)">Tipo de arquivo</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="projetos_sociaisXLS.php?mes=<?php echo $rsLinha2['mes'];?>&ano=<?php echo $rsLinha2['ano'];?>&extensao=xls"> Excel (XLS)  </a>
                            </li>
                            <li>
                                <a href="projetos_sociaisXLS.php?mes=<?php echo $rsLinha2['mes'];?>&ano=<?php echo $rsLinha2['ano'];?>&extensao=ods"> Open Office Calc (ODS)  </a>
                            </li>
                            <li>
                                <a href="projetos_sociaisXLS.php?mes=<?php echo $rsLinha2['mes'];?>&ano=<?php echo $rsLinha2['ano'];?>&extensao=odt"> Open Office Writer (ODT)  </a>
                            </li>

                        </ul>
                    </div>

                    <table class="table table-hover">
                        <colgroup>
                            <col class="col-xs-9">
                            <col class="col-xs-1">
                            <col class="col-xs-2">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>PROJETO</th>
                            <th>PUBLICO</th>
                            <th>VALOR (R$)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $sqlGlossario = mysql_query($sql);
                        $Glossario = mysql_num_rows($sqlGlossario);

                        $total = 0;
                        for ($y = 0; $y < $Glossario; $y++) {
                            $verGlossario = mysql_fetch_array($sqlGlossario);

                            ?>

                            <tr class='clickable-row'
                                onclick="verDetalhe(<?php echo $verGlossario['id'];?>,<?php echo $verGlossario['mes'];?>,<?php echo $verGlossario['ano'];?>)">

                                <td>
                                    <small><?php echo $verGlossario['servico'];?></small>
                                </td>
                                <td>
                                    <small><?php echo $verGlossario['publico'];?></small>
                                </td>
                                <td>
                                    <small>R$ <?php echo number_format($verGlossario['total'], 2, ',', '.');?></small>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>


                        </tbody>
                    </table>
                <?php
                }else{?>
                    <div class="callout callout-warning">
                        <h4>Não foi encontrado nada no periodo selecionado</h4>
                        <p>
                            Periodo:
                            <code><?php echo retorna_mes_extenso($mes);?> / <?php echo $ano;?></code>

                        </p>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>