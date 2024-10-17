<?php
require '../vendor/autoload.php';
if(isset($_GET["debug"])){
    session_start();
    echo "Sessão<br>";
    var_dump($_SESSION);
    echo "<br>POST<br>";
    var_dump($_POST);
}
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();
use App\Controllers\HomeController;

// Roteamento básico (simples demais para produção)
$url = $_SERVER['REQUEST_URI'] == '/' ? '/home/index' : $_SERVER['REQUEST_URI'];

// Remove a query string da URL (ex: ?id=1) para processar apenas o caminho
$urlParts = parse_url($url);
$urlPath = $urlParts['path'];

// Remove a barra inicial e divide a URL em partes
$urlSegments = explode('/', ltrim($urlPath, '/'));

// Defina o controlador e a ação, e capture o nome do produto se ele estiver presente
$controller = $urlSegments[0] ?? 'home';
$action = $urlSegments[1] ?? 'index';
$produtoNome = isset($urlSegments[2]) ? urldecode($urlSegments[2]) : null;  // Decodifica o nome do produto na URL

// Construa os nomes do controlador e do método
$controllerName = ucfirst($controller) . 'Controller';
$actionName = $action;

// Verifique se o controlador existe
$controllerClass = "App\\Controllers\\$controllerName";
if (class_exists($controllerClass)) {
    $controllerInstance = new $controllerClass();

    // Verifique se o método existe no controlador
    if (method_exists($controllerInstance, $actionName)) {
        // Chame o método com o nome do produto (se houver)
        if ($produtoNome) {
            $controllerInstance->$actionName($produtoNome);
        } else {
            $controllerInstance->$actionName();
        }
    } else {
        if($actionName == ''){
            $controllerInstance->index();
        }
        // Método não encontrado
        http_response_code(404);
        echo "Erro 404: Ação '$actionName' não encontrada no controlador '$controllerName'.";
    }
} else {
    // Controlador não encontrado
    http_response_code(404);
    echo "Erro 404: Controlador '$controllerName' não encontrado.";
}
