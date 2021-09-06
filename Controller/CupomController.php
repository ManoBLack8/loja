<?php 
require_once("../conexao.php");
$cupom = $_POST['cupom'];
$query = $pdo->query("SELECT * FROM cupoms WHERE chave = '$cupom '");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
    foreach ($res as $cupoms){
        if ($cupoms["data_fim"] > date("j/n/Y")) {
            echo "esse cupom não está mais disponivel";
            exit;
        }
        echo "<li>cupom aplicado: <strong>".$cupoms["chave"]."</strong><span>R$ -".$cupoms["desconto_por"]."</span></li><hr>
        <input type='hidden' value=".$cupoms["desconto_por"].">";
    }
}
else {
    echo "nenhum cupom encontrado";
}
