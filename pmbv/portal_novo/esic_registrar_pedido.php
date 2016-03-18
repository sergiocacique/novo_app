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

    $(document).ready( function() {
        $("#tip-validate").validate({
            // Define as regras
            rules:{
                tipNome:{
                    // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                    required: true, minlength: 5
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
                    }else{
                        $('#tipMAIL').css('border', '1px #1e8449 solid');
                        $('#tickMAIL').css('background', '#1e8449');
                        $('#iconMAIL').css('color', '#FFF');
                        $("#iconMAIL").removeClass("fa fa-question-circle").fadeIn();
                        $("#iconMAIL").addClass("fa fa-check-circle");
                    }
                }
            });
        }
    }

    function CPF_check(){

        var CPF = $('#tipCPF').val();

        if(CPF == '' || CPF.length < 11){
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
                        //$('#tickCPF').hide(); $('#cross').fadeIn();
                    }else{
                        $('#tipCPF').css('border', '1px #1e8449 solid');
                        $('#tickCPF').css('background', '#1e8449');
                        $('#iconCPF').css('color', '#FFF');
                        $("#iconCPF").removeClass("fa fa-question-circle").fadeIn();
                        $("#iconCPF").addClass("fa fa-check-circle");
                    }
                }
            });
        }
    }

</script>
<section class="margin-top-50">
    <div class="container">
        <?php
        $cpf_enviado = validar_cpf($rsSIC['CPF']);
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
        if($rsSIC['DtNascimento'] <> "") {

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
                    <?php
                    if($cpf_enviado == true) {
                        ?>
                        <?php if($rsSIC['DtNascimento'] <> "") {?>
                    <h4 class="uppercase">
                        Solicitar
                        <strong>informação</strong>
                    </h4>

                    <form id="tip-validate" class="form-bordered" action="esic_salvar_pedido.php" method="post">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="tipNome" class="control-label">Interessado</label>
                                <div class="input-group input-group-in">
                                    <input id="tipNome" name="tipNome" readonly="readonly" class="form-control" placeholder="Nome Completo" value="<?php echo $rsSIC['Nome']?>">
                                    <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>
                        <br clear="all">

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipDtAbertura" class="control-label">Data de abertura</label>
                                <div class="input-group input-group-in">
                                    <input id="tipDtAbertura" name="tipDtAbertura" readonly="readonly" class="form-control" placeholder="<?php echo $DataAgora; ?>" value="<?php echo $DataAgora; ?>">
                                    <span id="tipDtAbertura" class="input-group-addon"><i id="tipDtAbertura" class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="tipDtFinal" class="control-label">Prazo de atendimento</label>
                                <div class="input-group input-group-in">
                                    <input id="tipDtFinal" name="tipDtFinal" readonly="readonly" class="form-control" placeholder="<?php echo $xdata; ?>" value="<?php echo $xdata; ?>">
                                    <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                </div>
                            </div>
                        </div>
                        <br clear="all">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="tipOrgao">Órgão</label>
                                <div class="input-group input-group-in">
                                    <select id="tipOrgao" name="tipOrgao" class="form-control">
                                        <?php
                                        $sqlSec = mysql_query("SELECT * FROM estrutura");
                                        $Secre = mysql_num_rows($sqlSec);

                                        for ($y = 0; $y < $Secre; $y++){
                                            $verSecre = mysql_fetch_array($sqlSec);
                                            ?>
                                            <option value="<?= $verSecre['Nome'];?>"><?= $verSecre['Nome'];?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br clear="all">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="tipFormaResposta" class="control-label">Forma de recebimento da resposta</label>
                                <div class="input-group input-group-in">
                                    <select id="tipFormaResposta" name="tipFormaResposta" class="form-control">
                                        <option value="E-mail">E-mail</option>
                                        <option value="Papel (Valor das cópias custeado pelo solicitante)">Papel (Valor das cópias custeado pelo solicitante)</option>
                                        <option value="CD/DVD (Fornecido pelo interessado)">CD/DVD (Fornecido pelo interessado)</option>
                                        <option value="Pendrive (Fornecido pelo interessado)">Pendrive (Fornecido pelo interessado)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <br clear="all">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="tipDescricao" class="control-label">Descrição da solicitação</label>
                                <textarea id="tipDescricao" name="tipDescricao" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <br clear="all">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <p>Prezado (a):</p>
                            <p>
                                A transparência pública é importante para toda a coletividade, por isso a resposta a este pedido de informação será divulgada, preservando-se dados pessoais (caso houver).
                                Já o texto da sua pergunta só será divulgado com sua autorização. </p>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="radio2"> <input id="Autorizo" type="radio" checked="checked" value="Autorizo" name="optionsRadios"></div>
                                        <span class="radio2">Autorizo a divulgação da minha pergunta</span>
                                    </div>
                                </div>
                                <br clear="all">
                                <div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="radio2"><input id="NaoAutorizo" type="radio" value="NaoAutorizo" name="optionsRadios"></div>
                                        <span class="radio2">Não autorizo a divulgação da minha pergunta</span>
                                    </div>
                                </div>
                            </div>
                            <p><strong>IMPORTANTE:</strong> Dados pessoais serão preservados também no texto da pergunta. </p>
                        </div>

                        <br clear="all">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Enviar</button>
                            </div>
                        </div>
                        <br clear="all">
                    </form>
                        <?php }else{?>
                            <div class="alert alert-danger margin-bottom-30">
                                <h4>
                                    <strong>DATA DE NASCIMENTO</strong>
                                </h4>
                                <p> Informe sua DATA DE NASCIMENTO para fazer uma solicitação </p>
                                <br>
                                <a class="btn btn-primary" href="?Pages=esic_meus_dados">Atualizar Dados</a>
                            </div>
                        <?php }?>
                    <?php }elseif($cpf_enviado == false){?>
                        <div class="alert alert-danger margin-bottom-30">
                            <h4>
                                <strong>CPF</strong> INVÁLIDO
                            </h4>
                            <p> Informe um CPF válido para fazer uma solicitação </p>
                            <br>
                            <a class="btn btn-primary" href="?Pages=esic_meus_dados">Atualizar Dados</a>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8">

            <ul id="sidebar-nav" class="side-nav list-group margin-bottom-60">
                <li class="list-group-item active">
                    <a href="?Pages=esic_registrar_pedido">
                        FAZER SOLICITA&Ccedil;ÃO
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="?Pages=esic_protocolo">
                        MINHAS SOLICITA&Ccedil;ÕES
                    </a>
                </li>
                <li class="list-group-item">
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