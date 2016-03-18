<?php
//include ("../conexao.php");
$CdPagina = $_GET['id'];

$sqlPagina = mysql_query("SELECT * FROM site_pagina WHERE id = '".$CdPagina."'");
$rsPagina = mysql_fetch_array($sqlPagina);

?>
<script>

    function Pagint(CdItens){
        $('#loading2').css('visibility','visible');
        $.post("interno2.php", { CdItens: CdItens },
            function(data){
                $('#resultado').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

</script>
<div class="container">
    <div class="page-header">
        <h3><?php echo $rsPagina['Titulo']?></h3>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
        <ul class="nav nav-pills nav-stacked" style="max-width: 100%">
            <?php
            $sqlGlossario = mysql_query("SELECT * FROM site_itens_pagina WHERE CdPagina = '".$CdPagina."'");
            $Glossario = mysql_num_rows($sqlGlossario);

            for ($y = 0; $y < $Glossario; $y++){
            $verGlossario = mysql_fetch_array($sqlGlossario);

                if ($y > 0){
                    $classServ = "false";
                }else{
                    $classServ = "true";
                }

                if ($verGlossario['Link'] == "") {
                    $linkInterno = "<a href='javascript:void(0)' onclick='Pagint(".$verGlossario['id'].")'>";
                }else{
                    $linkInterno = "<a href=".$UrlAmigavel.$verGlossario['Link'].">";
                }
            ?>
            <li <?php //echo $classServ == "true" ? 'class="active"':'';?>><?php echo $linkInterno;?><?php echo $verGlossario['Nome'];?></a></li>
            <?php
            }
            ?>

        </ul>
    </div>
    <div id="resultado" class="col-xs-12 col-sm-8 col-md-9" style="text-align: justify">
        <div class="col-lg-12 visible-phone">
            <h2 class="page-header"></h2>
        </div>
        <?php echo $rsPagina['Resumo']?></div>
</div>