<?php 
require_once("../conexao.php");
session_start();
$id_usuario = $_SESSION['id_usuario'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$lote = $_POST['numero']; 
$bairo = $_POST['bairro'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];
$ddd = $_POST['ddd'];
$complemento = $_POST['complemento'];

$res = $pdo->query("SELECT * FROM andress where id_usuario = $id_usuario ");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
if (@count($dados) < 1) {
$res = $pdo->prepare("INSERT into andress (id_usuario, cep, rua, bairo, cidade, estado, lote, complemento) values (:id_usuario, :cep, :rua, :bairo, :cidade, :estado, :lote, :complemento)");
}

$res->bindValue(":id_usuario", $id_usuario);
$res->bindValue(":cep", $cep);
$res->bindValue(":rua", $rua);
$res->bindValue(":bairo", $bairo);
$res->bindValue(":cidade", $cidade);
$res->bindValue(":estado", $uf);
$res->bindValue(":lote", $lote);
$res->bindValue(":complemento", $complemento);


$res->execute();



?>