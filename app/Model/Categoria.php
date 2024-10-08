<?php
namespace App\Model;

use Config\BancoDeDados;
use PDO;

class Categoria {
    private $conn;
    private $nomeTabela = 'categorias';

    private $id;
    private $nome;
    private $descricao;
    private $status;
    private $dtCriacao;

    public function __construct() {
        $this->conn = (new BancoDeDados())->Conexao();
    }

    // Métodos para criar, ler, atualizar e deletar categorias (CRUD)
    
    public function create() {
        $query = "INSERT INTO " . $this->nomeTabela . " (nome, descricao, status) 
                  VALUES (:nome, :descricao, :status)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':status', $this->status);

        return $stmt->execute();
    }

    public function read($where ="") {
        $query = "SELECT * FROM " . $this->nomeTabela." WHERE 1=1 ".$where;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->nomeTabela . " 
                  SET nome = :nome, descricao = :descricao, status = :status 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->status = $this->status ?? 'ativo'; 
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "UPDATE " . $this->nomeTabela . "
        SET status = :status WHERE id = :id";
        $this->id = intval($id);
        $this->status = 'inativo';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':status', $this->status);
        return $stmt->execute();
    }

    // Função para popular o modelo com dados
    public function fill(array $data): void {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = htmlspecialchars(strip_tags($value));
            }
        }
    }

    public function getCategoriaPorId($id){
        $query = "SELECT * FROM " . $this->nomeTabela . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $id = intval($id);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
