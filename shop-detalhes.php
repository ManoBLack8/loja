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
   $peso2 = $res[0]['peso'];
   $id = $res[0]['id'];
    

   $valor = number_format($valor2, 2, ',', '.');

$query2 = $pdo->query("SELECT * FROM imagens where id_produto = '" . $id . "' ");
$ress = $query2->fetchAll(PDO::FETCH_ASSOC);
?>

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="img/produtos/<?php echo $imagem2 ?>" width="470"  alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <?php
                   for ($i=0; $i < count($ress); $i++) {
                        $id = $ress[$i]['id'];
                        $imagem = $ress[$i]['imagens'];
                       ?>
                            <img data-imgbigurl="img/produtos/<?= $imagem ?>"
                                src="img/produtos/<?= $imagem ?>" alt=""> <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?= $nome2 ?></h3>
                        <div class="product__details__price">R$<?= $valor ?></div>
                        <p>
                        <?= $desc2 ?>
                        </p>
                          <a class="site-btn" href="checkout.php?id=<?= $id2?>">Comprar</a>
                        <ul>
                            <li><b>Tamanho:</b> <span><?= $tamanho2 ?></span></li>
                            <li><b>Tamanho veste:</b> <span><?= $tamanhove2 ?></span></li>
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