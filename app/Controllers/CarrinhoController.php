<?php

namespace App\Controllers;
use Config\BancoDeDados;
use App\Model\Carrinho;
class CarrinhoController extends Controller {

    private $carrinho;

    public function __construct() {
        @session_start();
    }
    public function index(){
        $carrinho =$this->carrinho->listaCarrinhoUsuario();
        $this->render('Carrinho/index', $data = [
            "carrinho" => $carrinho,
            "totalCarrinho" => $this->carrinho->totalCarrinho()[0]
        ]);
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