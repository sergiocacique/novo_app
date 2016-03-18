
<script>

    jQuery(function($){
        // JQUERY MASK INPUT
        $('[data-mask="date"]').mask('00/00/0000');
        $('[data-mask="time"]').mask('00:00:00');
        $('[data-mask="date_time"]').mask('00/00/0000 00:00:00');
        $('[data-mask="zip"]').mask('00000-000');
        $('[data-mask="money"]').mask('000.000.000.000.000,00', {reverse: true});
        $('[data-mask="phone"]').mask('0000-0000');
        $('[data-mask="phone_with_ddd"]').mask('(00) 0 0000-0000');
        $('[data-mask="phone_us"]').mask('(000) 000-0000');
        $('[data-mask="cpf"]').mask('000.000.000-00', {reverse: true});
        $('[data-mask="ip_address"]').mask('099.099.099.099');
        $('[data-mask="percent"]').mask('##0,00%', {reverse: true});
        // END JQUERY MASK INPUT
    });

    $(document).ready( function() {
        $("#tip-validate").validate({
            // Define as regras
            rules:{
                tipNome:{
                    // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                    required: true, minlength: 5
                },
                tipDtNasc:{
                    // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                    required: true
                },

                tipMAIL:{
                    // campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                    required: true, email: true
                },
                tipCPF:{
                    // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                    required: true, minlength: 11
                },
                tipSenha:{
                    // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                    required: true, minlength: 6
                },
                tipCep:{
                    // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                    required: true, minlength: 8
                },
                tipEndereco:{
                    // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                    required: true, minlength: 2
                },
                tipBairro:{
                    // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                    required: true, minlength: 2
                },
                tipCidade:{
                    // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                    required: true, minlength: 2
                },
                tipEstado:{
                    // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                    required: true, minlength: 2
                },
                tipTelefone:{
                    // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                    required: true, minlength: 2
                }
            },
            // Define as mensagens de erro para cada regra
            messages:{
                tipNome:{
                    required: "*",
                    minLength: "O seu nome deve conter, no mínimo, 2 caracteres"
                },
                tipDtNasc:{
                    required: "*",
                    minLength: "O seu nome deve conter, no mínimo, 2 caracteres"
                },

                tipMAIL:{
                    required: "*",
                    email: "Digite um e-mail válido"
                },
                tipCPF:{
                    required: "*",
                    minLength: "A sua mensagem deve conter, no mínimo, 2 caracteres"
                },
                tipSenha:{
                    required: "*",
                    minLength: "A sua mensagem deve conter, no mínimo, 2 caracteres"
                },
                tipCep:{
                    required: "*",
                    minLength: "A sua mensagem deve conter, no mínimo, 2 caracteres"
                },
                tipEndereco:{
                    required: "*",
                    minLength: "A sua mensagem deve conter, no mínimo, 2 caracteres"
                },
                tipBairro:{
                    required: "*",
                    minLength: "A sua mensagem deve conter, no mínimo, 2 caracteres"
                },
                tipCidade:{
                    required: "*",
                    minLength: "A sua mensagem deve conter, no mínimo, 2 caracteres"
                },
                tipEstado:{
                    required: "*",
                    minLength: "A sua mensagem deve conter, no mínimo, 2 caracteres"
                },
                tipTelefone:{
                    required: "*",
                    minLength: "A sua mensagem deve conter, no mínimo, 2 caracteres"
                }
            }
        });
    });

    $(document).ready(function(){

        $('#tipMAIL').keyup(email_check);
        $('#tipCPF').keyup(CPF_check); });

    function email_check(){

        var email = $('#tipMAIL').val();

        if(email == '' || email.length < 4){
            $('#tipMAIL').css('border', '1px #CCC solid');
            //$('#tickMAIL').hide();
        }else{
            jQuery.ajax({
                type: 'POST', url: 'lista/check_email.php', data: 'tipMAIL='+ email, cache: false, success: function(response){
                    if(response == 1){
                        $('#tipMAIL').css('border', '1px #C33 solid');
                        $('#tickMAIL').css('background', '#C33');
                        $('#iconMAIL').css('color', '#FFF');
                        $("#iconMAIL").removeClass("fa fa-question-circle").fadeIn();
                        $("#iconMAIL").addClass("fa fa-times-circle");
                        //$('#tickCPF').hide(); $('#cross').fadeIn();
                        $("#addCadastro").addClass("oculto")
                    }else{
                        $('#tipMAIL').css('border', '1px #1e8449 solid');
                        $('#tickMAIL').css('background', '#1e8449');
                        $('#iconMAIL').css('color', '#FFF');
                        $("#iconMAIL").removeClass("fa fa-question-circle").fadeIn();
                        $("#iconMAIL").addClass("fa fa-check-circle");
                        $("#addCadastro").removeClass("oculto");
                    }
                }
            });
        }
    }

    function CPF_check() {

        var CPF = $('#tipCPF').val();

        if (CPF == '' || CPF.length < 14 || CPF.length > 14) {
            $('#tipCPF').css('border', '1px #CCC solid');
            //$('#tickCPF').hide();
        }else{
            jQuery.ajax({
                type: 'POST', url: 'lista/check_cpf.php', data: 'tipCPF='+ CPF, cache: false, success: function(response){
                    if(response == 1){
                        $('#tipCPF').css('border', '1px #C33 solid');
                        $('#tickCPF').css('background', '#C33');
                        $('#iconCPF').css('color', '#FFF');
                        $("#iconCPF").removeClass("fa fa-question-circle").fadeIn();
                        $("#iconCPF").addClass("fa fa-times-circle");
                        $("#addCadastro").addClass("oculto")
                        //$('#tickCPF').hide(); $('#cross').fadeIn();
                    }else{
                        $('#tipCPF').css('border', '1px #1e8449 solid');
                        $('#tickCPF').css('background', '#1e8449');
                        $('#iconCPF').css('color', '#FFF');
                        $("#iconCPF").removeClass("fa fa-question-circle").fadeIn();
                        $("#iconCPF").addClass("fa fa-check-circle");
                        $("#addCadastro").removeClass("oculto");
                    }
                }
            });
        }
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
                    <h3 class="panel-title">Ainda não tenho cadastro</h3>
                </div><!-- /panel-heading -->

                <div class="panel-body">
                    <br><br>
                    <form id="tip-validate" class="form-bordered" action="esic_salvar.php" method="post">

                        <div class="col-xs-8 col-sm-8 col-md-8">
                            <div class="form-group">
                                <label for="tipNome">Nome Completo</label>
                                <div class="input-group input-group-in">
                                    <input id="tipNome" name="tipNome" class="form-control" placeholder="Nome Completo">
                                    <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="tipDtNasc">Data de Nascimento</label>
                                <div class="input-group input-group-in">
                                    <input data-mask="date" id="tipDtNasc" name="tipDtNasc" class="form-control" placeholder="Data de Nascimento">
                                    <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipMAIL">E-MAIL</label>
                                <div class="input-group input-group-in">
                                    <input id="tipMAIL" name="tipMAIL" class="form-control" placeholder="E-mail">
                                    <span id="tickMAIL" class="input-group-addon"><i id="iconMAIL" class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipCPF">CPF</label>
                                <div class="input-group input-group-in">
                                    <input data-mask="cpf" id="tipCPF" maxlength="11" name="tipCPF" class="form-control" placeholder="CPF">
                                    <span id="tickCPF" class="input-group-addon"><i id="iconCPF" class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipSenha">Senha</label>
                                <div class="input-group input-group-in">
                                <input type="password" id="tipSenha" name="tipSenha" class="form-control" placeholder="Senha">
                                    <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>



                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipCep">CEP</label>
                                <div class="input-group input-group-in">
                                <input data-mask="zip" id="tipCep"  name="tipCep" class="form-control" placeholder="CEP">
                                <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>



                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipEndereco">Endereço</label>
                                <div class="input-group input-group-in">
                                <input id="tipEndereco" name="tipEndereco" class="form-control" placeholder="Endereço">
                                <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipBairro">Bairro</label>
                                <div class="input-group input-group-in">
                                <input id="tipBairro" name="tipBairro" class="form-control" placeholder="Bairro">
                                <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="tipCidade">Cidade</label>
                                <div class="input-group input-group-in">
                                <input id="tipCidade" name="tipCidade" class="form-control" placeholder="Cidade">
                                <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="tipEstado">Estado</label>
                                <div class="input-group input-group-in">
                                <input id="tipEstado" name="tipEstado" class="form-control" placeholder="Estado">
                                <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="tipTelefone">Telefone</label>
                                <div class="input-group input-group-in">
                                <input type="tel" pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$" data-mask="phone_with_ddd" id="tipTelefone" name="tipTelefone" class="form-control" placeholder="Telefone">
                                <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div id="addCadastro" class="col-xs-12 col-sm-12 col-md-12 oculto">
                            <div class="form-group">
                                <button class="btn btn-3d btn-xlg btn-dirtygreen" type="submit">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /panel-body -->
            </div><!-- /panel-rpcdefault -->



        </div><!-- /.cols -->
    </div>