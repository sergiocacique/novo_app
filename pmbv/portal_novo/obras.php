<?php
$DtFinal = date('Y-m-d', strtotime('-1 days'));
?>
<?php
$sqlUlt = mysql_query("SELECT * FROM obras WHERE Acao = 'Publicado' GROUP BY ano, mes ORDER BY ano DESC, mes DESC LIMIT 1");
$rsLinha2 = mysql_fetch_array($sqlUlt);


$MesSelecionado = $rsLinha2['mes'];
$AnoSeleciona = $rsLinha2['ano'];



$mesSeguinte = ($MesSelecionado+1);
$anoSeguinte = ($AnoSeleciona);

if($mesSeguinte > 12){
    $mesSeguinte = 1;
    $anoSeguinte = ($AnoSeleciona+1);
}


$mesAnterior = ($MesSelecionado-1);
$anoAnterior = ($AnoSeleciona);

if($mesAnterior == 0){
    $mesAnterior = 12;
    $anoAnterior = ($AnoSeleciona-1);
}

$anoSeguinteRREO = ($AnoSeleciona+1);
$anoAnteriorRREO = ($AnoSeleciona-1);
?>
<script>
    function buscaMes(id,mes,ano){
        $('#loading2').css('visibility','visible');
        $.post("obras_detalhe.php", { id: id, mes: mes, ano: ano },
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
            var ano = quebra[0].split("=")[1];
            var mes = quebra[1].split("=")[1];
            var objeto = quebra[2].split("=")[1];


            console.log(quebra);
            jQuery.ajax({
                type: "POST",
                //url: "obras_listar.php",
                data: dados,
                success: function( data )
                {
                    $.post("obras_listar.php", {mes: mes, ano: ano, objeto: objeto},

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
                        CONSULTAR OBRAS
                        <br>
                    </h4>
                    <form method="post" action="" id="ajax_form">

                        <div class="group col-md-3">
                            <div class="select">
                            <select name="ano" id="ano">
                                <option></option>
                                <?php foreach( range(date('Y'), 2013) as $ano){?>
                                    <option value="<?php echo $ano?>"><?php echo $ano?></option>
                                <?php }?>
                            </select>
                            <label>Exercício</label>
                            <span class="bar"></span>
                                </div>
                        </div>

                        <div class="group col-md-3">
                            <div class="select">
                            <select name="mes" id="mes">
                                <option></option>
                                <option id="1" value="1">JANEIRO</option>
                                <option id="2" value="2">FEVEREIRO</option>
                                <option id="3" value="3">MARÇO</option>
                                <option id="4" value="4">ABRIL</option>
                                <option id="5" value="5">MAIO</option>
                                <option id="6" value="6">JUNHO</option>
                                <option id="7" value="7">JULHO</option>
                                <option id="8" value="8">AGOSTO</option>
                                <option id="9" value="9">SETEMBRO</option>
                                <option id="10" value="10">OUTUBRO</option>
                                <option id="11" value="11">NOVEMBRO</option>
                                <option id="12" value="12">DEZEMBRO</option>
                            </select>
                            <label>Mês</label>
                            <span class="bar"></span>
                                </div>
                        </div>

                        <div class="group col-md-6">
                            <input type="text" name="objeto" id="objeto" maxlength="37" >
                            <label>Obra</label>
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
                        OBRAS DE <?php echo retorna_mes_extenso($rsLinha2['mes']);?> / <?php echo $rsLinha2['ano'];?>
                        <br>
                        <small class="text-muted">atualizado em <?php echo date('d/m/Y H:i:s a', strtotime($rsLinha2['DtAtualizacao']))?></small>
                    </h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Mes / Ano</th>
                            <th>Nº Processo</th>
                            <th>Obra</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php



                        $sql = "SELECT * FROM obras WHERE (Acao = 'Publicado') AND ( ano = ".$rsLinha2['ano'].") AND ( mes = ".$rsLinha2['mes'].")";

                        $sqlGlossario = mysql_query($sql);
                        $Glossario = mysql_num_rows($sqlGlossario);

                        $total = 0;
                        for ($y = 0; $y < $Glossario; $y++){
                            $verGlossario = mysql_fetch_array($sqlGlossario);

                            $valor = $verGlossario['total'];
                            $total = $total + $valor;

                            if ($verGlossario['fisico'] < 20){
                                $valorCss = "progress-bar progress-bar-danger";
                            }elseif ($verGlossario['fisico'] < 40){
                                $valorCss = "progress-bar progress-bar-warning";
                            }elseif ($verGlossario['fisico'] < 60){
                                $valorCss = "progress-bar progress-bar-info";
                            }elseif ($verGlossario['fisico'] < 75){
                                $valorCss = "progress-bar";
                            }elseif ($verGlossario['fisico'] < 100){
                                $valorCss = "progress-bar progress-bar-success";
                            }elseif ($verGlossario['fisico'] > 98){
                                $valorCss = "progress-bar progress-bar-success";
                            }
                            ?>

                            <tr class='clickable-row' onclick="buscaMes(<?php echo $verGlossario['id'];?>,<?php echo $verGlossario['mes'];?>,<?php echo $verGlossario['ano'];?>)"  >
                                <td><small><?php echo retorna_mes_extenso($verGlossario['mes']);?>/<?php echo $verGlossario['ano'];?></small></td>
                                <td><small><?php echo $verGlossario['numero_processo'];?></small></td>
                                <td><small><?php echo $verGlossario['objeto'];?></small></td>
                                <td><small>R$ <?php echo number_format($verGlossario['total'], 2, ',', '.');?></small></td>
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