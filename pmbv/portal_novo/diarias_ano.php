<?php
include ("../conexao.php");
include('funcoes.php');
$SelAno = $_POST['ano'];


    $sql = "SELECT * FROM diarias WHERE ano = " . $SelAno . " AND Acao = 'Publicado' GROUP BY mes ORDER BY ano DESC, mes DESC";
    $sqlAnos = mysql_query("SELECT * FROM diarias WHERE Acao = 'Publicado' GROUP BY ano ORDER BY ano DESC");


?>
    <div class="col-md-1">
    <div class="btn-group">
        <button type="button" id="dashboardRange" class="btn btn-3d btn-black pull-right dropdown-toggle" data-toggle="dropdown">
            <span><?php echo $SelAno;?></span>
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu" role="menu">
            <?php
            $Anos = mysql_num_rows($sqlAnos);

            for ($y = 0; $y < $Anos; $y++){
                $verAnos = mysql_fetch_array($sqlAnos);
                ?>
                <li><a href="javascript:void(0)" onclick="carregaAno(<?php echo $verAnos['ano'];?>)"><?php echo $verAnos['ano'];?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>
    <div class="col-md-11 text-left">
<?php
$sqlGlossario = mysql_query($sql);
$Glossario = mysql_num_rows($sqlGlossario);

$total = 0;
$totalliberado = 0;
for ($y = 0; $y < $Glossario; $y++) {
    $verGlossario = mysql_fetch_array($sqlGlossario);

    if ($verGlossario['Acao'] == "Aguardando"){
        $classStatus = "btn-red";
    }else{

        $classStatus = "btn-dirtygreen";
    }



    ?>
    <a onclick="carregaMesAno(<?php echo $verGlossario['mes']; ?>,<?php echo $verGlossario['ano']; ?>)" href="javascript:void(0)">
        <i class="btn btn-3d <?php echo $classStatus;?>"><?php echo retorna_mes_extenso($verGlossario['mes']); ?> / <?php echo $verGlossario['ano']; ?></i>
    </a>
<?php
}
?>
        </div>