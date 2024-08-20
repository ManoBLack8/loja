<?php
require '../vendor/autoload.php';
use App\Controllers\HomeController;

// Roteamento básico (simples demais para produção)
$url = $_SERVER['REQUEST_URI'] == '/' ? '/home/index': $_SERVER['REQUEST_URI'];
$url = substr($url, 1);
@list($controller, $action) = explode('/', $url);
$controllerName = ucfirst($controller) . 'Controller';
if ($action == null or $action == ""){
    $action = 'index';
}
$actionName = $action;
$controllerClass = "App\\Controllers\\$controllerName";
$controllerInstance = new $controllerClass();

$controllerInstance->$actionName();