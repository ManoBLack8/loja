<?php 
namespace App\Model;

class Categoria{

    private $conn;
    private $nomeTabela = 'categorias';
    private $id;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->nomeTabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}