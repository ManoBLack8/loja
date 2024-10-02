<?php
namespace App\Model;

use Config\BancoDeDados;
use PDO;

class Usuario 
{
    private $conn;
    private $nomeTabela = 'usuarios';

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $documento;
    private $sexo;
    private $telefone;
    private $dtNascimento;
    private $nivelAcesso;
    private $ipUsuario;
    private $navegadorUsuario;
    private $ultimoAcesso;
    private $dtCriacao;
    private $endereco_id;

    public function __construct() {
        $this->conn = (new BancoDeDados())->Conexao();
    }

    // Getters e Setters gerados de forma automática para maior simplicidade

    
    public function getEmail(){
        return $this->email;
    }

    public function setDocumento($documento){
        $this->documento = $documento;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function getNivelAcesso(){
        return $this->nivelAcesso;
    }
    public function setUltimoAcesso($ultimoAcesso){
        $this->ultimoAcesso = $ultimoAcesso;
    }
    public function read() {
        $query = 'SELECT * FROM ' . $this->nomeTabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->nomeTabela . " 
        SET nome=:nome, email=:email, senha=:senha, telefone=:telefone, dtNascimento=:dtNascimento, sexo=:sexo, documento=:documento, nivelAcesso=:nivelAcesso, ipUsuario=:ipUsuario, navegadorUsuario=:navegadorUsuario, ultimoAcesso=:ultimoAcesso, dtCriacao=:dtCriacao, endereco_id=:endereco_id";
        $stmt = $this->conn->prepare($query);

        $this->senha = md5($this->senha);
        $this->ipUsuario = $_SERVER["REMOTE_ADDR"];
        $this->navegadorUsuario = $_SERVER['HTTP_USER_AGENT'];
        $this->ultimoAcesso = date("Y-m-d H:i:s");
        $this->dtCriacao = date("Y-m-d H:i:s");

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':dtNascimento', $this->dtNascimento);
        $stmt->bindParam(':sexo', $this->sexo);
        $stmt->bindParam(':documento', $this->documento);
        $stmt->bindParam(':nivelAcesso', $this->nivelAcesso);
        $stmt->bindParam(':ipUsuario', $this->ipUsuario);
        $stmt->bindParam(':navegadorUsuario', $this->navegadorUsuario);
        $stmt->bindParam(':ultimoAcesso', $this->ultimoAcesso);
        $stmt->bindParam(':dtCriacao', $this->dtCriacao);
        $stmt->bindParam(':endereco_id', $this->endereco_id);

        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->nomeTabela . " 
        SET nome=:nome, email=:email, senha=:senha, telefone=:telefone, dtNascimento=:dtNascimento, sexo=:sexo, documento=:documento, nivelAcesso=:nivelAcesso, ipUsuario=:ipUsuario, navegadorUsuario=:navegadorUsuario, ultimoAcesso=:ultimoAcesso, dtCriacao=:dtCriacao, endereco_id=:endereco_id 
        WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->senha = md5($this->senha);
        
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':dtNascimento', $this->dtNascimento);
        $stmt->bindParam(':sexo', $this->sexo);
        $stmt->bindParam(':documento', $this->documento);
        $stmt->bindParam(':nivelAcesso', $this->nivelAcesso);
        $stmt->bindParam(':ipUsuario', $this->ipUsuario);
        $stmt->bindParam(':navegadorUsuario', $this->navegadorUsuario);
        $stmt->bindParam(':ultimoAcesso', $this->ultimoAcesso);
        $stmt->bindParam(':dtCriacao', $this->dtCriacao);
        $stmt->bindParam(':endereco_id', $this->endereco_id);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function findByid($id) {
        $query = 'SELECT * FROM ' . $this->nomeTabela . ' WHERE id=:id LIMIT 1';
        $stmt = $this->conn->prepare($query);

        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(':id', $id);
    
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function loginUsuario(){
        $query = 'SELECT * FROM ' . $this->nomeTabela . ' WHERE email=:email AND senha=:senha LIMIT 1';
        $stmt = $this->conn->prepare($query);
        
        //$this->senha = md5($this->senha);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);
    
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($user = (object) $user[0]) {
            $this->sessaoUsuarioInicio($user);
            return true;
        }

        return false;
    }

    public function sessaoUsuarioInicio($user) {
        $_SESSION["usuario"] = (array) $user;
    }

    public function logout() {
        @$_SESSION ["usuario"] = null;
        @session_start();
        @session_destroy();
    }
}
?>
