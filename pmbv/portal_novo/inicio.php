<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 29/08/14
 * Hora: 10:20
 * Página: Servidor
 *
 */


//$sqlUlt = mysql_query("SELECT *, sum(RemuneracaoBasica) as total FROM servidor WHERE (Acao = 'Publicado') GROUP BY Mes, Ano ORDER BY Ano DESC, Mes DESC");
//$rsLinha2 = mysql_fetch_array($sqlUlt);

//
//$sqlGlossario1 = mysql_query("SELECT Orgao,Mes, Ano, count(Orgao) as Total FROM servidor WHERE CargoComissao = 'Comissionados' AND (Acao = 'Publicado') AND Ano = (SELECT Ano FROM servidor Order By Ano DESC, Mes Desc Limit 1)   GROUP BY Orgao, Mes, Ano Order By Ano DESC , Mes Desc");
//$Glossario1 = mysql_num_rows($sqlGlossario1);


$sqlGlossario = mysql_query("SELECT *, sum(RemuneracaoBasica) as total FROM servidor WHERE (Acao = 'Publicado') AND Ano = (SELECT Ano FROM servidor Order By Ano DESC, Mes Desc Limit 1) GROUP BY Mes, Ano ORDER BY Ano DESC, Mes DESC");
$Glossario = mysql_num_rows($sqlGlossario);

//$sqlGlossario2 = mysql_query("SELECT Orgao,Mes, Ano, count(Orgao) as Total FROM servidor WHERE CargoComissao = 'Comissionados' AND (Acao = 'Publicado') AND Ano = (SELECT Ano FROM servidor Order By Ano DESC, Mes Desc Limit 1)   GROUP BY Orgao, Mes, Ano Order By Ano DESC , Mes Desc");
//$Glossario2 = mysql_num_rows($sqlGlossario2);

$soma = 0;
$somaTotal = 0;
$json_data=array();


for ($y = 0; $y < $Glossario; $y++) {
    $verGlossario = mysql_fetch_array($sqlGlossario);



    $porcentagem = ($verGlossario['total']);
    $porcentagem = $porcentagem;


    $json_array['y']= retorna_mes_extenso($verGlossario['Mes'])." / ".$verGlossario['Ano'];
    $json_array['a']=$porcentagem;
    array_push($json_data,$json_array);
}

?>
<script>
    $(function () {
        Morris.Bar({
            element: 'graph',
            data: <?php echo json_encode($json_data)?>,
            xkey: 'y',
            ykeys: ['a'],
            labels: ['R$']
        });

        $("#owl-demo").owlCarousel({

            navigation : true, // Show next and prev buttons
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem:true

            // "singleItem:true" is a shortcut for:
            // items : 1,
            // itemsDesktop : false,
            // itemsDesktopSmall : false,
            // itemsTablet: false,
            // itemsMobile : false

        });

    });
</script>
<section class="content-wrapper content-midwet">
    <div class="content">
        <div class="row discovery">
            <div class="col-sm-12 col-md-12">
                <div class="header">
                    <h1>Bem Vindo</h1>
                    <div class="tagline"> Conforme determina o Decreto n. 204/E de 22 de novembro de 2013, criamos este Portal da Transparência do Governo Municipal. Através deste portal, o cidadão poderá acompanhar a execução financeira.

                        Obrigada por sua visita!  </div>
                </div>

                <div class="category">
                    <div class="title">
                        <h4>Consultas</h4>
                        Consultas são as maneiras como os clientes interagem com você.
                    </div>

                    <div class="cards">
                        <div class="items">
                            <a class="ember-view" data-toggle="modal" data-target="#despesas" href="javascript:void(0)">
                            <span class="card">
                                <i class="ember-view card-icon fa-3x fa fa-bar-chart-o"></i>
                            </span>
                                <br>
                                <span class="card-name">Despesas</span>
                            </a>
                        </div>

                        <div class="items">
                            <a class="ember-view" data-toggle="modal" data-target="#receitas" href="javascript:void(0)">
                            <span class="card">
                                <i class="ember-view card-icon fa-3x fa fa-line-chart "></i>
                            </span>
                                <br>
                                <span class="card-name">Receitas</span>
                            </a>
                        </div>

                        <div class="items">
                            <a id="ember4500" class="ember-view" href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=obras">
                            <span class="card">
                                <i class="ember-view card-icon fa-3x fa fa-road"></i>
                            </span>
                                <br>
                                <span class="card-name">Obras</span>
                            </a>
                        </div>

                        <div class="items">
                            <a id="ember4500" class="ember-view" href="<?php echo $UrlAmigavel.$Pasta ?>?Pages=cpl">
                            <span class="card">
                                <i class="ember-view card-icon fa-3x fa fa-file-text"></i>
                            </span>
                                <br>
                                <span class="card-name">Contratos e Licitações</span>
                            </a>
                        </div>



                    </div>

                </div>

                <div class="category">


                    <div class="title">
                        <h4>Servidores</h4>
                        Confira a folha de pagamento dos servidores.
                    </div>
                    <div class="cards">
                        <div id="graph" class="graph"></div>
                    </div>

                </div>

                <div class="category">
                    <div class="title">
                        <h4>Acesso à informações</h4>
                        A Lei nº 12.527 regulamenta o direito constitucional de acesso dos cidadãos às informações públicas.
                    </div>

                    <div class="cards">
                        <div class="items">
                            <a id="ember4500" class="ember-view" href="#/discovery/feature/email">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                                <br>
                                <span class="card-name">Convênios</span>
                            </a>
                        </div>

                        <div class="items">
                            <a id="ember4500" class="ember-view" href="#/discovery/feature/email">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                                <br>
                                <span class="card-name">Projetos Sociais</span>
                            </a>
                        </div>

                        <div class="items">
                            <a id="ember4500" class="ember-view" href="#/discovery/feature/email">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                                <br>
                                <span class="card-name">Obras</span>
                            </a>
                        </div>

                        <div class="items">
                            <a id="ember4500" class="ember-view" href="#/discovery/feature/email">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                                <br>
                                <span class="card-name">RREO / RGF</span>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="category">
                    <div class="title">
                        <h4>Consultas</h4>
                        Canais são as maneiras como os clientes interagem com você.
                    </div>

                    <div class="cards">
                        <div class="items">
                            <a id="ember4500" class="ember-view" href="#/discovery/feature/email">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                                <br>
                                <span class="card-name">Convênios</span>
                            </a>
                        </div>

                        <div class="items">
                            <a id="ember4500" class="ember-view" href="#/discovery/feature/email">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                                <br>
                                <span class="card-name">Projetos Sociais</span>
                            </a>
                        </div>

                        <div class="items">
                            <a id="ember4500" class="ember-view" href="#/discovery/feature/email">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                                <br>
                                <span class="card-name">Obras</span>
                            </a>
                        </div>

                        <div class="items">
                            <a id="ember4500" class="ember-view" href="#/discovery/feature/email">
                            <span class="card">
                                <svg id="ember4501" class="ember-view card-icon" viewBox="0 0 116 116"></svg>
                            </span>
                                <br>
                                <span class="card-name">RREO / RGF</span>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>




