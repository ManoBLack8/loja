<?php 
namespace App\Model;

class Pedido{

    private $conn;
    private $nomeTabela = 'pedidos';
    private $id;

    public function __construct($db){
        $this->conn = $db;
    }
}