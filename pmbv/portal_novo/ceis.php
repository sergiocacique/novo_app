<?php
$DtFinal = date('Y-m-d', strtotime('-1 days'));
?>
<script>
    function verDetalhe(id){
        $('#loading2').css('visibility','visible');
        $.post("ceis_detalhe.php", { id: id },
            function(data){
                $('#resultado').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    function gerarXLS(mes,ano){
        $('#loading2').css('visibility','visible');
        $.post("obrasXLS.php", { mes: mes, ano: ano },
            function(data){
                $('#resultado').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    jQuery(document).ready(function(){
        jQuery('#ajax_form').submit(function(){
            var dados = jQuery( this ).serialize();

            var quebra  = dados.split("&");

            var objeto = quebra[0].split("=")[1];


            console.log(quebra);
            jQuery.ajax({
                type: "POST",
                //url: "obras_listar.php",
                data: dados,
                success: function( data )
                {
                    $.post("ceis_listar.php", {objeto: objeto},

                        function(data){
                            $('#resultado').html(data);
                        }).done(function() {
                            $('#loading2').css('visibility','hidden');
                        });

                },
                error: function( xhr, error)
                {
                    console.debug(xhr);
                    toastr.error(xhr.statusText);
                }
            });

            return false;
        });
    });




</script>
<section class="content-wrapper content-midwet">

<div class="content centralizado">
    <div class="help-block text-center">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>
                        EMPRESAS SANCIONADAS
                        <br>
                        <small class="text-muted">Cadastro Nacional de Empresas Inidôneas e Suspensas (CEIS)</small>

                    </h4>
                    <form method="post" action="" id="ajax_form">

                        <div class="group col-md-12">
                            <input type="text" name="objeto" id="objeto" maxlength="37" >
                            <label>Digite o Nome ou CNPJ da empresa</label>
                            <span class="bar"></span>
                        </div>

                        <div class="group col-md-2 col-md-offset-5">
                            <button type="button" class="btn btn-primary" onclick="$('#ajax_form').submit()">CONSULTAR</button>
                        </div>

                    </form>

                    <script>

                        $(document).ready(function() {

                            $('input').blur(function() {

                                if ($(this).val())
                                    $(this).addClass('used');
                                else
                                    $(this).removeClass('used');

                            });

                            $('select').blur(function() {

                                if ($(this).val())
                                    $(this).addClass('used');
                                else
                                    $(this).removeClass('used');

                            });


                        });


                    </script>
                </div>
            </div>
        </div>
    </div>

    <div id="resultado" class="help-block text-center">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>
                        EMPRESAS SANCIONADAS
                        <br>
                    </h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>CPF / CNPJ</th>
                            <th>Nome</th>
                            <th>Data Final</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $dDtAgora = date('Y-m-d');

                        $sql = "SELECT * ,T1.id as IdCIEIS FROM CEIS T1 INNER JOIN CEIS_INFO T2 ON T1.id = T2.CdCEIS WHERE T2.Acao = 'Publicado' AND FimSancao is null OR FimSancao >= '$dDtAgora' GROUP BY CNPJ ORDER BY PublicacaoSancao DESC ";
                        $sqlGlossario = mysql_query($sql);
                        $Glossario = mysql_num_rows($sqlGlossario);

                        $total = 0;
                        for ($y = 0; $y < $Glossario; $y++){
                            $verGlossario = mysql_fetch_array($sqlGlossario);

                            ?>

                            <tr class='clickable-row' onclick="verDetalhe(<?php echo $verGlossario['id'];?>)"  >
                                <td><small><?php echo $verGlossario['CNPJ'];?></small></td>
                                <td><small><?php echo $verGlossario['Nome'];?></small></td>
                                <td><small>
                                        <?php
                                        if ($verGlossario['FimSancao'] != "") {
                                            echo date('d/m/Y', strtotime($verGlossario['FimSancao']));
                                        }else{
                                            echo "**";
                                        }
                                        ?>
                                        </small></td>
                            </tr>
                        <?php
                        }
                        ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    </section>