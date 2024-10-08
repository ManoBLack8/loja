<?php
namespace App\Controllers;

use App\Model\Imagen;
use Config\BancoDeDados;
class ApiController extends Controller{

    function index($oi){
        echo $oi;
    }
    function inserirImagenProduto($id, $arquivo){
        $imagens = new Imagen();
        $imagens->inserirImagemProduto($id, $arquivo);

    }
    function listarImagens($id){
        $imagens = new Imagen();
        $imagens->listarImagensProduto($id);
    }
}