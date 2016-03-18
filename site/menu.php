<header id="topNav">
  <div class="container">
<nav class="navbar" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul id="topMain" class="nav nav-pills nav-main">
                <li>
                    <a href="<?php echo $UrlAmigavel ?>">Início</a>
                </li>
                    <li class="dropdown mega-menu">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">O Município</a>
                      <ul class="dropdown-menu" role="menu">
                        <li>
                          <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                              <ul class="list-unstyled">
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=o_municipio_historia"><strong>História do Município</strong></a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=o_municipio_dados"><strong>Dados do Município</strong></a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=o_municipio_simbolo"><strong>Símbolos do Município</strong></a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=o_municipio_projeto"><strong>Projetos</strong></a></li>
                              </ul>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                              <p class="menu-category">Atrações Turísticas</p>
                              <ul class="list-unstyled">
                                <?php
                                $sqlGlossario = mysql_query("SELECT * FROM atracao_categoria WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY Nome ASC");
                                $Glossario = mysql_num_rows($sqlGlossario);

                                for ($y = 0; $y < $Glossario; $y++){
                                    $verGlossario = mysql_fetch_array($sqlGlossario);

                                    ?>
                                <li>
                                  <a href="<?php echo $UrlAmigavel ?>?Pages=o_municipio_turismo&atracao=<?php echo $verGlossario['id']; ?>"><?php echo $verGlossario['Nome']; ?></a>
                                </li>
                                <?php
                                }
                                ?>
                              </ul>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                              <p class="menu-category">Serviços</p>
                              <ul class="list-unstyled">
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=o_municipio_servico_ao_cidadao">Serviços ao Cidadão</a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=o_municipio_servico_ao_empreendedor">Serviços ao Empreendedor</a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=o_municipio_servico_ao_estudante">Serviços ao Estutante</a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=o_municipio_servico_ao_servidor_publico">Serviços ao Servidor Público</a></li>
                              </ul>
                            </div>

                          </div>
                        </li>
                    </ul>
                    </li>

                    <li class="dropdown mega-menu">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Departamentos</a>
                      <ul class="dropdown-menu" role="menu">
                        <li>
                          <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                              <ul class="list-unstyled">
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=departamento_prefeito"><strong>Gabinete do Prefeito(a)</strong></a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=departamento_vice_prefeito"><strong>Gabinete do Vice Prefeito(a)</strong></a></li>
                              </ul>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                              <p class="menu-category">Secretarias</p>
                              <ul class="list-unstyled">
                                <?php
                                $sqlGlossario = mysql_query("SELECT * FROM departamento WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY NomeDepartamento ASC");
                                $Glossario = mysql_num_rows($sqlGlossario);

                                for ($y = 0; $y < $Glossario; $y++){
                                    $verGlossario = mysql_fetch_array($sqlGlossario);

                                    ?>
                                <li>
                                  <a href="<?php echo $UrlAmigavel ?>?Pages=departamento&id=<?php echo $verGlossario['CdDepartamento']; ?>"><?php echo $verGlossario['NomeDepartamento']; ?></a>
                                </li>
                                <?php
                                }
                                ?>
                              </ul>
                            </div>

                          </div>
                        </li>
                    </ul>
                    </li>

                    <li class="dropdown mega-menu">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Informativos</a>
                      <ul class="dropdown-menu" role="menu">
                        <li>
                          <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                              <ul class="list-unstyled">
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=noticia"><strong>Notícias</strong></a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=eventos"><strong>Eventos</strong></a></li>
                              </ul>
                            </div>

                            <!-- <div class="col-xs-4 col-sm-4 col-md-4">
                              <p class="menu-category">Multimídia</p>
                              <ul class="list-unstyled">
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=galeria_de_foto">Galeria de Fotos</a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=galeria_de_video">Galeria de Vídeos</a></li>
                              </ul>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">

                            </div> -->

                          </div>
                        </li>
                    </ul>
                    </li>

                    <li>
                        <a href="<?php echo $UrlAmigavel ?>?Pages=diario_oficial">Diário Oficial</a>
                    </li>

                    <!-- <li class="dropdown mega-menu">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Publicações Oficiais</a>
                      <ul class="dropdown-menu" role="menu">
                        <li>
                          <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                              <ul class="list-unstyled">
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=diario_oficial"><strong>Diário Oficial</strong></a></li>
                                <p class="menu-category">Licitações</p>
                                <ul class="list-unstyled">
                                  <li><a href="portfolio-single-extended.html">Galeria de Fotos</a></li>
                                <li><a href="portfolio-single-extended.html">Galeria de Vídeos</a></li>
                                </ul>
                              </ul>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                              <p class="menu-category">Concursos</p>
                              <ul class="list-unstyled">
                                <li><a href="portfolio-single-extended.html">Galeria de Fotos</a></li>
                              <li><a href="portfolio-single-extended.html">Galeria de Vídeos</a></li>
                              </ul>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                              <p class="menu-category">Legislação</p>
                              <ul class="list-unstyled">
                                <li><a href="portfolio-single-extended.html">Galeria de Fotos</a></li>
                              <li><a href="portfolio-single-extended.html">Galeria de Vídeos</a></li>
                              </ul>
                            </div>

                          </div>
                        </li>
                    </ul>
                    </li> -->

                    <li class="dropdown mega-menu">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Transparência</a>
                      <ul class="dropdown-menu" role="menu">
                        <li>
                          <div class="row">
                            <div class="col-md-3">
                              <ul class="list-unstyled">
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=receitas"><strong>Receitas</strong></a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=despesas"><strong>Despesas</strong></a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=servidor"><strong>Despesa com Pessoal</strong></a></li>
                              </ul>
                            </div>

                            <div class="col-md-3">
                              <p class="menu-category">Contas</p>
                              <ul class="list-unstyled">
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=passagens">Passagens</a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=diarias">Diárias</a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=convenios">Convênios</a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=projetos_sociais">Projetos Sociais</a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=obras">Obras</a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=contrato_e_licitacao">Contratos e Licitações</a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=rreo">RREO / RGF</a></li>
                              </ul>
                            </div>

                            <div class="col-md-3">
                              <p class="menu-category">Acesso à Informação</p>
                              <ul class="list-unstyled">
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=esic_solicitar">Fazer uma Solicitação</a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=esic_consulta">Consultar Protocolo</a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=pergunta_frequentes">Perguntas Frequentes</a></li>
                                <li><a href="<?php echo $UrlAmigavel ?>?Pages=glossario">Glossário</a></li>
                              </ul>
                            </div>

                            <div class="col-md-3">
                              <p class="menu-category">SIC</p>
                              <p>
                                <p class="menu-detalhe"><?php echo $rsConfig['SIC'];?></p>
                              </p>
                            </div>

                          </div>
                        </li>
                    </ul>
                    </li>

                    <!-- <li>
                        <a href="<?php echo $UrlAmigavel ?><?php echo $rsPrefeitura['Pasta'] ?>">Contato</a>
                    </li> -->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
</div>
</header>
