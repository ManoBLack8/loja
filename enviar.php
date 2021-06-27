<?php
require_once("conexão.php");
if ($_POST['nomecontato'] === "") {
    echo 'Preencha o campo Nome';
    exit();
    
}
if ($_POST['emailcontato'] === "") {
    echo 'Preencha o campo Email';
    exit();
    
}
if ($_POST['msgcontato'] === "") {
    echo 'Preencha o campo Mensagem';
    exit();
    
}

$destinatario = $email;
$assunto = $nome . ' - Email da loja';

$mensagem = utf8_decode('Nome: '.$_POST['nomecontato']. "\r\n"."\r\n". 'Mensagem: '.$_POST['msgcontato']);

$cabecalhos ="From: ".$_POST['emailcontato'];

@mail($destinatario, $assunto, $mensagem, $cabecalhos);

echo 'Enviado com Sucesso!';

//ENVIANDO DADOS ARA A TABELA DE EMAILS

$res = $pdo->query("SELECT * FROM emails where email = '$_POST[emailcontato]'");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
if (@count($dados)== 0) {
    $res = $pdo->prepare("INSERT into emails (nome, email, ativo) values (:nome, :email, :ativo)");
    $res->bindValue(":nome", $_POST['nomecontato']);
    $res->bindValue(":email", $_POST['emailcontato']);
    $res->bindValue(":ativo", "sim");
    $res->execute();
    
}
 
?>