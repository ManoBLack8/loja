<?php
namespace App\Controllers;
use Config\BancoDeDados;
use App\Model\Produto;
class ProdutoController extends Controller{
    private $db;
    private $produto;


    public function __construct() {
        @session_start();
        $database = new BancoDeDados();
        $this->db = $database->Conexao();
        $this->produto = new Produto($this->db);
    }
    public function detalhes($nome = '') {
        $produto = $this->produto->getProdutoPorNome($nome);
        $this->render("Produto/detalhes", $data = [
            "produtos" => $produto,
            "imagensProdutos" => $this->produto->getImagensProdutos($produto['id'])
        ]);
    }


}