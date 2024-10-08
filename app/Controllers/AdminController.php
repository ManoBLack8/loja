<?php 
namespace App\Controllers;

use App\Model\Categoria;
use App\Model\Imagen;
use App\Model\Pedido;
use App\Model\Produto;
use App\Model\Usuario;

class AdminController extends Controller{

    public function __construct(){
        session_start();
        if($_SESSION["usuario"][0]["nivelAcesso"] != "admin"){
            $this->rendirecionar("../Login/index");
        }
    }
    public function index(){
        $this->render("Admin/index");
    }

    public function produtos(){
        $produtos = new Produto();
        $categorias = new Categoria();

        if(@$_POST['acao'] == 'cadastro'){
            $p = new Produto();
            $p->setImagem($_FILES["imagem"]);
            $p->fill($_POST);
            $p->create();
            $_POST = [];
            $p = null;
            $this->rendirecionar("Produtos");

        }elseif(@$_POST['acao'] == 'edicao'){
            $p = new Produto();
            $p->fill($_POST);
            $p->update();
            $_POST = [];
            $p = null;
            $this->rendirecionar("Produtos");
        }

        if(@$_GET["funcao"]=="novo"){
            $this->ModalForm("Produto/adicionar",$modal=[
                "produtos" => $produtos->getProdutoPorId(),
                "categorias" => $categorias->read()
            ]);
        }elseif(@$_GET["funcao"] == "editar"){
            $this->ModalForm("Produto/adicionar",$modal=[
                "produtos" => $produtos->getProdutoPorId($_GET["id"]),
                "categorias" => $categorias->read()
            ]);
        }elseif (@$_GET["funcao"] == "deletar") {
            $p = new Produto();
            $p->fill($_GET);
            $p->delete();
            $_POST = [];
            $p = null;
           $this->rendirecionar("Produtos");
        }elseif(@$_GET["funcao"] == "imagens"){
            $fotos = $_FILES['imgproduto'] ?? null;
            if($fotos){
                // Verifica se há múltiplos arquivos e os processa
                $totalArquivos = count($_FILES['imgproduto']['name']);
                for($i = 0; $i < $totalArquivos; $i++){
                    $nomeArquivo = $_FILES['imgproduto']['name'][$i];
                    $arquivoTmp = $_FILES['imgproduto']['tmp_name'][$i];
                    $caminhoDestino = "./src/img/produtos/" . $nomeArquivo;
    
                    // Move o arquivo para o diretório de destino
                    if(move_uploaded_file($arquivoTmp, $caminhoDestino)){
                        $imagem = new Imagen();
                        $imagem->setImagens($nomeArquivo);
                        $imagem->create($_POST["id"]);
                    } else {
                        // Tratar erro ao mover arquivo
                        echo "Erro ao mover o arquivo $nomeArquivo";
                    }
                }
            }
    
            $this->ModalForm("Produto/imagens");
        }
    
        // Renderização da página de produtos
        $this->render("Admin/index", $data=[
            "pag" => "produtos",
            "produtos" => $produtos->read("AND status != 'Excluido'")
        ]);
        $this->render("Admin/index", $data=[
            "pag" => "produtos",
            "produtos"=> $produtos->read("AND status != 'Excluido'")
        ]);
    }

    public function categorias(){
        $categorias = new Categoria();
        
        if(@$_GET["funcao"]=="novo"){
            $this->ModalForm("Categoria/adicionar");
        }else if(@$_GET["funcao"]=="editar"){
            $this->ModalForm("Categoria/adicionar",$modal=[
                //"categoria" => $categorias->getCategoriaPorId($_GET["id"])
            ]);
        }

        if(@$_POST['acao'] == 'cadastro'){
            $c = new Categoria();
            $c->fill($_POST);
            $c->create();
            $_POST = [];
            $c = null;
            $this->rendirecionar("Produtos");

        }

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

    public function logout(){
        $usuario = new Usuario();
        $usuario->logout();
    }

    
}