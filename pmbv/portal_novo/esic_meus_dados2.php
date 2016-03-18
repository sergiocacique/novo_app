<?php
if(isset($_SESSION['IDSIC']) == ""){
    ?>
    <script language="JavaScript">
        window.location="index.php?Pages=esic_acesso";
    </script>
<?php
}
?>
<script src="<?php echo $UrlAmigavel?>js/jquery.mask.min.js"></script>

<!-- DEPENDENCIES -->

<link rel="stylesheet" href="<?php echo $UrlAmigavel?>css/demo.min.css">
<script>
    $( function() {
        'use strict';
// Validation using tooltip
        $( '#tip-validate' ).validate({
            rules:{
                tipText: {
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
    }
</script>
<div id="breadcrumb">
        <div id="breadcrumb_primeiro"><span>Sistema e-SIC</span></div>
        <div id="breadcrumb_ultima"><span>Dados Cadastrais</span></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Meus Dados</h3>
                </div><!-- /panel-heading -->

                <div class="panel-body">
                    <?php
                    $sqlSIC1 = mysql_query("SELECT * FROM sic_usuario WHERE id = '".$_SESSION['IDSIC']."'");
                    $rsSIC1 = mysql_fetch_array($sqlSIC1);
                    ?>
                    <form id="tip-validate" class="form-bordered" action="#">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label>Nome</label><br>
                                <?php echo $rsSIC1['Nome']?>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>E-mail</label><br>
                                <?php echo $rsSIC1['Email']?>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>CPF</label><br>
                                <?php echo mask($rsSIC1['CPF'],'###.###.###-##')?>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipSenha">Senha</label>
                                <input type="password" id="tipSenha" name="tipSenha" class="form-control" placeholder="Senha">
                            </div>
                        </div>



                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipCep">CEP</label>
                                <div class="input-group input-group-in">
                                <input id="tipCep"  name="tipCep" class="form-control" placeholder="69305-130" value="<?php echo $rsSIC1['CEP']?>">
                                <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>



                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipEndereco">Endereço</label>
                                <div class="input-group input-group-in">
                                <input id="tipEndereco" name="tipEndereco" class="form-control" placeholder="Rua General Penha Brasil, 1011" value="<?php echo $rsSIC1['Endereco']?>">
                                <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipBairro">Bairro</label>
                                <div class="input-group input-group-in">
                                <input id="tipBairro" name="tipBairro" class="form-control" placeholder="São Francisco" value="<?php echo $rsSIC1['Bairro']?>">
                                <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="tipCidade">Cidade</label>
                                <div class="input-group input-group-in">
                                <input id="tipCidade" name="tipCidade" class="form-control" placeholder="Boa Vista" value="<?php echo $rsSIC1['Cidade']?>">
                                <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="tipEstado">Estado</label>
                                <div class="input-group input-group-in">
                                <input id="tipEstado" name="tipEstado" class="form-control" placeholder="Roraima" value="<?php echo $rsSIC1['Estado']?>">
                                <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="tipTelefone">Telefone</label>
                                <div class="input-group input-group-in">
                                <input id="tipTelefone" name="tipTelefone" class="form-control" placeholder="(00) 00000-0000" value="<?php echo $rsSIC1['Telefone']?>">
                                <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <button class="btn btn-default" type="submit">Salvar dados</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /panel-body -->
            </div><!-- /panel-rpcdefault -->



        </div><!-- /.cols -->
    </div>