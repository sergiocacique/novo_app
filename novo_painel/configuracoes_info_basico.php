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

    jQuery(function($){
        // JQUERY MASK INPUT
        $('[data-mask="date"]').mask('00/00/0000');
        $('[data-mask="time"]').mask('00:00:00');
        $('[data-mask="date_time"]').mask('00/00/0000 00:00:00');
        $('[data-mask="zip"]').mask('00000-000');
        $('[data-mask="money"]').mask('000.000.000.000.000,00', {reverse: true});
        $('[data-mask="phone"]').mask('0000-0000');
        $('[data-mask="phone_with_ddd"]').mask('(00) 0000-0000');
        $('[data-mask="phone_us"]').mask('(000) 000-0000');
        $('[data-mask="cpf"]').mask('000.000.000-00', {reverse: true});
        $('[data-mask="cnpj"]').mask('00.000.000/0000-00', {reverse: true});
        $('[data-mask="ip_address"]').mask('099.099.099.099');
        $('[data-mask="percent"]').mask('##0,00%', {reverse: true});
        // END JQUERY MASK INPUT
    });

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

        function listaChamado(acao){
            start();
            $('#loading2').css('visibility','visible');
            $.post("inicio_chamado.php", { acao: acao },
                function(data){
                    $('#conteudo').html(data);
                    $('html, body').animate({scrollTop:0}, 'slow');
                }).done(function() {
                    $('#loading2').css('visibility','hidden');
                });
        }
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
<?php include ("menu_configuracao.php");?>
<?php include ("topo.php");?>

<?php
$sqlPagina = mysql_query("SELECT * FROM prefeitura_config WHERE CdPrefeitura = '".$_SESSION['PrefeituraID']."'");
$rsPagina = mysql_fetch_array($sqlPagina);
 ?>
