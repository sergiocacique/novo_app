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

if (isset($_GET['protocolo'])) {
  $protocolo = $_GET['protocolo'];
  $sqlPagina = mysql_query("SELECT * FROM cpl WHERE Protocolo = '".$protocolo."'");
}else{
  $contrato = $_GET['contrato'];
  $sqlPagina = mysql_query("SELECT * FROM cpl WHERE CdCPL = '".$contrato."'");
}
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
      	<li class="active"><a href="javascript:void(0)">Dados Iniciais</a></li>
      	<li><a href="transparencia_cpl_empresa.php?contrato=<?php echo $rsPagina['CdCPL'];?>">Empresa</a></li>
        <li><a href="transparencia_cpl_recursos.php?contrato=<?php echo $rsPagina['CdCPL'];?>">Recursos</a></li>
        <li><a href="transparencia_cpl_anexo.php?contrato=<?php echo $rsPagina['CdCPL'];?>">Anexos</a></li>
      </ul>

      <div class="table-responsive">
        <form id="formulario_clientes" name="formulario_clientes" class="validate" action="transparencia_cpl_gravar.php" method="post">
            <input type="hidden" name="CdCPL" value="<?php echo $rsPagina['CdCPL'];?>">

          <div class=" col-sm-12 col-md-6">
            <label>Secretaria</label>
            <div class="fancy-form fancy-form-select">
              <select class="form-control" id="secretaria" name="secretaria">
                <?php
                $sqlGlossario = mysql_query("SELECT * FROM departamento WHERE CdPrefeitura = '".$_SESSION['PrefeituraID']."' AND Acao <> 'Excluido' ORDER BY NomeDepartamento ASC");
                $Glossario = mysql_num_rows($sqlGlossario);

                for ($y = 0; $y < $Glossario; $y++){
                    $verGlossario = mysql_fetch_array($sqlGlossario);

                    ?>
            		<option value="<?php echo $verGlossario['CdDepartamento']; ?>" <?php if ($verGlossario['CdDepartamento'] == $rsPagina['Orgao']){?>selected<?php }?>><?php echo $verGlossario['NomeDepartamento']; ?></option>
                <?php
                }
                ?>
            	</select>
            <i class="fancy-arrow"></i>
          </div>
        </div>

        <div class=" col-sm-12 col-md-3">
          <div class="fancy-form">
            <label>Número do Processo</label>
            <input id="processo" name="processo" class="form-control" type="text" placeholder="0001/2016" value="<?php echo $rsPagina['NumeroProcesso'];?>">
          </div>
        </div>

        <div class=" col-sm-12 col-md-3">
          <div class="fancy-form">
            <label>Valor do Contrato (R$)</label>
            <input data-mask="money" id="valor_contrato" name="valor_contrato" class="form-control" type="text" placeholder="0,00" value="<?php echo $rsPagina['valor_licitacao'];?>">
          </div>
        </div>

        <div class=" col-sm-12 col-md-12">
          <label>Situação</label>
          <div class="fancy-form fancy-form-select">
            <select class="form-control" id="situacao" name="situacao">
              <?php
              $sqlGlossario = mysql_query("SELECT * FROM cpl_situacao WHERE Acao <> 'Excluido' ORDER BY nome ASC");
              $Glossario = mysql_num_rows($sqlGlossario);

              for ($y = 0; $y < $Glossario; $y++){
                  $verGlossario = mysql_fetch_array($sqlGlossario);

                  ?>
              <option value="<?php echo $verGlossario['id']; ?>" <?php if ($verGlossario['id'] == $rsPagina['Orgao']){?>selected<?php }?>><?php echo $verGlossario['nome']; ?></option>
              <?php
              }
              ?>
            </select>
          <i class="fancy-arrow"></i>
        </div>
      </div>

      <div class="box-branco">
      <div class=" col-sm-12 col-md-6">
        <div class="fancy-form">
          <label>Data da Abertura</label>
          <input id="dtAbertura" name="dtAbertura" class="form-control" type="text" placeholder="00/00/0000" value="<?php echo date('d/m/Y', strtotime($rsPagina['DtAbertura']));?>">
        </div>
      </div>

      <div class=" col-sm-12 col-md-6">
        <div class="fancy-form">
          <label>Publicado em:</label>
          <input id="publicado" name="publicado" class="form-control" type="text" placeholder="DOM - Diário Oficial Municipal" value="<?php echo $rsPagina['Veiculo'];?>">
        </div>
      </div>

      <div class=" col-sm-12 col-md-6">
        <div class="fancy-form">
          <label>Data da Publicação</label>
          <input id="DtPublicacao" name="DtPublicacao" class="form-control" type="text" placeholder="00/00/0000" value="<?php echo date('d/m/Y', strtotime($rsPagina['DtPublicacao']));?>">
        </div>
      </div>

      <div class=" col-sm-12 col-md-6">
        <div class="fancy-form">
          <label>Número do DOC. de Publicação</label>
          <input id="numDoc" name="numDoc" class="form-control" type="text" placeholder="DOM - 0001" value="<?php echo $rsPagina['numeroDOM'];?>">
        </div>
      </div>
