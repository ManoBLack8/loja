<?php
namespace App\Controllers;

use App\Model\Carrinho;
use App\Model\Imagen;
use Config\BancoDeDados;
class ApiController extends Controller{

    function index($oi){
        echo $oi;
    }
    function inserirImagenProduto($id, $arquivo){
        $imagens = new Imagen();
        $imagens->inserirImagemProduto($id, $arquivo);

    }
    function listarImagens($id){
        $imagens = new Imagen();
        $imagens->listarImagensProduto($id);
    }
    function carrinhoAdicionar(){
        $carrinho = new Carrinho();
        $carrinho->adicionarProduto($_POST["id"]);
    }
    function carrinhoDeletar(){
        $carrinho = new Carrinho();
        $carrinho->delete($_POST["id"]);
    }

    function entregas(){
        $this->render("../../api/Ajax/entregas");
    }
}