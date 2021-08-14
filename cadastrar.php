<?php
require_once("conexao.php");
if ($_POST['nomere'] === "") {
    echo 'Preencha o campo Nome';
    exit();
    
}
if ($_POST['emailre'] === "") {
    echo 'Preencha o campo Email';
    exit();
    
}
if ($_POST['senhare'] != $_POST['senhare2']) {
    echo 'fudeu';
    exit();
    
}




//ENVIANDO DADOS ARA A TABELA DE EMAILS

//cadastro
$res = $pdo->query("SELECT * FROM usuarios where email = '$_POST[emailre]'");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
if (@count($dados) == 0) {
    $senhacreipre = md5($_POST['senhare']);
    $res = $pdo->prepare("INSERT into usuarios (nome, email, senha, nivel) values (:nome, :email, :senha, :nivel)");
    $res->bindValue(":nome", $_POST['nomere']);
    $res->bindValue(":email", $_POST['emailre']);
    $res->bindValue(":senha", $senhacreipre);
    $res->bindValue(":nivel", "Cliente");
    $res->execute();  
    echo 'Enviado com Sucesso!';

   
}else {
    echo'Usuario já esta cadastrado';
}
?>