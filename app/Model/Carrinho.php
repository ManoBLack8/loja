<?php 
namespace App\Model;

class Carrinho {
    private $conn;
    private $nomeTabela = 'carrinhos';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->nomeTabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    

    public function listaCarrinhoUsuario() {
        $_SESSION['usuario']['id'] = 1;
        $usuario_id = @$_SESSION['usuario']['id'];
        $query = 
        'SELECT
            p.id as id_produto
            ,p.nome as nome_produto
            ,p.valor as valor_produto
            ,p.imagem as imagem_produto
            ,p.status as status_produto
            ,c.id as id_carrinho
        
        FROM ' . $this->nomeTabela . ' AS c
        INNER JOIN produtos AS p ON p.id = c.produto_id 
        WHERE usuario_id = :usuario_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function adicionarProduto($produtoId) {
        // Adiciona o produto ao carrinho na sessão
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        // Adiciona o produto ao array do carrinho
        $_SESSION['carrinho'][] = $produtoId;
    }

    public function getQuantidadeItens() {
        // Conta a quantidade de itens no carrinho
        @$_SESSION['usuario']['id'] = 1;
        $usuario_id = @$_SESSION['usuario']['id'];
        $query = 
        'SELECT COUNT(*) FROM ' . $this->nomeTabela . ' AS c
        INNER JOIN produtos AS p ON p.id = c.produto_id 
                        WHERE usuario_id = :usuario_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function totalCarrinho() {
        @$_SESSION['usuario']['id'] = 1;
        $usuario_id = @$_SESSION['usuario']['id'];
        $query = 
        'SELECT SUM(p.valor) FROM ' . $this->nomeTabela . ' AS c
        INNER JOIN produtos AS p ON p.id = c.produto_id 
                        WHERE usuario_id = :usuario_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
