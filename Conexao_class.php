<?php
class Conexao 
{
    private function conexao()
    {
        require_once("config.php");

        date_default_timezone_set('America/Cuiaba');

        try{
             $pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario","$senha");
        } catch (Exception $e){
            echo "erro ao conectar com banco de dados" .  $e;
        }
        require_once("Controller/funcoes_globais.php");

        return $pdo;
    }

    public static function select($table, $where = null, $data = '*')
    {
        $whereClause = '';
        if ($where !== null) {
            $whereClause = "WHERE $where";
        }
       $sql = self::conexao()->query("SELECT $data FROM $table $whereClause");
       $query = $sql->fetchAll(PDO::FETCH_ASSOC);
       return $query;
    }

    public static function update($table, $data, $where)
    {
        $conexao = self::conexao();

        $set = "";
        foreach ($data as $coluna => $valor) {
            $set .= "$coluna = :$coluna, ";
        }
        $set = rtrim($set, ', ');

        $sql = "UPDATE $table SET $set WHERE $where";

        $stmt = $conexao->prepare($sql);
        $stmt->execute($data);
    }

    public static function delete($table, $where)
    {
        $conexao = self::conexao();

        $sql = "DELETE FROM $table WHERE $where";

        $stmt = $conexao->prepare($sql);
        $stmt->execute();
    }
}


?>