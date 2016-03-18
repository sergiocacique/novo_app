<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 29/08/14
 * Hora: 10:20
 * Página: Servidor
 *
 */


//include ("../conexao.php");
$CdLeis = $_GET['lei'];

$sqlLinha = mysql_query("SELECT * FROM Leis WHERE CdLeis = '".$CdLeis."'");
$rsLinha = mysql_fetch_array($sqlLinha);

$sqlLinha2 = mysql_query("SELECT * FROM Leis_categoria WHERE CdCategoria = '".$rsLinha['CdCategoria']."'");
$rsLinha2 = mysql_fetch_array($sqlLinha2);



?>


    <div id="breadcrumb">
        <div id="breadcrumb_primeiro"><span>Legislação</span></div>
        <div id="breadcrumb_segundo"><span><?php echo $rsLinha2['Categoria']?></span></div>
        <div id="breadcrumb_ultima"><span><?php echo $rsLinha['Titulo']?></span></div>
    </div>

    <div id="estrutura">

        <div class="panel-body">
            <div class="brasao">
                <?php if ($rsLinha['TpLei'] == 'Federal'){?>
                <img src="../img/brasao_federal.jpg" width="100">
                    <p class="brasao_texto">
                        Presidência da República<br>
                        Casa Civil<br>
                        Subchefia para Assuntos Jurídicos
                    </p>
                <?php }else{?>
                <img src="../img/brasao_municipio.jpg" width="100">
                    <p class="brasao_texto">
                        “BRASIL: DO CABURAÍ AO CHUÍ”<br>
                        PREFEITURA MUNICIPAL DE BOA VISTA<br>
                        GABINETE DO PREFEITO </p>
                <?php }?>
            </div>
            <div class="data_lei"><?php echo $rsLinha2['Categoria']?> N&ordm; <strong><?php echo $rsLinha['NumLeis']?></strong>, De <?php echo strftime('%d de %B de %Y', strtotime($rsLinha['DtPub']));?></div>
            <h3><?php echo $rsLinha['Titulo']?></h3>
            <p class="sobre"><?php echo $rsLinha['txtLeis']?></p>

        </div><!-- /panel-body -->

    </div>


