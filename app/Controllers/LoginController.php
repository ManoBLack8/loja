<?php
namespace App\Controllers;

use App\Model\Usuario;

class LoginController extends Controller {

    public function index() {
        session_start();
        if(@$_SESSION["usuario"][0]["nivelAcesso"] == 'usuario'){
            $this->rendirecionar("../Usuario");
        }
        if(@$_SESSION["usuario"][0]["nivelAcesso"] == 'admin'){
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
                if(@$usuario->getNivelAcesso() == 'admin'){
                    $this->rendirecionar("../admin/index");

                }else{
                    $this->Modal('Usuário autenticado com sucesso', 'success');
                    $this->rendirecionar("../Usuario/index");                    
                }

            } else {
                // Falha no login
                echo "Usuário ou senha inválidos";
                $this->render("Login/index");
            }
        } else {
            if($_POST){
                $this->Modal("Preencha todos os campos.", "danger");
                $this->render("Login/index");
            }
            else{
                $this->render("Login/index");
            }
        }
    }
}
