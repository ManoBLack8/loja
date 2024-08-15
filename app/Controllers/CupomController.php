<?php 
require_once("../conexao.php");
$cupom = $_POST['cupom'];
$query = $pdo->query("SELECT * FROM cupoms WHERE chave = '$cupom '");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
    foreach ($res as $cupoms){
        $cupom_valor = $cupoms["desconto_por"];
        if ( strtotime($cupoms["data_fim"]) < time()) {
            echo "esse cupom não está mais disponivel";
            exit;
        }
        echo "cupom aplicado: <strong>".$cupoms["chave"]."</strong>
        <input type='hidden' id='desconto' name='desconto' value='".$cupom_valor."'>";
    }
}
else {
    echo "nenhum cupom encontrado";
}
