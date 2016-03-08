<?php
/**
 * Created by PhpStorm.
 * User: elidiane
 * Date: 24/11/14
 * Time: 09:34
 */
include ("conexao.php");
include ("funcao.php");
?>
<?php
$sqlPermissao = mysql_query("SELECT * FROM adm_permissao WHERE CdUsuario = ".$_SESSION['UsuarioID']." ");
$verPermissao = mysql_fetch_array($sqlPermissao);

$sqlAdmin = mysql_query("SELECT * FROM admin WHERE CdUsuario = ".$_SESSION['UsuarioID']." ");
$verAdmin = mysql_fetch_array($sqlAdmin);

$Config = mysql_query("SELECT * FROM config WHERE Nome = 'Limite'") or die("erro ao selecionar");
$verConfig = mysql_fetch_array($Config);
?>
<script>
    function Mudarestado(el) {
        var display = document.getElementById(el).style.display;
        if(display == "block")
            document.getElementById(el).style.display = 'none';
        else
            document.getElementById(el).style.display = 'block';
    }
    jQuery(function($){
        // JQUERY MASK INPUT
        $('[data-mask="date"]').mask('00/00/0000');
        $('[data-mask="time"]').mask('00:00:00');
        $('[data-mask="date_time"]').mask('00/00/0000 00:00:00');
        $('[data-mask="zip"]').mask('00000-000');
        $('[data-mask="money"]').mask('000.000.000.000.000,00', {reverse: true});
        $('[data-mask="phone"]').mask('0000-0000');
        $('[data-mask="phone_with_ddd"]').mask('(00) 0000-0000');
        $('[data-mask="phone_us"]').mask('(000) 000-0000');
        $('[data-mask="cpf"]').mask('000.000.000-00', {reverse: true});
        $('[data-mask="ip_address"]').mask('099.099.099.099');
        $('[data-mask="percent"]').mask('##0,00%', {reverse: true});
        // END JQUERY MASK INPUT
    });

    // Validation using tooltip
    $( '#formulario_adicionar' ).validate({
        rules:{
            nunSIAFI: {
                required: true,
                minlength: 2
            },
            tipPasswd: {
                required: true,
                minlength: 5
            },
            confirmTipPasswd: {
                required: true,
                minlength: 5,
                equalTo: '#tipPasswd'
            },
            tipEmail: {
                required: true,
                email: true
            },
            tipSelect: {
                required: true
            },
            tipFile: {
                required: true
            },
            tipAgree: 'required'
        },
        showErrors: function(errorMap, errorList) {
            var $form = $( this.currentForm ),
                errors = this.numberOfInvalids();

            if( errors ){
                // disable submit button
                $form.find('[type="submit"]').attr('disabled', true);
            } else{
                // enable submit button
                $form.find('[type="submit"]').attr('disabled', false);
            }

            // Clean up any tooltips for valid elements
            $.each( this.validElements(), function ( i, elem ) {
                var $elem = $( elem ),
                    $targetTip = ( $elem.is( '[type="checkbox"]' ) ) ? $elem.next().children( '.fake-addon' ) : $elem.next(),
                    $formGroup = $elem.closest( '.form-group' );

                // remove error state
                $formGroup.removeClass( 'has-error' );
                // remove tooltip
                $targetTip.tooltip( 'destroy' );
            });

            // Create new tooltips for invalid elements
            $.each(errorList, function( i, error ){
                var $elem = $( error.element ),
                    $targetTip = ( $elem.is( '[type="checkbox"]' ) ) ? $elem.next().children( '.fake-addon' ) : $elem.next(),	// targeting the tooltip on addon input
                    $formGroup = $elem.closest( '.form-group' ),
                    data = {};

                // adding error state
                $formGroup.addClass( 'has-error' );

                // tooltip options
                data.template = '<div class="tooltip tooltip-danger"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>';
                data.placement = ( $elem.is( '[type="checkbox"]' ) ) ? 'bottom' : 'left';
                data.container = 'body';
                data.title = error.message;
                data.trigger = 'focus';		// use focus, so tooltip still available until element is valid

                // destroy existing tooltip
                $targetTip.tooltip( 'destroy' );

                // create a new tooltip
                $targetTip.tooltip( data )
                    .tooltip( 'show' );
            });
        }
    });


    function carregaAno(ano){
        start();
        $('#loading2').css('visibility','visible');
        $.post("cpl_ano.php", { ano: ano },
            function(data){
                $('#anos').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    function carregaMesAno(mes,ano){
        start();
        $('#loading2').css('visibility','visible');
        $.post("cpl_mes_ano.php", { mes: mes, ano: ano },
            function(data){
                $('#resultado').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }


    function recusar(id,mes,ano){
        bootbox.dialog({
            message: 'Deseja Devolver está Passagem?',
            title: 'Confirmação',
            buttons: {
                success: {
                    label: 'Devolver',
                    className: 'btn-success',
                    callback: function() {
                        toastr.success('Contrato e Licitação Devolvido com sucesso.');

                        var dados = jQuery( this ).serialize();

                        jQuery.ajax({
                            type: "POST",
                            url: "cpl_status.php?id="+id+"&acao=Correcao",
                            data: dados,
                            success: function( data )
                            {
                                start();
                                $('#loading2').css('visibility','visible');
                                $.post("cpl_mes_ano.php", { mes: mes, ano: ano },
                                    function(data){
                                        start();
                                        $('#resultado').html(data);
                                    }).done(function() {
                                        $('#loading2').css('visibility','hidden');
                                    });
                            }
                        });
                    }
                },
                danger: {
                    label: 'Cancelar',
                    className: 'btn-danger',
                    callback: function() {
                        toastr.info('Ação cancelada');
                    }
                }
            }
        });

        return false;
    };

    function Esvaziar(id){
        bootbox.dialog({
            message: 'Deseja TRAMITAR este contrato para o Órgão Fiscalizador?',
            title: 'Confirmação',
            buttons: {
                success: {
                    label: 'Confirmar',
                    className: 'btn-success',
                    callback: function() {
                        toastr.success('contrato TRAMITADO com sucesso.');

                        var dados = jQuery( this ).serialize();

                        jQuery.ajax({
                            type: "POST",
                            url: "cpl_status.php?id="+id+"&acao=Tramitar",
                            data: dados,
                            success: function( data )
                            {
                                start();
                                $('#loading2').css('visibility','visible');
                                $.post("cpl_carrega.php",
                                    function(data){
                                        start();
                                        $('#resultado').html(data);
                                    }).done(function() {
                                        $('#loading2').css('visibility','hidden');
                                    });
                            }
                        });
                    }
                },
                danger: {
                    label: 'Cancelar',
                    className: 'btn-danger',
                    callback: function() {
                        toastr.info('Ação cancelada');
                    }
                }
            }
        });

        return false;
    };


    function Excluir(id,mes,ano){
        bootbox.dialog({
            message: 'Deseja Excluir este Contrato e Licitação?',
            title: 'Confirmação',
            buttons: {
                success: {
                    label: 'Excluir',
                    className: 'btn-success',
                    callback: function() {
                        toastr.success('Contrato e Licitação Excluido com sucesso.');

                        var dados = jQuery( this ).serialize();

                        jQuery.ajax({
                            type: "POST",
                            url: "cpl_status.php?id="+id+"&acao=Excluido",
                            data: dados,
                            success: function( data )
                            {
                                start();
                                $('#loading2').css('visibility','visible');
                                $.post("cpl_carrega.php",
                                    function(data){
                                        start();
                                        $('#resultado').html(data);
                                    }).done(function() {
                                        $('#loading2').css('visibility','hidden');
                                    });
                            }
                        });
                    }
                },
                danger: {
                    label: 'Cancelar',
                    className: 'btn-danger',
                    callback: function() {
                        toastr.info('Ação cancelada');
                    }
                }
            }
        });

        return false;
    };



    function Publicar(id,mes,ano){
        bootbox.dialog({
            message: 'Deseja publicado este Contrato e Licitação?',
            title: 'Confirmação',
            buttons: {
                success: {
                    label: 'Aprovar',
                    className: 'btn-success',
                    callback: function() {
                        toastr.success('Contrato e Licitação Publicado com sucesso.');

                        var dados = jQuery( this ).serialize();

                        jQuery.ajax({
                            type: "POST",
                            url: "cpl_status.php?id="+id+"&acao=Publicado",
                            data: dados,
                            success: function( data )
                            {
                                start();
                                $('#loading2').css('visibility','visible');
                                $.post("cpl_mes_ano.php", { mes: mes, ano: ano },
                                    function(data){
                                        start();
                                        $('#resultado').html(data);
                                    }).done(function() {
                                        $('#loading2').css('visibility','hidden');
                                    });
                            }
                        });
                    }
                },
                danger: {
                    label: 'Cancelar',
                    className: 'btn-danger',
                    callback: function() {
                        toastr.info('Ação cancelada');
                    }
                }
            }
        });

        return false;
    };


    /*
     * Adicionar Planilha
     */



    $(document).ready(function(){
        $('#salvar').click(function(){
            $('#formulario_enviar_planilha').ajaxForm({

                success: function(data) {

                    if(data.sucesso == true){
                        start();
                        toastr.success('Importado com sucesso');
                        $('#modalEnviarPlanilha').modal('hide');
                        $('#loading2').css('visibility','visible');
                        $('#resultado').html('<img src="'+ data.msg +'" />');
                    }
                    else{
                        $('#resultado').html(data.msg);
                    }
                },
//                error : function(){
//                    $('#modalEnviarPlanilha').modal('hide');
//                    $('#resultado').html('Erro ao enviar requisição!!!');
//                },
                dataType: 'json',
                url: 'cpl_enviar_planilha.php',
                resetForm: true
            }).submit();
        })
    })

    /*
     * Cadastrar Manual
     */

    jQuery(document).ready(function(){
        jQuery('#formulario_adicionar').submit(function(){
            var dados = jQuery( this ).serialize();

            jQuery.ajax({
                type: "POST",
                url: "cpl_grava.php",
                data: dados,
                success: function( data )
                {
                    start();
                    //$('#resultado').load("legislacao_inc.php");
                    $("#formulario_adicionar").get(0).reset();
                    $('#modalCadastrar').modal('hide');
                    toastr.success('Contrato e Licitação inserido com sucesso.');
                },
                error: function( xhr, error)
                {
                    console.debug(xhr);
                    toastr.error(xhr.statusText);
                }
            });
            return false;
        });
    });

    /*
     * Alterar Registro
     */
    jQuery(document).ready(function(){
        jQuery('#formulario_clientes').submit(function(){
            var dados = jQuery( this ).serialize();

            var quebra  = dados.split("&");
            var mes = quebra[12].split("=")[1];
            var ano = quebra[13].split("=")[1];

            jQuery.ajax({
                type: "POST",
                url: "cpl_salvar.php",
                data: dados,
                success: function( data )
                {
                    start();
                    toastr.success('Contrato e Licitação Alterado.');
                    $('#modalLarge').modal('hide');
                    $.post("cpl_mes_ano.php", {mes: mes, ano: ano},

                        function(data){
                            $('#resultado').html(data);
                        }).done(function() {
                            $('#loading2').css('visibility','hidden');
                        });

                },
                error: function( xhr, error)
                {
                    console.debug(xhr);
                    toastr.error(xhr.statusText);
                }
            });
            return false;
        });
    });

    /*
     * Esta função serve para preencher os campos do cliente na janela flutuante
     * usando jSon.
     */
    function carregaDadosClienteJSon(id){
        $.get('cpl_seleciona.php', {
            id: id
        }, function (data){
            $('#CdPrefeitura').val(data.CdPrefeitura);
            $('#numProtocolo').val(data.numProtocolo);
            $('#DtEntrada').val(data.DtEntrada);
            $('#Processo').val(data.Processo);
            $('#Unidade').val(data.Unidade);
            $('#Fonte').val(data.Fonte);
            $('#Modalidade').val(data.Modalidade);
            $('#Objeto').val(data.Objeto);
            $('#DtDOM').val(data.DtDOM);
            $('#Vencedor').val(data.Vencedor);
            $('#CNPJ').val(data.CNPJ);
            $('#Valor').val(data.Valor);
            $('#mes').val(data.mes);
            $('#ano').val(data.ano);
            $('#id').val(data.id);//aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente.
        }, 'json');
    }

    function janelaEditarCliente(id){

        //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
        carregaDadosClienteJSon(id);

        $('#modalLarge').modal('show');
    }
</script>
<section class="page-header page-header-xs">
    <div class="container">
        <h1>CONTRATOS E LICITA&Ccedil;ÕES</h1>
        <ul class="page-header-tabs list-inline">
            <li class="active"><a href="shortcode-tables.html">Mostrar Todos</a></li>
            <li><a href="shortcode-tables-jqgrid.html">Cadastrar</a></li>
        </ul>
    </div>
</section>

<section>
    <div class="container wrapper">

    </div>
</section>

<section>
    <div class="container">
        <?php if ($verAdmin['Perfil'] == '1' OR $verAdmin['Perfil'] == '2'){
            $sqlUlt = mysql_query("SELECT * FROM cpl GROUP BY DATE_FORMAT(DtAbertura, '%Y'), DATE_FORMAT(DtAbertura, '%m') ORDER BY DATE_FORMAT(DtAbertura, '%Y') DESC, DATE_FORMAT(DtAbertura, '%m') DESC LIMIT 1");
            $rsLinha2 = mysql_fetch_array($sqlUlt);

            $Conta = mysql_num_rows($sqlUlt);

            $MesSelecionado = date('m', strtotime($rsLinha2['DtAbertura']));
            $AnoSeleciona = date('Y', strtotime($rsLinha2['DtAbertura']));
            ?>
            <div class="content">
                <div class="row">
                    <?php
                    if ($Conta != 0) {
                        ?>
                        <div id="anos" class="col-md-12">
                            <div class="btn-group">
                                <button type="button" id="dashboardRange" class="btn btn-3d btn-black pull-right dropdown-toggle" data-toggle="dropdown">
                                    <span><?php echo $AnoSeleciona;?></span>
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <?php
                                    $sqlAnos = mysql_query("SELECT * FROM cpl GROUP BY DATE_FORMAT(DtAbertura, '%Y') ORDER BY DATE_FORMAT(DtAbertura, '%Y') DESC");
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

                            <?php

                            $sql = "SELECT * FROM cpl WHERE DATE_FORMAT(DtAbertura, '%Y' )= " . $AnoSeleciona . " AND Acao <> 'Arquivo' AND Acao <> 'Correcao' GROUP BY DATE_FORMAT(DtAbertura, '%m') ORDER BY DATE_FORMAT(DtAbertura, '%Y') DESC, DATE_FORMAT(DtAbertura, '%m') DESC";
                            $sqlGlossario = mysql_query($sql);
                            $Glossario = mysql_num_rows($sqlGlossario);

                            $total = 0;
                            $totalliberado = 0;
                            for ($y = 0; $y < $Glossario; $y++) {
                                $verGlossario = mysql_fetch_array($sqlGlossario);

                                if ($verGlossario['Acao'] == "Aguardando"){
                                    $classStatus = "btn-red";
                                }else{
                                    if (date('m', strtotime($verGlossario['DtAbertura'])) == $MesSelecionado){
                                        $classStatus = "btn-purple";
                                    }else{
                                        $classStatus = "btn-dirtygreen";
                                    }
                                }



                                ?>
                                <a onclick="carregaMesAno(<?php echo date('m', strtotime($verGlossario['DtAbertura'])); ?>,<?php echo date('Y', strtotime($verGlossario['DtAbertura'])); ?>)" href="javascript:void(0)">
                                    <i class="btn btn-3d <?php echo $classStatus;?>"><?php echo retorna_mes_extenso(date('m', strtotime($verGlossario['DtAbertura']))); ?> / <?php echo date('Y', strtotime($verGlossario['DtAbertura'])); ?></i>
                                </a>
                            <?php
                            }
                            ?>

                        </div>
                        <br clear="all"><br clear="all">
                        <div id="verDados" class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body text-center">
                                    <h4><?php echo retorna_mes_extenso($MesSelecionado); ?> / <?php echo $AnoSeleciona; ?></h4><br clear="all">

                                    <?php
                                    $sql = "SELECT * FROM cpl WHERE Acao <> 'Cadastrando' AND DATE_FORMAT(DtAbertura, '%c') = ".$MesSelecionado." AND DATE_FORMAT(DtAbertura, '%Y') = ".$AnoSeleciona." ORDER BY Acao ASC";
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
                                                    <i class="btn btn-3d btn-<?php echo $color;?>"><?php echo $verGlossario['Acao']; ?></i>
                                                </h4>

                                                <div class="col-md-12 oculto" id="<?php echo $y;?>">
                                                    <div class="col-md-12">
                                                        <?php
                                                        if ($verGlossario['Acao'] == 'Publicado'){
                                                            ?>
                                                            <i class="btn btn-3d btn-<?php echo $color;?>"><?php echo $verGlossario['Acao']; ?></i>
                                                            <br><br clear="all">
                                                        <?php
                                                        }else{
                                                            ?>

                                                            <a onclick="Publicar(<?php echo $verGlossario['CdCPL']; ?>,<?php echo date('m', strtotime($verGlossario['DtAbertura'])); ?>,<?php echo date('Y', strtotime($verGlossario['DtAbertura'])); ?>)" href="javascript:void(0)">
                                                                <i class="btn btn-3d btn-dirtygreen fa fa-thumbs-o-up"></i>
                                                            </a>

                                                            <a onclick="recusar(<?php echo $verGlossario['CdCPL']; ?>,<?php echo date('m', strtotime($verGlossario['DtAbertura'])); ?>,<?php echo date('Y', strtotime($verGlossario['DtAbertura'])); ?>)" href="javascript:void(0)">
                                                                <i class="btn btn-3d btn-red fa fa-thumbs-o-down"></i>
                                                            </a>
                                                            <br><br clear="all">

                                                        <?php }?>
                                                    </div>
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
                                                    <table class="table table-bordered table-striped">
                                                        <colgroup>
                                                            <col class="col-xs-3">
                                                            <col class="col-xs-3">
                                                            <col class="col-xs-7">
                                                        </colgroup>

                                                        <tbody>
                                                        <?php
                                                        $sqlAnexo = "SELECT * FROM arquivos WHERE (Codigo = ".$verGlossario['CdCPL'].")";
                                                        $sqlAz = mysql_query($sqlAnexo);
                                                        $Anexo = mysql_num_rows($sqlAz);

                                                        for ($x = 0; $x < $Anexo; $x++){
                                                            $verAnexo = mysql_fetch_array($sqlAz);
                                                            ?>
                                                            <div class="col-sm-4">
                                                                <a class="btn btn-default btn-xlg btn-featured btn-inverse" href="dinamico/cpl/<?php echo $verAnexo['Arquivo'];?>" target="_blank">
                                                                    <span><?php echo $verAnexo['Tipo'];?></span>
                                                                    <i class="fa fa-file-pdf-o"></i>
                                                                </a>
                                                            </div>

                                                        <?php }?>
                                                        </tbody>
                                                    </table>

                                                    <div class="callout callout-success callout-right fade in">
                                                        <h4><?php echo $rsLinha3['Nome'];?></h4>
                                                        <p>cadastrado em: <?php echo date('d/m/Y h:m:s', strtotime($verGlossario['DtCadastro']));?></p>
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
        <?php } else { ?>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <h4>Minhas Tarefas</h4>

                                <div class="row">
                                    <div class="col-xs-3 bordered-right">
                                        <?php
                                        $sicAberto = mysql_query("SELECT * FROM cpl WHERE Acao = 'Arquivo' AND CdUsuario = ".$verAdmin['CdUsuario']." ");
                                        $aberto = mysql_num_rows($sicAberto);
                                        ?>
                                        <p class="text-muted">
                                            <small>EM ABERTO</small>
                                        </p>
                                        <h4>
                                            <strong class="text-warning"><?php echo $aberto;?></strong>
                                        </h4>
                                    </div>


                                    <div class="col-xs-3 bordered-right">
                                        <?php
                                        $sicNao = mysql_query("SELECT * FROM cpl WHERE Acao = 'Aguardando' AND CdUsuario = ".$verAdmin['CdUsuario']."");
                                        $nao_lida = mysql_num_rows($sicNao);
                                        ?>
                                        <p class="text-muted">
                                            <small>AGUARDANDO</small>
                                        </p>
                                        <h4>
                                            <strong class="text-danger"><?php echo $nao_lida;?></strong>
                                        </h4>
                                    </div>

                                    <div class="col-xs-3 bordered-right">
                                        <?php
                                        $sicNao = mysql_query("SELECT * FROM cpl WHERE Acao = 'Correcao' AND CdUsuario = ".$verAdmin['CdUsuario']."");
                                        $nao_lida = mysql_num_rows($sicNao);
                                        ?>
                                        <p class="text-muted">
                                            <small>CORREÇÃO</small>
                                        </p>
                                        <h4>
                                            <strong class="text-danger"><?php echo $nao_lida;?></strong>
                                        </h4>
                                    </div>

                                    <div class="col-xs-3">
                                        <?php
                                        $sicNao = mysql_query("SELECT * FROM cpl WHERE Acao = 'Cadastrando'");
                                        $nao_lida = mysql_num_rows($sicNao);
                                        ?>
                                        <p class="text-muted">
                                            <small>CADASTRANDO</small>
                                        </p>
                                        <h4>
                                            <strong class="text-warning"><?php echo $nao_lida;?></strong>
                                        </h4>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div id="chamado" class="panel-body">
                                <h4>Tarefas Pendentes</h4>
                                <hr>
                                <table class="table table-hover">
                                    <colgroup>
                                        <col class="col-xs-2">
                                        <col class="col-xs-1">
                                        <col class="col-xs-1">
                                        <col class="col-xs-5">
                                        <col class="col-xs-1">
                                        <col class="col-xs-2">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>PROCESSO</th>
                                        <th>HOMOLOGAÇÃO</th>
                                        <th>OBJETO</th>
                                        <th>ABERTURA</th>
                                        <th>VALOR (R$)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = "SELECT * FROM cpl WHERE ((DtHomologacao  is NULL) OR (DtHomologacao is not NULL AND  Acao <> 'Publicado'))  AND CdUsuario = ".$verAdmin['CdUsuario']." ORDER BY Acao DESC";

                                    $sqlGlossario = mysql_query($sql);
                                    $Glossario = mysql_num_rows($sqlGlossario);

                                    if ($Glossario == 0) {
                                        ?>
                                        <tr>
                                            <td colspan="6" class="text-danger text-center"><h4>vázio</h4></td>
                                        </tr>
                                    <?php
                                    }else{

                                        $total = 0;
                                        for ($y = 0; $y < $Glossario; $y++) {
                                            $verGlossario = mysql_fetch_array($sqlGlossario);

                                            if ($verGlossario['Acao'] == 'Correcao'){
                                                $classI = "class='danger'";
                                            }elseif ($verGlossario['Acao'] == 'Arquivo'){
                                                $classI = "class='info'";
                                            }else{
                                                $classI = "";
                                            }

                                            ?>
                                            <tr <?php echo $classI;?>>
                                            <?php if($verGlossario['DtHomologacao'] == ''){?>
                                                <td>
                                                    <a href="index.php?Pages=cpl_alterar&cpl=<?php echo $verGlossario['CdCPL']; ?>"> <i class="btn btn-3d btn-aqua">Corrigir Data</i></a>
                                                </td>
                                            <?php }else{?>

                                                <?php if ($verGlossario['Acao'] == 'Cadastrando') { ?>
                                                    <td><a href="index.php?Pages=cpl_alterar&cpl=<?php echo $verGlossario['CdCPL']; ?>"> <i class="btn btn-3d btn-aqua">Continuar</i></a></td>
                                                <?php
                                                }
                                                if ($verGlossario['Acao'] == 'Aguardando'){ ?>
                                                    <td><i class="btn btn-3d btn-red"><?php echo $verGlossario['Acao']; ?></i></td>
                                                <?php }
                                                elseif ($verGlossario['Acao'] == 'Correcao' OR $verGlossario['Acao'] == 'Arquivo') {
                                                    ?>
                                                    <td>
                                                        <?php if ($verGlossario['Acao'] == 'Arquivo' OR $verGlossario['Acao'] == 'Correcao'){
                                                            if(date('d') <= $verConfig['Valor']){
                                                                ?>
                                                                <a onclick="Esvaziar(<?php echo $verGlossario['CdCPL']; ?>)" href="javascript:void(0)">
                                                                    <i class="btn btn-3d btn-amber fa fa-exchange"></i>
                                                                </a>
                                                            <?php }
                                                        }?>
                                                        <a href="index.php?Pages=cpl_alterar&cpl=<?php echo $verGlossario['CdCPL']; ?>">
                                                            <i class="btn btn-3d btn-dirtygreen fa fa-pencil"></i>
                                                        </a>
                                                        <?php if ($verGlossario['Acao'] <> 'Correcao'){ ?>
                                                            <a onclick="Excluir(<?php echo $verGlossario['CdCPL']; ?>)" href="javascript:void(0)">
                                                                <i class="btn btn-3d btn-red fa fa-times"></i>
                                                            </a>
                                                        <?php }?>
                                                    </td>
                                                <?php }?>
                                                <?php }?>
                                                <td><?php echo $verGlossario['NumeroProcesso']; ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($verGlossario['DtHomologacao'])); ?></td>
                                                <td><?php echo $verGlossario['Descricao']; ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($verGlossario['DtAbertura'])); ?></td>
                                                <td>R$ <?php echo number_format($verGlossario['valor_licitacao'], 2, ',', '.'); ?></td>
                                            </tr>
                                        <?php
                                        }

                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
</section>