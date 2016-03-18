
<section class="container">
    <div class="line box-plans mar-20">
        <?php
        $sqlReceita = mysql_query("SELECT * FROM receita WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' GROUP BY ano, mes ORDER BY ano DESC, mes DESC LIMIT 1");
        $rsRece = mysql_fetch_array($sqlReceita);
        $ContaReceita = mysql_num_rows($sqlReceita);

        if ($ContaReceita == 0){
            $valRe = "0,00";
            $atRe = "sem registro";
        }else{
            $sqlRe = mysql_query("SELECT sum(arrecadado) AS total FROM receita WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND (Acao = 'Publicado') AND ( ano = ".$rsRece['ano'].") AND ( mes = ".$rsRece['mes'].")");
            $rsRe = mysql_fetch_array($sqlRe);

            $valRe = number_format($rsRe['total'], 2, ',', '.');
            $atRe = date('d/m/Y H:i:s', strtotime($rsRece['DtAtualizacao']));
        }
        ?>
        <div class="box-plan nitro">
            <h2 class="title">Receitas</h2>
            <p class="support"><?php echo retorna_mes_extenso($rsRece['mes'])?>/<?php echo $rsRece['ano']?></p>
            <div class="price">
                <div class="price-value" style="">
                    <sup class="sup">R$</sup>
                    <?php echo $valRe;?>
                </div>
            </div>
            <ul class="list list-configs">
                <li class="item">
                    <strong>Atualizado em</strong>
                </li>
                <li class="item">
                    <?php echo $atRe?>
                </li>
            </ul>
        </div>


        <?php
        $sqlDep = mysql_query("SELECT * FROM empenho WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND acao = 'Publicado' ORDER BY Ano DESC, Mes DESC LIMIT 1");
        $rsDespe = mysql_fetch_array($sqlDep);
        $ContaDesp = mysql_num_rows($sqlDep);

        if ($ContaDesp == 0){
            $atDesp = "sem registro";
        }else{

            $atDesp = date('d/m/Y H:i:s', strtotime($rsDespe['DtAtualizacao']));
        }
        ?>

        <div class="box-plan ultra">
            <h2 class="title">Despesas</h2>
            <p class="support"><?php echo retorna_mes_extenso($rsDespe["Mes"])?>/<?php echo $rsDespe["Ano"]?></p>
            <div class="price">
                <div class="price-value" style="">
                    <sup class="sup"></sup>
                    <a class="btn type-d" title="Despesas" href="<?php echo $legal ?>despesas">SAIBA MAIS</a>
                </div>
            </div>
            <ul class="list list-configs">
                <li class="item">
                    <strong>Atualizado em</strong>
                </li>
                <li class="item">
                    <?php echo $atDesp?>
                </li>
            </ul>
        </div>
<?php
$sqlUlt = mysql_query("SELECT * FROM obras WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND acao = 'Publicado' GROUP BY ano, mes ORDER BY ano DESC, mes DESC LIMIT 1");
$rsLinha2 = mysql_fetch_array($sqlUlt);
$ContaObra = mysql_num_rows($sqlUlt);

if ($ContaObra == 0){
    $valObras = "0,00";
    $atObra = "sem registro";
}else{
    $sqlObras = mysql_query("SELECT sum(valor_realizado) AS total FROM obras WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND (acao = 'Publicado') AND ( ano = ".$rsLinha2['ano'].") AND ( mes = ".$rsLinha2['mes'].")");
    $rsObras = mysql_fetch_array($sqlObras);

    $valObras = number_format($rsObras['total'], 2, ',', '.');
    $atObra = date('d/m/Y H:i:s', strtotime($rsLinha2['DtAtualizacao']));
}
?>
        <div class="box-plan turbo">
            <h2 class="title">Obras</h2>
            <p class="support"><?php echo retorna_mes_extenso($rsLinha2['mes'])?>/<?php echo $rsLinha2['ano']?></p>
            <div class="price">
                <div class="price-value" style="">
                    <sup class="sup">R$</sup>
                    <?php echo $valObras;?>
                </div>
            </div>
            <ul class="list list-configs">
                <li class="item">
                    <strong>Atualizado em</strong>
                </li>
                <li class="item">
                    <?php echo $atObra?>
                </li>
            </ul>
        </div>

<?php
$sqlRREO = mysql_query("SELECT * FROM rreo WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND acao = 'Publicado' GROUP BY Ano, Bimestre ORDER BY Ano DESC, Pasta DESC LIMIT 1");
$rsRREO = mysql_fetch_array($sqlRREO);
$ContaRREO = mysql_num_rows($sqlRREO);

