<?php 
global $pdo;
$query = $pdo->query("SELECT * FROM categorias order by id asc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$query2 = $pdo->query("SELECT * FROM promocao order by id asc ");
$ress = $query2->fetchAll(PDO::FETCH_ASSOC);
@$cate = $_GET['cat'];
@$tam = $_GET['tamanho'];

$query3 = $pdo->query("SELECT * FROM produtos order by id desc ");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$query4 = $pdo->query("SELECT DISTINCT tamanho FROM produtos order by id desc ");
$res4 = $query4->fetchAll(PDO::FETCH_ASSOC);

if ($tam != null) {
    $query3 = $pdo->query("SELECT * FROM produtos where idcategoria = $cate order by id desc ");
    $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
    $query4 = $pdo->query("SELECT DISTINCT tamanho FROM produtos where idcategoria = $cate order by id desc ");
    $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
}