
<?php
$sqlPrefeitura = mysql_query("SELECT * FROM vw_prefeitura WHERE CdPrefeitura = ".$_SESSION['PrefeituraID']." ");
$verPrefeitura = mysql_fetch_array($sqlPrefeitura);

$sqlPerfil2 = mysql_query("SELECT * FROM vw_admin WHERE CdUsuario = ".$_SESSION['UsuarioID']." ");
$verPerfil2 = mysql_fetch_array($sqlPerfil2);
?>
<nav class="main-menu">
    <a class="<?php echo $verPrefeitura['Pasta'];?>" href="/admin"><?php echo $verPrefeitura['Fantasia'];?></a>

    <ul>
        <li>
            <a href="index.php">
                <i class="fa fa-tachometer fa-2x"></i>
                        <span class="nav-text">
                            Dashboard
                        </span>
            </a>

        </li>
        <?php
        if($verPerfil2['NomePerfil'] == "Desenvolvedor"){
        ?>
        <li>
            <a href="prefeitura.php">
                <i class="fa fa-th fa-2x"></i>
                        <span class="nav-text">
                            Prefeituras
                        </span>
            </a>

        </li>
        <?php
      }
        ?>

        <?php if($verPerfil2['Capa'] == "sim"){ ?>
        <li class="has-subnav">
            <a href="capa.php">
                <i class="fa fa-laptop fa-2x"></i>
                        <span class="nav-text">
                            Capa
                        </span>
            </a>

      <?php
        }
        if($verPerfil2['Municipio'] == "sim"){
      ?>
        </li>
        <li class="has-subnav">
            <a href="o_municipio.php">
                <i class="fa fa-list fa-2x"></i>
                        <span class="nav-text">
                            O Município
                        </span>
            </a>

        </li>
        <?php
          }
          if($verPerfil2['Departamento'] == "sim"){
        ?>
        <li class="has-subnav">
            <a href="departamentos.php">
                <i class="fa fa-folder-open fa-2x"></i>
                        <span class="nav-text">
                            Departamentos
                        </span>
            </a>

        </li>
        <?php
          }
          if($verPerfil2['Informativo'] == "sim"){
        ?>
        <li>
            <a href="informativos.php">
                <i class="fa fa-tags fa-2x"></i>
                        <span class="nav-text">
                            Informativos
                        </span>
            </a>
        </li>
        <?php
          }
          if($verPerfil2['Publicacoes'] == "sim"){
        ?>
        <li>
            <a href="publicacoes_oficiais.php">
                <i class="fa fa-font fa-2x"></i>
                        <span class="nav-text">
                            Publicações Oficiais
                        </span>
            </a>
        </li>
        <?php
          }
          if($verPerfil2['Transparencia'] == "sim"){
        ?>
        <li>
            <a href="transparencia.php">
                <i class="fa fa-bar-chart-o fa-2x"></i>
                        <span class="nav-text">
                            Transparência
                        </span>
            </a>
        </li>
        <?php
          }
          if($verPerfil2['ContraCheque'] == "sim"){
        ?>
        <li>
            <a href="contra-cheque.php">
                <i class="fa fa-dollar fa-2x"></i>
                        <span class="nav-text">
                            Contra-cheque
                        </span>
            </a>
        </li>
        <?php
          }
          if($verPerfil2['AcessoInfor'] == "sim"){
        ?>
        <li>
            <a href="acesso_informacao.php">
                <i class="fa fa-exclamation fa-2x"></i>
                        <span class="nav-text">
                            Acesso á Informação
                        </span>
            </a>
        </li>
        <?php
      }
        if($verPerfil2['NomePerfil'] == "Desenvolvedor" OR $verPerfil2['NomePerfil'] == "Administrador"){
        ?>
        <li>
            <a href="configuracao.php">
                <i class="fa fa-cog fa-2x"></i>
                        <span class="nav-text">
                            Configurações
                        </span>
            </a>
        </li>
        <?php
      }
        ?>
    </ul>

    <ul class="logout">
        <li>
            <a href="sair.php">
                <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text">
                            Sair
                        </span>
            </a>
        </li>
    </ul>
</nav>
