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

      String.prototype.formatMoney = function() {
            var v = this;

            if(v.indexOf('.') === -1) {
                v = v.replace(/([\d]+)/, "$1,00");
            }

            v = v.replace(/([\d]+)\.([\d]{1})$/, "$1,$20");
            v = v.replace(/([\d]+)\.([\d]{2})$/, "$1,$2");

            return v;
        };
        function id( el ){
            return document.getElementById( el );
        }
        function getMoney( el ){
            var money = id( el ).value.replace( ',', '.' );
            return money ;
        }

        function soma()
        {
    //        console.log('Diarias antes = '+$('#valor_diaria2').val())
            var Diarias = $('#valor_diaria2').val()

            Diarias = Diarias.replace('.', '')
            Diarias = Diarias.replace(',', '.')

    //        console.log('Diarias depois = '+Diarias)
            var Dias = $('#dias2').val()

            var total = Dias*Diarias;
            id('valor_bruto2').value = String(total).formatMoney();
            var valLiq = $('#valor_liquido2').val();
            valLiq = $('#valor_bruto2').val();
            id('valor_liquido2').value = String(valLiq)
            //console.log('Valor Liquido = '+String(total).formatMoney());

        }


        function subtrai()
        {
    //        console.log('Diarias antes = '+$('#valor_diaria2').val())
            var Liq = $('#valor_bruto2').val();
            var inss = $('#inss2').val();
            var irrf = $('#irrf2').val();

            console.log('Antes = '+Liq)

            Liq = Liq.replace('.', '')
            Liq = Liq.replace(',', '.')

            console.log('INSS Antes = '+inss)
            console.log('IRRF Antes = '+irrf)
            inss = inss.replace('.', '')
            inss = inss.replace(',', '.')

            irrf = irrf.replace('.', '')
            irrf = irrf.replace(',', '.')

            console.log('INSS Depois = '+inss)
            console.log('IRRF Depois = '+irrf)

            if(inss == ''){
                inss = 0;
            }

            if(irrf == ''){
                irrf = 0;
            }

            var total = parseFloat(inss)+parseFloat(irrf)
            console.log('Total = '+total)
            var total2 = Liq-total;
            console.log('Total2 = '+total2)

            console.log('Depois = '+Liq)

    //        id('valor_liquido2').value = total2.toFixed(2);
            id('valor_liquido2').value = String(total2.toFixed(2)).formatMoney();
        }





        function soma1()
        {
    //        console.log('Diarias antes = '+$('#valor_diaria2').val())
            var Diarias = $('#valor_diaria').val()

            Diarias = Diarias.replace('.', '')
            Diarias = Diarias.replace(',', '.')

    //        console.log('Diarias depois = '+Diarias)
            var Dias = $('#dias').val()

            var total = Dias*Diarias;
            id('valor_bruto').value = String(total).formatMoney();
            var valLiq = $('#valor_liquido').val();
            valLiq = $('#valor_bruto').val();
            id('valor_liquido').value = String(valLiq)
    //        console.log('Valor Liquido = '+valLiq);

        }


        function subtrai1()
        {
    //        console.log('Diarias antes = '+$('#valor_diaria2').val())
            var Liq = $('#valor_bruto').val();
            var inss = $('#inss').val();
            var irrf = $('#irrf').val();

            console.log('Antes = '+Liq)

            Liq = Liq.replace('.', '')
            Liq = Liq.replace(',', '.')

            console.log('INSS Antes = '+inss)
            console.log('IRRF Antes = '+irrf)
            inss = inss.replace('.', '')
            inss = inss.replace(',', '.')

            irrf = irrf.replace('.', '')
            irrf = irrf.replace(',', '.')

            console.log('INSS Depois = '+inss)
            console.log('IRRF Depois = '+irrf)

            if(inss == ''){
                inss = 0;
            }

            if(irrf == ''){
                irrf = 0;
            }

            var total = parseFloat(inss)+parseFloat(irrf)
            console.log('Total = '+total)
            var total3 = Liq-total;
            console.log('Total = '+total3)

            console.log('Depois = '+Liq)

    //        id('valor_liquido2').value = total2.toFixed(2);
            id('valor_liquido').value = String(total3.toFixed(2)).formatMoney();
        }

        function maskIt(w,e,m,r,a){
    // Cancela se o evento for Backspace
            if (!e) var e = window.event;
            if (e.keyCode) code = e.keyCode;
            else if (e.which) code = e.which;
    // Variáveis da função
            var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
            var mask = (!r) ? m : m.reverse();
            var pre  = (a ) ? a.pre : "";
            var pos  = (a ) ? a.pos : "";
            var ret  = "";
            if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;
    // Loop na máscara para aplicar os caracteres
            for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
                if(mask.charAt(x)!='#'){
                    ret += mask.charAt(x); x++; }
                else {
                    ret += txt.charAt(y); y++; x++; } }
    // Retorno da função
            ret = (!r) ? ret : ret.reverse()
            w.value = pre+ret+pos; }
        // Novo método para o objeto 'String'
        String.prototype.reverse = function(){
            return this.split('').reverse().join(''); };
        function number_format( number, decimals, dec_point, thousands_sep ) {
            var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
            var d = dec_point == undefined ? "," : dec_point;
            var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
            var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
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
<?php include ("menu_transparencia.php");?>
<?php include ("topo.php");?>

<div id="conteudo" class="container">
  <div class="row discovery">
      <div class="col-sm-9 col-md-10">
        <div class="header">
            <h1>Adicionar Nova Diária</h1>
        </div>
      </div>
  </div>
    <div class="row discovery2">
      <div class="table-responsive">
        <form id="formulario_clientes" name="formulario_clientes" class="validate" action="transparencia_diaria_adicionar.php" method="post">

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
          <label>Destino</label>
          <input id="Destino" name="Destino" class="form-control" type="text" placeholder="Digite o Destino Completo">
        </div>
      </div>

          <div class=" col-sm-12 col-md-6">
            <div class="fancy-form">
              <label>Nome Completo</label>
              <input id="Nome" name="Nome" class="form-control" type="text" placeholder="Digite o Nome Completo">
            </div>
          </div>

          <div class=" col-sm-12 col-md-6">
            <div class="fancy-form">
              <label>Cargo</label>
              <input id="Cargo" name="Cargo" class="form-control" type="text" placeholder="Digite o Cargo Completo">
            </div>
          </div>

          <div class=" col-sm-12 col-md-12">
            <label>Objetivo da Viagem</label>
            <textarea name="objetivo" class="form-control" rows="5" id="objetivo"></textarea>
          </div>

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
            		<option value="<?php echo $verGlossario['NomeDepartamento']; ?>"><?php echo $verGlossario['NomeDepartamento']; ?></option>
                <?php
                }
                ?>
            	</select>
            <i class="fancy-arrow"></i>
          </div>
        </div>



          <div class=" col-sm-12 col-md-6">
            <div class="fancy-form">
              <label>Periodo</label>
              <input id="Periodo" name="Periodo" class="form-control" type="text" placeholder="Digite o Destino Completo">
            </div>
          </div>



          <div class="box-branco">

            <div class=" col-sm-12 col-md-2">
              <div class="fancy-form">
                <label>Dias</label>
                <input class="form-control" id="dias" name="dias" placeholder="Dias">
              </div>
            </div>

            <div class=" col-sm-12 col-md-5">
              <div class="fancy-form">
                <label>Valor da Diária (R$)</label>
