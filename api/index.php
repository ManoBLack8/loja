<?php
// Inclua o arquivo de conexão
require_once("../conexao.php");

if (isset($_GET['funcao'])) {
    $funcao = $_GET['funcao'];

    if ($funcao != "conexao") {
        // Verifique se a função existe antes de chamar
        if (function_exists($funcao)) {
            // Chame a função
            $funcao();
        } else {
            echo "Função não encontrada.";
        }
    }
} else {
    echo "Parâmetro 'funcao' não especificado na URL.";
}

function chamarProdutos()
{
    global $pdo; // Use a variável de conexão global

    $query3 = $pdo->query("SELECT * FROM produtos order by id desc");
    $result = $query3->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function chamarProdutosEspessifico($id)
{
    global $pdo; // Use a variável de conexão global
    $id = intval($id);
    $query = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
    $query->execute([$id]);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function chamarCategorias()
{
    global $pdo; // Use a variável de conexão global

    $query3 = $pdo->query("SELECT * FROM categorias order by id asc");
    $result = $query3->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function Pesquisar($pesquisar)
{
    global $pdo; // Use a variável de conexão global

    $query = $pdo->prepare("SELECT * FROM produtos where nome LIKE ?");
    $query->execute(["%$pesquisar%"]);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}
?>
