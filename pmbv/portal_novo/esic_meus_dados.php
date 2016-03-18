<?php

$DataAgora = date("d/m/Y");
$xdata = date('d/m/Y', strtotime('+20 days'));

if(isset($_SESSION['IDSIC']) == ""){
    ?>
    <script language="JavaScript">
        window.location="index.php?Pages=esic_acesso";
    </script>
<?php
}

$sqlLinha2 = mysql_query("SELECT * FROM sic_usuario WHERE id = '".$_SESSION['IDSIC']."'");
$rsSIC = mysql_fetch_array($sqlLinha2);
?>
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

<?php
$sqlSIC1 = mysql_query("SELECT * FROM sic_usuario WHERE id = '".$_SESSION['IDSIC']."'");
$rsSIC1 = mysql_fetch_array($sqlSIC1);
?>
<section class="margin-top-50">
    <div class="container">
        <?php
        $cpf_enviado = validar_cpf($rsSIC1['CPF']);
        // Verifica a resposta da função e exibe na tela
        if($cpf_enviado == true) {

        }elseif($cpf_enviado == false){
        echo "<div class='alert alert-danger margin-bottom-30'>" ;
            echo "<strong>CPF INVÁLIDO</strong><br>" ;
            echo "O seu CPF é inválido, por favor informe um CPF válido" ;

        echo "</div>" ;
        }
        ?>

        <?php
        if($rsSIC1['DtNascimento'] <> "") {

        }else{
            echo "<div class='alert alert-danger margin-bottom-30'>" ;
            echo "<strong>DATA DE NASCIMENTO</strong><br>" ;
            echo "Informe sua data de nascimento, para fazer uma solicitação" ;

            echo "</div>" ;
        }
        ?>

        <div class="col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4 margin-bottom-30">
            <div class="box-light">
                <div class="box-inner">
                    <h4 class="uppercase">
                        Meus
                        <strong>dados</strong>
                    </h4>


                    <form id="tip-validate" class="form-bordered"  method="post" action="esic_gravar.php">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nome</label><br>
                                <?php echo $rsSIC1['Nome']?>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="control-label">Data de Nascimento</label><br>
                                <?php if($rsSIC1['DtNascimento'] <> "") {?>
                                    <?php echo date('d/m/Y', strtotime($rsSIC1['DtNascimento']));?>
                                <?php }elseif($cpf_enviado == false){?>
                                    <input id="tipDtNasc"  data-mask="date" name="tipDtNasc" class="form-control" value="">
                                <?php }?>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="control-label">E-mail</label><br>
                                <?php echo $rsSIC1['Email']?>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="control-label">CPF</label><br>
                                <?php if($cpf_enviado == true) {?>
                                <?php echo $rsSIC1['CPF']?>
                                <?php }elseif($cpf_enviado == false){?>
                                    <input data-mask="cpf" id="tipCPF"  name="tipCPF" class="form-control" value="<?php echo $rsSIC1['CPF']?>">
                                <?php }?>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipSenha" class="control-label">Senha</label>
                                <input type="password" id="tipSenha" name="tipSenha" class="form-control" placeholder="Senha">
                            </div>
                        </div>



                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipCep" class="control-label">CEP</label>
                                <div class="input-group input-group-in">
                                    <input id="tipCep"  name="tipCep" class="form-control" placeholder="69305-130" value="<?php echo $rsSIC1['CEP']?>">
                                    <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>



                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipEndereco" class="control-label">Endereço</label>
                                <div class="input-group input-group-in">
                                    <input id="tipEndereco" name="tipEndereco" class="form-control" placeholder="Rua General Penha Brasil, 1011" value="<?php echo $rsSIC1['Endereco']?>">
                                    <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipBairro" class="control-label">Bairro</label>
                                <div class="input-group input-group-in">
                                    <input id="tipBairro" name="tipBairro" class="form-control" placeholder="São Francisco" value="<?php echo $rsSIC1['Bairro']?>">
                                    <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="tipCidade" class="control-label">Cidade</label>
                                <div class="input-group input-group-in">
                                    <input id="tipCidade" name="tipCidade" class="form-control" placeholder="Boa Vista" value="<?php echo $rsSIC1['Cidade']?>">
                                    <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="tipEstado" class="control-label">Estado</label>
                                <div class="input-group input-group-in">
                                    <input id="tipEstado" name="tipEstado" class="form-control" placeholder="Roraima" value="<?php echo $rsSIC1['Estado']?>">
                                    <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="tipTelefone" class="control-label">Telefone</label>
                                <div class="input-group input-group-in">
                                    <input type="tel" pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$" data-mask="phone_with_ddd"  id="tipTelefone" name="tipTelefone" class="form-control" placeholder="(00) 00000-0000" value="<?php echo $rsSIC1['Telefone']?>">
                                    <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Salvar dados</button>
                            </div>
                        </div>
                        <br clear="all">
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8">

            <ul id="sidebar-nav" class="side-nav list-group margin-bottom-60">
                <li class="list-group-item">
                    <a href="?Pages=esic_registrar_pedido">
                        FAZER SOLICITA&Ccedil;ÃO
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="?Pages=esic_protocolo">
                        MINHAS SOLICITA&Ccedil;ÕES
                    </a>
                </li>
                <li class="list-group-item active">
                    <a href="?Pages=esic_meus_dados">
                        MEUS DADOS
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="?Pages=esic_sair">
                        SAIR
                    </a>
                </li>
            </ul>

            <?php
            $sicAberto = mysql_query("SELECT * FROM sic_ticket WHERE Acao <> 'Fechado' AND Acao = 'Novo' AND CdUsuario = '".$_SESSION['IDSIC']."'");
            $aberto = mysql_num_rows($sicAberto);

            $sicConcluido = mysql_query("SELECT * FROM sic_ticket WHERE Acao = 'Fechado' AND CdUsuario = '".$_SESSION['IDSIC']."'");
            $concluido = mysql_num_rows($sicConcluido);
            ?>

            <div class="box-light margin-bottom-30">
                <div class="row margin-bottom-20">
                    <div class="col-md-6 col-sm-6 col-xs-6 text-center bold">
                        <h2 class="size-30 margin-top-10 margin-bottom-0 font-raleway"><?php echo $aberto;?></h2>
                        <h3 class="size-11 margin-top-0 margin-bottom-10 text-info">ABERTOS</h3>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-center bold">
                        <h2 class="size-30 margin-top-10 margin-bottom-0 font-raleway"><?php echo $concluido;?></h2>
                        <h3 class="size-11 margin-top-0 margin-bottom-10 text-info">CONCLUIDOS</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>