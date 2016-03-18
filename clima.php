<?php
        function tempo($climatempo){
            //abre arquivo
            $arquivo = file_get_contents("http://selos.climatempo.com.br/selos/selo.php?CODCIDADE=".$climatempo);
            // tira parte da formatação pra facilitar
           $arquivo = str_replace('<','',$arquivo);
           $arquivo = str_replace('>','',$arquivo);
           $arquivo = str_replace('"','',$arquivo);
            //separa arquivo em partes
           $data = explode("data=",$arquivo);
           $nome = explode("nome=",$arquivo);
           $min = explode("low=",$arquivo);
           $max = explode("high=",$arquivo);
           $prob = explode("prob=",$arquivo);
           $chuva = explode("mm=",$arquivo);
           $img = explode("ico=",$arquivo);
           $ico = explode("ico=",$arquivo);
          //exibe temperaturas do primeiro dia
          $nome_d1 = substr($nome[1],5,10);

          $data_d1 = substr($data[1],5,5);
          $min_d1 = substr($min[1],0,2);
          $max_d1 = substr($max[1],0,2);
          $prob_d1 = substr($prob[1],0,2);
          $chuva_d1 = substr($chuva[1],0,2);
          $ico_d1 = substr($ico[1],0,1);
          // aqui substitui a sigla da semana pela semana
          $data_d1 = str_replace('Dom','Domingo',$data_d1);
          $data_d1 = str_replace('Seg','Segunda',$data_d1);
          $data_d1 = str_replace('Ter','Terça',$data_d1);
          $data_d1 = str_replace('Qua','Quarta',$data_d1);
          $data_d1 = str_replace('Qui','Quinta',$data_d1);
          $data_d1 = str_replace('---','Sexta',$data_d1);
          $data_d1 = str_replace('Sáb','Sábado',$data_d1);

          //exibe temperaturas do segundo dia
          $data_d2 = substr($data[2],5,5);
          $min_d2 = substr($min[2],0,2);
          $max_d2 = substr($max[2],0,2);
          $prob_d2 = substr($prob[2],0,2);
          $chuva_d2 = substr($chuva[2],0,2);
          $ico_d2 = substr($ico[2],0,1);
          $data_d2 = str_replace('Dom','Domingo',$data_d2);
          $data_d2 = str_replace('Seg','Segunda',$data_d2);
          $data_d2 = str_replace('Ter','Terça',$data_d2);
          $data_d2 = str_replace('Qua','Quarta',$data_d2);
          $data_d2 = str_replace('Qui','Quinta',$data_d2);
          $data_d2 = str_replace('---','Sexta',$data_d2);
          $data_d2 = str_replace('Sáb','Sábado',$data_d2);

          $data_d3 = substr($data[3],5,5);
          $data_d3 = str_replace('Dom','Domingo',$data_d3);
          $data_d3 = str_replace('Seg','Segunda',$data_d3);
          $data_d3 = str_replace('Ter','Terça',$data_d3);
          $data_d3 = str_replace('Qua','Quarta',$data_d3);
          $data_d3 = str_replace('Qui','Quinta',$data_d3);
          $data_d3 = str_replace('---','Sexta',$data_d3);
          $data_d3 = str_replace('Sáb','Sábado',$data_d3);
          $min_d3 = substr($min[3],0,2);
          $max_d3 = substr($max[3],0,2);
          $prob_d3 = substr($prob[3],0,2);
          $chuva_d3 = substr($chuva[3],0,2);
          $ico_d3 = substr($ico[3],0,1);
          // o selo pode exibir previsão do tempo para quatro dias, no meu caso só precisei de três
          echo "<table><tr>";

          echo "<td width='1'><img src='images/spacer_azul.gif' width='1' height='128'></td><td width='172' style='background:url(tempo/ico$ico_d1.gif) no-repeat center;'>";
          echo "<span>$nome_d1<br /></span>";
          echo "<span class='textomaior'>$data_d1</span><br>";
          echo "<span class='max'>Máx: $max_d1 &deg;C</span><BR>";
          echo "<span class='min'>Mín: $min_d1 &deg;C</span><BR>";
          echo "Probabilidade: $prob_d1%<BR>$chuva_d1 mm";

          echo "<td width='1'><img src='images/spacer_azul.gif' width='1' height='128'></td><td width='172' style='background:url(tempo/ico$ico_d2.gif) no-repeat center;'>";
          echo "<span class='textomaior'>$data_d2</span><br>";
          echo "<span class='max'>Máx: $max_d2 &deg;C</span><BR>";
          echo "<span class='min'>Mín: $min_d2 &deg;C</span><BR>";
          echo "Probabilidade: $prob_d2%<BR>$chuva_d2 mm";

          echo "<td width='1'><img src='images/spacer_azul.gif' width='1' height='128'></td><td width='172' style='background:url(tempo/ico$ico_d3.gif) no-repeat center;'>";
          echo "<span class='textomaior'>$data_d3</span><br>";
          echo "<span class='max'>Máx: $max_d3 &deg;C</span><BR>";
          echo "<span class='min'>Mín: $min_d3 &deg;C</span><BR>";
          echo "Probabilidade: $prob_d3%<BR>$chuva_d3 mm";
          echo "<td width='1'><img src='images/spacer_azul.gif' width='1' height='128'></td>";

          echo "</tr></table>";
        }
        $climatempo = tempo("347"); //código da cidade, no meu caso Matelândia-PR, mas você pode entrar no site do climatempo e ver o cód da sua cidade
       ?>
