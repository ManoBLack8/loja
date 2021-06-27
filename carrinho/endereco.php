<?php 
require_once("../conexao.php");
session_start();
$id_usuario = $_SESSION['id_usuario'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];
$complemento = $_POST['complemento'];
$refe = $_POST['referencia'];

$res = $pdo->query("SELECT * FROM andress where id_usuario = $id_usuario ");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
if (@count($dados) < 1) {
$res = $pdo->prepare("INSERT into andress (id_usuario, cep, rua, bairro, cidade, estado, complemento, refe) values (:id_usuario, :cep, :rua, :bairro, :cidade, :estado, :complemento, :refe)");


echo "<script language='javascript'> window.location='../carrinho.php' </script>";
}

$res->bindValue(":id_usuario", $id_usuario);
$res->bindValue(":cep", $cep);
$res->bindValue(":rua", $rua);
$res->bindValue(":bairro", $bairro);
$res->bindValue(":cidade", $cidade);
$res->bindValue(":estado", $uf);
$res->bindValue(":complemento", $complemento);
$res->bindValue(":refe", $refe);

$res->execute();



?>