<script>

    $(document).ready( function() {
        $("#tip-validate").validate({
            // Define as regras
            rules:{
                email:{
                    // campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                    required: true, email: true
                },
                passwd:{
                    // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                    required: true, minlength: 6
                }
            },
            // Define as mensagens de erro para cada regra
            messages:{
                email:{
                    required: "*",
                    email: "Digite um e-mail válido"
                },
                passwd:{
                    required: "*",
                    minLength: "A sua mensagem deve conter, no mínimo, 2 caracteres"
                }
            }
        });
    });



</script>
<br><br>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Dados de acesso</h3>
                </div><!-- /panel-heading -->

                <div class="panel-body">
                    <form action="verifica.php" method="post" id="tip-validate" role="form" class="form-bordered">
                        <p class="lead">&nbsp;</p>
                        <div class="form-group">
                            <div class="input-group input-group-in">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input name="email" id="email" class="form-control" placeholder="Email">
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <div class="input-group input-group-in">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="passwd" id="passwd" class="form-control" placeholder="Senha">
                            </div>
                        </div><!-- /.form-group -->
                        <div class="form-group clearfix">
                            <div class="animated-hue pull-right">
                                <button id="btnSignin" type="submit" class="btn btn-primary">Entrar <i class="fa fa-chevron-circle-right"></i></button>
                            </div>

                            <div class="nice-checkbox nice-checkbox-inline">
                                <p>
                                    <a data-toggle="modal" href="?Pages=esic_cadastro">Ainda não tenho cadastro</a>
                                </p>
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group clearfix">

                            <div class="nice-checkbox nice-checkbox-inline">
                                <p>
                                    A <strong>Transparência Passiva</strong> consiste no pedido de informações não inseridas na Internet, solicitadas por meio físico, virtual, telefônico ou por correspondência.
                                    <br><br>
                                    O cidadão poderá efetuar o pedido de acesso à informações por meio dos seguintes canais:
                                </p>

                                <p>
                                    <strong>I – virtual / e-SIC:</strong><br>
                                    Sistema Eletrônico do Serviço de Informações ao Cidadão, ferramenta via web de fácil acesso e aberto ao público.<br>
                                    <a href="?Pages=esic_acesso"> Clique aqui para abrir a solicitação</a>
                                </p>

                                <p>
                                    <strong>II – físico – SIC:</strong><br>
                                    Através do endereço:<br>
                                    Centro de Ciencias, Tecnologia e Inovação<br>
                                    Av. Surumu, 1820 - Mecejana - Boa Vista / RR<br>
                                    Ao Lado do Mercado Romeu Caldas<br>
                                    De segunda a sexta-feira, das 8h00 às 12h00 / 14h00 às 18:00
                                </p>


                                <p><strong>III – correspondência:</strong><br>
                                    Através do endereço:<br>
                                    Centro de Ciencias, Tecnologia e Inovação<br>
                                    Av. Surumu, 1820 - Mecejana - Boa Vista / RR <br> CEP: 69305-070<br>
                                </p>

                            </div>
                        </div><!-- /.form-group -->
                    </form><!-- /form -->

                </div><!-- /panel-body -->

            </div><!-- /panel-rpcdefault -->



        </div><!-- /.cols -->




        </div><!-- /.cols -->
    </div>