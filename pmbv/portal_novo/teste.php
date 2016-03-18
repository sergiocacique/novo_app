<table width="100%" border="1" cellspacing="2" cellpadding="2">
<?php

include ("../conexao.php");
include('funcoes.php');

$arquivo = fopen('teste.csv','r');
$i = 0;

function moeda($get_valor) {
    $source = array('.', ',');
    $replace = array('', '.');
    $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
    return $valor; //retorna o valor formatado para gravar no banco
}

$data = date('Y/m/d');

while (!feof($arquivo))
{
    $linha = fgets($arquivo,1000);
    $dados = explode(';', $linha);

    if ($i > 0){


    ?>


    <tr>
        <td><?php echo $i?></td>
        <td>Nome<br> <?php echo $dados[0]?></td>
        <td>CPF<br> <?php echo $dados[1]?></td>
        <td>Orgao<br> <?php echo $dados[2]?></td>
        <td>Lotação<br> <?php echo $dados[3]?></td>
        <td>Cargo<br> <?php echo $dados[4]?></td>
        <td>Comissao<br> <?php echo $dados[5]?></td>
        <td>Salario<br> <?php echo moeda($dados[6]);?>  <?php //echo $dados[6]?></td>
        <td>IRRF<br> <?php echo $dados[7]?></td>
        <td>PSS<br> <?php echo $dados[8]?></td>
        <td>13<br> <?php echo $dados[9]?></td>
        <td>13 Prev<br> <?php echo $dados[10]?></td>
        <td>Ferias<br> <?php echo $dados[11]?></td>
    </tr>

<?php

        $query = mysql_query("INSERT INTO servidor (Nome, CPF, Orgao, Secretaria, Cargo, CargoComissao, RemuneracaoBasica, DecimoAnt, DecimoAntPrev, IRRS, PSS, DtCadastro, Disponivel, Aprovado, Lixo, DtDisponivel, Ferias)
        VALUES
                                                    ('$dados[0]', '$dados[1]', '$dados[2]', '$dados[3]',  '$dados[4]', '$dados[5]', '".moeda($dados[6])."', '".moeda($dados[9])."', '".moeda($dados[10])."', '".moeda($dados[7])."', '".moeda($dados[8])."', '$data' ,'sim', 'nao', 'nao', '$data', '".moeda($dados[11])."')") or die(mysql_error());
    }
    $i++;

}

fclose($arquivo);
?>
</table>