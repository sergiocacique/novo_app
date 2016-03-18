
<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 29/08/14
 * Hora: 10:20
 * Página: Servidor
 *
 */


$sqlUlt = mysql_query("SELECT * FROM servidor_cedido WHERE (Acao = 'Publicado') GROUP BY CPF ORDER BY Ano DESC, Mes DESC, Nome ASC LIMIT 1");
$rsLinha2 = mysql_fetch_array($sqlUlt);


$sqlGlossario1 = mysql_query("SELECT Para, De,Mes, Ano, count(Para) as Total FROM servidor_cedido WHERE (Acao = 'Publicado') AND Ano = (SELECT Ano FROM servidor_cedido Order By Ano DESC, Mes Desc Limit 1)   GROUP BY Para, Mes, Ano Order By Ano DESC , Mes Desc");
$Glossario1 = mysql_num_rows($sqlGlossario1);


$sqlGlossario = mysql_query("SELECT Para, De,Mes, Ano, count(Para) as Total FROM servidor_cedido WHERE (Acao = 'Publicado') AND Ano = (SELECT Ano FROM servidor_cedido Order By Ano DESC, Mes Desc Limit 1)   GROUP BY Para, Mes, Ano Order By Ano DESC , Mes Desc");
$Glossario = mysql_num_rows($sqlGlossario);

$sqlGlossario2 = mysql_query("SELECT Para, De, Mes, Ano, count(Para) as Total FROM servidor_cedido WHERE (Acao = 'Publicado') AND Ano = (SELECT Ano FROM servidor_cedido Order By Ano DESC, Mes Desc Limit 1)   GROUP BY Para, Mes, Ano Order By Ano DESC , Mes Desc");
$Glossario2 = mysql_num_rows($sqlGlossario2);

$soma = 0;
$somaTotal = 0;
$json_data=array();


for($y1 = 0; $y1 < $Glossario1; $y1++){
    $verGlossario1 = mysql_fetch_array($sqlGlossario1);
    $soma= $verGlossario1['Total'];
    $somaTotal = $somaTotal+$soma;
}
for ($y = 0; $y < $Glossario; $y++) {
    $verGlossario = mysql_fetch_array($sqlGlossario);



    $porcentagem = ($verGlossario['Total'] * 100 / $somaTotal );
    $porcentagem = number_format($porcentagem,2);


    $json_array['label']=$verGlossario['Para'];
    $json_array['value']=$porcentagem;
    array_push($json_data,$json_array);
}

?>


<script>

    $(function () {
        Morris.Donut({
            element: 'graph',
            data: <?php echo json_encode($json_data)?>,
            backgroundColor: '#fff',
            labelColor: '#525051',
            colors: [ '#fbbd40', '#f08940', '#6aa452', '#17a161', '#2c91a5', '#2d6d9a' ],
            formatter: function (x) { return x + "%"}
        });

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

    <div id="resultado" class="content centralizado">


        <div class="help-block text-center">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4> SERVIDORES CEDIDOS <br><br></h4>
                        <div class="col-md-5">
                            <div id="graph" class="graph"></div>
                         </div>
                        <div class="col-md-7">
                            <table class="table table-bordered table-striped">
                                <colgroup>
                                    <col class="col-xs-5">
                                    <col class="col-xs-5">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>Orgão</th>
                                    <th>Cedido para</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                for ($y2 = 0; $y2 < $Glossario2; $y2++) {
                                    $verGlossario2 = mysql_fetch_array($sqlGlossario2);
                                    ?>
                                    <tr>
                                        <td><?php echo $verGlossario2['Para'];?></td>
                                        <td><?php echo $verGlossario2['De'];?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                                <thead>
                                <tr>
                                    <th colspan="2">Total de cedidos em <?php echo retorna_mes_extenso(date('m', strtotime($rsLinha2['DtAtualizacao'])));?> DE <?php echo date('Y', strtotime($rsLinha2['DtAtualizacao']));?></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="help-block text-center">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <table class="table table-bordered table-striped">
                            <colgroup>
                                <col class="col-xs-3">
                                <col class="col-xs-1">
                                <col class="col-xs-3">
                                <col class="col-xs-3">
                                <col class="col-xs-2">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Orgão</th>
                                <th>Cedido Para</th>
                                <th>Cedido Em</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sqlGlossario3 = mysql_query("SELECT * FROM servidor_cedido WHERE (Acao = 'Publicado') AND Ano = (SELECT Ano FROM servidor_cedido Order By Ano DESC, Mes Desc Limit 1)   GROUP BY Para, Mes, Ano Order By Ano DESC , Mes Desc");
                            $Glossario3 = mysql_num_rows($sqlGlossario3);
                            for ($y3 = 0; $y3 < $Glossario3; $y3++) {
                                $verGlossario3 = mysql_fetch_array($sqlGlossario3);
                                $CPF = $verGlossario3['CPF'];
                                ?>
                                <tr>
                                    <td><?php echo $verGlossario3['Nome'];?></td>
                                    <td><?php echo mask($CPF,'***.###.###-**');?></td>
                                    <td><?php echo $verGlossario3['De'];?></td>
                                    <td><?php echo $verGlossario3['Para'];?></td>
                                    <td>fev/2015</td>
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

        <div class="help-block text-center">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>
                            DADOS DO PORTAL - SERVIDORES CEDIDOS
                            <br>
                        </h4>

                        <p>DADOS ATUALIZADOS EM  <?php echo date('d', strtotime($rsLinha2['DtAtualizacao']));?> DE <?php echo retorna_mes_extenso(date('m', strtotime($rsLinha2['DtAtualizacao'])));?> DE <?php echo date('Y', strtotime($rsLinha2['DtAtualizacao']));?> (SERVIDORES CEDIDOS)</p>
                    </div>
                </div>
            </div>
        </div>

    </div>


</section>

