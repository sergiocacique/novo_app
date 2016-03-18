
<script>

    function Pagint(CdItens){
        $('#loading2').css('visibility','visible');
        $.post("editais_inc.php", { CdItens: CdItens },
            function(data){
                $('#resultado').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

</script>
<div class="container">
    <div class="page-header">
        <h3>Editais</h3>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3 visible-desktop">
        <ul class="nav nav-pills nav-stacked" style="max-width: 100%">
            <?php
            $sqlGlossario = mysql_query("SELECT site_editais_categoria.id, site_editais_categoria.Nome, site_editais.Acao, site_editais.CdPrefeitura FROM site_editais_categoria INNER JOIN site_editais ON site_editais_categoria.id = site_editais.CdCategoria WHERE site_editais.CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND site_editais.Acao = 'Publicado' GROUP BY site_editais_categoria.Nome");
            $Glossario = mysql_num_rows($sqlGlossario);

            for ($y = 0; $y < $Glossario; $y++){
            $verGlossario = mysql_fetch_array($sqlGlossario);

                if ($y > 0){
                    $classServ = "false";
                }else{
                    $classServ = "true";
                }
            ?>
            <li <?php //echo $classServ == "true" ? 'class="active"':'';?>><a href='javascript:void(0)' onclick='Pagint(<?php echo $verGlossario['id'];?>)'><?php echo $verGlossario['Nome'];?></a></li>
            <?php
            }
            ?>

        </ul>
    </div>
    <div id="resultado" class="col-xs-12 col-sm-12 col-md-9">

        <?php
        $sqlverDiario = mysql_query("SELECT * FROM site_editais WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY DtCadastro DESC") or die(mysql_error());
        $DiarioOficial = mysql_num_rows($sqlverDiario);

        $contador1 = mysql_num_rows($sqlverDiario);

        if ($contador1 == 0){

            ?>
            <div class="alert alert-dark margin-bottom-30">
                <h4>
                    <p>Não há editais cadastrado.</p>
            </div>
            <?php

        }else {


            for ($y = 0; $y < $DiarioOficial; $y++) {
                $verDiario = mysql_fetch_array($sqlverDiario);
                ?>
                <div class="col-xs-12 col-sm-4 col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="panel-actions">
                                <li>
                                    <a href="<?php echo $UrlAmigavel ?>arquivosDinamicos/editais/<?php echo $verDiario["Arquivo"] ?>"
                                       target="_blank">
                                        <i class="fa fa-spin-2x fa-2x fa-file-pdf-o text-danger"></i>
                                    </a>
                                </li>
                            </ul>
                            <p class="text-muted"><?php echo $verDiario["Titulo"] ?></p>

                        </div>
                    </div>
                </div>
            <?php
            }
        }
        ?>
    </div>
</div>