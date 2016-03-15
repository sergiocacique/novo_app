<?php

include ("conexao.php");
include ("funcao.php");

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();


// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: login.php"); exit;
}

?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Portal da Transparência</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/bootstrap.css">


    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.1.11.1.min.js"></script>
    <script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script>

        function loadImages() {
            if (document.getElementById) {  // DOM3 = IE5, NS6
                document.getElementById('loading').style.visibility = 'hidden';
            }
            else {
                if (document.layers) {  // Netscape 4
                    document.hidepage.visibility = 'hidden';
                }
                else {  // IE 4
                    document.all.hidepage.style.visibility = 'hidden';
                }
            }
        }

        $(window).load(function() {
            // Animate loader off screen
            $("#loading2").delay(200).fadeOut("slow");
        });


        jQuery(function($){
            // JQUERY MASK INPUT
            $('[data-mask="date"]').mask('00/00/0000');
            $('[data-mask="time"]').mask('00:00:00');
            $('[data-mask="date_time"]').mask('00/00/0000 00:00:00');
            $('[data-mask="zip"]').mask('00000-000');
            $('[data-mask="money"]').mask('000.000.000.000.000,00', {reverse: true});
            $('[data-mask="procc"]').mask('000.00', {reverse: true});
            $('[data-mask="phone"]').mask('0000-0000');
            $('[data-mask="phone_with_ddd"]').mask('(00) 0000-0000');
            $('[data-mask="phone_us"]').mask('(000) 000-0000');
            $('[data-mask="cpf"]').mask('000.000.000-00', {reverse: true});
            $('[data-mask="ip_address"]').mask('099.099.099.099');
            $('[data-mask="percent"]').mask('##0,00%', {reverse: true});
            // END JQUERY MASK INPUT
        });
    </script>
</head>
<body class="orders index">
<div id="loading2">
    <div id="loading">
        <div class="container">
            <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-1">
                <h1>Carregando dados</h1>
                <p>aguarde por favor</p>
                <div id="circleG">
                    <div id="circleG_1" class="circleG"></div>
                    <div id="circleG_2" class="circleG"></div>
                    <div id="circleG_3" class="circleG"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ("menu.php");?>
<?php include ("menu_transparencia.php");?>
<?php include ("topo.php");?>


<div id="conteudo" class="container">
  <div class="row discovery">
      <div class="col-sm-9 col-md-10">
        <div class="header">
            <h1>Alterar Convênios</h1>
        </div>
      </div>
  </div>
    <div class="row discovery2">
      <div class="table-responsive">
        <form class="validate" action="transparencia_convenios_adicionar.php" method="post">

          <div class=" col-sm-12 col-md-3">
            <label>Mês</label>
            <div class="fancy-form fancy-form-select">
              <select class="form-control" id="mes" name="mes">
                <?php
                for ($i = 1; $i <= 12; $i++){
                    ?>
                    <option value="<?=$i?>"><?=retorna_mes_extenso($i)?></option>
                <?php }?>
              </select>
            <i class="fancy-arrow"></i>
          </div>
        </div>

        <div class=" col-sm-12 col-md-3">
          <label>Ano</label>
          <div class="fancy-form fancy-form-select">
            <select class="form-control" id="ano" name="ano">
              <?php
              for($ano=date('Y');$ano > date('Y')-10;$ano--){
                  ?>
                  <option value="<?=$ano?>"><?=$ano?></option>
              <?php }?>
            </select>
          <i class="fancy-arrow"></i>
        </div>
      </div>

      <div class=" col-sm-12 col-md-3">
        <label>Tipo do Convênio</label>
        <div class="fancy-form fancy-form-select">
          <select class="form-control" id="Tipo" name="Tipo">
                <option value="Concedente">Concedente</option>
                <option value="Convenente">Convenente</option>
          </select>
        <i class="fancy-arrow"></i>
      </div>
    </div>


          <div class=" col-sm-12 col-md-7">
            <div class="fancy-form">
              <label>Número SIAFI</label>
              <input id="SIAFI" name="SIAFI" class="form-control" type="text">
            </div>
          </div>

          <div class=" col-sm-12 col-md-7">
            <div class="fancy-form">
              <label>Órgão</label>
              <input id="orgao" name="orgao" class="form-control" type="text" placeholder="Digite o Nome do Orgão Completo">
            </div>
          </div>

          <div class=" col-sm-12 col-md-12">
            <label>Objeto do Convênio</label>
            <textarea name="objeto" class="form-control" rows="5" id="objeto"></textarea>
          </div>

          <div class="box-branco">
              <h4>Informações inmportantes</h4>
              <div class=" col-sm-12 col-md-4">
                <label>Valor Aprovado (R$)</label>
                <input id="val_aprovado" name="val_aprovado" class="form-control" type="text">
              </div>

              <div class=" col-sm-12 col-md-4">
                <label>Valor Liberado (R$)</label>
                <input data-mask="money" id="val_liberado" name="val_liberado" class="form-control" type="text">
              </div>

              <div class=" col-sm-12 col-md-4">
                <label>Valor Contrapartida (R$)</label>
                <input data-mask="money" id="val_contrapartida" name="val_contrapartida" class="form-control" type="text">
              </div>

              <div class=" col-sm-12 col-md-4">
                <label>Inicio da Vigencia</label>
                <input data-mask="date" id="inicio_vigencia" name="inicio_vigencia" class="form-control" type="text">
              </div>

              <div class=" col-sm-12 col-md-4">
                <label>Fim da Vigencia</label>
                <input data-mask="date" id="fim_vigencia" name="fim_vigencia" class="form-control" type="text">
              </div>

              <div class=" col-sm-12 col-md-4">
                <label>Data da Publicação</label>
                <input data-mask="date" id="data_publicacao" name="data_publicacao" class="form-control" type="text">
              </div>
          </div>

          <div class=" col-sm-12 col-md-4">
            <label>Prorrogação</label>
            <input data-mask="date" id="prorrogacao" name="prorrogacao" class="form-control" type="text">
          </div>

          <div class=" col-sm-12 col-md-4">
            <label>Status do Convênio</label>
            <input id="status_convenio" name="status_convenio" class="form-control" type="text">
          </div>

          <div class=" col-sm-12 col-md-4">
            <label>Execução do Convênio</label>
            <input data-mask="procc" id="execucao" name="execucao" class="form-control" type="text">
          </div>

          <div class=" col-sm-12 col-md-12">
            <label>Observação do Convênio</label>
            <textarea name="observacao" class="form-control" rows="5" id="observacao"></textarea>
          </div>

          <div class=" col-sm-12 col-md-6">
            <label>Ação</label>
            <div class="fancy-form fancy-form-select">
              <select class="form-control" id="acao" name="acao">
                <?php
                $sqlGlossario = mysql_query("SELECT * FROM acao ORDER BY NomeAcao ASC");
                $Glossario = mysql_num_rows($sqlGlossario);

                for ($y = 0; $y < $Glossario; $y++){
                    $verGlossario = mysql_fetch_array($sqlGlossario);

                    ?>
                <option value="<?php echo $verGlossario['NomeAcao']; ?>"><?php echo $verGlossario['NomeAcao']; ?></option>
                <?php
                }
                ?>
              </select>
            <i class="fancy-arrow"></i>
          </div>
          <br clear="all" />
        </div>

        <div class=" col-sm-12 col-md-12">
          <button type="submit" class="btn btn-3d btn-teal btn-block margin-top-30">
  				GRAVAR
  			</button></div>

        </form>
        </div>
    </div>
</div>

</body>
</html>
