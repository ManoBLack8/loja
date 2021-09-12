
<?php
function itensDoCarrinho($id_usuario){
    global $pdo;
    if ($id_usuario = "0"){
        $res = 0;
    }
    $query = $pdo->query("SELECT * FROM carrinho where situ = 'disponivel' and id_usuario =  $id_usuario order by id desc ");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    
    return $res ;
}
