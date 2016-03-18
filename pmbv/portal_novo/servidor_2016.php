
<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 29/08/14
 * Hora: 10:20
 * Página: Servidor
 *
 */




if (isset($_POST['txtNome']) and ($_POST['txtNome'] != '')){
    $bNome = $_POST['txtNome'];
    $bNome = mysql_real_escape_string($bNome);
}elseif (isset($_GET['txtNome']) and ($_GET['txtNome'] != '')){
    $bNome = $_GET['txtNome'];
    $bNome = mysql_real_escape_string($bNome);
}





$sql = "SELECT * FROM servidor WHERE (Acao = 'Publicado')";


if (isset($bNome) AND $bNome  != ''){
    $bNome = str_replace(" ","%", $bNome);
    $sql =$sql . " AND (Nome LIKE '%".$bNome."%') OR (CPF LIKE '%".$bNome."%')";
}


$sql = $sql . "GROUP BY CPF ORDER BY Ano DESC, Mes DESC, Nome ASC";

//echo "sql=".$sql;
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

$rs_servidor = ($sql);
$servidor = mysql_query($rs_servidor);

$total = mysql_num_rows($servidor);
//quantidade de itens por pagina
$registros = 50;

//calcula o número de páginas
$numPaginas = ceil($total/$registros);

$inicio = ($registros*$pagina)-$registros;
$rs_servidor = ($sql." limit $inicio,$registros");
$servidor = mysql_query($rs_servidor);
$total = mysql_num_rows($servidor);

$max_links = 5;

//echo $sql;
?>
<script>

    // Carousel Auto-Cycle
    $(document).ready(function() {
        $('.carousel').carousel({
            interval: 6000
        })
    });

    function carregaAno(ano,CdServidor){
        $('#loading2').css('visibility','visible');
        $.post("servidor_ano.php", { ano: ano ,CdServidor: CdServidor},
            function(data){
                $('#anos').html(data);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }


    function buscaMes(id){
        $('#loading2').css('visibility','visible');
        $.post("servidor_detalhe.php", { id: id},
            function(data){
                $('#resultado').html(data);
                $('html, body').animate({scrollTop: $(document).height()}, 600);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    function salario(id){
        $('#loading2').css('visibility','visible');
        $.post("servidor_salario.php", { id: id},
            function(data){
                $('#resultado').html(data);
                $('html, body').animate({scrollTop: $(document).height()}, 600);
            }).done(function() {
                $('#loading2').css('visibility','hidden');
            });
    }

    function gerarXLS(mes,ano){
        $('#loading2').css('visibility','visible');
        $.post("servidorXLS.php", { mes: mes, ano: ano },
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
            var nome = quebra[0].split("=")[1];

            console.log(quebra);
            jQuery.ajax({
                type: "POST",
                //url: "obras_listar.php",
                data: dados,
                success: function( data )
                {
                    $.post("servidor_listar.php", {nome: nome},

                        function(data){
                            $('#resultado').html(data);
                            $('html, body').animate({scrollTop: $(document).height()}, 600);
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
                            CONSULTAR SERVIDORES
                            <br>
                        </h4>
                        <form method="post" action="" id="ajax_form">



                            <div class="group col-md-12">
                                <input type="text" name="nome" id="nome" maxlength="37" >
                                <label>Nome do Servidor</label>
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
                            SERVIDORES
                            <br>
                        </h4>

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>CPF</th>
                                <th>SERVIDOR</th>
                                <th>CARGO</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            while ($listar = mysql_fetch_array($servidor)){

                                $sqlLinha2 = mysql_query("SELECT * FROM servidor WHERE CPF = '".$listar['CPF']."'");
                                $rsLinha2 = mysql_fetch_array($sqlLinha2);

                                $CPF = $listar['CPF'];
                                $CPFs = $CPF;
                                //$CPFs = explode(".", $CPF);
                                ?>

                                <tr class='clickable-row' onclick="buscaMes(<?php echo $listar['CdServidor'];?>)"  >
                                    <td><small><?php echo mask($CPF,'***.###.###-**');?></small></td>
                                    <td><small><?php echo $listar['Nome'];?></small></td>
                                    <td><small>
                                            <?php
                                            if ($rsLinha2['Cargo'] == ''){
                                                echo $rsLinha2['CargoComissao'];
                                            }else {
                                                echo $rsLinha2['Cargo'];
                                            }
                                            ?>
                                        </small></td>
                                </tr>
                                <?php
                                $i ++;
                            }
                            //endwhile; ?>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>


</section>

