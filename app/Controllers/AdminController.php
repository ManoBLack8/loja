<?php 
namespace App\Controllers;
use App\Model\Produto;

class AdminController extends Controller{

    public function __construct(){
        session_start();
        if($_SESSION["usuario"]["nivelAcesso"] != "admin"){
            $this->rendirecionar("../Login/index");
        }
    }
    public function index(){
        $this->render("Admin/index");
    }

    public function produtos(){
        $produtos = new Produto();
        $this->render("Admin/index", $data=[
            "pag" => "produtos",
            "produtos"=> $produtos->read()]);
    }
}