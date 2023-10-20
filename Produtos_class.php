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
    
    public static function autenticarLogin($user, $senha)
    {
        $usuarios = Conexao::select('usuarios', "email = $user AND senha = $senha");
        if(count($usuarios) > 1){
            session_start();
            $_SESSION["cliente"]["id"] = $usuarios[0]["id"];
            $_SESSION["cliente"]["nome"] = $usuarios[0]["nome"];
            $_SESSION["cliente"]["email"] = $usuarios[0]["email"];
            $_SESSION["cliente"]["nivel"] = $usuarios[0]["nivel"];

        }else{
            return "USUARIO NÃO EXISTE";
        }
    }
}
?>