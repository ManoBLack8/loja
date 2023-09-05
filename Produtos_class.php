<?php 
use Conexao;
class produtos
{
    public static function chamarProdutos()
    {
        return json_encode(Conexao::select('produtos')); 
    }

    public static function chamarProdutoEsp($id) {
        return json_encode(Conexao::select('produtos', "id = $id"));
    }

    public static function imagensProdutos($id)
    {
        return json_encode(Conexao::select('imagens', "id_produto = $id"));
    }
    
}
?>