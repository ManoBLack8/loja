<?php require_once("../conexao.php"); 

$id = $_POST['id'];

$pdo->query("DELETE from carrinho WHERE id = '$id'");

echo 'Excluído com Sucesso!!';
?>