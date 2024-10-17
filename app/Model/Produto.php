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
    private $categoria_id;

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
                      categoria_id =: categoria_id
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

    public function setImagem($arquivo){
        $diretorio = '../../../img/produtos/';
        $nomeImagem = basename($arquivo['name']);
        $caminhoCompleto = $diretorio . $nomeImagem;

        // Validações de arquivo
        $extensao = pathinfo($nomeImagem, PATHINFO_EXTENSION);
        if (!in_array($extensao, ['png', 'PNG', 'jpg', 'jpeg', 'gif'])) {
            throw new \Exception('Extensão de imagem não permitida!');
        }

        // Valida se o diretório existe
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0755, true); // Cria o diretório se não existir
        }

        // Verifica se a imagem já existe, para não sobrescrever
        if (file_exists($caminhoCompleto)) {
            $nomeImagem = time() . '_' . $nomeImagem; // Adiciona timestamp para evitar conflitos
            $caminhoCompleto = $diretorio . $nomeImagem;
        }

        // Move o arquivo para o diretório de destino
        if (!move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)) {
            throw new \Exception('Falha ao fazer o upload da imagem.');
        }
        $this->imagem = $nomeImagem;
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

    public function getProdutoPorId($id){
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
