<?php require_once '../app/Views/layout/cabecalho.php';
?>   
   <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="../src/img/produtos/<?= $data['produtos']['imagem']  ?>" width="470"  alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <?php
                        foreach($data['imagensProdutos'] as $imagens){ ?>
                            <img data-imgbigurl="../src/img/produtos/<?= $imagens['imagens'] ?>"
                                src="../src/img/produtos/<?= $imagens['imagens'] ?>" alt=""> 
                        <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?= $data['produtos']['nome'] ?></h3>
                        <div class="product__details__price">R$ <?= $data['produtos']['valor'] ?></div>
                        <p>
                        <?= $data['produtos']['descricao'] ?>
                        </p>
                          <a class="site-btn" href="checkout.php?id=<?= $data['produtos']['id'] ?>">Comprar</a>
                        <ul>
                            <li><b>Tamanho:</b> <span><?= $data['produtos']['tamanho'] ?></span></li>
                            <li><b>Tamanho veste:</b> <span><?= $data['produtos']['tamanhoVeste'] ?></span></li>
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
require_once '../app/Views/layout/Roda_pe.php';
?>  