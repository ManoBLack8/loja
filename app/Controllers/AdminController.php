<?php 
namespace App\Controllers;

use App\Model\Cupom;
use App\Model\Categoria;
use App\Model\Imagen;
use App\Model\Pedido;
use App\Model\Produto;
use App\Model\Usuario;
use App\Model\Lote;


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

    public function lotes(){
        ob_start();
        $lotes = new Lote();
        if(isset($_GET["funcao"])){
            switch ($_GET["funcao"]) {
                case 'novo':
                    $this->ModalForm("Lote/adicionar");
                    break;
                case 'editar':
                    $this->ModalForm("Lote/adicionar", $lotes->getLoteById($_GET["id"])[0]);
                    break;
                case 'excluir':
                    $lotes->delete($_GET["id"]);

                default:
                    # code...
                    break;
            }
        }
        if(isset($_GET["acao"])){
            switch ($_POST["acao"]) {
                case 'novo':
                    $lotes->fill($_POST);
                    $lotes->create();
                    break;
                case 'editar':
                    $lotes->fill($_POST);
                    $lotes->update();
                    $this->rendirecionar("lotes");
                    break;
                
                default:
                    # code...
                    break;
            }
        }
        $this->render("Admin/index", $data=[
            "pag" => "lotes",
            "lotes" => $lotes->read()
        ]);
        ob_end_flush();
    }
    public function produtos(){
        $produtos = new Produto();
        $categorias = new Categoria();

        if(isset($_POST["acao"])){
            if($_POST['acao'] == 'cadastro'){
                $p = new Produto();
                $p->setImagem($_FILES["imagem"]);
                $p->fill($_POST);
                $p->create();
                $_POST = [];
                $p = null;
                $this->rendirecionar("Produtos");
    
            }elseif($_POST['acao'] == 'edicao'){
                $p = new Produto();
                $p->fill($_POST);
                $p->update();
                $_POST = [];
                $p = null;
                $this->rendirecionar("Produtos");
            }
        }
        
        if(isset($_GET["funcao"])){
            if($_GET["funcao"]=="novo"){
                $this->ModalForm("Produto/adicionar",$modal=[
                    "produtos" => $produtos->getProdutoPorId($_GET["id"]),
                    "categorias" => $categorias->read()
                ]);
            }elseif($_GET["funcao"] == "editar"){
                $this->ModalForm("Produto/adicionar",$modal=[
                    "produtos" => $produtos->getProdutoPorId($_GET["id"]),
                    "categorias" => $categorias->read()
                ]);
            }elseif ($_GET["funcao"] == "deletar") {
                $p = new Produto();
                $p->fill($_GET);
                $p->delete();
                $_POST = [];
                $p = null;
               $this->rendirecionar("Produtos");
            }elseif($_GET["funcao"] == "imagens"){
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
        }
        
    
        // Renderização da página de produtos
        $this->render("Admin/index", $data=[
            "pag" => "produtos",
            "produtos" => $produtos->read("AND status != 'Excluido'")
        ]);
    }

    public function categorias(){
        ob_start(); // Inicia o buffer de saída
        
        $categorias = new Categoria();
        
        if(isset($_GET["funcao"])){
            if($_GET["funcao"]=="novo"){
                $this->ModalForm("Categoria/adicionar");
            }else if($_GET["funcao"]=="editar"){
                $this->ModalForm("Categoria/adicionar", $modal=[
                    "categoria" => $categorias->getCategoriaPorId($_GET["id"])
                ]);
            }elseif($_GET["funcao"] =='excluir'){
                $c = new Categoria();
                $c->fill($_POST);
                $c->delete($_GET["id"]);
                $this->rendirecionar("../admin/categorias");
                exit(); // Certifique-se de sair após o redirecionament
            }
        }
        
        if(isset($_GET["acao"])){
            if($_POST['acao'] == 'novo'){
                $c = new Categoria();
                $c->fill($_POST);
                $c->create();
        
            }elseif($_POST['acao'] == "editar"){
                $c = new Categoria();
                $c->fill($_POST);
                $c->update();
                $this->rendirecionar("../admin/categorias");
                exit(); // Certifique-se de sair após o redirecionamento
            }
        }
        
    
        $this->render("Admin/index", $data=[
            "pag" => "categorias",
            "categorias"=> $categorias->read("AND status = 'ativo'")
        ]);
    
        ob_end_flush(); // Envia todo o conteúdo do buffer de saída
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

    public function cupoms(){
        ob_start();
        $cupoms = new Cupom();
        if(isset($_GET['funcao'])){
            switch($_GET['funcao']){
                case 'novo':
                    $this->ModalForm("Cupom/adicionar");                    # code...
                    break;       
                case 'editar':
                    $this->ModalForm("Cupom/adicionar", $cupoms->getCupomById($_GET["id"])[0]);
                    break;
                case 'excluir':
                    $cupoms->id = intval($_GET["id"]);
                    $cupoms->delete();
                    $this->rendirecionar("../admin/cupoms");
                
            }
            
            if(isset($_POST["acao"])){
                switch ($_POST["acao"]) {
                    case 'novo':
                        $cupom = new Cupom();
                        $cupom->fill($_POST);
                        $cupom->create();
                        break;
                    case 'editar':
                        $cupom = new Cupom();
                        $cupom->fill($_POST);
                        $cupom->update();
                        $this->rendirecionar("../admin/cupoms");
                        break;
                }    
            }
            
        }
        $this->render("Admin/index", $data=[
            "pag" => "cupoms",
            "cupoms"=> $cupoms->read("")
        ]);
        ob_end_flush();
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
        $this->rendirecionar("../Login/index");
    }

    
}