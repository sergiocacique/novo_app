<script src="<?php echo $UrlAmigavel ?>js/owl.carousel.js"></script>
<script>


    $(document).ready(function() {

        $("#owl-demo").owlCarousel({

            autoPlay: 3000, //Set AutoPlay to 3 seconds

            items : 1,
            itemsDesktop : [1199,3],
            itemsDesktopSmall : [979,3]

        });

    });


</script>

<div class="container">
    <div class="page-header">
        <h3>Governo Municipal</h3>
    </div>
    <div class="col-xs-9 col-sm-9 col-md-9">
        <div class="col-md-12 mb10">
            <p>CARACTERIZAÇÃO DO MUNICÍPIO DE PACARAIMA

            <p>O município localiza-se ao norte do estado de Roraima, situando-se na zona conhecida geograficamente como planalto Parima apresentando as maiores altitudes do estado e de toda Região Norte do Brasil, com seus 920 m de altitude. A sede do município localiza-se no interior da T.I. São Marcos, estando ainda em fase de definição da sua área urbana que necessita ser desmembrada da respectiva terra indígena.</p>

            <p>Na organização espacial o município possui além da sede urbana, 55 comunidades indígenas organizadas em duas regiões: Surumu e São Marcos. A maior comunidade indígena é a do Contão com 1.055 moradores, as demais comunidades apresentam uma população que varia de 20 a 250 habitantes. Conforme estabelece o decreto presidencial nº 8.065, de 07 de agosto de 2013, define que a responsabilidade pela gestão e planejamento das ações de saneamento, em terras indígenas, compete a SESAI/MS, através do Departamento de Saneamento e Edificações de Saúde Indígena.</p>

            <p>Portanto a gestão municipal de Pacaraima oficializará junto a SESAI/DSEI-Leste o interesse de proceder à regulamentação do processo de gestão dos resíduos na área indígena, de forma compartilhada e conjunta, definindo responsabilidades e financiamento das ações de coleta de resíduos sólidos nestas comunidades.  Assumindo o plano a definição da gestão de resíduos na sede urbana.</p>

            <p>Porém a existência do núcleo urbano remonta a demarcação das fronteiras entre Brasil e Venezuela no decorrer da década de 1920 e da instalação do terceiro pelotão especial de fronteira por volta dos anos. O garimpo consistiu no principal atrativo econômico para a formação do aglomerado urbano de Pacaraima no decorrer do século passado. Em 15 de outubro de 1995, o município é criado, através de seu desmembramento do município de Boa Vista. A área territorial é de 8.028,428 km², possuindo uma densidade demográfica de 1,3 hab/Km², tendo limítrofes com os municípios de Boa Vista, Amajarí, Normandia e Uiramutã, além de manter limites com a República Bolivariana da Venezuela, país que mantém uma fronteira viva, ligada através de uma rodovia que estabelece um intenso movimento entre a cidade de Pacaraima e Santa Helena de Uiaren (Venezuela).</p>

            <p>Conforme o censo de 2010, o município possui uma população de 10.433 habitantes, sendo que 5.919 habitantes vivem no centro urbano de Pacaraima, as duas outras localidades que apresentam maiores concentrações de pessoas são as comunidades indígenas de Surumú e Contão, localizadas respectivamente a sul e sudeste do território.</p>

            <p>A bacia hidrográfica do município é composta pelos rios Cotingo, Parimé e Surumú que consistem em tributários da principal bacia do Estado a composta pelo Rio Branco, porém a sede municipal não possui relação direta com estes rios, tendo em vista que se localiza em cima da serra Parima, estando todos eles encravados dentro da terra indígena.</p>

            <p>Pacaraima têm no setor terciário sua principal fonte de renda. O comércio e o setor público consistem nas principais formas de geração de emprego e renda. O turismo que se apresenta como uma provável fonte de geração de renda não conseguiu desenvolver-se ainda em virtude dos entraves burocráticos estabelecidos pela legislação indígena, porém o assunto perfaz a pauta de discussão na gestão pública municipal, a qual possui vários indígenas em cargos de gestão e no parlamento, bem como é pauta do território da cidadania indígena, criado pelo governo federal. A renda per capita é de R$ 9.777,84, tendo um PIB de R$ 88.186,37. Esses dados apresentados pelo censo econômico do IBGE, em 2008, sofreram impactos significativos com a transferência da área de livre comércio de Pacaraima para Boa Vista, no ano de 2010. O IDHM do município é de 0,650.</p>

            <p>A fronteira com a Venezuela, e a grande depreciação da moeda deste país impõe um amplo movimento de pessoas na fronteira durante todos os dias, intensificando-se nos finais de semana quando milhares de boa-vistenses dirigem-se a cidade de Santa Helena de Uairen para realizarem compras ou apenas abastecerem seus automóveis. A cidade de Santa Helena do Uiaren possui uma zona de livre comércio propícia à compra de produtos não duráveis que impõe uma ampla necessidade de estrutura do município, implicando diretamente na política de resíduos sólidos que ora apresentamos a sociedade de Pacaraima.</p>

            <p>Os demais setores do saneamento organizam-se da seguinte forma:</p>

            <p>- Abastecimento d’água a cidade apresenta 13.678 ligações de água, sendo que a sede do município de Pacaraima é abastecida por poços artesianos e o tratamento é realizado pela Companhia de Águas e Esgotos de Roraima – CAER.</p>

            <p>- A drenagem urbana ainda consiste de ações incipientes, principalmente em virtude dos declives e aclives da sede municipal que facilitam o escoamento das águas pluviais.</p>

            <p>- O esgotamento sanitário ainda não possui intervenção na cidade, sendo as soluções de destino dos dejetos, solucionados através de fossas sépticas/sumidouros individuais.</p>

            <p>Fonte SESAI/DSEI-Leste</p>
        </div>


    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="side-nav">
            <div class="side-nav-head">
                <h4>ACESSO RÁPIDO</h4>
            </div>
            <ul class="list-group list-unstyled">
                <?php
                $sqlAcesso = mysql_query("SELECT *  FROM site_acesso_rapido WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado'  ORDER BY Posicao ASC") or die(mysql_error());
                $contaAcesso = mysql_num_rows($sqlAcesso);

                for ($a = 0; $a < $contaAcesso; $a++){
                    $Acessos = mysql_fetch_array($sqlAcesso);
                    ?>
                    <li class="list-group-item">
                        <a href="<?php echo $Acessos['Link'];?>"><?php echo $Acessos['Nome'];?></a>
                    </li>
                <?php }?>
            </ul>
        </div>

        <div class="side-nav">


            <div id="owl-demo">

                <div class="item"><img src="http://portal.minhaprefeitura.com.br/municipio/pacaraima/prefeito.jpg" alt="Owl Image"></div>
                <div class="item"><img src="http://portal.minhaprefeitura.com.br/municipio/pacaraima/vice.jpg" alt="Owl Image"></div>

            </div>


        </div>

        <div class="side-nav">
            <div class="side-nav-head">
                <h4>SECRETÁRIAS</h4>
            </div>
            <ul class="list-group list-unstyled">
                <?php
                $sqlGlossario = mysql_query("SELECT * FROM estrutura WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY Rand() Limit 3");
                $Glossario = mysql_num_rows($sqlGlossario);

                for ($y = 0; $y < $Glossario; $y++){
                $verGlossario = mysql_fetch_array($sqlGlossario);
                ?>
                <li>
                    <div class="row">
                        <div class="col-md-12">
                                <strong><?php echo $verGlossario['Nome'];?></strong>
                            <p class="mb0">
                                <strong>Resp:</strong>
                                <?php echo $verGlossario['Secretario'];?>
                                <br>
                                <strong>Fone:</strong>
                                <?php echo $verGlossario['Telefones'];?>
                            </p>
                        </div>
                    </div>
                    <hr class="hr-secretarias">
                </li>
                <?php
                }
                ?>

            </ul>
            <a class="btn btn-default pull-right btn-sm" href="<?php echo $UrlAmigavel.$rsPrefeitura['Pasta']."/".$linha['Link'];?>secretarias" title="Mais Secretarias">Mais Secretarias</a>
        </div>


    </div>
</div>