<input type="tel" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" class="form-control" id="valor_diaria" name="valor_diaria" placeholder="0,00" onkeyup="maskIt(this,event,'###.###.###,##',true), soma1()">              </div>
            </div>

            <div class=" col-sm-12 col-md-5">
              <div class="fancy-form">
                <label>Valor Bruto (R$)</label>
                <input data-mask="money" class="form-control" id="valor_bruto" name="valor_bruto" placeholder="0,00">
              </div>
            </div>

            <div class=" col-sm-12 col-md-4">
              <div class="fancy-form">
                <label>Valor INSS (R$)</label>
                <input type="tel" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" class="form-control" id="inss" name="inss" placeholder="0,00" onkeyup="maskIt(this,event,'###.###.###,##',true), subtrai1()">
              </div>
            </div>

            <div class=" col-sm-12 col-md-4">
              <div class="fancy-form">
                <label>Valor IRRF (R$)</label>
                <input type="tel" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" data-mask="money" class="form-control" id="irrf" name="irrf" placeholder="0,00" onkeyup="maskIt(this,event,'###.###.###,##',true), subtrai1()">
              </div>
            </div>

            <div class=" col-sm-12 col-md-4">
              <div class="fancy-form">
                <label>Valor Liquido (R$)</label>
                <input data-mask="money" class="form-control" id="valor_liquido" name="valor_liquido" placeholder="0,00">
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
