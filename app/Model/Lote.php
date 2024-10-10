<?php
namespace App\Model;

use Config\BancoDeDados;
use DateTime;
use PDO;

class Lote {
    private $conn;
    private $nomeTabela = 'lotes';

    public $id;
    public $codigo;
    public $apelido;
    public $produto_id;
    public $dthora_criacao;
    public $status;

    public function __construct() {
        $this->conn = (new BancoDeDados())->Conexao();
    }

    // Método para criar um lote
    public function create() {
        $query = "INSERT INTO " . $this->nomeTabela . " 
            (Apelido, dthora_criacao, status) 
            VALUES 
            (:apelido, NOW(), :status)";
        
        $stmt = $this->conn->prepare($query);
        
        // Limpar dados
        $this->apelido = htmlspecialchars(strip_tags($this->apelido));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // Bind parâmetros
        $stmt->bindParam(':apelido', $this->apelido);
        $stmt->bindParam(':status', $this->status);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para ler lotes
    public function read($where = "") {
        $query = "SELECT * FROM " . $this->nomeTabela . " WHERE 1=1 " . $where;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para atualizar um lote
    public function update() {
        $query = "UPDATE " . $this->nomeTabela . " 
            SET Apelido = :apelido, 
                 status = :status 
            WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Limpar dados
        $this->apelido = htmlspecialchars(strip_tags($this->apelido));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id = intval($this->id);

        // Bind parâmetros
        $stmt->bindParam(':apelido', $this->apelido);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para deletar um lote
    public function delete($id) {
        $query = "DELETE FROM " . $this->nomeTabela . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Limpar dado
        $id = intval($id);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para preencher as propriedades do objeto
    public function fill(array $data): void {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = htmlspecialchars(strip_tags($value));
            }
        }
    }

    // Método para obter um lote pelo ID
    public function getLoteById($id) {
        return $this->read("AND id = $id");
    }
}
