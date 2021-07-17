<?php 
require_once("../conexao.php");
@session_start();

$id_produto = $_POST['id'] ;
$id_cliente = @$_SESSION['id_usuario'];

$res = $pdo->query("SELECT * FROM carrinho where id_usuario = '$id_cliente' and id_produto = '$id_produto'");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	if(@count($dados) == 0){
$pdo->query("INSERT into carrinho (id_usuario, id_produto, id_venda, dataa, situ) values ('$id_cliente', '$id_produto','0', curDate(), 'disponivel' )");
echo 'Cadastrado com Sucesso!';
    }else {
        echo 'Produto já cadastrado';
    }


?>