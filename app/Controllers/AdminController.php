<?php 
namespace App\Controllers;

use App\Model\Categoria;
use App\Model\Pedido;
use App\Model\Produto;
use App\Model\Usuario;

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

    public function categorias(){
        $categorias = new Categoria();
        $this->render("Admin/index", $data=[
            "pag" => "categorias",
            "categorias"=> $categorias->read()]);
    }

    public function subCategorias(){
        $produtos = new Produto();
        $this->render("Admin/index", $data=[
            "pag" => "sub-categorias",
            "produtos"=> $produtos->read()]);
    }
    
    public function tipoEnvios(){
        $produtos = new Produto();
        $this->render("Admin/index", $data=[
            "pag" => "tipo-envios",
            "produtos"=> $produtos->read()]);
    }

    public function caracteristicas(){
        $produtos = new Produto();
        $this->render("Admin/index", $data=[
            "pag" => "carac",
            "produtos"=> $produtos->read()]);
    }

    public function combos(){
        $produtos = new Produto();
        $this->render("Admin/index", $data=[
            "pag" => "combos",
            "produtos"=> $produtos->read()]);
    }

    public function promocoes(){
        $produtos = new Produto();
        $this->render("Admin/index", $data=[
            "pag" => "promocoes",
            "produtos"=> $produtos->read()]);
    }

    public function clientes(){
        $clientes = new Usuario();
        $this->render("Admin/index", $data=[
            "pag" => "clientes",
            "clientes"=> $clientes->read()]);
    }

    public function vendas(){
        $pedidos = new Pedido();
        $this->render("Admin/index", $data=[
            "pag" => "vendas",
            "pedidos"=> $pedidos->read()]);
    }

    
}