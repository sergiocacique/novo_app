<?php
include ("../conexao.php");
include('funcoes.php');

?>
<script>

    function buscaMes(mes,ano){
        $('#resultado').html("Pesquisando...");
        $('html, body').animate({scrollTop:0}, 'slow');
        $.post("cpl_inc.php", { mes: mes, ano: ano },
            function(data){
                $('#resultado').html(data);
            });
    }



    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            carregaDadosClienteJSon(id);
            $('#modalVizualizar').modal('show');
        });
    });

</script>
<?php


$id = $_POST['id'];

$sqlLinha = mysql_query("SELECT * FROM cpl WHERE CdCPL = '".$id."'");
$rsLinha = mysql_fetch_array($sqlLinha);

$sqlLinha2 = mysql_query("SELECT * FROM estrutura WHERE CdEstrutura = '".$rsLinha['Orgao']."'");
$rsLinha2 = mysql_fetch_array($sqlLinha2);

$sqlModa = mysql_query("SELECT * FROM cpl_modalidade WHERE id = '".$rsLinha['Modalidade']."'");
$rsModalidade = mysql_fetch_array($sqlModa);

$sqlSituacao = mysql_query("SELECT * FROM cpl_situacao WHERE id = '".$rsLinha['Situacao']."'");
$rsSituacao = mysql_fetch_array($sqlSituacao);
?>

<div class="content">


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Processo : <?php echo $rsLinha['NumeroProcesso'];?></h3>
        </div>

        <div class="panel-body">
            <br clear="all">
            <table class="table">
                <colgroup>
                    <col class="col-xs-3">
                    <col class="col-xs-6">
                </colgroup>
                <tbody>
                <tr>
                    <td colspan="2"><?php echo $rsLinha['Descricao'];?></td>
                </tr>
                <tr>
                    <td>Data de entrada</td>
                    <td><?php echo date('d/m/Y', strtotime($rsLinha['DtAbertura']));?></td>
                </tr>
                <tr>
                    <td>Unidade</td>
                    <td><?php echo $rsLinha2['Nome'];?></td>
                </tr>
                <tr>
                    <td>Fonte</td>
                    <td>
                        <?php
                        $sql3 = "SELECT * FROM cpl_recursos WHERE (CdCPL = ".$rsLinha['CdCPL'].")";
                        $sqlRecurso = mysql_query($sql3);
                        $Recurso = mysql_num_rows($sqlRecurso);

                        for ($x = 0; $x < $Recurso; $x++){
                        $verRecurso = mysql_fetch_array($sqlRecurso);
                            $sqlRec = mysql_query("SELECT * FROM cpl_recurso WHERE id = '".$verRecurso['CdRecurso']."'");
                            $rsRec = mysql_fetch_array($sqlRec);
                        ?>
                        <code><?php echo $rsRec['nome'];?> <?php if ($verRecurso['Descricao'] != ""){ echo "  " .$verRecurso['Descricao']; }?><br></code>
                        <?php }?>
                    </td>
                </tr>
                <tr>
                    <td>Modalidade</td>
                    <td><?php echo $rsModalidade['nome'];?></td>
                </tr>

                <tr class="fundoTable">
                    <td colspan="2">
                        <table class="table table-bordered table-striped">
                            <colgroup>
                                <col class="col-xs-3">
                                <col class="col-xs-7">
                            </colgroup>
                            <thead>
                            <tr>
                                <th colspan="2">Aviso de Abertura</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Data de Abertura</td>
                                <td><code><?php echo date('d/m/Y', strtotime($rsLinha['DtAbertura']));?></code></td>
                            </tr>
                            <tr>
                                <td>Data de Publicação</td>
                                <td><code><?php echo date('d/m/Y', strtotime($rsLinha['DtPublicacao']));?></code></td>
                            </tr>
                            <tr>
                                <td>Veículo de publicação (Ex. DOM)</td>
                                <td><code><?php echo $rsLinha['Veiculo'];?></code></td>
                            </tr>
                            <tr>
                                <td>Número do DOM</td>
                                <td><code><?php echo $rsLinha['numeroDOM'];?></code></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td>Publicação Diário Oficial</td>
                    <td><?php echo date('d/m/Y', strtotime($rsLinha['DtPublicacao']));?></td>
                </tr>
                <tr>
                    <td>Número Diário</td>
                    <td><?php echo $rsLinha['numeroDOM'];?></td>
                </tr>
                <tr>
                    <td>Situação</td>
                    <td><?php echo $rsSituacao['nome'];?></td>
                </tr>
                <tr>
                    <td>Valor</td>
                    <td><?php echo 'R$' . number_format($rsLinha['valor_licitacao'], 2, ',', '.');?></td>
                </tr>

                <tr class="fundoTable">
                    <td colspan="2">
                        <table class="table table-bordered table-striped">
                            <colgroup>
                                <col class="col-xs-7">
                                <col class="col-xs-3">
                            </colgroup>
                            <thead>
                            <tr>
                                <th colspan="2">EMPRESAS PARTICIPANTES</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Nome</td>
                                <td>CPF / CNPJ</td>
                            </tr>
                            <?php
                            $sql2 = "SELECT * FROM cpl_empresa WHERE (CdCPL = ".$rsLinha['CdCPL'].") AND (Acao = 'Publicado')";
                            $sqlEmpresa = mysql_query($sql2);
                            $Empresa = mysql_num_rows($sqlEmpresa);

                            for ($x = 0; $x < $Empresa; $x++){
                            $verEmpresa = mysql_fetch_array($sqlEmpresa);

                            if ($verEmpresa['Situacao'] == "Ganhadora"){
                                $classSituacao = "success";
                                $classIcon = "fa-check";
                            }else{
                                $classSituacao = "warning";
                                $classIcon = "fa-times";
                            }
                            ?>
                            <tr>
                                <td><?php echo $verEmpresa['Nome'];?></td>
                                <td><?php echo $verEmpresa['CPFCNPJ'];?></td>
                            </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>


        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Anexos</h3>
        </div>

        <div class="panel-body">
            <br clear="all">
            <table class="table table-bordered table-striped">
                <colgroup>
                    <col class="col-xs-3">
                    <col class="col-xs-3">
                    <col class="col-xs-7">
                </colgroup>

                <tbody>
                <?php
                $sqlAnexo = "SELECT * FROM arquivos WHERE (Codigo = ".$rsLinha['CdCPL'].")";
                $sqlAz = mysql_query($sqlAnexo);
                $Anexo = mysql_num_rows($sqlAz);

                for ($x = 0; $x < $Anexo; $x++){
                    $verAnexo = mysql_fetch_array($sqlAz);
                ?>
                    <div class="col-sm-4">
                        <a class="btn btn-default btn-xlg btn-featured btn-inverse" href="<?php echo $UrlAmigavel ?>dinamico/cpl/<?php echo $verAnexo['Arquivo'];?>" target="_blank">
                            <span><?php echo $verAnexo['Tipo'];?></span>
                            <i class="fa fa-file-pdf-o"></i>
                        </a>
                    </div>

                <?php }?>
                </tbody>
            </table>
        </div>
    </div>

<!--    <button class="btn btn-icon btn-icon-left btn-sm btn-primary">-->
<!--        <i class="fa fa-arrow-left"></i>-->
<!--        Voltar-->
<!--    </button>-->
</div>

