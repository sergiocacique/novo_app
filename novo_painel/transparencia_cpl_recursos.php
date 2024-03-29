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
<?php


  $contrato = $_GET['contrato'];
  $sqlPagina = mysql_query("SELECT * FROM cpl WHERE CdCPL = '".$contrato."'");

$rsPagina = mysql_fetch_array($sqlPagina);
 ?>
<div id="conteudo" class="container">
  <div class="row discovery">
      <div class="col-sm-9 col-md-10">
        <div class="header">
            <h1>Alterar Contratos e Licitações</h1>
        </div>
      </div>
  </div>
    <div class="row discovery2">
      <ul class="nav nav-tabs">
      	<li><a href="transparencia_cpl_editar.php?contrato=<?php echo $rsPagina['CdCPL'];?>">Dados Iniciais</a></li>
      	<li><a href="transparencia_cpl_empresa.php?contrato=<?php echo $rsPagina['CdCPL'];?>">Empresa</a></li>
        <li class="active"><a href="javascript:void(0)">Recursos</a></li>
        <li><a href="transparencia_cpl_anexo.php?contrato=<?php echo $rsPagina['CdCPL'];?>">Anexos</a></li>
      </ul>

      <div class="table-responsive">
        <form id="formulario_clientes" name="formulario_clientes" class="validate" action="transparencia_cpl_recurso_adicionar.php" method="post">
        <input type="hidden" name="CdCPL" value="<?php echo $rsPagina['CdCPL'];?>">

        <div class=" col-sm-12 col-md-12">
          <label>Recurso</label>
          <div class="fancy-form fancy-form-select">
            <select class="form-control" id="recurso" name="recurso">
              <?php
              $sqlGlossario = mysql_query("SELECT * FROM cpl_recurso WHERE Acao <> 'Excluido' ORDER BY nome ASC");
              $Glossario = mysql_num_rows($sqlGlossario);

              for ($y = 0; $y < $Glossario; $y++){
                  $verGlossario = mysql_fetch_array($sqlGlossario);

                  ?>
              <option value="<?php echo $verGlossario['id']; ?>"><?php echo $verGlossario['nome']; ?></option>
              <?php
              }
              ?>
            </select>
          <i class="fancy-arrow"></i>
        </div>
      </div>

        <div class=" col-sm-12 col-md-3">
          <div class="fancy-form">
            <label>Descrição</label>
            <input id="descricao" name="descricao" class="form-control" type="text">
          </div>
        </div>

        <div class=" col-sm-12 col-md-12">
          <button type="submit" class="btn btn-3d btn-teal btn-block margin-top-30">
  				ADICIONAR EMPRESA
  			</button></div>

        </form>
        </div>
    </div>
    <div class="row discovery2">
      <div class="box-branco">
        <div class="col-sm-12 col-md-12">
          <table class="table table-bordered table-striped">
            <colgroup>
              <col class="col-xs-1">
              <col class="col-xs-2">
              <col class="col-xs-2">
              <col class="col-xs-7">

            </colgroup>
        		<thead>
        			<tr>
                <th></th>
        				<th>Nome</th>
        				<th>Descrição</th>
        			</tr>
        		</thead>
        		<tbody>
              <?php
              $sqlGlossario = mysql_query("SELECT * FROM vw_recursos WHERE CdCPL = '".$rsPagina['CdCPL']."' AND CdPrefeitura = '".$_SESSION['PrefeituraID']."' AND Acao <> 'Excluido' ORDER BY Nome ASC");
              $Glossario = mysql_num_rows($sqlGlossario);

              for ($y = 0; $y < $Glossario; $y++){
                  $verGlossario = mysql_fetch_array($sqlGlossario);

                  ?>
        			<tr>
        				<td><a class="btn btn-3d btn-reveal btn-red" href="transparencia_cpl_recurso_excluir.php?id=<?php echo $verGlossario['id']; ?>&CdCPL=<?php echo $verGlossario['CdCPL']; ?>">EXCLUIR</a></td>
                <td><?php echo $verGlossario['nome']; ?></td>
                <td><?php echo $verGlossario['Descricao']; ?></td>
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

</body>
</html>
