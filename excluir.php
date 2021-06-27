<?php

require_once("../../../conexão.php"); 

$id = $_POST['id'];

$pdo->query("DELETE from produtos WHERE id = '$id'");

echo 'Excluído com Sucesso!!';

?>