<?php

namespace App\Controllers;
use Config\BancoDeDados;
use App\Model\Carrinho;
class CarrinhoController extends Controller {

    

    public function __construct() {
        @session_start();
    }
    public function index(){
        $carrinho = new Carrinho();
        $this->render('Carrinho/index', $data = [
            "carrinho" => $carrinho->listaCarrinhoUsuario(),
            "totalCarrinho" => $carrinho->totalCarrinho()
        ]);
    }
    public function adicionar() {
        // Recebe o ID do produto da requisição POST
        $produtoId = $_POST['id'];
        // Adiciona o produto ao carrinho
       // $carrinho->adicionarProduto($produtoId);

        // Obtém a quantidade atual de itens no carrinho
        //$quantidadeCarrinho = $carrinho->getQuantidadeItens();

        // Retorna a quantidade em formato JSON
        //echo json_encode(['quantidadeCarrinho' => $quantidadeCarrinho]);
    }
}