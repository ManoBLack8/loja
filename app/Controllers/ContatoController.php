<?php
namespace App\Controllers;
use App\Controllers\Controller;
class ContatoController extends Controller{

    public function index(){
        $this->render("Contato/index");

    }
}