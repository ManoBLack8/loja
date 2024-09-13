<?php 
use Config\BancoDeDados;
@session_start();
use App\Model\Carrinho;
use App\Model\Loja;

// Inicialização de objetos
$database = new BancoDeDados();
$db = $database->Conexao();
$carrinho = new Carrinho($db);
$loja = new Loja();

// Tratamento da URL para definir o controlador e a ação
$url = $_SERVER['REQUEST_URI'] == '/' ? '/home/index' : $_SERVER['REQUEST_URI'];

// Remove a query string da URL (ex: ?id=1) para processar apenas o caminho
$urlParts = parse_url($url);
list($controller, $action) = explode('/', $urlParts["path"]);
$actionName = ($action === 'index') ? 'Home' : ucfirst($action);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Brechó online | Moda Vintage e Atemporal 🍂 Para quem busca inclusão, diversidade e autenticidade. Explore peças únicas e sustentáveis.">

    <!-- Meta Keywords (atualizado para SEO moderno) -->
    <meta name="keywords" content="brechó online, moda vintage, moda atemporal, moda sustentável, inclusão, diversidade, cuiabá MT, peças exclusivas">
    
    <!-- SEO Social Meta Tags -->
    <!-- Open Graph for Facebook -->
    <meta property="og:title" content="<?= htmlspecialchars($loja->nome) ?> - <?= htmlspecialchars($actionName) ?>">
    <meta property="og:description" content="Brechó online de moda vintage e atemporal, com foco em inclusão e autenticidade. Confira nossa seleção exclusiva de roupas sustentáveis.">
    <meta property="og:image" content="URL_da_imagem_da_loja">
    <meta property="og:url" content="<?= "https://www.seusite.com/$url" ?>">
    <meta property="og:type" content="website">

    <!-- Twitter Card for better visibility on Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($loja->nome) ?> - <?= htmlspecialchars($actionName) ?>">
    <meta name="twitter:description" content="Moda vintage e sustentável. Explore nosso brechó online e encontre peças únicas e atemporais.">
    <meta name="twitter:image" content="URL_da_imagem_da_loja">
    
    <!-- Canonical URL (para evitar duplicação de conteúdo) -->
    <link rel="canonical" href="<?= "https://www.seusite.com/$url" ?>">
    
    <!-- Robots (controle de indexação) -->
    <meta name="robots" content="index, follow">

    <!-- Favicon & Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="../src/iconesELogos/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="../src/iconesELogos/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../src/iconesELogos/favicon.ico">
    <link rel="manifest" href="../src/iconesELogos/site.webmanifest">
    <link rel="mask-icon" href="../src/iconesELogos/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">

    <!-- Title -->
    <title><?= htmlspecialchars($loja->nome) ?> - <?= htmlspecialchars($actionName) ?></title>

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../src/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../src/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../src/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../src/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../src/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../src/css/sb-admin-2.min.css" type="text/css">
    <link rel="stylesheet" href="../src/vendor/datatables/dataTables.bootstrap4.min.css" type="text/css">
    <link rel="stylesheet" href="../src/css/style.css" type="text/css">
</head>