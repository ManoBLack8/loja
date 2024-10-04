<?php 
namespace App\Model;

use Config\BancoDeDados;
use PDO;
class Imagen{

    private $conn;
    private $nomeTabela = 'imagens';
    private $id;
    private $imagens;

    public function __construct() {
        $this->conn = (new BancoDeDados())->Conexao();
    }

    public function setImagens($imagem){
        $this->imagens = $imagem;
    }
    public function create($id_produto){
        $query = "INSERT INTO " . $this->nomeTabela . " 
        SET id_produto=:id_produto, imagens=:imagens";
        $stmt = $this->conn->prepare($query);
        $id_produto = intval($id_produto);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->bindParam(':imagens', $this->imagens);
        $stmt->execute();
        return true;
    }
    public function getImagemByProdutoId($produtoId){
        $query = "SELECT * FROM " . $this->nomeTabela . " WHERE id_produto = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $produtoId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

    public function inserirImagemProduto($id_produto){
        $caminho = '../../../img/produtos' .@$_FILES['imgproduto']['name'];
        if (@$_FILES['imgproduto']['name'] == ""){
        $imagem = "sem-foto.jpg";
        }else{
        $imagem = @$_FILES['imgproduto']['name']; 
        }

        $imagem_temp = @$_FILES['imgproduto']['tmp_name']; 

        $ext = pathinfo($imagem, PATHINFO_EXTENSION);   
        if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'PNG'){ 
        move_uploaded_file($imagem_temp, $caminho);
        }else{
            echo 'Extensão de Imagem não permitida!';
            exit();
        }   
        $this->imagens = $imagem;
        $this->create($id_produto);
        echo 'Salvo com Sucesso!!';

        return true;
    }

    public function listarImagensProduto($id){
        $query = $this->conn->query("SELECT * FROM imagens where id_produto = '" . $id . "' ");
        echo "<div class='row'>";
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        for ($i=0; $i < count($res); $i++) {                   
            echo "<img class='ml-4 mb-2' src='../../src/img/produtos/" . $res[$i]['imagens'] . "' width='70'><a href='#' onClick='deletarImg(". $res[$i]['id'] .")'><i class='text-danger fas fa-times' style='margin-left: -15px'></i></a>";

        }
            echo "</div>";
    }



}