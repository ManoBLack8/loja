<?php 
global $pdo;
$query = $pdo->query("SELECT * FROM categorias order by id asc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$query2 = $pdo->query("SELECT * FROM promocao order by id asc ");
$ress = $query2->fetchAll(PDO::FETCH_ASSOC);
@$cate = $_GET['cat'];
@$tam = $_GET['tamanho'];
@$pesquisar = trim($_POST['pesquisar']);


$query3 = $pdo->query("SELECT * FROM produtos order by id desc ");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$query4 = $pdo->query("SELECT DISTINCT tamanho FROM produtos order by id desc ");
$res4 = $query4->fetchAll(PDO::FETCH_ASSOC);

if ($cate != null) {
    $query3 = $pdo->query("SELECT * FROM produtos where idcategoria = $cate order by id desc ");
    $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
    $query4 = $pdo->query("SELECT DISTINCT tamanho FROM produtos where idcategoria = $cate order by id desc ");
    $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
}
if ($tam != null) {
    $query3 = $pdo->query("SELECT * FROM produtos where idcategoria = $cate order by id desc ");
    $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
    if ($cate = null) {
        $query3 = $pdo->query("SELECT * FROM produtos order by id desc ");
    $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
        $query4 = $pdo->query("SELECT DISTINCT tamanho FROM produtos where idcategoria = $cate order by id desc ");
        $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
if ($cate and $tam != null) {
    $query3 = $pdo->query("SELECT * FROM produtos WHERE idcategoria = $cate AND tamanho = '$tam'");
    $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
    $query4 = $pdo->query("SELECT DISTINCT tamanho FROM produtos where idcategoria = $cate order by id desc ");
    $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
}
if ($pesquisar != null) {
    $query5 = $pdo->query("SELECT * FROM produtos where nome LIKE  '%$pesquisar%' order by id desc ");
$res3 = $query5->fetchAll(PDO::FETCH_ASSOC);
}

//paginacao

$total_de_produtos = count($res3);
$produtos_por_pagina = 9;
@$pagina = $_GET["pag"];
if (!$pagina) {
    $pagina = 1;
}
