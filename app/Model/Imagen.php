<?php 
namespace App\Model;

class Imagen{

    private $conn;
    private $nomeTabela = 'imagens';
    private $id;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getImagemByProdutoId($produtoId){
        $query = "SELECT * FROM " . $this->nomeTabela . " WHERE id_produto = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $produtoId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }
}