<?php 
namespace App\Controllers;
use App\Model\Carrinho;
use App\Model\Endereco;
use App\Model\Pedido;
use App\Model\Produto;
use App\Model\Usuario;

class CheckoutController extends Controller{
    public function index(){ 
        session_start();
        $fretes = explode(',', $_POST["fretes"]);
        $produtos = new Produto();
        $usuario = new Usuario();
        $carrinho = new Carrinho();
        if(isset($_GET["id"])){
            if($usuario->verificarUsuarioOnline()){
                $produtosLista = $produtos->getProdutoPorId($_GET["id"]); 
            }else{
                $produtosLista = $_SESSION["carrinho"];
            }
        }else{
            if($usuario->verificarUsuarioOnline()){
                $produtosLista = $carrinho->listaCarrinhoUsuario(); 
            }else{
                $produtosLista = $_SESSION["carrinho"];
            }
        }
        $this->render("Checkout/index", $data= [
            "produtos" => $produtosLista,
            "fretes" => $fretes
        ]);
    }

    public function comprar(){
        $endereco = new Endereco();
        $usuario = new Usuario();
        $pedido = new Pedido();


    }
}