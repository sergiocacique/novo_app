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
<?php
$sqlPrefeitura = mysql_query("SELECT * FROM prefeitura WHERE Pasta = '".$dominio."'");
$rsPrefeitura = mysql_fetch_array($sqlPrefeitura);
?>
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
            <div class="col-xs-8 col-sm-8 col-md-8">
                <div class="panel-body bordered-bottom">
                    <p>A Lei Federal N° 12.527/2011 garante ao cidadão o direito constitucional de acesso às informações públicas.</p>
                    <p>Disponibilizamos no Portal da Transparência, as seguintes informações:</p>

                    <li>Informações sobre funções, competências e estrutura organizacional.</li>
                    <li>Dados sobre programas, ações, projetos e atividades.</li>
                    <li>Informações referentes ao resultado de inspeções, auditorias, prestações e tomada de contas realizadas.</li>
                    <li>Detalhes sobre repasses e transferências de recursos.</li>
                    <li>Informações sobre a execução orçamentária e financeira.</li>
                    <li>Informações sobre licitações, contratos, contratações e atas de registro de preços.</li>
                    <li>Informações sobre provimento de cargos e relação dos servidores públicos lotados ou em exercício.</li>
                    <p>Para solicitar informações adicionais do Portal da Transparência, assim como outras informações públicas, clique no botão abaixo.</p>

                </div>

                <div class="panel-body">
                    <p>
                        <a class="btn btn-lg btn-greentur" href="<?php echo $legal ?>esic_solicitar">
                            Solicitar Informação
                        </a>
                        <a class="btn btn-lg btn-primary" href="<?php echo $legal ?>esic_consulta">
                            Consultar Protocolo
                        </a>
                    </p>
                </div>
            </div>

            <?php
            $sqSIC = mysql_query("SELECT * FROM prefeitura_config WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."'");
            $rsSIC = mysql_fetch_array($sqSIC);

            if ($rsSIC['SIC'] != '') {
            ?>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="title title-d"><strong>SIC</strong></h2>
                    </div>
                    <div class="panel-body bordered-bottom">
                        <p>O Serviço de Informações ao Cidadão (SIC) é a unidade física existente em todos os órgãos e
                            entidades do poder público, para atender o cidadão que deseja solicitar o acesso à
                            informação pública.</p>
                    </div>
                    <div class="panel-body callout-success">
                        <p><?php echo $rsSIC['SIC'];?></p>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
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