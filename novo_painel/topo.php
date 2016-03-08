<?php
$sqlAdmin = mysql_query("SELECT * FROM admin WHERE CdUsuario = ".$_SESSION['UsuarioID']." ");
$verAdmin = mysql_fetch_array($sqlAdmin);

$sqlPermissao = mysql_query("SELECT * FROM adm_permissao WHERE CdUsuario = ".$_SESSION['UsuarioID']." ");
$verPermissao = mysql_fetch_array($sqlPermissao);

$sqlPerfil = mysql_query("SELECT * FROM adm_perfil WHERE id = ".$verAdmin['Perfil']." ");
$verPerfil = mysql_fetch_array($sqlPerfil);
?>
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-sm-offset-1">
                <div class="see-frontstore">
                    <a href="http://area-vip.minestore.com.br/" target="blank">ver portal da transparência</a>
                </div>
                <a href=""></a>
            </div>
            <div class="col-sm-3 pull-right">
                <div class="profile-nav">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <img class="profile-avatar" src="https://www.gravatar.com/avatar/0b8db6c8e66f3505c0f6e7ddd99fcc71?d=mm">
                        <h6><?php echo $verAdmin['Nome'];?></h6>
                        <small><?php echo $verPerfil['Nome_perfil'];?></small>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>