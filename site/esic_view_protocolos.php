<script>
    function carregaProjeto(id,prefeitura){
        $('#loading2').css('visibility','visible');
        $.post("<?php echo $UrlAmigavel;?>obras_ver.php", { id: id, prefeitura: prefeitura },
            function(data){
                $('#ver').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

</script>
<script>
    function cont(){
        var conteudo = document.getElementById('verHolerite').innerHTML;
        tela_impressao = window.open('about:blank');
        tela_impressao.document.write(conteudo);
        tela_impressao.window.print();
        tela_impressao.window.close();
    }
</script>
<section class="texto-simples">
    <div class="container">
        <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
        <h2 class="title title-d"> <strong>e-SIC</strong></h2>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="divisor divisor-c">
            <span> </span>
        </div>
    </div>
            </div>
        </div>
</section>


<section id="ver" class="texto-simples mar-top-30">

    <div class="container">
        <div class="row">


            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="painel_borda_pagina">

                    <div class="container_titulo_holerite">
                        <div class="container_nome_e_mes_tipo_de_folha sem_logo">
                            <div class="container_texto_nome_do_holerite">  PROTOCOLO</div>
                            <div class="container_texto_mes_tipo_de_folha"> <?php echo $rsLinha['Protocolo']; ?> </div>
                        </div>
                        <div class="container_texto_matricula"> Relatório gerado em : <?php echo strftime('%d/%m/%Y ás %H:%I:%S', strtotime($dataAtual));?> </div>
                    </div>

                    <table class="tabela_cabecalho_dados_pessoais">
                        <tbody>
                        <tr>

                            <td class="celula_titulo_dados_pessoais" colspan="6"> DADOS PESSOAIS </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="label_celula"> Nome </div>
                                <div class="valor_celula valor_nome"> <?php echo $rsLinha2['Nome']; ?> </div>
                            </td>
                            <td>
                                <div class="label_celula"> CPF </div>
                                <div class="valor_celula valor_cpf"> <?php echo mask($rsLinha2['CPF'],'###.###.###-##');?> </div>
                            </td>
                            <td>
                                <div class="label_celula"> Celular </div>
                                <div class="valor_celula valor_celular"> <?php echo $rsLinha2['Telefone']; ?> </div>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <div class="label_celula"> CEP </div>
                                <div class="valor_celula"> <?php echo mask($rsLinha2['CEP'],'#####-###');?> </div>
                            </td>
                            <td colspan="3">
                                <div class="label_celula"> Endereço </div>
                                <div class="valor_celula"> <?php echo $rsLinha2['Endereco']; ?> </div>
                            </td>
                            <td>
                                <div class="label_celula"> Bairro </div>
                                <div class="valor_celula"> <?php echo $rsLinha2['Bairro']; ?> </div>
                            </td>
                            <td>
                                <div class="label_celula"> Município / UF </div>
                                <div class="valor_celula"> <?php echo $rsLinha2['Cidade']; ?> / <?php echo $rsLinha2['Estado']; ?> </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div class="label_celula"> E-mail </div>
                                <div class="valor_celula"> <?php echo $rsLinha2['Email']; ?> </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <table class="tabela_cabecalho_dados_empresa">
                        <tbody>
                        <tr>
                            <td class="celula_titulo_dados_empresa" colspan="4"> INFORMAÇÃO </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="label_celula"> Prioridade </div>
                                <div class="valor_celula valor_cnpj"> <?php echo $rsLinha['Prioridade']; ?> </div>
                            </td>
                            <td colspan="2">
                                <div class="label_celula"> Status </div>
                                <div class="valor_celula valor_nome_empresa"> <?php echo $rsLinha['Acao']; ?> </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="label_celula"> Data da Solicitação </div>
                                <div class="valor_celula"> <?php echo strftime('%d/%m/%Y', strtotime($rsLinha['DtCadastro'])); ?> </div>
                            </td>
                            <td>
                                <div class="label_celula"> Formato de recebimento </div>
                                <div class="valor_celula"> <?php echo $rsLinha['Recebimento']; ?> </div>
                            </td>
                            <td colspan="2">
                                <div class="label_celula"> Prazo final </div>
                                <div class="valor_celula"> <?php echo $rsLinha['DtFinal']; ?> </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <table class="tabela_cabecalho_dados_empresa">
                        <tbody>
                        <tr>
                            <td class="celula_titulo_dados_empresa" colspan="4"> DADOS DA SOLICITAÇÃO </td>
                        </tr>

                        <tr>
                            <td class="celula_titulo_dados_empresa" colspan="4">
                                <div class="label_celula"> Assunto </div>
                                <div class="valor_celula valor_cnpj"> <?php echo $rsLinha['Titulo']; ?> </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="celula_titulo_dados_empresa" colspan="4">
                                <div class="label_celula"> Especificações do pedido </div>
                                <div class="valor_celula valor_cnpj"> <?php echo $rsLinha['Assunto']; ?> </div>
                            </td>
                        </tr>


                        </tbody>
                    </table>
                    <?php
                    if ($rsLinha['Resposta'] != ''){
                        ?>
                        <table class="tabela_cabecalho_dados_empresa">
                            <tbody>
                            <tr>
                                <td class="celula_titulo_dados_empresa" colspan="4"> RESPOSTA </td>
                            </tr>

                            <tr>
                                <td class="celula_titulo_dados_empresa" colspan="4">
                                    <div class="label_celula">  </div>
                                    <div class="valor_celula valor_cnpj"> <?php echo $rsLinha['Resposta']; ?> </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="celula_titulo_dados_empresa" colspan="4">
                                    <div class="label_celula"> Data da resposta </div>
                                    <div class="valor_celula valor_cnpj"> <?php echo strftime('%d/%m/%Y', strtotime($rsLinha['DtResposta'])); ?> </div>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    <?php }?>

                    <div class="container_validacao_holerite">
                        <button onclick="cont();" class="botao_confirmacao_ok" type="button">Imprimir</button>
                    </div>
                </div>
            </div>
        </div>
</div>

</section>


<section class="line-100 type-c line-advantages">
    <div class="container">
        <div class="grid-12 pull-left">
            <h4 class="title title-d">
                <strong>ACESSO À </strong>INFORMAÇÃO
            </h4>
        </div>
        <div class="col-md-8 mar-20">
            <div class="divisor divisor-b">
                <span> </span>
            </div>
        </div>
        <div class="col-md-8 mar-10">
            <p class="text text-c"> O objetivo do e-SIC é facilitar o exercício do direito fundamental de acesso às informações públicas. Por meio deste sistema, você faz o seu pedido e acompanha todo o trâmite. </p>
        </div>
        <div class="clear"> </div>
        <div class="col-md-8 mar-20">
            <a class="btn type-d" title="saiba mais sobre o e-SIC" href="<?php echo $legal ?>esic">SAIBA MAIS</a>
        </div>
    </div>
</section>