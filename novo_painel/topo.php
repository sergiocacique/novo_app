<?php
$sqlAdmin = mysql_query("SELECT * FROM vw_prefeitura WHERE CdPrefeitura = ".$_SESSION['PrefeituraID']." ");
$verAdmin = mysql_fetch_array($sqlAdmin);

$sqlPerfil = mysql_query("SELECT * FROM vw_admin WHERE CdUsuario = ".$_SESSION['UsuarioID']." ");
$verPerfil = mysql_fetch_array($sqlPerfil);
?>
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-sm-offset-1">
                <div class="see-frontstore">
                    <a href="http://www.<?php echo $verAdmin['Dominio'];?>/" target="blank"><?php echo $verAdmin['Titulo'];?></a>
                </div>
                <a href=""></a>
            </div>
            <div class="col-sm-3 pull-right">
                <div class="profile-nav">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="meusdados.php">
                        <img class="profile-avatar" src="https://www.gravatar.com/avatar/0b8db6c8e66f3505c0f6e7ddd99fcc71?d=mm">
                        <h6><?php echo $verPerfil['Nome'];?></h6>
                        <small><?php echo $verPerfil['NomePerfil'];?></small>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
