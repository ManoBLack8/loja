<?php 
namespace App\Model;
use Config\BancoDeDados;
use PDO;
class Pedido{

    private $conn;
    private $nomeTabela = 'pedidos';
    private $id;

    public function __construct(){
        $this->conn = (new BancoDeDados())->Conexao();
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->nomeTabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}