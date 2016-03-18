
<?php
include ("../conexao.php");
include('funcoes.php');

$Nome = $_POST['nome'];


if (isset($ano) and ($ano != '')){
    $ano = mysql_real_escape_string($ano);
}elseif (isset($mes) and ($mes != '')){
    $mes = mysql_real_escape_string($mes);
}elseif (isset($objeto) and ($objeto != '')){
    $objeto = mysql_real_escape_string($objeto);
}


$sql = "SELECT * FROM servidor WHERE Acao = 'Publicado'";

if (isset($Nome) and $Nome != ''){
    $Nome = str_replace(" ","%", $Nome);
    $Nome = str_replace("+","%", $Nome);
    $sql =$sql . " AND Nome LIKE '%" . $Nome . "%'";
}

$sql =$sql ."GROUP BY CPF ORDER BY Ano DESC, Mes DESC, Nome ASC";

$sqlUlt = mysql_query($sql);
$rsLinha2 = mysql_fetch_array($sqlUlt);
$conta = mysql_num_rows($sqlUlt);
?>
<div id="resultado" class="help-block text-center">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php if ($conta != '0'){ ?>
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
                                <a href="obrasXLS.php?mes=<?php echo $rsLinha2['mes'];?>&ano=<?php echo $rsLinha2['ano'];?>&extensao=xls"> Excel (XLS)  </a>
                            </li>
                            <li>
                                <a href="obrasXLS.php?mes=<?php echo $rsLinha2['mes'];?>&ano=<?php echo $rsLinha2['ano'];?>&extensao=ods"> Open Office Calc (ODS)  </a>
                            </li>
                            <li>
                                <a href="obrasXLS.php?mes=<?php echo $rsLinha2['mes'];?>&ano=<?php echo $rsLinha2['ano'];?>&extensao=odt"> Open Office Writer (ODT)  </a>
                            </li>

                        </ul>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>CPF</th>
                            <th>SERVIDOR</th>
                            <th>CARGO</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php




                        $sqlGlossario = mysql_query($sql);
                        $Glossario = mysql_num_rows($sqlGlossario);

                        $total = 0;
                        for ($y = 0; $y < $Glossario; $y++) {
                            $verGlossario = mysql_fetch_array($sqlGlossario);
                            $CPF = $verGlossario['CPF'];
                            $CPFs = $CPF;

                            ?>

                            <tr class='clickable-row' onclick="buscaMes(<?php echo $verGlossario['CdServidor'];?>)"  >
                                <td><small><?php echo mask($CPF,'***.###.###-**');?></small></td>
                                <td><small><?php echo $verGlossario['Nome'];?></small></td>
                                <td><small>
                                        <?php
                                        if ($verGlossario['Cargo'] == ''){
                                            echo $verGlossario['CargoComissao'];
                                        }else {
                                            echo $verGlossario['Cargo'];
                                        }
                                        ?>
                                    </small></td>
                            </tr>
                        <?php
                        }
                        ?>


                        </tbody>
                    </table>
                <?php
                }else{?>
                    <div class="callout callout-warning">
                        <h4>Não foi encontrado nada com a palavra pesquisada</h4>
                        <p>

                            <code><?php echo $Nome;?></code>

                        </p>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>