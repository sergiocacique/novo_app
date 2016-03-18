<?php
if(isset($_SESSION['IDSIC']) == ""){
    ?>
<script language="JavaScript">
    window.location="index.php?Pages=esic_acesso";
</script>
<?php
}
?>
<section class="margin-top-50">
    <div class="container">
        <?php
        $sqlLinha2 = mysql_query("SELECT * FROM sic_usuario WHERE id = '".$_SESSION['IDSIC']."'");
        $rsSIC = mysql_fetch_array($sqlLinha2);

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
                    <div class="timeline">
                        <?php
                        $sqlProtocolos = mysql_query("SELECT * FROM sic_ticket WHERE CdUsuario = '".$_SESSION['IDSIC']."' ORDER BY DtAtualizacao DESC");
                        $Protocolos = mysql_num_rows($sqlProtocolos);

                        for ($y = 0; $y < $Protocolos; $y++){
                        $verProtocolos = mysql_fetch_array($sqlProtocolos);

                            if($verProtocolos['Acao'] == "Fechado"){
                                $label_text = "Concluido";
                                $label_class = "label-success";
                            }elseif($verProtocolos['Acao'] == "Encaminhado"){
                                $label_text = "Encaminhado";
                                $label_class = "label-warning";
                            }elseif($verProtocolos['Acao'] == "Aberto"){
                                $label_text = "Aberto";
                                $label_class = "label-info";
                            }elseif($verProtocolos['Acao'] == "Aguardando Resposta"){
                                $label_text = "Aguardando Resposta";
                                $label_class = "label-warning";
                            }elseif($verProtocolos['Acao'] == "Novo"){
                                $label_text = "Novo";
                                $label_class = "label-primary";
                            }
                        ?>
                        <div class="timeline-item timeline-item-bordered">
                            <div class="timeline-entry rounded">
                                <?php echo strftime('%d', strtotime($verProtocolos['DtCadastro']));?>
                                <span><?php echo retorna_mes(date('m', strtotime($verProtocolos['DtCadastro'])));?></span>
                                <div class="timeline-vline"></div>
                            </div>
                            <h2 class="uppercase"><span class="label <?php echo $label_class;?>"><?php echo $label_text;?></span><br><br>[ <strong><?php echo $verProtocolos['Protocolo'];?></strong> ] <?php echo $verProtocolos['Orgao'];?> </h2>
                            <p><?php echo $verProtocolos['Assunto'];?></p>
                            <div class="animated-hue pull-left">
                                <a href="?Pages=esic_protocolo_ver&protocolo=<?php echo base64_encode($verProtocolos['Protocolo']);?>"  class="btn btn-primary">
                                    visualizar chamado
                                </a>
                            </div>
                        </div>
                            <br>
                        <?php
                        }
                        ?>
                    </div>
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
                <li class="list-group-item active">
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