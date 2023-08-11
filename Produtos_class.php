<?php 
use Conexao;
class produtos
{
    private static $nome = $_REQUEST['nome'];
    private static $imagem = $_REQUEST['imagem'];
    private static $tamanho = $_REQUEST['tamanho'];
    private static $descricao = $_REQUEST['descricao'];
    private static $valor = $_REQUEST['valor'];
    private static $tamanho_veste = $_REQUEST['tamanho_veste'];
    private static $peso = $_REQUEST['peso'];
    private static $id = $_REQUEST['id'];

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