<?php
namespace App\Controllers;

use App\Model\Imagen;
use Config\BancoDeDados;
class ApiController extends Controller{

    function index($oi){
        echo $oi;
    }
    function inserirImagenProduto($id){
        $imagens = new Imagen();
        $imagens->inserirImagemProduto(1);

    }
    function listarImagens(){
        include "../api/Ajax/listarImagens.phpj";
    }
}