<footer id="footer" class="footer02" role="contentinfo">
  <div class="container">
    <div class="row">
      <div class="spaced col-md-4 col-sm-4">
        <p>
          <?php echo $rsConfig['Endereco'];?>
          <br>
          CEP: <?php echo $rsConfig['CEP'];?>
          <br>
          <?php echo $rsConfig['Email'];?>
          <br>
        </p>
        <p class="similar-h3"><?php echo $rsConfig['Telefone'];?></p>
        <p>
      <strong><?php echo $rsConfig['Dias'];?>:</strong>
      <?php echo $rsConfig['HorarioFuncionamento'];?>
      </p>
      </div>
      <div class="spaced col-md-8 col-sm-8"></div>
    </div>
  </div>

  <div class="copyright">
    <div class="container text-center fsize12">
      <a class="fsize11 img-empresa" target="_blank" href="http://www.minhaprefeitura.com.br" title="Minha Prefeitura">
        <img alt="Minha Prefeitura" src="imagens/mp.png">
        </a>
        Orgulhosamente desenvolvido em Roraima. 

    </div>
  </div>
</footer>
