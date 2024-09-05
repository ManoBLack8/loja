<?php
namespace App\Controllers;

use App\Model\Usuario;

class LoginController extends Controller {

    public function index() {
        session_start();
        if($_SESSION["usuario"]["nivelAcesso"] == 'usuario'){
            $this->rendirecionar("../Usuario/index");
        }
        
        if($_SESSION["usuario"]["nivelAcesso"] == 'admin'){
            $this->rendirecionar("../Admin/index");
        }
        $usuario = new Usuario();
        $emailDocumento = $_POST["email_login"] ?? null;
        $senha = $_POST["senha_login"] ?? null;
        if ($emailDocumento && $senha) {
            $usuario->email = $emailDocumento;
            $usuario->documento = $emailDocumento;
            $usuario->senha = $senha;
            if ($usuario->loginUsuario()) {
                if($usuario->nivelAcesso == 'admin'){
                    //$this->Modal('Usuário autenticado com sucesso', 'success');
                    $this->rendirecionar("../Admin/index");

                }else{
                    $this->Modal('Usuário autenticado com sucesso', 'success');
                    $this->rendirecionar("../Usuario/index");                    
                }

            } else {
                // Falha no login
                echo "Usuário ou senha inválidos";
                //$this->render("Login/index");
            }
        } else {
            // Campos não preenchidos
            echo "Preencha todos os campos.";
            //$this->render("Login/index");
        }
    }
}
