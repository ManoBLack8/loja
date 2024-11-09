<?php
namespace App\Models;

class Pagamento {
    public $produtoNome;
    public $produtoPreco;
    public $quantidade;
    public $freteValor;
    public $descontoValor;

    public function __construct($produtoNome, $produtoPreco, $quantidade, $freteValor, $descontoValor) {
        $this->produtoNome = $produtoNome;
        $this->produtoPreco = $produtoPreco;
        $this->quantidade = $quantidade;
        $this->freteValor = $freteValor;
        $this->descontoValor = $descontoValor;
    }
}
?>