<div id="conteudo" class="container">
  <div class="row discovery">
      <div class="col-sm-9 col-md-10">
        <div class="header">
            <h1>Informações Básicas</h1>
        </div>
      </div>
  </div>

    <div class="row discovery2">
      <div class="table-responsive">
        <form class="validate" action="configuracao_info_basica_gravar.php" method="post">

          <div class=" col-sm-12 col-md-5">
            <div class="fancy-form">
              <label>Endereço</label>
              <input id="endereco" name="endereco" class="form-control" type="text" value="<?php echo $rsPagina['Endereco'];?>">
            </div>
          </div>

          <div class=" col-sm-12 col-md-5">
            <div class="fancy-form">
              <label>Bairro</label>
              <input id="bairro" name="bairro" class="form-control" type="text" value="<?php echo $rsPagina['Bairro'];?>">
            </div>
          </div>


          <div class=" col-sm-12 col-md-4">
            <div class="fancy-form">
              <label>Cidade</label>
              <input id="cidade" name="cidade" class="form-control" type="text" value="<?php echo $rsPagina['Cidade'];?>">
            </div>
          </div>


          <div class=" col-sm-12 col-md-3">
            <label>Estado</label>
            <div class="fancy-form fancy-form-select">
            <select class="form-control" id="estado" name="estado">
              <option value="AC" <?php if ($rsPagina['Estado'] == "AC"){?>selected<?php }?>>Acre</option>
              <option value="AL" <?php if ($rsPagina['Estado'] == "AL"){?>selected<?php }?>>Alagoas</option>
              <option value="AP" <?php if ($rsPagina['Estado'] == "AP"){?>selected<?php }?>>Amapá</option>
              <option value="AM" <?php if ($rsPagina['Estado'] == "AM"){?>selected<?php }?>>Amazonas</option>
              <option value="BA" <?php if ($rsPagina['Estado'] == "BA"){?>selected<?php }?>>Bahia</option>
              <option value="CE" <?php if ($rsPagina['Estado'] == "CE"){?>selected<?php }?>>Ceará</option>
              <option value="DF" <?php if ($rsPagina['Estado'] == "DF"){?>selected<?php }?>>Distrito Federal</option>
              <option value="ES" <?php if ($rsPagina['Estado'] == "ES"){?>selected<?php }?>>Espírito Santo</option>
              <option value="GO" <?php if ($rsPagina['Estado'] == "GO"){?>selected<?php }?>>Goiás</option>
              <option value="MA" <?php if ($rsPagina['Estado'] == "MA"){?>selected<?php }?>>Maranhão</option>
              <option value="MT" <?php if ($rsPagina['Estado'] == "MT"){?>selected<?php }?>>Mato Grosso</option>
              <option value="MS" <?php if ($rsPagina['Estado'] == "MS"){?>selected<?php }?>>Mato Grosso do Sul</option>
              <option value="MG" <?php if ($rsPagina['Estado'] == "MG"){?>selected<?php }?>>Minas Gerais</option>
              <option value="PA" <?php if ($rsPagina['Estado'] == "PA"){?>selected<?php }?>>Pará</option>
              <option value="PB" <?php if ($rsPagina['Estado'] == "PB"){?>selected<?php }?>>Paraíba</option>
              <option value="PR" <?php if ($rsPagina['Estado'] == "PR"){?>selected<?php }?>>Paraná</option>
              <option value="PE" <?php if ($rsPagina['Estado'] == "PE"){?>selected<?php }?>>Pernanbuco</option>
              <option value="PI" <?php if ($rsPagina['Estado'] == "PI"){?>selected<?php }?>>Piauí</option>
              <option value="RJ" <?php if ($rsPagina['Estado'] == "RJ"){?>selected<?php }?>>Rio de Janeiro</option>
              <option value="RN" <?php if ($rsPagina['Estado'] == "RN"){?>selected<?php }?>>Rio Grande do Norte</option>
              <option value="RS" <?php if ($rsPagina['Estado'] == "RS"){?>selected<?php }?>>Rio Grande do Sul</option>
              <option value="RO" <?php if ($rsPagina['Estado'] == "RO"){?>selected<?php }?>>Rondônia</option>
              <option value="RR" <?php if ($rsPagina['Estado'] == "RR"){?>selected<?php }?>>Roraima</option>
              <option value="SC" <?php if ($rsPagina['Estado'] == "SC"){?>selected<?php }?>>Santa Catarina</option>
              <option value="SP" <?php if ($rsPagina['Estado'] == "SP"){?>selected<?php }?>>São Paulo</option>
              <option value="SE" <?php if ($rsPagina['Estado'] == "SE"){?>selected<?php }?>>Sergipe</option>
              <option value="TO" <?php if ($rsPagina['Estado'] == "TO"){?>selected<?php }?>>Tocantins</option>
            </select>
            <i class="fancy-arrow"></i>
          </div>
        </div>

          <div class=" col-sm-12 col-md-3">
            <div class="fancy-form">
              <label>CEP</label>
              <input data-mask="zip" id="CEP" name="CEP" class="form-control" type="text" value="<?php echo $rsPagina['CEP'];?>">
            </div>
          </div>

          <div class=" col-sm-12 col-md-9">
            <div class="fancy-form">
              <label>Razão Social</label>
              <input id="RazaoSocial" name="RazaoSocial" class="form-control" type="text" value="<?php echo $rsPagina['RazaoSocial'];?>">
            </div>
          </div>

          <div class=" col-sm-12 col-md-9">
            <div class="fancy-form">
              <label>CNPJ</label>
              <input data-mask="cnpj" id="CNPJ" name="CNPJ" class="form-control" type="text" value="<?php echo $rsPagina['CNPJ'];?>">
            </div>
          </div>

          <div class=" col-sm-12 col-md-9">
            <div class="fancy-form">
              <label>Telefone</label>
              <input id="Telefone" name="Telefone" class="form-control" type="text" value="<?php echo $rsPagina['Telefone'];?>">
            </div>
          </div>

          <div class=" col-sm-12 col-md-9">
            <div class="fancy-form">
              <label>E-mail</label>
              <input id="email" name="email" class="form-control" type="text" value="<?php echo $rsPagina['Email'];?>">
            </div>
          </div>

          <div class=" col-sm-12 col-md-4">
            <div class="fancy-form">
              <label>Dias Abertos</label>
              <input id="Dias" name="Dias" class="form-control" type="text" value="<?php echo $rsPagina['Dias'];?>">
            </div>
          </div>

          <div class=" col-sm-12 col-md-5">
            <div class="fancy-form">
              <label>Horário de Funcionamento</label>
              <input id="HorarioFuncionamento" name="HorarioFuncionamento" class="form-control" type="text" value="<?php echo $rsPagina['HorarioFuncionamento'];?>">
            </div>
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
