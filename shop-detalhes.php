<?php require_once("cabecalho.php");
$id2 = $_GET['id'];
$query = $pdo->query("SELECT * FROM produtos where id = '" . $id2 . "' ");
   $res = $query->fetchAll(PDO::FETCH_ASSOC);
   $nome2 = $res[0]['nome'];
   $imagem2 = $res[0]['imagem'];
   $tamanho2 = $res[0]['tamanho'];
   $desc2 = $res[0]['descricao'];
   $valor2 = $res[0]['valor'];
   $tamanhove2 = $res[0]['tamanho_veste'];
    

   $valor = number_format($valor2, 2, ',', '.');
   

?>

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="img/produtos/<?php echo $imagem2 ?>"   alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="img/k1.png"
                                src="img/k1.png" alt="">
                            <img data-imgbigurl="img/k2.png"
                                src="img/k2.png" alt="">
                            <img data-imgbigurl="img/k3.png "
                                src="img/k3.png" alt="">
                            <img data-imgbigurl="img/k4.png"
                                src="img/k4.png" alt="">
                            <img data-imgbigurl="img/k5.png"
                                src="img/k5.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $nome2 ?></h3>
                        <div class="product__details__price">R$<?php echo $valor ?></div>
                        <p>
                        <?php echo $desc2 ?>
                        </p>
                        <form method="post" target="pagseguro"  
                        action="https://pagseguro.uol.com.br/v2/checkout/payment.html">  
                                
                                <!-- Campos obrigatórios -->  
                                <input name="receiverEmail" type="hidden" value="viniciusfe66@gmail.com">  
                                <input name="currency" type="hidden" value="BRL">  
                        
                                <!-- Itens do pagamento (ao menos um item é obrigatório) -->  
                                <input name="itemId1" type="hidden" value="<?php echo $id2 ?>">  
                                <input name="itemDescription1" type="hidden" value="<?php echo $nome2 ?>">  
                                <input name="itemAmount1" type="hidden" value="<?php echo $valor2 ?>">  
                                <input name="itemQuantity1" type="hidden" value=1>  
                                <input name="itemWeight1" type="hidden" value="1000">     
                        
                                <!-- Código de referência do pagamento no seu sistema (opcional) -->  
                                <input name="reference" type="hidden" value="encontrei">  
                                <!-- submit do form (obrigatório) -->  
                                <input alt="Pague com PagSeguro" name="submit"  type="image" class="primary-btn"/>  
                                
                        </form>  
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Tamanho:</b> <span><?php echo $tamanho2 ?></span></li>
                            <li><b>Tamanho veste:</b> <span><?php echo $tamanhove2 ?></span></li>
                            <li><b>Compartlhe em:</b>
                                <div class="sharethis-inline-share-buttons"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>  

    <?php
    require_once("Roda_pe.php");
    ?>  