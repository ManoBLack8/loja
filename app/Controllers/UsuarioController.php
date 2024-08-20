<?php
namespace App\Controllers;
use App\Model\Usuario;
use App\Controllers\Controller;
use Config\BancoDeDados;
class UsuarioController extends Controller 
{
    private $db;
    private $usuario;
    private $usuarios;
    private $salas;
    public function __construct() {
        @session_start();
        $database = new BancoDeDados();
        $this->db = $database->Conexao();
        $this->usuario = new Usuario($this->db);
    }

    public function index() {
       
        
    }
}
?>
