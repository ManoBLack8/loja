<?php 
namespace App\Model;
use Config\BancoDeDados;
use Dotenv\Util\Str;

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
    private $tags;
    private $peso;
    private $largura;
    private $altura;
    private $comprimento;
    private $status;
    private $idcategoria;

    function __construct() {
        $this->conn = (new BancoDeDados())->Conexao();
    }

    public function read($where='') {
        $query = 'SELECT * FROM ' . $this->nomeTabela." WHERE 1=1 ".$where;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fill(array $data): void {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = htmlspecialchars(strip_tags($value));
            }
        }
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
                      idcategoria=:idcategoria";
        
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->nomeURL = htmlspecialchars(strip_tags($this->nomeURL));
        $this->imagem = htmlspecialchars(strip_tags($this->imagem));
        $this->tamanho = htmlspecialchars(strip_tags($this->tamanho));
        $this->tamanhoVeste = htmlspecialchars(strip_tags($this->tamanhoVeste));
        $this->valor = htmlspecialchars(strip_tags($this->valor));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->idcategoria = htmlspecialchars(strip_tags($this->idcategoria));

        // Bind parameters
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':nomeURL', $this->nomeURL);
        $stmt->bindParam(':imagem', $this->imagem);
        $stmt->bindParam(':tamanho', $this->tamanho);
        $stmt->bindParam(':tamanhoVeste', $this->tamanhoVeste);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':idcategoria', $this->idcategoria);

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
                      idcategoria =: idcategoria
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
        $this->idcategoria = htmlspecialchars(strip_tags($this->idcategoria));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind parameters
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':nomeURL', $this->nomeURL);
        $stmt->bindParam(':imagem', $this->imagem);
        $stmt->bindParam(':tamanho', $this->tamanho);
        $stmt->bindParam(':tamanhoVeste', $this->tamanhoVeste);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':idcategoria', $this->idcategoria);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $this->status = "Excluido";
        $query = "UPDATE " . $this->nomeTabela . " 
                  SET status = :status
                  WHERE id=:id";

        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags(intval($this->id)));
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function produtosVitrine() {
        $produtosPorPagina = 12;  // Quantos produtos por página
        $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;  // Página atual
        $inicio = ($paginaAtual - 1) * $produtosPorPagina;  // Cálculo do offset
        $query = 'SELECT * FROM ' . $this->nomeTabela . ' WHERE status >= 0 LIMIT :inicio, :produtoPorPagina';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':inicio', $inicio);
        $stmt->bindParam(':produtoPorPagina', $produtosPorPagina);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTamanhosvitrine() {
        $query = 'SELECT DISTINCT tamanho FROM ' . $this->nomeTabela . ' WHERE status > 0';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProdutosPaginados($inicio, $produtosPorPagina) {
        $query = "SELECT * FROM " . $this->nomeTabela . " LIMIT :inicio, :produtosPorPagina";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':inicio', $inicio, \PDO::PARAM_INT);
        $stmt->bindParam(':produtosPorPagina', $produtosPorPagina, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTotalProdutos() {
        $query = "SELECT COUNT(*) as total FROM " . $this->nomeTabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }

    public function getProdutoPorNome(){
        $nome = $_GET['nome'];
        $query = "SELECT * FROM " . $this->nomeTabela . " WHERE nome = :nome LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getProdutoPorId(){
        $id = @$_GET['id'];
        $query = "SELECT * FROM " . $this->nomeTabela . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getImagensProdutos($produtoId){
        $produtoId = intval($produtoId);
        $imagens = new Imagen($this->conn);
         return $imagens->getImagemByProdutoId($produtoId);
    }
}