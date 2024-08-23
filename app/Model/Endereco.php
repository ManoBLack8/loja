<?php 
namespace App\Model;

class Endereco{

    private $conn;
    private $nomeTabela = 'endereco';
    private $id;

    public function __construct($db){
        $this->conn = $db;
    }
}