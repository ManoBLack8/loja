<?php 
namespace App\Model;

class Carrinho {
    private $conn;
    private $nomeTabela = 'carrinhos';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function adicionarProduto($produtoId) {
        // Adiciona o produto ao carrinho na sessão
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        // Adiciona o produto ao array do carrinho
        $_SESSION['carrinho'][] = $produtoId;
    }

    public function getQuantidadeItens() {
        // Conta a quantidade de itens no carrinho
        return isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0;
    }
}
