<?php
namespace App\Model;

use Config\BancoDeDados;
use PDO;

class Imagen {

    private $conn;
    private $nomeTabela = 'imagens';
    private $id;
    private $imagens;

    public function __construct() {
        $this->conn = (new BancoDeDados())->Conexao();
    }

    // Define as imagens
    public function setImagens($imagem) {
        $this->imagens = $imagem;
    }

    // Insere uma nova imagem no banco
    public function create($id_produto) {
        $query = "INSERT INTO " . $this->nomeTabela . " (id_produto, imagens) 
                  VALUES (:id_produto, :imagens)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
        $stmt->bindParam(':imagens', $this->imagens, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Recupera as imagens de um produto com base no ID do produto
    public function getImagemByProdutoId($produtoId) {
        $query = "SELECT * FROM " . $this->nomeTabela . " WHERE id_produto = :id_produto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_produto', $produtoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insere uma imagem no banco e faz upload do arquivo
    public function inserirImagemProduto($id_produto, $arquivo) {
        // Diretório onde as imagens serão salvas
        $diretorio = '../../../img/produtos/';
        $nomeImagem = basename($arquivo['name']);
        $caminhoCompleto = $diretorio . $nomeImagem;

        // Validações de arquivo
        $extensao = pathinfo($nomeImagem, PATHINFO_EXTENSION);
        if (!in_array($extensao, ['png', 'jpg', 'jpeg', 'gif'])) {
            throw new \Exception('Extensão de imagem não permitida!');
        }

        // Valida se o diretório existe
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0755, true); // Cria o diretório se não existir
        }

        // Verifica se a imagem já existe, para não sobrescrever
        if (file_exists($caminhoCompleto)) {
            $nomeImagem = time() . '_' . $nomeImagem; // Adiciona timestamp para evitar conflitos
            $caminhoCompleto = $diretorio . $nomeImagem;
        }

        // Move o arquivo para o diretório de destino
        if (!move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)) {
            throw new \Exception('Falha ao fazer o upload da imagem.');
        }

        // Salva o caminho da imagem no banco de dados
        $this->setImagens($nomeImagem);
        if ($this->create($id_produto)) {
            return 'Imagem salva com sucesso!';
        } else {
            throw new \Exception('Erro ao salvar imagem no banco de dados.');
        }
    }

    // Lista todas as imagens de um produto
    public function listarImagensProduto($id_produto) {
        $imagens = $this->getImagemByProdutoId($id_produto);
        if (count($imagens) === 0) {
            return 'Nenhuma imagem encontrada para este produto.';
        }

        echo "<div class='row'>";
        foreach ($imagens as $imagem) {
            echo "<img class='ml-4 mb-2' src='../../src/img/produtos/" . $imagem['imagens'] . "' width='70'>
                  <a href='#' onClick='deletarImg(". $imagem['id'] .")'>
                    <i class='text-danger fas fa-times' style='margin-left: -15px'></i>
                  </a>";
        }
        echo "</div>";
    }

    // Remove uma imagem do banco e do servidor
    public function removerImagem($id_imagem) {
        // Primeiro, obtemos a imagem para excluir do servidor
        $query = "SELECT imagens FROM " . $this->nomeTabela . " WHERE id = :id_imagem";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_imagem', $id_imagem, PDO::PARAM_INT);
        $stmt->execute();
        $imagem = $stmt->fetch(PDO::FETCH_ASSOC)['imagens'];

        // Verifica se a imagem existe e remove do diretório
        $caminhoCompleto = '../../../img/produtos/' . $imagem;
        if (file_exists($caminhoCompleto)) {
            unlink($caminhoCompleto); // Exclui o arquivo do servidor
        }

        // Depois, removemos a entrada do banco de dados
        $query = "DELETE FROM " . $this->nomeTabela . " WHERE id = :id_imagem";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_imagem', $id_imagem, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
