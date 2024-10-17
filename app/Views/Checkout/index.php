<?php require_once '../app/Views/layout/cabecalho.php';?>    
  <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Detalhes da cobrança</h4>
                    <form method="post" action="https://pagseguro.uol.com.br/v2/checkout/payment.html">  
                        <div class="row">
                            <div class="col-lg-7 col-md-6">
                                <div class="checkout__input">
                                    <p>CEP<span>*</span></p>
                                    <input name="shippingAddressPostalCode" class="cep" type="postalcode" value="<?= @$cep ?>">
                                </div>
                                <div class="checkout__input">
                                    <p>UF<span>*</span></p>
                                    <input name="shippingAddressState" id="uf" type="text" value="<?= @$estado ?>">
                                </div>
                                <div class="checkout__input">
                                    <p>Cidade<span>*</span></p>
                                    <input name="shippingAddressCity" id="cidade" type="text" value="<?= @$cidade ?>">  
                                </div>
                                <div class="checkout__input">
                                    <p>Bairro<span>*</span></p>
                                    <input name="shippingAddressDistrict" type="text" id="bairro" value="<?= @$bairro ?>"> 
                                </div>
                                <div class="checkout__input">
                                    <p>Endereço<span>*</span></p>
                                    <input name="shippingAddressStreet" placeholder="Nome da Rua" class="checkout__input__add" type="text" value="<?= @$rua ?>"> 
                                    <input class="col-md-2" name="shippingAddressNumber" placeholder="numero" type="text" value="<?= @$lote ?>">
                                </div>
                                <div class="checkout__input">
                                    <p>Complemento<span>*</span></p>
                                    <input name="shippingAddressComplement" type="text" value="<?= @$complemento ?>">  
                                </div>
                                
                                
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Telefone<span>*</span></p>
                                            <input name="senderAreaCode" type="text" id="telefone" class="checkout__input__add phone_with_ddd" placeholder="Numero de telefone" value="<?= @$_SESSION["ddd_usuario"] ?>">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        
                         
                        <div class="col-lg-5 col-md-6">
                        <div class="checkout__order">
                            <h4>Seu pedido</h4>
                            <div class="checkout__order__products">Produtos</div>
                            <?php 
                            foreach($data["produtos"] as $produto){ 
                                $soma = @$soma + $produto["valor"]; ?>

                            <input name="itemId<?=$a?>" type="hidden" value="<?= $produto["id"] ?>">
                            <input name="itemDescription<?=$a?>" type="hidden" value="<?= $produto["nome"] ?>">  
                            <input name="itemAmount<?=$a?>" type="hidden" value="<?= $produto["valor"] ?>">  
                            <input name="itemQuantity<?=$a?>" type="hidden" value="1"> 
                            <input name="itemWeight<?=$a?>" type="hidden" value="<?= $produto["peso"] ?>">

                            <ul>
                                <li><?= $produto["nome"] ?><span>R$ <?= number_format($produto["valor"], 2, ',', '.') ?></span></li>
                            </ul>

                            <!-- <input name="itemId" type="hidden" value="1">
                            <input name="itemDescription" type="hidden" value="frete:">  
                            <input name="itemAmount" type="hidden" value="">  
                            <input name="itemQuantity" type="hidden" value="1"> -->
                            <?php } ?>


                            <div class="checkout__order__subtotal">Valor<span>R$ <?= number_format($soma, 2, ',', '.') ?></span></div>
                            <div class="checkout__order__frete">frete: <?= @$fretes_name?> - <?= @$fretes_name_company ?> <span>R$<?= @$fretes_price ?></span></div>

                            <?php if (isset($_POST["desconto"])) {
                                $total = $valor_descontado; ?>
                                <div class="checkout__order__frete">Desconto <span>-<?= $_POST["desconto"] ?>%</span></div>
                           <?php } ?>
                            <div class="checkout__order__total">Total <span>R$ <?= number_format(@$total+@$soma+@$frete_price, 2, ',', '.') ?></span></div>
                            
                            
                            <!-- Campos obrigatórios -->  
                            <input name="receiverEmail" type="hidden" value="viniciusfe66@gmail.com">  
                            <input name="currency" type="hidden" value="BRL">  
                            <!-- Código de referência do pagamento no seu sistema (opcional) -->  
                            <input name="reference" type="hidden" value="brecho">  
                            
                            <!-- Informações de frete (opcionais) -->  
                            <input name="shippingType" type="hidden" value="3">

                            <input name="shippingAddressCountry" type="hidden" value="BRA">    

                    
                            
                            <!-- Dados do comprador (opcionais) -->   
                            <input name="senderEmail" type="hidden" value="<?= @$_SESSION["email_usuario"] ?>">  
                            <input name="senderName" type="hidden" value="<?= @$_SESSION["nome_usuario"] ?>"> 
                            <!-- submit do form (obrigatório) -->  
                            <button class="site-btn" type="submit">Comprar com a Pagseguro</button>
                        </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
require_once '../app/Views/layout/Roda_pe.php';
?>  