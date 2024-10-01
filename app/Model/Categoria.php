<?php 
namespace App\Model;
Use Config\BancoDeDados;
class Categoria{

    private $conn;
    private $nomeTabela = 'categorias';
    private $id;

    public function __construct(){
        $this->conn = (new BancoDeDados())->Conexao();
    }

    public function read($where = "") {
        $query = 'SELECT * FROM ' . $this->nomeTabela." WHERE 1=1 ".$where;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCategoriaPorId($id): array {
        return self::read("AND id = $id");
    }
}