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
        $this->usuario = new Usuario();
    }

    public function index() {
        if ($this->usuario->findByid($_SESSION["usuario"]["id"])){
            $user = $this->usuario->findByid($_SESSION["usuario"]["id"]);
            $this->usuario->sessaoUsuarioInicio();
            $this->render("Usuario/index");
        }else{
            $this->rendirecionar("../Login");
        }
        
    }
}
?>
