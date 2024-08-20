<?php 
namespace App\Controllers;
use App\Model\Usuario;
use Config\BancoDeDados;
class ShopController
{
    private $db; 
    private $usuario;

    public function __construct() {
        @session_start();
        $database = new BancoDeDados();
        $this->db = $database->Conexao();
        $this->usuario = new Usuario($this->db);
    }

    public function index(){

        require '../app/Views/Shop/index.php';
    }

    
}
