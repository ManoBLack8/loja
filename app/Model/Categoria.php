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

    public function read() {
        $query = 'SELECT * FROM ' . $this->nomeTabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}