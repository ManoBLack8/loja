<?php
 require_once '../app/Views/layout/cabecalho.php'; ?>
<section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Produtos</th>
                                    <th>Preço</th>
                                    <th>fechar</th>
                                </tr>
                            </thead>
                            <?php 
                            foreach($data['carrinho'] as $carrinho) { 
                                $soma = @$soma + $carrinho["valor"];
                                ?>
                            
                            <tbody>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="./src/img/produtos/<?= $carrinho['imagem'] ?>"  alt="">
                                        <h5><?= $carrinho['nome'] ?></h5>
                                    </td>
                                    
                                    <td class="shoping__cart__total">
                                        R$ <?= number_format($carrinho['valor'], 2, ',', '.') ?>
                                    </td>
                                    <td>
                                    <a width="120" href="" class='text-danger mr-1' onclick="deletarCarrinho(<?= $carrinho['id'] ?>)" title="Excluir registro"><i class="fa fa-2x fa-times"></i></a>
                                    </td>
                                </tr>
                                
                            </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="Shop" class="primary-btn cart-btn">CONTINUE COMPRANDO</a>
                        <a href="Carrinho" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Atualizar carrinho</a>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Codigos de desconto</h5>
                            <form action="#">
                                <input type="text" name="cupom" placeholder="Adicione seu cupom">
                                <button type="submit" id="btn-cupom" class="site-btn">Aplicar desconto</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Calcular frete</h5>
                            <form action="../checkout" method="POST">
                                <input type="postalcode" class="cep" width="20" name="cep" placeholder="Adicione seu cupom" id="cep">
                                <input type="hidden" width="20" name="city" placeholder="Adicione seu cupom" id="cidade">
                                <button type="submit" id="btn-calcular"
                                class="site-btn">Calcular</button>
                                <div id="cupom"></div>
                            <div id="entregas"></div> 
                        </div>
                    </div>
                    <div class="shoping__checkout">
                        <h5>Total Carrinho</h5>
                        <ul>
                            <li>Total de produtos <span>R$ <?= number_format($data["totalCarrinho"] == '0,00' ? $soma : $data["totalCarrinho"], 2, ',', '.')  ?></span></li>
                        </ul>
                        <button type="submit" class="site-btn">Tela de vendas</button>
                    </div></form>
                </div>
            </div>
        </div>
    </section>
<?php require_once '../app/Views/layout/Roda_pe.php'?>

<Script>
        function deletarCarrinho(produtoId) {
        // Previne o comportamento padrão do link
        event.preventDefault();
        // Envia a requisição AJAX
        $.ajax({
            url: 'api/carrinhoDeletar',
            type: 'POST',
            data: { id: produtoId },
            success: function(response) {
                console.log(response);
                // Atualiza a quantidade de itens no carrinho
                $('#carrinhoQuantidade').text(response.quantidadeCarrinho);
                window.location = 'carrinho';
            },
            error: function() {
                alert('Erro ao adicionar o produto ao carrinho.');
            }
        });
    }
</Script>