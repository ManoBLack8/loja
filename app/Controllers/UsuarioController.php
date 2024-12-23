<?php
namespace App\Controllers;
use App\Model\Usuario;
use App\Controllers\Controller;
use Config\BancoDeDados;
class UsuarioController extends Controller 
{
    private $usuario;
    public function __construct() {
        @session_start();
        $this->usuario = new Usuario();
    }

    public function index() {
        if ($this->usuario->findByid($_SESSION["usuario"][0]["id"])){
            $user = $this->usuario->findByid($_SESSION["usuario"]["id"]);
            $this->usuario->sessaoUsuarioInicio($user);
            $this->render("Usuario/index");
        }else{
            $this->rendirecionar("../Login");
        }
        
    }
}

