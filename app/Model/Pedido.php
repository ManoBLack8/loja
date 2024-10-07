<?php
namespace App\Model;

use Config\BancoDeDados;
use PDO;

class Pedido {

    private $conn;
    private $nomeTabela = 'pedidos';
    private $id;
    private $id_usuario;
    private $data_criacao;
    private $status;
    private $metodo_pagamento;
    private $total;
    private $endereco_entrega;

    public function __construct() {
        $this->conn = (new BancoDeDados())->Conexao();
    }

    public function create() {
        $query = "INSERT INTO " . $this->nomeTabela . " 
                  (id_usuario, data_criacao, status, metodo_pagamento, total, endereco_entrega)
                  VALUES (:id_usuario, :data_criacao, :status, :metodo_pagamento, :total, :endereco_entrega)";
        
        $stmt = $this->conn->prepare($query);

        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $this->data_criacao = htmlspecialchars(strip_tags($this->data_criacao));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->metodo_pagamento = htmlspecialchars(strip_tags($this->metodo_pagamento));
        $this->total = htmlspecialchars(strip_tags($this->total));
        $this->endereco_entrega = htmlspecialchars(strip_tags($this->endereco_entrega));

        $stmt->bindParam(':id_usuario', $this->id_usuario);
        $stmt->bindParam(':data_criacao', $this->data_criacao);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':metodo_pagamento', $this->metodo_pagamento);
        $stmt->bindParam(':total', $this->total);
        $stmt->bindParam(':endereco_entrega', $this->endereco_entrega);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->nomeTabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->nomeTabela . " 
                  SET status=:status, metodo_pagamento=:metodo_pagamento, total=:total, endereco_entrega=:endereco_entrega 
                  WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->metodo_pagamento = htmlspecialchars(strip_tags($this->metodo_pagamento));
        $this->total = htmlspecialchars(strip_tags($this->total));
        $this->endereco_entrega = htmlspecialchars(strip_tags($this->endereco_entrega));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':metodo_pagamento', $this->metodo_pagamento);
        $stmt->bindParam(':total', $this->total);
        $stmt->bindParam(':endereco_entrega', $this->endereco_entrega);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->nomeTabela . " WHERE id=:id";

        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
