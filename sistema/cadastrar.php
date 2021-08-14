<?php 

require_once("../conexao.php");

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);

if($nome == ""){
	echo 'Preencha o Campo nome!';
	exit();
}

if($cpf == ""){
	echo 'Preencha o Campo cpf!';
	exit();
}

if($email == ""){
	echo 'Preencha o Campo email!';
	exit();
}

if($senha == ""){
	echo 'Preencha o Campo senha!';
	exit();
}

if($senha != md5($_POST['confirmar-senha'])){
	echo 'As senhas não coincidem!';
	exit();
}



$res = $pdo->query("SELECT * FROM usuarios where cpf = '$_POST[cpf]'"); 
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
if(@count($dados) == 0){

	$res = $pdo->prepare("INSERT into usuarios (nome, cpf, email, senha, nivel) values (:nome, :cpf, :email, :senha, :nivel)");
	$res->bindValue(":nome", $nome);
	$res->bindValue(":email", $email);
	$res->bindValue(":cpf", $cpf);
	$res->bindValue(":senha", $senha);
	$res->bindValue(":nivel", 'Cliente');

	$res->execute();


	$res = $pdo->query("SELECT * FROM emails where email = '$email'"); 
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	if(@count($dados) == 0){
	$res = $pdo->prepare("INSERT into emails (nome, email, ativo) values (:nome, :email, :ativo)");
	$res->bindValue(":nome", $nome);
	$res->bindValue(":email", $email);
	$res->bindValue(":ativo", "Sim");
	$res->execute();
}


	echo 'Cadastrado com Sucesso!';
}else{
	echo 'Email já Cadastrado!';
}


?>