if ($ContaRREO == 0){
    $atRREO = "sem registro";
}else{

    $atRREO = date('d/m/Y H:i:s', strtotime($rsRREO['DtAtualizado']));
}
?>

        <div class="box-plan mega">
            <h2 class="title">RREO / RGF</h2>
            <p class="support"><?php echo ($rsRREO['Bimestre'])?>/<?php echo $rsRREO['Ano']?></p>
            <div class="price">
                <div class="price-value" style="">
                    <sup class="sup"></sup>
                    <a class="btn type-d" title="RREO / RGF - <?php echo ($rsRREO['Bimestre'])?>/<?php echo $rsRREO['Ano']?>" href="<?php echo $legal ?>rreo">SAIBA MAIS</a>
                </div>
            </div>
            <ul class="list list-configs">
                <li class="item">
                    <strong>Atualizado em</strong>
                </li>
                <li class="item">
                    <?php echo $atRREO?>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="container line-100 type-a line-extra mar-60">
    <div class="container" style="margin-top: 30px; padding-bottom: 30px;">
        <?php
        $sqlConvenio = mysql_query("SELECT * FROM convenios WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND acao = 'Publicado' GROUP BY ano, mes ORDER BY ano DESC, mes DESC LIMIT 1");
        $rsConvenio = mysql_fetch_array($sqlConvenio);
        $ContaConvenio = mysql_num_rows($sqlConvenio);

        if ($ContaConvenio == 0){
            $valConvenio = "0,00";
            $atConvenio = "sem registro";
        }else{
            $sqlCon = mysql_query("SELECT sum(liberado) AS total FROM convenios WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND (acao = 'Publicado') AND ( ano = ".$rsConvenio['ano'].") AND ( mes = ".$rsConvenio['mes'].")");
            $rsCon = mysql_fetch_array($sqlCon);

            $valConvenio = number_format($rsCon['total'], 2, '.', ',');
            $atConvenio = date('d/m/Y H:i:s', strtotime($rsConvenio['DtAtualizado']));
        }
        ?>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <h3 class="title title-e mar-20"><strong>CONVÊNIOS</strong><br> </h3>
            <p>Confira os Convênios de <?php echo retorna_mes_extenso($rsConvenio['mes'])?> </p>
            <h3 class="title title-e mar-20"><a class="btn type-d" title="Confira os Convênios de <?php echo retorna_mes_extenso($rsConvenio['mes'])?>" href="<?php echo $legal ?>convenios">SAIBA MAIS</a></h3>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4">
            <h3 class="title title-e mar-20"><strong>CONTRATOS</strong><br> E LICITAÇÕES</h3>
            <p>Confira os contratos e licitações do Município de <?php echo $rsPrefeitura['Nome'] ?> </p>
            <h3 class="title title-e mar-20"><a class="btn type-d" title="Confira os contratos e licitações do Município de <?php echo $rsPrefeitura['Nome'] ?>" href="<?php echo $legal ?>contrato_licitacao">SAIBA MAIS</a></h3>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4">
            <h3 class="title title-e mar-20"><strong>LEGISLAÇÃO</strong><br></h3>
            <p>Confira as leis do Município de <?php echo $rsPrefeitura['Nome'] ?> </p>
            <h3 class="title title-e mar-20"><a class="btn type-d" title="Confira as leis do Município de <?php echo $rsPrefeitura['Nome'] ?>" href="<?php echo $legal ?>legislacao">SAIBA MAIS</a></h3>
        </div>
    </div>
</section>

<section class="container page-plans resell line-two mar-60">
    <div class="col-xs-8 col-sm-8 col-md-8">
        <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
            <h2 class="title title-d"><strong>ESTRUTURA</strong> ORGANIZACIONAL</h2>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="divisor divisor-c">
                <span> </span>
            </div>
        </div>
        <table class="table table-afiliados" summary="Despesas com pessoal">

            <tbody>
            <?php
            $sqlGlossario = mysql_query("SELECT * FROM estrutura WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado'");
            $Glossario = mysql_num_rows($sqlGlossario);

            for ($y = 0; $y < $Glossario; $y++){
                $verGlossario = mysql_fetch_array($sqlGlossario);
                ?>
                <tr onclick="carregaAno(<?php echo $verGlossario['CdEstrutura'];?>)">
                    <td>
                        <small><?php echo $verGlossario['Nome'];?></small>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php

    if ($rsConfig['Diario_oficial'] == 'Ativado'){
    ?>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="five-mins mar-top-100">
            <div class="five-mins-body">
                <i class="sprite bg-crown fa fa-file-text-o fa-3x"></i>
                <h3 class="subtitle">
                    DIÁRIO <strong>OFICÍAL</strong>
                </h3>
                <p class="text">
                Confira os atos da prefeitura
                <br>
                </p>
                <a class="btn-new type-one yellow center" style="color: #8B5F01;" href="http://www.<?php echo $rsPrefeitura['Pasta'] ?>.rr.gov.br/?Pages=diario_oficial">COMEÇAR</a>
            </div>
        </div>
    </div>
    <?php }?>
</section>

<section class="container page-plans resell line-two mar-60">
    <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
        <h2 class="title title-d"><strong>LEGISLAÇÃO</strong></h2>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="divisor divisor-c">
            <span> </span>
        </div>
    </div>

    <div class="row">
        <?php
        $sqlLeis = mysql_query("SELECT * FROM leis_categoria WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' LIMIT 3");
        $Leis = mysql_num_rows($sqlLeis);

        for ($y = 0; $y < $Leis; $y++){
        $verLeis = mysql_fetch_array($sqlLeis);
        ?>
        <div class="col-xs-6 col-md-4 ">
            <div class="item-para-download">
                <div class="descricao">
                    <h3 class="text-center"><?php echo $verLeis['Categoria'];?> </h3>
                    <?php echo $verLeis['Descricao'];?>
                </div>
                <div class="link-de-download">
                    <p class="text-center">
                        <a class="btn type-d" title="" href="<?php echo $legal ?>legislacao">SAIBA MAIS</a>
                    </p>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
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
        <hr>
        <div class="col-md-8 mar-10">
            <p class="text text-c">
            <strong>SIC</strong><br>
                Secretária Extraordinária de Inclusão Digital<br>
                Edna Aparecida de Lima<br>
                Rua Dom José Nepote, 902 - São Francisco - CEP: 69305-070
            </p>
        </div>
        <div class="col-md-8 mar-20">
            <a class="btn type-d" title="saiba mais sobre o e-SIC" href="<?php echo $legal ?>esic">SAIBA MAIS</a>
        </div>
    </div>
</section>