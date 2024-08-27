<?php
namespace App\Model;
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


    public function __construct($db, $id = null) {
        $this->conn = $db;
        // if (@$_SESSION["usuario"] != null){
        //     $usuario = Self::findBYid($_SESSION["usuario"]["id"]);
        //     $this->id = $usuario[0]['id'];
        //     $this->nome = $usuario[0]['nome'];
        //     $this->email = $usuario[0]['email'];
        //     $this->senha = $usuario[0]['senha'];
        //     $this->documento = $usuario[0]['documento'];
        //     $this->sexo = $usuario[0]['sexo'];
        //     $this->dtNascimento = $usuario[0]['dtNascimento'];
        //     $this->nivelAcesso = $usuario[0]['nivelAcesso'];
        //     $this->ipUsuario = $usuario[0]['ipUsuario'];
        //     $this->navegadorUsuario = $usuario[0]['navegadorUsuario'];
        //     $this->ultimoAcesso = $usuario[0]['ultimoAcesso'];
        //     $this->dtCriacao = $usuario[0]['dtCriacao'];
        //     $this->endereco_id = $usuario[0]['endereco_id'];
    
        // }
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->nomeTabela;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->nomeTabela . " 
        SET nome=:nome, email=:email, senha=:senha, telefone=:telefone, dtNacimento=:dtNacimento, sexo=:sexo, documento=:documneto, nivelAcesso=:nivelAcesso, ipUsuario=:ipUsuario, navegadorUsuario=:navegadorUsuario, ultimoAcesso=:ultimoAcesso, dtCriacao=:dtCriacao, endereco_id ";
        $stmt = $this->conn->prepare($query);
    
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->sexo = htmlspecialchars(strip_tags($this->sexo));
        $this->dtNascimento
 = htmlspecialchars(strip_tags($this->dtNascimento));
        $this->documento = htmlspecialchars(strip_tags($this->documento));
        

    
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', md5($this->senha));
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':dtNacimento', $this->dtNascimento);
        $stmt->bindParam(':sexo', $this->sexo);
        $stmt->bindParam(':documento', $this->documento);
        $stmt->bindParam(':ipUsuario', $_SERVER["REMOTE_ADDR"]);
        $stmt->bindParam(':navegadorUsuario', $_SERVER['HTTP_USER_AGENT']);
        $stmt->bindParam(':ultimoAcesso', date("Y-m-d h:i:s"));
        $stmt->bindParam(':dtCriacao', date("Y-m-d h:i:s"));
        $stmt->bindParam(':endereco_id', null);

        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }

    public function update() {
        $query = "Update " . $this->nomeTabela . " 
        SET nome=:nome, email=:email, senha=:senha, telefone=:telefone, dtNacimento=:dtNacimento, sexo=:sexo, documento=:documneto, nivelAcesso=:nivelAcesso, ipUsuario=:ipUsuario, navegadorUsuario=:navegadorUsuario, ultimoAcesso=:ultimoAcesso, dtCriacao=:dtCriacao, endereco_id=:endereco_id WHERE id=:id";
        $stmt = $this->conn->prepare($query);
    
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->sexo = htmlspecialchars(strip_tags($this->sexo));
        $this->dtNascimento
 = htmlspecialchars(strip_tags($this->dtNascimento));
        $this->ipUsuario = htmlspecialchars(strip_tags($this->ipUsuario));
        $this->navegadorUsuario = htmlspecialchars(strip_tags($this->navegadorUsuario));
        $this->ultimoAcesso = htmlspecialchars(strip_tags($this->ultimoAcesso));
        $this->dtCriacao = htmlspecialchars(strip_tags($this->dtCriacao));
        $this->endereco_id = htmlspecialchars(strip_tags($this->endereco_id));

    
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', md5($this->senha));
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':dtNacimento', $this->dtNascimento);
        $stmt->bindParam(':sexo', $this->sexo);
        $stmt->bindParam(':documento', $this->documento);
        $stmt->bindParam(':ipUsuario', $this->ipUsuario);
        $stmt->bindParam(':navegadorUsuario', $this->navegadorUsuario);
        $stmt->bindParam(':ultimoAcesso', $this->ultimoAcesso);
        $stmt->bindParam(':dtCriacao', $this->dtCriacao);
        $stmt->bindParam(':endereco_id', $this->endereco_id);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }

    public function findByid($id){

        $query = 'SELECT * FROM ' . $this->nomeTabela . ' WHERE id=:id LIMIT 1';
        $stmt = $this->conn->prepare($query);
        
        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(':id', $id);
    
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);  // Retorne os dados do usuário
        }
        return false;

    }
    
    
}
?>
