<?php 
use Config\BancoDeDados;//require_once("conexao.php");
@session_start();
use App\Model\Carrinho;
use App\Model\Loja;
$database = new BancoDeDados();
$db = $database->Conexao();
$carrinho = new Carrinho($db);
$loja = new Loja();
$url = $_GET['url'] ?? 'home/index';
list($controller, $action) = explode('/', $url);
$actionName = $action;

if($actionName == 'index'){
    $actionName = 'Home';
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Brechó online | Moda Vintage & Atemporal🍂
Para você que preza por inclusão, diversidade e autenticidade brecho online">
    <meta name="keywords" content="Brechó, encontrei lá brecho, encontrei la, moda atemporal, cuiabá MT, encontrei!, juliana, de, souza, silva">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $loja->nome ?> - <?= @$actionName ?></title>

    <!-- Css Styles -->
    <link rel="shortcut icon" href="../src/iconesELogos/favicon.ico">
    <link rel="stylesheet" href="../src/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../src/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../src/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../src/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../src/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../src/css/style.css" type="text/css">
    <link href="../src/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../src/css/style.css" rel="stylesheet">
    <link href="../src/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
    <script src="../src/vendor/jquery/jquery.min.js"></script>
    <script src="../src /vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
