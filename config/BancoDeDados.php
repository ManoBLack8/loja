<?php
namespace Config;
use PDO;
use PDOException;
class BancoDeDados {
    private $servidor = 'localhost';
    private $db_nome = 'loja';
    private $usuario = 'root';
    private $senha = '';
    public $conn;

    public function Conexao() {
        $this->conn = null;
        try {
            date_default_timezone_set("America/Cuiaba");
            $this->conn = new PDO('mysql:host=' . $this->servidor . ';dbname=' . $this->db_nome, $this->usuario, $this->senha);
            $this->conn->exec('set names utf8');
        } catch (PDOException $exception) {
            echo 'Erro na Conexão: ' . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