</div>

      <div class=" col-sm-12 col-md-4">
        <label>Finalidade</label>
        <div class="fancy-form fancy-form-select">
          <select class="form-control" id="finalidade" name="finalidade">
            <?php
            $sqlGlossario = mysql_query("SELECT * FROM cpl_finalidade WHERE Acao <> 'Excluido' ORDER BY nome ASC");
            $Glossario = mysql_num_rows($sqlGlossario);

            for ($y = 0; $y < $Glossario; $y++){
                $verGlossario = mysql_fetch_array($sqlGlossario);

                ?>
            <option value="<?php echo $verGlossario['id']; ?>" <?php if ($verGlossario['id'] == $rsPagina['Finalidade']){?>selected<?php }?>><?php echo $verGlossario['nome']; ?></option>
            <?php
            }
            ?>
          </select>
        <i class="fancy-arrow"></i>
      </div>
      </div>

      <div class=" col-sm-12 col-md-4">
        <label>Modalidade</label>
        <div class="fancy-form fancy-form-select">
          <select class="form-control" id="modalidade" name="modalidade">
            <?php
            $sqlGlossario = mysql_query("SELECT * FROM cpl_modalidade WHERE  Acao <> 'Excluido' ORDER BY nome ASC");
            $Glossario = mysql_num_rows($sqlGlossario);

            for ($y = 0; $y < $Glossario; $y++){
                $verGlossario = mysql_fetch_array($sqlGlossario);

                ?>
            <option value="<?php echo $verGlossario['id']; ?>" <?php if ($verGlossario['id'] == $rsPagina['Modalidade']){?>selected<?php }?>><?php echo $verGlossario['nome']; ?></option>
            <?php
            }
            ?>
          </select>
        <i class="fancy-arrow"></i>
      </div>
      </div>

      <div class=" col-sm-12 col-md-4">
        <label>Tipo</label>
        <div class="fancy-form fancy-form-select">
          <select class="form-control" id="tipo" name="tipo">
            <?php
            $sqlGlossario = mysql_query("SELECT * FROM cpl_tipo WHERE  Acao <> 'Excluido' ORDER BY nome ASC");
            $Glossario = mysql_num_rows($sqlGlossario);

            for ($y = 0; $y < $Glossario; $y++){
                $verGlossario = mysql_fetch_array($sqlGlossario);

                ?>
            <option value="<?php echo $verGlossario['id']; ?>" <?php if ($verGlossario['id'] == $rsPagina['Tipo']){?>selected<?php }?>><?php echo $verGlossario['nome']; ?></option>
            <?php
            }
            ?>
          </select>
        <i class="fancy-arrow"></i>
      </div>
      </div>

      <div class=" col-sm-12 col-md-12">
        <label>Objeto do Contrato</label>
        <textarea name="objeto" class="form-control" rows="5" id="objeto"><?php echo $rsPagina['Descricao'];?></textarea>
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
                <option value="<?php echo $verGlossario['NomeAcao']; ?>" <?php if ($rsPagina['Acao'] == $verGlossario['NomeAcao']){?>selected<?php }?>><?php echo $verGlossario['NomeAcao']; ?></option>
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
