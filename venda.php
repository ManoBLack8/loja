<?php
require_once("cabecalho.php");
$fretes = explode(",",@$_POST['fretes']);
$fretes_price = $fretes[0];
$fretes_name = $fretes[1];
$fretes_name_company = $fretes[2];

$id_usuario = $_SESSION['id_usuario'];
$query2 = $pdo->query("SELECT * FROM andress where id_usuario = '" . $id_usuario . "'");
@$ress = $query2->fetchAll(PDO::FETCH_ASSOC);
@$cep = $ress[0]['cep'];
@$rua = $ress[0]['rua'];
@$bairro = $ress[0]['bairro'];
@$cidade = $ress[0]['cidade'];
@$estado = $ress[0]['estado'];
@$lote = $ress[0]['lote'];
@$complemento = $ress[0]['complemento'];




?>
<body>
<section>
    <div class="container">
        <div class="venda_tela">
            <form action="https://pagseguro.uol.com.br/v2/checkout/payment.html" method="post">
                <div class="col-lg-12 col-md-12">
                    <div class="checkout__order">
                        <h4>Seu pedido</h4>
                        <div class="checkout__order__products">Produtos</div>
                        <?php
                        $id2 = $_SESSION['id_usuario'];
                        $query = $pdo->query("SELECT * FROM carrinho where situ = 'disponivel' and id_usuario =  $id2 order by id desc ");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                        
                        for ($i=0; $i < count($res); $i++) { 
                            
                        $idc = $res[$i]['id_produto'];
                        $id = $res[$i]['id'];
                        $query2 = $pdo->query("SELECT * FROM produtos where id = '" . $idc . "'");
                        @$ress = $query2->fetchAll(PDO::FETCH_ASSOC);
                        @$nomecar = $ress[0]['nome'];
                        @$imagemc = $ress[0]['imagem'];
                        @$valorcar = $ress[0]['valor'];
                        @$idp = $ress[0]['id'];
                        @$peso = $ress[0]['peso'];
                        @$total_produtos = $valorcar + $total_produtos;
                        $frete = 7.0;
                        $total = $fretes_price + $total_produtos;
                        
                        $a = $i + 1;
                        
                        if ($idp == null) {
                            Addsitu($idp,$id2);
                        }?>

                        <input name="itemId<?=$a?>" type="hidden" value="<?= $idp ?>">
                        <input name="itemDescription<?=$a?>" type="hidden" value="<?= $nomecar?>">  
                        <input name="itemAmount<?=$a?>" type="hidden" value="<?= $valorcar?>">  
                        <input name="itemQuantity<?=$a?>" type="hidden" value="1"> 
                        <input name="itemWeight<?=$a?>" type="hidden" value="<?= $peso ?>">

                        <ul>
                            <li><?= $nomecar ?><span>R$ <?= $valorcar?></span></li>
                        </ul><?php } 
                        
                        $b = count($res) + 1;?>

                        <input name="itemId<?=$b?>" type="hidden" value="1">
                        <input name="itemDescription<?=$b?>" type="hidden" value="frete: <?= $fretes_name?> - <?= $fretes_name_company ?>">  
                        <input name="itemAmount<?=$b?>" type="hidden" value="1.00">  
                        <input name="itemQuantity<?=$b?>" type="hidden" value="1">  

                        


                        <div class="checkout__order__subtotal">Valor<span>R$<?= $total_produtos ?></span></div>
                        <div class="checkout__order__frete">frete: <?= $fretes_name?> - <?=$fretes_name_company ?> <span>R$<?= $fretes_price ?></span></div>
                        <div class="checkout__order__total">Total <span>R$<?= $total?></span></div>
                        
                        
                        <!-- Campos obrigatórios -->  
                        <input name="receiverEmail" type="hidden" value="viniciusfe66@gmail.com">  
                        <input name="currency" type="hidden" value="BRL">  
                        <!-- Código de referência do pagamento no seu sistema (opcional) -->  
                        <input name="reference" type="hidden" value="brecho">  
                        
                        <!-- Informações de frete (opcionais) -->  
                        <input name="shippingType" type="hidden" value="3">
                        <input name="shippingAddressPostalCode" type="hidden" value="<?= $cep ?>">  
                        <input name="shippingAddressStreet" type="hidden" value="<?= $rua ?>">  
                        <input name="shippingAddressNumber" type="hidden" value="<?= $lote ?>">  
                        <input name="shippingAddressComplement" type="hidden" value="<?= $complemento ?>">  
                        <input name="shippingAddressDistrict" type="hidden" value="<?= $bairro ?>">  
                        <input name="shippingAddressCity" type="hidden" value="<?= $cidade ?>">  
                        <input name="shippingAddressState" type="hidden" value="<?= $estado ?>">  
                        <input name="shippingAddressCountry" type="hidden" value="BRA">  
                
                        
                        <!-- Dados do comprador (opcionais) -->   
                        <input name="senderEmail" type="hidden" value="<?= @$_SESSION["nome_usuario"] ?>">  
                        <input name="senderName" type="hidden" value="<?= @$_SESSION["nome_usuario"] ?>">  
                        <input name="senderAreaCode" type="hidden" value="<?= @$_SESSION["ddd_usuario"] ?>">  
                        <input name="senderPhone" type="hidden" value="<?= @$_SESSION["telefone_usuario"] ?>">
                        <input name="senderCpf" type="hidden" value="<?= @$_SESSION["cpf_usuario"] ?>">  


                        <!-- submit do form (obrigatório) -->  
                        <button class="site-btn" type="submit">Comprar com a Pagseguro</button>
                                
                            
                    </div>
                </div>
            </form>

        </div>
    </div>
</section>
</body>