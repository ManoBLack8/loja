<?php 
namespace App\Controllers;
use App\Model\Produto;

class CheckoutController extends Controller{
    public function index(){ 
        if(isset($_GET["id"])){
            $produtos = new Produto();
            $data = [
                "produtos" => $produtos->getProdutoPorId($_GET["id"])
            ];
        }
        $this->render("Checkout/index", $data);
    }
}