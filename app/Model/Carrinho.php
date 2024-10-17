<?php
namespace App\Model;

use Config\BancoDeDados;
use PDO;
use App\Util\Helpers;
class Carrinho {
    private $conn;
    private $nomeTabela = 'carrinhos';

    public function __construct() {
        $this->conn = (new BancoDeDados())->Conexao();
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->nomeTabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function listaCarrinhoUsuario() {
        $usuario_id = @$_SESSION['usuario']['id'];
        $query = 
        'SELECT
            p.id as id_produto,
            p.nome as nome_produto,
            p.valor as valor_produto,
            p.imagem as imagem_produto,
            p.status as status_produto,
            c.id as id_carrinho
        
        FROM ' . $this->nomeTabela . ' AS c
        INNER JOIN produtos AS p ON p.id = c.produto_id 
        WHERE usuario_id = :usuario_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function adicionarProduto($produtoId) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $usuario = new Usuario();
        $produto = new Produto();

        if ($usuario->verificarUsuarioOnline()) {
            // O código para adicionar o produto ao carrinho no banco
            $this->create($produtoId, $_SESSION['usuario']['id']);
        } else {
            if (!isset($_SESSION["carrinho"])) {
                $_SESSION["carrinho"] = [];
            }

            $produtoAdicionado = $produto->getProdutoPorId($produtoId);
            if ($produtoAdicionado) {
                $_SESSION["carrinho"][] = $produtoAdicionado[0];
                echo "Produto adicionado ao carrinho com sucesso!";
            } else {
                echo "Erro ao adicionar produto: Produto não encontrado.";
            }
        }
    }

    public function getQuantidadeItens() {
        $usuario_id = @$_SESSION['usuario']['id'];
        $query = 'SELECT COUNT(*) as total FROM ' . $this->nomeTabela . ' AS c
        INNER JOIN produtos AS p ON p.id = c.produto_id 
                        WHERE usuario_id = :usuario_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function totalCarrinho() {
        $usuario_id = @$_SESSION['usuario']['id'];
        $query = 
        'SELECT SUM(p.valor) as total FROM ' . $this->nomeTabela . ' AS c
        INNER JOIN produtos AS p ON p.id = c.produto_id 
                        WHERE usuario_id = :usuario_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        $resultado = Helpers::formatarMoeda($resultado);
        return $resultado;
    }

    // Método para criar uma entrada no carrinho
    public function create($produtoId, $usuarioId) {
        $query = "INSERT INTO " . $this->nomeTabela . " (usuario_id, produto_id) VALUES (:usuario_id, :produto_id)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':usuario_id', $usuarioId);
        $stmt->bindParam(':produto_id', $produtoId);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para deletar um item do carrinho
    public function delete($carrinhoId) {
        $query = "DELETE FROM " . $this->nomeTabela . " WHERE id = :carrinho_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':carrinho_id', $carrinhoId);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

