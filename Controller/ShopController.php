<?php 
global $pdo;
$query = $pdo->query("SELECT * FROM categorias order by id asc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

@$cate = $_GET['cat'];
@$tam = $_GET['tamanho'];
@$pesquisar = trim($_POST['pesquisar']);


$query3 = $pdo->query("SELECT * FROM produtos order by id desc ");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$query4 = $pdo->query("SELECT DISTINCT tamanho FROM produtos order by id desc ");
$res4 = $query4->fetchAll(PDO::FETCH_ASSOC);

$where = "";    
if ($cate != null and $tam != null) {
    @$where = "AND idcategoria = $cate AND tamanho = '$tam'";
    $query4 = $pdo->query("SELECT DISTINCT tamanho FROM produtos where idcategoria = $cate order by id desc ");
    $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
}else {
    if ($cate != null) {
        @$where = "AND idcategoria = $cate";
        $query4 = $pdo->query("SELECT DISTINCT tamanho FROM produtos order by id desc ");
        $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
    }
    
    if ($tam != null) {
        @$where = "AND tamanho = '$tam'";
    }
}

if ($pesquisar != null) {
    $query5 = $pdo->query("SELECT * FROM produtos where nome LIKE  '%$pesquisar%' order by id desc ");
$res3 = $query5->fetchAll(PDO::FETCH_ASSOC);
}

//paginacao

$busca = "SELECT * FROM produtos where statu = 1 $where";

$total_reg = "12"; // número de registros por página

$pagina=@$_GET['pag'];
if (!$pagina) {
$pc = "1";
} else {
$pc = $pagina;
}

$inicio = $pc - 1;
$inicio = $inicio * $total_reg;

$limite = $pdo->query("$busca LIMIT $inicio,$total_reg");
$todos = $pdo->query("$busca");
$todoss = $todos->fetchAll(PDO::FETCH_ASSOC);
$tr = count($todoss); // verifica o número total de registros
$tp = $tr / $total_reg; // verifica o número total de páginas

// vamos criar a visualização
$res3 = $limite->fetchAll(PDO::FETCH_ASSOC); 

// agora vamos criar os botões "Anterior e próximo"
$anterior = $pc -1;
$proximo = $pc +1;
