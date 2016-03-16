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
          console.log('aplicando mascara')
          $('[data-mask="date"]').mask('00/00/0000');
          $('[data-mask="time"]').mask('00:00:00');
          $('[data-mask="date_time"]').mask('00/00/0000 00:00:00');
          $('[data-mask="zip"]').mask('00000-000');
          $('[data-mask="money"]').mask('000.000.000.000.000,00', {reverse: true});
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
            <h1>Adicionar Nova Obras</h1>
        </div>
      </div>
  </div>
    <div class="row discovery2">
      <div class="table-responsive">
        <form id="formulario_clientes" name="formulario_clientes" class="validate" action="transparencia_obra_adicionar.php" method="post">

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

          <div class=" col-sm-12 col-md-6">
            <div class="fancy-form">
              <label>Número do Processo</label>
              <input id="numero_processo" name="numero_processo" class="form-control" type="text" placeholder="Digite o Nome Completo">
            </div>
          </div>

          <div class=" col-sm-12 col-md-12">
            <label>Objeto da Obra</label>
            <textarea name="objeto" class="form-control" rows="5" id="objeto"></textarea>
          </div>

          <div class=" col-sm-12 col-md-12">
            <label>Observação da Obra</label>
            <textarea name="observacao" class="form-control" rows="5" id="objeto"></textarea>
          </div>

          <div class=" col-sm-12 col-md-6">
            <div class="fancy-form">
              <label>Status da Obra</label>
              <input id="estatus" name="estatus" class="form-control" type="text" placeholder="Digite o Destino Completo">
            </div>
          </div>


          <div class="box-branco">


            <div class=" col-sm-12 col-md-4">
              <div class="fancy-form">
                <label>Valor do Convênio (R$)</label>
                <input data-mask="money" id="convenio" name="convenio" class="form-control" type="text" placeholder="Digite o Destino Completo">
              </div>
            </div>

            <div class=" col-sm-12 col-md-4">
              <div class="fancy-form">
                <label>Valor do Recurso Próprio (R$)</label>
                <input data-mask="money" id="recurso_proprio" name="recurso_proprio" class="form-control" type="text" placeholder="Digite o Destino Completo">
              </div>
            </div>

            <div class=" col-sm-12 col-md-4">
              <div class="fancy-form">
                <label>Total concluida (%)</label>
                <input data-mask="money" id="fisico" name="fisico" class="form-control" type="text" placeholder="Digite o Destino Completo">
              </div>
            </div>

            <div class=" col-sm-12 col-md-6">
              <div class="fancy-form">
                <label>Valor Gasto até o Momento (R$)</label>
                <input data-mask="money" id="valor_realizado" name="valor_realizado" class="form-control" type="text" placeholder="Digite o Destino Completo">
              </div>
            </div>

            <div class=" col-sm-12 col-md-6">
              <div class="fancy-form">
                <label>Valor Total - Convênio + Recurso Próprio (R$)</label>
                <input data-mask="money" id="total" name="total" class="form-control" type="text" placeholder="Digite o Destino Completo">
              </div>
            </div>

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
          </div><br clear="all">
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
