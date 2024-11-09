<?php 
namespace App\Controllers;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

class PagamentoController {

    public function criarPagamento() {
        // Definir as credenciais
        MercadoPagoConfig::setAccessToken($_ENV["APY_ACCESS_TOKEN_MERCADOPAGO"]);

        // Obter dados da requisição
        $dados = json_decode(file_get_contents('php://input'), true);

        $produtoNome = $dados['produtoNome'];
        $produtoPreco = $dados['produtoPreco'];
        $quantidade = $dados['quantidade'];
        $freteValor = $dados['freteValor'];
        $descontoValor = $dados['descontoValor'];

        // Inicializar o cliente PreferenceClient
        $client = new PreferenceClient();

        // Criar a preferência de pagamento
        $preferenceData = [
            "items" => [
                [
                    "title" => $produtoNome,
                    "quantity" => $quantidade,
                    "unit_price" => $produtoPreco - $descontoValor, // Aplicar desconto
                ]
            ],
            "shipments" => [
                "cost" => $freteValor,
                "mode" => "custom" // Frete personalizado
            ],
            "back_urls" => [
                "success" => "http://localhost/loja/checkout/sucesso",
                "failure" => "http://localhost/loja/checkout/falha",
                "pending" => "http://localhost/loja/checkout/pendente"
            ],
            "auto_return" => "approved"
        ];

        // Enviar a preferência e obter a resposta
        $preference = $client->create($preferenceData);

        // Retornar ID da preferência como resposta
        return json_encode(['preferenceId' => $preference->id]);
    }
}
?>
