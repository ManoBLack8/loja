<?php 
namespace App\Controllers;
use Config\BancoDeDados;

class SandboxController extends Controller {
    
    public function index($id){
        $banco = new BancoDeDados();
        $con = $banco->Conexao();
        $query = $con->query("SELECT * FROM usuarios WHERE id = $id ");
    }
}