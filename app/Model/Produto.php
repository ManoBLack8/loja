<?php 
namespace App\Model;

class Produto {

    private $conn;
    private $nomeTabela = 'produtos';
    private $id;
    private $nome;
    private $nomeURL;
    private $imagem;
    private $tamanho;
    private $tamanhoVeste;
    private $valor;
    private $descricao;
    private $categoria_id;

    function __construct($conn) {
        $this->conn = $conn;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->nomeTabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->nomeTabela . " 
                  SET nome=:nome, 
                      nomeURL=:nomeURL, 
                      imagem=:imagem, 
                      tamanho=:tamanho, 
                      tamanhoVeste=:tamanhoVeste, 
                      valor=:valor, 
                      descricao=:descricao, 
                      categoria_id=:categoria_id";
        
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->nomeURL = htmlspecialchars(strip_tags($this->nomeURL));
        $this->imagem = htmlspecialchars(strip_tags($this->imagem));
        $this->tamanho = htmlspecialchars(strip_tags($this->tamanho));
        $this->tamanhoVeste = htmlspecialchars(strip_tags($this->tamanhoVeste));
        $this->valor = htmlspecialchars(strip_tags($this->valor));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->categoria_id = htmlspecialchars(strip_tags($this->categoria_id));

        // Bind parameters
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':nomeURL', $this->nomeURL);
        $stmt->bindParam(':imagem', $this->imagem);
        $stmt->bindParam(':tamanho', $this->tamanho);
        $stmt->bindParam(':tamanhoVeste', $this->tamanhoVeste);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':categoria_id', $this->categoria_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->nomeTabela . " 
                  SET nome=:nome, 
                      nomeURL=:nomeURL, 
                      imagem=:imagem, 
                      tamanho=:tamanho, 
                      tamanhoVeste=:tamanhoVeste, 
                      valor=:valor, 
                      descricao=:descricao, 
                      categoria_id=:categoria_id
                  WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->nomeURL = htmlspecialchars(strip_tags($this->nomeURL));
        $this->imagem = htmlspecialchars(strip_tags($this->imagem));
        $this->tamanho = htmlspecialchars(strip_tags($this->tamanho));
        $this->tamanhoVeste = htmlspecialchars(strip_tags($this->tamanhoVeste));
        $this->valor = htmlspecialchars(strip_tags($this->valor));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->categoria_id = htmlspecialchars(strip_tags($this->categoria_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind parameters
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':nomeURL', $this->nomeURL);
        $stmt->bindParam(':imagem', $this->imagem);
        $stmt->bindParam(':tamanho', $this->tamanho);
        $stmt->bindParam(':tamanhoVeste', $this->tamanhoVeste);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':categoria_id', $this->categoria_id);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function produtosVitrine() {
        $query = 'SELECT * FROM ' . $this->nomeTabela . ' WHERE situ >= 0';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
