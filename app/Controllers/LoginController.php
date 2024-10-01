<?php
namespace App\Controllers;

use App\Model\Usuario;

class LoginController extends Controller {

    public function index() {
        session_start();
        if($_SESSION["usuario"]["nivelAcesso"] == 'usuario'){
            $this->rendirecionar("../Usuario");
        }
        
        if($_SESSION["usuario"]["nivelAcesso"] == 'admin'){
            $this->rendirecionar("../Admin");
        }
        $usuario = new Usuario();
        $emailDocumento = $_POST["email_login"] ?? null;
        $senha = $_POST["senha_login"] ?? null;
        if ($emailDocumento && $senha) {
            $usuario->setEmail($emailDocumento);
            $usuario->setDocumento($emailDocumento);
            $usuario->setSenha($senha);
            if ($usuario->loginUsuario()) {
                if($usuario->getNivelAcesso() == 'admin'){
<<<<<<< HEAD
                    $this->Modal('Usuário autenticado com sucesso', 'success');
=======
                    //$this->Modal('Usuário autenticado com sucesso', 'success');
>>>>>>> 34308f421c061bcada8cd3c39a97c39b93b9cfa0
                    $this->rendirecionar("../Admin");

                }else{
                    $this->Modal('Usuário autenticado com sucesso', 'success');
                    $this->rendirecionar("../Usuario");                    
                }

            } else {
                // Falha no login
                echo "Usuário ou senha inválidos";
                $this->render("Login");
            }
        } else {
            // Campos não preenchidos
            echo "Preencha todos os campos.";
            $this->render("Login");
        }
    }
}
