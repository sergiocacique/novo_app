<?php
include ("../conexao.php");
include('funcoes.php');
$SelAno = $_POST['ano'];


    $sql = "SELECT * FROM passagens WHERE DATE_FORMAT(DtViagem, '%Y' ) = " . $SelAno . " AND Acao = 'Publicado' GROUP BY DATE_FORMAT(DtViagem, '%m') ORDER BY DATE_FORMAT(DtViagem, '%Y') DESC, DATE_FORMAT(DtViagem, '%m') DESC";
    $sqlAnos = mysql_query("SELECT * FROM passagens WHERE Acao = 'Publicado' GROUP BY DATE_FORMAT(DtViagem, '%Y') ORDER BY DATE_FORMAT(DtViagem, '%Y') DESC");


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
                <li><a href="javascript:void(0)" onclick="carregaAno(<?php echo date('Y', strtotime($verAnos['DtViagem']));?>)"><?php echo date('Y', strtotime($verAnos['DtViagem']));?></a></li>
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
    <a onclick="carregaMesAno(<?php echo date('m', strtotime($verGlossario['DtViagem'])); ?>,<?php echo date('Y', strtotime($verGlossario['DtViagem'])); ?>)" href="javascript:void(0)">
        <i class="btn btn-3d <?php echo $classStatus;?>"><?php echo retorna_mes_extenso(date('m', strtotime($verGlossario['DtViagem']))); ?> / <?php echo date('Y', strtotime($verGlossario['DtViagem'])); ?></i>
    </a>
<?php
}
?>
        </div>