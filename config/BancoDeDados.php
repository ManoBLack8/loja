<?php
namespace Config;
use PDO;
use PDOException;
class BancoDeDados {

    public $conn;

    public function Conexao() {
        $this->conn = null;
        try {
            date_default_timezone_set("America/Cuiaba");
            $this->conn = new PDO('mysql:host=' . $_ENV["BANCO_SERVIDOR"] . ';dbname=' . $_ENV["BANCO_NOME"], $_ENV["BANCO_USUARIO"], $_ENV["BANCO_SENHA"]);
            $this->conn->exec('set names utf8');
        } catch (PDOException $exception) {
            echo 'Erro na Conexão: ' . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
