<?php

require_once("config.php");

date_default_timezone_set('America/Cuiaba');

try{
    $pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario","$senha");
} catch (Exception $e){
    echo "erro ao conectar com banco de dados" .  $e;
}
global $pdo;
require_once("Controller/funcoes_globais.php");
?>