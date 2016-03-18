<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 29/08/14
 * Hora: 10:20
 * Página: Servidor
 *
 */


?>
<div class="jumbotron">
    <h1>Bem vindo,</h1>
    <p>Portal da Transparência</p>
    <!-- <p><a class="btn btn-primary btn-lg" role="button">Learn more</a></p>-->
</div>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#despesas" role="tab" data-toggle="tab">Despesas</a></li>
    <li><a href="#receitas" role="tab" data-toggle="tab">Receitas</a></li>
    <li><a href="#convenios" role="tab" data-toggle="tab">Convênios</a></li>
    <li><a href="#empresas" role="tab" data-toggle="tab">CEIS</a></li>
    <li><a href="#entidade" role="tab" data-toggle="tab">CEPIM</a></li>
    <li><a href="#servidor" role="tab" data-toggle="tab">Servidores</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="despesas">...</div>
    <div class="tab-pane" id="receitas">receitas</div>
    <div class="tab-pane" id="convenios">.convenios..</div>
    <div class="tab-pane" id="empresas">.empresas..</div>
    <div class="tab-pane" id="entidade">..entidade.</div>
    <div class="tab-pane" id="servidor">
        <h3>Servidores</h3>
        <p>Use a pesquisa para obter informções sobre cargo, função, situação funcional e remuneração dos servidores.</p>
        <p>
            <a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor" class="btn btn-primary">Por Nome ou CPF</a>
            <a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor_lotacao" class="btn btn-primary">Por Orgão de Lotação</a>
                <a href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=servidor_cargo" class="btn btn-primary">Por Função ou Cargo </a>
        </p>
        <p><strong>ATENÇÃO:</strong> As informações disponíveis nesta consulta referem-se aos servidores ativos.
            Não estão incluídos na consulta dados sobre servidores aposentados, pensionistas ou instituidores de pensão,
            salvo em caso de estarem na ativa em razão de exercício de um segundo cargo público, de acordo com as
            previsões legais.
            <br><br>
            Os dados têm origem no Sistema Integrado de Administração de Recursos Humanos (Siape),
            no sistema próprio do Banco Central e ainda, nos sistemas mantidos pelos Comandos Militares.
            <br><Br>
            Assim, orientamos que, caso seja identificada alguma inconsistência em sua ficha cadastral ou
            financeira, entre em contato, em seu órgão de lotação ou de exercício, com o responsável pelo cadastro de
            informações de pessoal.</p>

    </div>
</div>

<script>
    $('#myTab a[href="#profile"]').tab('show') // Select tab by name
    $('#myTab a:first').tab('show') // Select first tab
    $('#myTab a:last').tab('show') // Select last tab
    $('#myTab li:eq(2) a').tab('show') // Select third tab (0-indexed)
</script>