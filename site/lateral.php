<div class="side-nav">
    <div class="side-nav-head">
        <h4>ACESSO RÁPIDO</h4>
    </div>
    <ul class="list-group list-unstyled">
        <?php
        $sqlAcesso = mysql_query("SELECT *  FROM site_acesso_rapido WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado'  ORDER BY Posicao ASC") or die(mysql_error());
        $contaAcesso = mysql_num_rows($sqlAcesso);

        for ($a = 0; $a < $contaAcesso; $a++){
        $Acessos = mysql_fetch_array($sqlAcesso);
        ?>
        <li class="list-group-item AcessoRapido">
            <a href="<?php echo $Acessos['Link'];?>"><?php echo $Acessos['Nome'];?></a>
        </li>
        <?php }?>
    </ul>
</div>

<div class="side-nav">


    <div id="owl-gabinete">
      <?php
      $sqlGlossario = mysql_query("SELECT * FROM gabinete WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' ORDER BY Tipo ASC");
      $Glossario = mysql_num_rows($sqlGlossario);

      for ($y = 0; $y < $Glossario; $y++){
          $verGlossario = mysql_fetch_array($sqlGlossario);

          ?>
        <div class="item"><img src="https://www.minhaprefeitura.com.br/arquivosDinamicos/municipio/<?php echo $rsPrefeitura['Pasta'];?>/departamento/<?php echo $verGlossario['Imagem']?>" alt="<?php echo $verGlossario['Nome']; ?>"></div>
        <?php
        }
        ?>

    </div>


</div>

<div class="side-nav">
    <div class="side-nav-head">
        <h4>SECRETARIAS</h4>
    </div>

    <ul class="list-group list-unstyled">
        <?php
        $sqlGlossario = mysql_query("SELECT * FROM departamento WHERE CdPrefeitura = '".$rsPrefeitura['CdPrefeitura']."' AND Acao = 'Publicado' ORDER BY Rand() Limit 3");
        $Glossario = mysql_num_rows($sqlGlossario);

        for ($y = 0; $y < $Glossario; $y++){
            $verGlossario = mysql_fetch_array($sqlGlossario);
            ?>
            <li>
                <div class="row">
                    <div class="col-md-12">
                            <strong><?php echo $verGlossario['NomeDepartamento'];?></strong>
                        <p class="mb0">
                            <strong>Resp:</strong>
                            <?php echo $verGlossario['NomeSecretario'];?>
                            <br>
                            <strong>Fone:</strong>
                            <?php echo $verGlossario['Telefones'];?>
                        </p>
                    </div>
                </div>
                <hr class="hr-secretarias">
            </li>
        <?php
        }
        ?>

    </ul>
    <a class="btn btn-default pull-right btn-sm" href="<?php echo $UrlAmigavel;?>secretarias" title="Mais Secretarias">Mais Secretarias</a>
</div>
