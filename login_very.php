<?php 
require_once("conexão.php");
session_start();

$nivel = 'adimin';
$senhacreiplo = md5($_POST['pass']);
$res2 = $pdo->query("SELECT * FROM usuarios where email = '$_POST[email]' AND senha = '$senhacreiplo' AND nivel = 'Cliente'");
$dados2 = $res2->fetchAll(PDO::FETCH_ASSOC);
$res = $pdo->query("SELECT * FROM usuarios where email = '$_POST[email]' AND senha = '$senhacreiplo' AND nivel = '$nivel'");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
if (@count($dados) == 1) { 
 
    echo 'O adm está online';

   
}else if (@count($dados2) == 1){
    echo 'Logado com sucesso';
    
}else {
    echo 'Usuario inexistente';

}
$_SESSION['email'] = $_POST['email'];
$_SESSION['nivel'] = $nivel;
?>