<?php
namespace App\Model;

use Config\BancoDeDados;
use PDO;
class Cupom {
    private $conn;
    private $nomeTabela = 'cupons';

    public $id;
    public $codigo;
    public $tipo_desconto;
    public $valor_desconto;
    public $data_validade_inicio;
    public $data_validade_fim;
    public $uso_maximo;
    public $uso_por_cliente;
    public $valor_minimo_pedido;
    public $status;

    public function __construct() {
        $this->conn = (new BancoDeDados())->Conexao();
    }

    public function read($where ="") {
        $query = "SELECT * FROM " . $this->nomeTabela." WHERE 1=1 ".$where;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Método para criar cupom
    public function create() {
        $query = "INSERT INTO " . $this->nomeTabela . " 
            (codigo, tipo_desconto, valor_desconto, data_validade_inicio, data_validade_fim, uso_maximo, uso_por_cliente, valor_minimo_pedido, status) 
            VALUES 
            (:codigo, :tipo_desconto, :valor_desconto, :data_validade_inicio, :data_validade_fim, :uso_maximo, :uso_por_cliente, :valor_minimo_pedido, :status)";
        
        $stmt = $this->conn->prepare($query);
        
        // Limpar dados
        $this->codigo = htmlspecialchars(strip_tags($this->codigo));
        $this->tipo_desconto = htmlspecialchars(strip_tags($this->tipo_desconto));
        $this->valor_desconto = htmlspecialchars(strip_tags($this->valor_desconto));
        $this->data_validade_inicio = htmlspecialchars(strip_tags($this->data_validade_inicio));
        $this->data_validade_fim = htmlspecialchars(strip_tags($this->data_validade_fim));
        $this->uso_maximo = htmlspecialchars(strip_tags($this->uso_maximo));
        $this->uso_por_cliente = htmlspecialchars(strip_tags($this->uso_por_cliente));
        $this->valor_minimo_pedido = htmlspecialchars(strip_tags($this->valor_minimo_pedido));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // Bind parâmetros
        $stmt->bindParam(':codigo', $this->codigo);
        $stmt->bindParam(':tipo_desconto', $this->tipo_desconto);
        $stmt->bindParam(':valor_desconto', $this->valor_desconto);
        $stmt->bindParam(':data_validade_inicio', $this->data_validade_inicio);
        $stmt->bindParam(':data_validade_fim', $this->data_validade_fim);
        $stmt->bindParam(':uso_maximo', $this->uso_maximo);
        $stmt->bindParam(':uso_por_cliente', $this->uso_por_cliente);
        $stmt->bindParam(':valor_minimo_pedido', $this->valor_minimo_pedido);
        $stmt->bindParam(':status', $this->status);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function fill(array $data): void {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = htmlspecialchars(strip_tags($value));
            }
        }
    }

    // Método para verificar a validade do cupom
    public function verificarCupom($codigo) {
        $query = "SELECT * FROM " . $this->nomeTabela . " 
            WHERE codigo = :codigo 
            AND status = 'ativo' 
            AND data_validade_inicio <= CURDATE() 
            AND data_validade_fim >= CURDATE() 
            LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para validar o uso do cupom
    public function validarUsoCupom($idCupom, $idCliente) {
        // Verificar quantas vezes o cliente já usou o cupom
        $query = "SELECT COUNT(*) as total_uso 
                  FROM pedidos 
                  WHERE id_cupom = :idCupom 
                  AND id_cliente = :idCliente";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idCupom', $idCupom);
        $stmt->bindParam(':idCliente', $idCliente);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total_uso'];
    }

    // Método para aplicar o cupom ao valor do pedido
    public function aplicarDesconto($valorPedido, $tipoDesconto, $valorDesconto) {
        if ($tipoDesconto == 'percentual') {
            return $valorPedido - ($valorPedido * ($valorDesconto / 100));
        } else if ($tipoDesconto == 'valor_fixo') {
            return max(0, $valorPedido - $valorDesconto); // Garante que o valor do pedido nunca seja negativo
        }
        return $valorPedido;
    }
}
