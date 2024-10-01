<?php
namespace App\Controllers;

use Config\BancoDeDados;

class ApiController {

    private $conn;
    function __construct(){
        $this->conn = new BancoDeDados;
        $this->conn = $this->conn->Conexao();
    }
    function inseriImagen(){
        include "../api/Ajax/inserirImagens.php";
    }
    function listarImagens(){
        include "../api/Ajax/listarImagens.phpj";
    }
}