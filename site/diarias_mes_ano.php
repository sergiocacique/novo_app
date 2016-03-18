<?php
include ("conexao.php");
include ("funcao.php");


    $CdPrefeitura = $_POST['prefeitura'];
    $SelAno = $_POST['ano'];
    $SelMes = $_POST['mes'];

?>
<div class="container">
    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8 pull-left">
            <h2 class="title title-d"> <strong><?php echo retorna_mes_extenso($SelMes); ?></strong> <?php echo $SelAno; ?></h2>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 pull-left">
            <div id="atualiza" class="pull-right hidden-xs">
                <div class="btn-group">
                    <button type="button" id="dashboardRange" class="btn type-d dropdown-toggle" data-toggle="dropdown">
                        <span>BUSCAR DIÁRIAS</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        $sqlAnos = mysql_query("SELECT * FROM diarias WHERE (CdPrefeitura = ".$CdPrefeitura.") GROUP BY ano, mes ORDER BY ano DESC, mes DESC ");
                        $Anos = mysql_num_rows($sqlAnos);

                        for ($y = 0; $y < $Anos; $y++){
                            $verAnos = mysql_fetch_array($sqlAnos);
                            ?>
                            <li><a href="javascript:void(0)" onclick="carregaMesAno(<?php echo $verAnos['mes'];?>,<?php echo $verAnos['ano'];?>,<?php echo $CdPrefeitura?>)"><?php echo retorna_mes_extenso($verAnos['mes']);?> / <?php echo $verAnos['ano'];?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ver" class="container">

    <table class="table table-afiliados" summary="Passagens">
        <thead>
        <tr>
            <th><span class="texto-amarelo">DATA</span></th>
            <th><span class="texto-amarelo">NOME</span></th>
            <th><span class="texto-amarelo">DESTINO</span></th>
            <th><span class="texto-amarelo">SECRETÁRIA</span></th>
            <th><span class="texto-amarelo">VALOR (R$)</span></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sqlDespesa = mysql_query("SELECT * FROM diarias WHERE CdPrefeitura = '".$CdPrefeitura."' AND acao = 'Publicado' AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")");
        $rsDespe = mysql_fetch_array($sqlDespesa);
        $ContaDespe = mysql_num_rows($sqlDespesa);

        if ($ContaDespe == 0) {?>

            <tr>
                <td colspan="4">
                    <small>Nenhum registro encontrado no periodo selecionado</small>
                </td>
            </tr>
        <?php

        }else{

            $sqlGlossario = mysql_query("SELECT * FROM diarias WHERE CdPrefeitura = '".$CdPrefeitura."' AND acao = 'Publicado' AND ( ano = ".$SelAno.") AND ( mes = ".$SelMes.")");
            $Glossario = mysql_num_rows($sqlGlossario);

            for ($y = 0; $y < $Glossario; $y++) {
                $verGlossario = mysql_fetch_array($sqlGlossario);
                ?>
                <tr onclick="carregaProjeto(<?php echo $verGlossario['id']; ?>,<?php echo $CdPrefeitura; ?>)" style="cursor: pointer">
                    <td>
                        <small><?php echo retorna_mes_extenso($verGlossario['mes']);?>/<?php echo $verGlossario['ano']; ?></small>
                    </td>
                    <td>
                        <small><?php echo $verGlossario['nome']; ?></small>
                    </td>
                    <td>
                        <small><?php echo $verGlossario['destino']; ?></small>
                    </td>
                    <td>
                        <small><?php echo $verGlossario['secretaria']; ?></small>
                    </td>
                    <td>
                        <small><?php echo number_format($verGlossario['valor_liquido'], 2, ',', '.'); ?></small>
                    </td>
                </tr>
            <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>