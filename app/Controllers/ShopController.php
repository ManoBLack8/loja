<?php 
namespace App\Controllers;

use App\Model\Categoria;
use App\Model\Produto;
use App\Model\Usuario;
use Config\BancoDeDados;

class ShopController extends Controller
{
    private $db; 
    private $usuario;
    private $produto;
    private $categoria;

    public function __construct() {
        @session_start();
        $database = new BancoDeDados();
        $this->db = $database->Conexao();
        $this->usuario = new Usuario($this->db);
        $this->produto = new Produto($this->db);
        $this->categoria = new Categoria($this->db);
    }

    public function index($pag = 1){
        // Configuração da paginação
        $produtosPorPagina = 12;  // Número de produtos por página
        $paginaAtual = isset($pag) ? (int)$pag : 1;
        $inicio = ($paginaAtual - 1) * $produtosPorPagina;

        // Busca os produtos paginados e o total de produtos
        $produtos = $this->produto->getProdutosPaginados($inicio, $produtosPorPagina);
        $totalProdutos = $this->produto->getTotalProdutos();
        $totalPaginas = ceil($totalProdutos / $produtosPorPagina);

        $this->render("Shop/index", $data = [
            "produtos" => $produtos,
            "categoria" => $this->categoria,
            "usuario" => $this->usuario,
            "tamanho" => $this->produto->getTamanhosvitrine(),
            "paginaAtual" => $paginaAtual,
            "totalPaginas" => $totalPaginas
        ]);
    }
}
