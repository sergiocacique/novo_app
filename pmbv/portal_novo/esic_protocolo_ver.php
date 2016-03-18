<?php
if(isset($_SESSION['IDSIC']) == ""){
    ?>
    <script language="JavaScript">
        window.location="index.php?Pages=esic_acesso";
    </script>
<?php
}


$protocolo = base64_decode($_GET['protocolo']);

$sqlPro = mysql_query("SELECT * FROM sic_ticket WHERE Protocolo = '".$protocolo."'");
$rsPro = mysql_fetch_array($sqlPro);

$sqlSIC = mysql_query("SELECT * FROM sic_usuario WHERE id = '".$rsPro['CdUsuario']."'");
$rsSIC = mysql_fetch_array($sqlSIC);

if($rsPro['Acao'] == "Fechado"){
    $label_text = "Concluido";
    $label_class = "label-success";
}elseif($rsPro['Acao'] == "Encaminhado"){
    $label_text = "Encaminhado";
    $label_class = "label-warning";
}elseif($rsPro['Acao'] == "Aberto"){
    $label_text = "Aberto";
    $label_class = "label-info";
}elseif($rsPro['Acao'] == "Aguardando Resposta"){
    $label_text = "Aguardando Resposta";
    $label_class = "label-warning";
}elseif($rsPro['Acao'] == "Novo"){
    $label_text = "Novo";
    $label_class = "label-primary";
}
?>
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
                    <div class="timeline">

                        <div class="timeline-item timeline-item-bordered">
                            <div class="timeline-entry rounded">
                                <?php echo strftime('%d', strtotime($rsPro['DtCadastro']));?>
                                <span><?php echo retorna_mes(date('m', strtotime($rsPro['DtCadastro'])));?></span>
                                <div class="timeline-vline"></div>
                            </div>
                            <h2 class="uppercase"><?php echo $rsPro['Orgao'];?> <span class="label <?php echo $label_class;?>"><?php echo $label_text;?></span></h2>
                            <p>

                                    <h2 class="uppercase">Interessado<br><br> <span><?php echo $rsSIC['Nome']?></span></h2>
                            <h2 class="uppercase">Data de abertura<br><br> <span><?php echo strftime('%d de %B de %Y', strtotime($rsPro['DtCadastro']))?></span></h2>
                            <h2 class="uppercase">Prazo de atendimento<br><br> <span><?php echo strftime('%d de %B de %Y', strtotime($rsPro['DtFinal']))?></span></h2>
                            <h2 class="uppercase">Forma de recebimento da resposta<br><br> <span><?php echo $rsPro['Recebimento']?></span></h2>
                            <h2 class="uppercase">Descrição da solicitação<br><br> <span><?php echo $rsPro['Assunto']?></span></h2>


                            </p>

                        </div>

                    </div>
                </div>
            </div>
            <br>
            <?php
            $sql2 = "SELECT * FROM sic_ticket_resposta WHERE idResposta = '".$rsPro['id']."' ORDER BY DtAtualizacao DESC";
            $sqlProtocolos = mysql_query($sql2);
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
            <div class="box-light">
                <div class="box-inner">
                    <div class="timeline">

                        <div class="timeline-item timeline-item-bordered">
                            <div class="timeline-entry rounded">
                                <?php echo strftime('%d', strtotime($verProtocolos['DtCadastro']));?>
                                <span><?php echo retorna_mes(date('m', strtotime($verProtocolos['DtCadastro'])));?></span>
                                <div class="timeline-vline"></div>
                            </div>
                            <h2 class="uppercase">RESPOSTA</h2>
                            <p>
                                <?php
                                if($cpf_enviado == true) {
                                ?>
                                <?php if($rsSIC['DtNascimento'] <> "") {?>
                           <?php echo $verProtocolos['Assunto']?>
                                <?php }else{?>
                            <div class="alert alert-danger margin-bottom-30">
                                <h4>
                                    <strong>DATA DE NASCIMENTO</strong>
                                </h4>
                                <p> Informe sua DATA DE NASCIMENTO para visualizar a resposta </p>
                                <br>
                                <a class="btn btn-primary" href="?Pages=esic_meus_dados">Atualizar Dados</a>
                            </div>
                            <?php }?>
                            <?php }elseif($cpf_enviado == false){?>
                                <div class="alert alert-danger margin-bottom-30">
                                    <h4>
                                        <strong>CPF</strong> INVÁLIDO
                                    </h4>
                                    <p> Informe um CPF válido para visualizar a resposta </p>
                                    <br>
                                    <a class="btn btn-primary" href="?Pages=esic_meus_dados">Atualizar Dados</a>
                                </div>
                            <?php }?>

                            </p>

                        </div>

                    </div>
                </div>
            </div>
            <?php
            }
            ?>
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
            $sicAberto = mysql_query("SELECT * FROM sic_ticket WHERE Acao <> 'Fechado' AND Acao <> 'Novo' AND CdUsuario = '".$_SESSION['IDSIC']."'");
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