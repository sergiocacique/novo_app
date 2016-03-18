
<script>
    function Mudarestado(el) {
        var display = document.getElementById(el).style.display;
        if(display == "block")
            document.getElementById(el).style.display = 'none';
        else
            document.getElementById(el).style.display = 'block';
    }
    var base_url = "<?php echo $UrlAmigavel.$Pasta ?>";



    function carregaAno(ano){
        $('#loading2').css('visibility','visible');
        $.post("cpl_ano.php", { ano: ano },
            function(data){
                $('#anos').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    function carregaMesAno(mes,ano){
        $('#loading2').css('visibility','visible');
        $.post("cpl_mes_ano.php", { mes: mes, ano: ano },
            function(data){
                $('#resultado').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }


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


<!-- modalSmall -->

<div id="resultado">
    <?php
    $sqlUlt = mysql_query("SELECT * FROM cpl WHERE Acao = 'Publicado' GROUP BY DATE_FORMAT(DtAbertura, '%Y'), DATE_FORMAT(DtAbertura, '%m') ORDER BY DATE_FORMAT(DtAbertura, '%Y') DESC, DATE_FORMAT(DtAbertura, '%m') DESC LIMIT 1");
    $rsLinha2 = mysql_fetch_array($sqlUlt);

    $Conta = mysql_num_rows($sqlUlt);

    $MesSelecionado = date('m', strtotime($rsLinha2['DtAbertura']));
    $AnoSeleciona = date('Y', strtotime($rsLinha2['DtAbertura']));
    ?>
    <div id="resultados" class="content">
        <div class="row">
            <?php
            if ($Conta != 0) {
                ?>
                <div class="col-md-12">
                    <div class="heading-title heading-dotted text-center">
                        <h2>
                            CONTRATOS E LICITAÇÕES
                        </h2>
                    </div>
                </div>
                <br clear="all"><br clear="all">
                <div id="anos" class="col-md-12 text-left">
                    <div class="col-md-1">
                    <div class="btn-group">
                        <button type="button" id="dashboardRange" class="btn btn-3d btn-black pull-right dropdown-toggle" data-toggle="dropdown">
                            <span><?php echo $AnoSeleciona;?></span>
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php
                            $sqlAnos = mysql_query("SELECT * FROM cpl WHERE Acao = 'Publicado' GROUP BY DATE_FORMAT(DtAbertura, '%Y') ORDER BY DATE_FORMAT(DtAbertura, '%Y') DESC");
                            $Anos = mysql_num_rows($sqlAnos);

                            for ($y = 0; $y < $Anos; $y++){
                                $verAnos = mysql_fetch_array($sqlAnos);
                                ?>
                                <li><a href="javascript:void(0)" onclick="carregaAno(<?php echo date('Y', strtotime($verAnos['DtAbertura']));?>)"><?php echo date('Y', strtotime($verAnos['DtAbertura']));?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    </div>
                    <div class="col-md-11 text-left">
                    <?php

                    $sql = "SELECT * FROM cpl WHERE DATE_FORMAT(DtAbertura, '%Y' )= " . $AnoSeleciona . " AND Acao = 'Publicado' GROUP BY DATE_FORMAT(DtAbertura, '%m') ORDER BY DATE_FORMAT(DtAbertura, '%Y') DESC, DATE_FORMAT(DtAbertura, '%m') DESC";
                    $sqlGlossario = mysql_query($sql);
                    $Glossario = mysql_num_rows($sqlGlossario);

                    $total = 0;
                    $totalliberado = 0;
                    for ($y = 0; $y < $Glossario; $y++) {
                        $verGlossario = mysql_fetch_array($sqlGlossario);

                        ?>
                        <a onclick="carregaMesAno(<?php echo date('m', strtotime($verGlossario['DtAbertura'])); ?>,<?php echo date('Y', strtotime($verGlossario['DtAbertura'])); ?>)" href="javascript:void(0)">
                            <i class="btn btn-3d btn-dirtygreen"><?php echo retorna_mes_extenso(date('m', strtotime($verGlossario['DtAbertura']))); ?> / <?php echo date('Y', strtotime($verGlossario['DtAbertura'])); ?></i>
                        </a>
                    <?php
                    }
                    ?>
</div>
                </div>
                <br clear="all"><br clear="all">
                <div id="verDados" class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <h4>
                                    CONTRATOS E LICITAÇÕES DE <?php echo retorna_mes_extenso($MesSelecionado); ?> / <?php echo $AnoSeleciona; ?>
                                    <br>
                                    <small class="text-muted">atualizado em <?php echo date('d/m/Y H:i:s a', strtotime($rsLinha2['DtAtualizacao']))?></small>
                                </h4>
                            <div class="btn-group">
                                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" type="button">
                                    BAIXAR CONTRATO E LICITAÇÃO
                                    <i class="fa fa-arrow-down"></i>
                                </button>
                                <ul class="dropdown-menu text-left" role="menu">
                                    <li>
                                        <a href="javascript:void(0)">Tipo de arquivo</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="cplXLS.php?mes=<?php echo $MesSelecionado;?>&ano=<?php echo $AnoSeleciona;?>&extensao=xls"> Excel (XLS)  </a>
                                    </li>
                                    <li>
                                        <a href="cplXLS.php?mes=<?php echo $MesSelecionado;?>&ano=<?php echo $AnoSeleciona;?>&extensao=ods"> Open Office Calc (ODS)  </a>
                                    </li>
                                    <li>
                                        <a href="cplXLS.php?mes=<?php echo $MesSelecionado;?>&ano=<?php echo $AnoSeleciona;?>&extensao=odt"> Open Office Writer (ODT)  </a>
                                    </li>

                                </ul>
                            </div><br clear="all">

                            <?php
                            $sql = "SELECT * FROM cpl WHERE Acao = 'Publicado' AND DATE_FORMAT(DtAbertura, '%c') = ".$MesSelecionado." AND DATE_FORMAT(DtAbertura, '%Y') = ".$AnoSeleciona." ORDER BY Acao ASC";
                            $sqlGlossario = mysql_query($sql);
                            $Glossario = mysql_num_rows($sqlGlossario);

                            if ($Glossario == 0) {
                                ?>
                                <pre class="col-md-12 xdebug-var-dump" dir="ltr">vázio</pre>
                            <?php
                            }else{

                                $total = 0;
                                for ($y = 0; $y < $Glossario; $y++) {
                                    $verGlossario = mysql_fetch_array($sqlGlossario);

                                    $sqlLinha2 = mysql_query("SELECT * FROM estrutura WHERE CdEstrutura = '".$verGlossario['Orgao']."'");
                                    $rsLinha2 = mysql_fetch_array($sqlLinha2);

                                    $sqlModa = mysql_query("SELECT * FROM cpl_modalidade WHERE id = '".$verGlossario['Modalidade']."'");
                                    $rsModalidade = mysql_fetch_array($sqlModa);

                                    $sqlSituacao = mysql_query("SELECT * FROM cpl_situacao WHERE id = '".$verGlossario['Situacao']."'");
                                    $rsSituacao = mysql_fetch_array($sqlSituacao);

                                    $sqlLinha3 = mysql_query("SELECT * FROM admin WHERE CdUsuario = '".$verGlossario['CdUsuario']."'");
                                    $rsLinha3 = mysql_fetch_array($sqlLinha3);
                                    ?>
                                    <div class="panel-body <?php if($y == 0){?>bordered-bottom<?php }?> text-left">
                                        <h4 class="text-muted text-left col-md-9" style="cursor: pointer" onclick="Mudarestado('<?php echo $y;?>')">
                                            <?php echo $verGlossario['NumeroProcesso'];?> - <?php echo $rsLinha2['Nome'];?><br><br><small><?php echo $verGlossario['Descricao'];?></small><br><br>

                                        </h4>
                                        <?php
                                        if ($verGlossario['Acao'] == 'Publicado'){
                                            $color = "dirtygreen";
                                        }elseIf ($verGlossario['Acao'] == 'Aguardando'){
                                            $color = "amber";
                                        }else{
                                            $color = "red";
                                        }
                                        ?>
                                        <h4 class="text-muted text-right col-md-3" style="cursor: pointer" onclick="Mudarestado('<?php echo $y;?>')">
                                            <?php echo 'R$ ' . number_format($verGlossario['valor_licitacao'], 2, ',', '.');?>
                                        </h4>

                                        <div class="col-md-12 ocultar" id="<?php echo $y;?>">
                                            <table class="table">
                                                <colgroup>
                                                    <col class="col-xs-3">
                                                    <col class="col-xs-6">
                                                </colgroup>
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><?php echo $verGlossario['Descricao'];?></td>
                                                </tr>
                                                <tr>
                                                    <td>Data de entrada</td>
                                                    <td><?php echo date('d/m/Y', strtotime($verGlossario['DtAbertura']));?></td>
                                                </tr>
                                                <tr>
                                                    <td>Unidade</td>
                                                    <td><?php echo $rsLinha2['Nome'];?></td>
                                                </tr>
                                                <tr>
                                                    <td>Fonte</td>
                                                    <td>
                                                        <?php
                                                        $sql3 = "SELECT * FROM cpl_recursos WHERE (CdCPL = ".$verGlossario['CdCPL'].")";
                                                        $sqlRecurso = mysql_query($sql3);
                                                        $Recurso = mysql_num_rows($sqlRecurso);

                                                        for ($x = 0; $x < $Recurso; $x++){
                                                            $verRecurso = mysql_fetch_array($sqlRecurso);
                                                            $sqlRec = mysql_query("SELECT * FROM cpl_recurso WHERE id = '".$verRecurso['CdRecurso']."'");
                                                            $rsRec = mysql_fetch_array($sqlRec);
                                                            ?>
                                                            <code><?php echo $rsRec['nome'];?> <?php if ($verGlossario['Descricao'] != ""){ echo "  " .$verGlossario['Descricao']; }?><br></code>
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
                                                                <col class="col-xs-9">
                                                            </colgroup>
                                                            <thead>
                                                            <tr>
                                                                <th colspan="2">Aviso de Abertura</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>Data de Abertura</td>
                                                                <td><code><?php echo date('d/m/Y', strtotime($verGlossario['DtAbertura']));?></code></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Data de Publicação</td>
                                                                <td><code><?php echo date('d/m/Y', strtotime($verGlossario['DtPublicacao']));?></code></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Veículo de publicação (Ex. DOM)</td>
                                                                <td><code><?php echo $verGlossario['Veiculo'];?></code></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Número do DOM</td>
                                                                <td><code><?php echo $verGlossario['numeroDOM'];?></code></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Publicação Diário Oficial</td>
                                                    <td><?php echo date('d/m/Y', strtotime($verGlossario['DtPublicacao']));?></td>
                                                </tr>
                                                <tr>
                                                    <td>Número Diário</td>
                                                    <td><?php echo $verGlossario['numeroDOM'];?></td>
                                                </tr>
                                                <tr>
                                                    <td>Situação</td>
                                                    <td><?php echo $rsSituacao['nome'];?></td>
                                                </tr>
                                                <tr>
                                                    <td>Valor</td>
                                                    <td><?php echo 'R$' . number_format($verGlossario['valor_licitacao'], 2, ',', '.');?></td>
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
                                                            $sql2 = "SELECT * FROM cpl_empresa WHERE (CdCPL = ".$verGlossario['CdCPL'].") AND (Acao = 'Publicado')";
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
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Anexos</h3>
                                            </div>
                                            <div class="help-block text-center">
                                                <?php
                                                $sqlAnexo = "SELECT * FROM arquivos WHERE (Codigo = ".$verGlossario['CdCPL'].")";
                                                $sqlAz = mysql_query($sqlAnexo);
                                                $Anexo = mysql_num_rows($sqlAz);

                                                for ($x = 0; $x < $Anexo; $x++){
                                                    $verAnexo = mysql_fetch_array($sqlAz);
                                                    ?>
                                                <a class="btn btn-3d btn-xlg btn-purple" href="http://transparencia.boavista.rr.gov.br/dinamico/cpl/<?php echo $verAnexo['Arquivo'];?>" target="_blank">
                                                    <i class="fa fa-file-pdf-o"></i>
                                                    <br>
                                                    <span><?php echo $verAnexo['Tipo'];?></span>
                                                </a>


                                                <?php }?>
                                              </div>

                                            <div class="callout callout-success callout-left fade in">
                                                <small>cadastrado em: <?php echo date('d/m/Y h:m:s', strtotime($verGlossario['DtCadastro']));?></small><br>
                                                <small>publicado em: <?php echo date('d/m/Y h:m:s', strtotime($verGlossario['DtAtualizacao']));?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }

                            }
                            ?>

                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php
            }else{
                ?>
                <h5>
                    Nenhum registro encontrado
                </h5>
            <?php
            }
            ?>
        </div>
    </div>
</div>

</section>