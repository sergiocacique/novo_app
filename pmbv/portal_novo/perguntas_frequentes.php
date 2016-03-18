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
?>

<?php
$CdCategoria = $_GET['categoria'];

$sqlLinha = mysql_query("SELECT * FROM perguntas_frequentes_categoria WHERE CdCategoria = '".$CdCategoria."'");
$rsLinha = mysql_fetch_array($sqlLinha);

?>

    <div id="breadcrumb">
        <div id="breadcrumb_primeiro"><span>+ Transparência</span></div>
        <div id="breadcrumb_segundo"><span>Perguntas Frequentes</span></div>
        <div id="breadcrumb_ultima"><span><?php echo $rsLinha['Nome']?></span></div>
    </div>

    <div id="estrutura">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php
            $sqlEstrutura = mysql_query("SELECT * FROM perguntas_frequentes WHERE Ativo = 'sim' AND CdCategoria = '".$CdCategoria."' ORDER BY Titulo ASC") or die(mysql_error());
            $contador = mysql_num_rows($sqlEstrutura);
            for ($i = 0; $i < $contador; $i++){
                $linha = mysql_fetch_array($sqlEstrutura);

                if ($i > 0){
                    $classServ = "false";
                }else{
                    $classServ = "true";
                }

            ?>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading<?php echo $i; ?>">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="" aria-controls="collapse<?php echo $i; ?>">
                            <?php echo $linha['Titulo']; ?>
                        </a>
                    </h4>
                </div>
                <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                    <div class="panel-body">
                        <?php echo $linha['Descricao']; ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>


