<?php 
namespace App\Model;

use Config\BancoDeDados;

class Endereco{

    private $conn;
    private $nomeTabela = 'endereco';
    private $id;
    private $usuario_id;
    private $logradouro;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $estado;
    private $cep;
    private $pais;
    private $created_at;
    private $updated_at;

    public function __construct() {
        $this->conn = (new BancoDeDados())->Conexao();
    }


    // Função para criar um novo endereço
    public function create(){
        $query = "INSERT INTO " . $this->nomeTabela . " 
                  (usuario_id, logradouro, numero, complemento, bairro, cidade, estado, cep, pais) 
                  VALUES (:usuario_id, :logradouro, :numero, :complemento, :bairro, :cidade, :estado, :cep, :pais)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":usuario_id", $this->usuario_id);
        $stmt->bindParam(":logradouro", $this->logradouro);
        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(":complemento", $this->complemento);
        $stmt->bindParam(":bairro", $this->bairro);
        $stmt->bindParam(":cidade", $this->cidade);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":cep", $this->cep);
        $stmt->bindParam(":pais", $this->pais);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Função para atualizar o endereço
    public function update(){
        $query = "UPDATE " . $this->nomeTabela . " 
                  SET logradouro = :logradouro, numero = :numero, complemento = :complemento, 
                      bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep, pais = :pais 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":logradouro", $this->logradouro);
        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(":complemento", $this->complemento);
        $stmt->bindParam(":bairro", $this->bairro);
        $stmt->bindParam(":cidade", $this->cidade);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":cep", $this->cep);
        $stmt->bindParam(":pais", $this->pais);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Função para deletar um endereço
    public function delete(){
        $query = "DELETE FROM " . $this->nomeTabela . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Função para listar os endereços por usuário
    public function getEnderecosPorUsuario($usuario_id){
        $query = "SELECT * FROM " . $this->nomeTabela . " WHERE usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Setters
    public function setId($id){ $this->id = $id; }
    public function setUsuarioId($usuario_id){ $this->usuario_id = $usuario_id; }
    public function setLogradouro($logradouro){ $this->logradouro = $logradouro; }
    public function setNumero($numero){ $this->numero = $numero; }
    public function setComplemento($complemento){ $this->complemento = $complemento; }
    public function setBairro($bairro){ $this->bairro = $bairro; }
    public function setCidade($cidade){ $this->cidade = $cidade; }
    public function setEstado($estado){ $this->estado = $estado; }
    public function setCep($cep){ $this->cep = $cep; }
    public function setPais($pais){ $this->pais = $pais; }
}
