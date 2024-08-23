<?php

namespace App\Controllers;
use Config\BancoDeDados;
use App\Model\Carrinho;
class CarrinhoController extends Controller {

    private $db;
    private $carrinho;

    public function __construct() {
        @session_start();
        $database = new BancoDeDados();
        $this->db = $database->Conexao();
        $this->carrinho = new Carrinho($this->db);
    }
    public function adicionar() {
        // Recebe o ID do produto da requisição POST
        $produtoId = $_POST['id'];

        // Adiciona o produto ao carrinho
        $this->carrinho->adicionarProduto($produtoId);

        // Obtém a quantidade atual de itens no carrinho
        $quantidadeCarrinho = $this->carrinho->getQuantidadeItens();

        // Retorna a quantidade em formato JSON
        echo json_encode(['quantidadeCarrinho' => $quantidadeCarrinho]);
    }
}