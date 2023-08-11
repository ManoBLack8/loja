<?php
use Conexao;
class Categorias
{
    public static $nome;
    public static $id;

    public static function chamarCategorias()
    {
        return json_encode(Conexao::select('categorias'));
    }
}