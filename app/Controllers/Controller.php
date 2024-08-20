<?php 
namespace App\Controllers;
class Controller {

    protected function render($view, $data = []){
        include '../app/Views/'.$view.'.php';
    }

    protected function Modal($texto, $alerta){
        include '../app/Views/Layout/header.php';
        include '../app/Views/Modals/modal.php';
        include '../app/Views/Layout/footer.php';
        include '../app/Views/Modals/executarModal.php';
    }
    
}