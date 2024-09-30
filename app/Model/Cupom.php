<?php 
namespace App\Model;
Use Config\BancoDeDados;
class Cupom{

    private $conn;
    private $nomeTabela = 'cupoms';

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