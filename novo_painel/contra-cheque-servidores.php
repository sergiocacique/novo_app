<?php
/**
 * Created by PhpStorm.
 * User: elidiane
 * Date: 24/11/14
 * Time: 09:34
 */
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
</head>
<body class="orders index">
<?php include ("menu.php");?>
<?php include ("topo.php");?>
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="header-title">
                            Configurações
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-1">
                <ul class="nav nav-pills">
                    <li><a href="contra-cheque.php">Geral</a></li>
                    <li><a href="contra-cheque-arquivo.php">Contra-Cheque</a></li>
                    <li class="active"><a href="contra-cheque-servidores.php">Servidores</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-1">
            <table class="table table-bordered table-striped">
                <colgroup>
                    <col class="col-xs-1">
                    <col class="col-xs-7">
                </colgroup>
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a class="btn btn-3d btn-red" href="#">
                                <i class="et-megaphone"></i>
                                Red
                            </a>
                            <a class="btn btn-3d btn-red" href="#">
                                <i class="et-megaphone"></i>
                                Red
                            </a>
                        </td>
                        <td>Indicates a info</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container"></div>
</body>
</html>