<body>
    <section>
        <div class="container">
            <div class="entregas" width="200">
                <form action="venda.php" method="POST">
                    <?php foreach ($response as $frete){
                        if (@$frete->error < 1) { ?>
                        <label class="label_entrega">
                            <img src="<?= $frete->company->picture ?>" width="120" alt="<?= $frete->name ?>">
                            <h3><?= $frete->name ?></h3>
                            <h5><?= $frete->price ?></h5>
                            <h6><?= $frete->company->name ?></h6>
                            <p><?= $frete->delivery_time ?> dias</p>
                            <input type="radio" name="frete" id="frete" value="<?= $frete->price?>">
                        </label><?php } ?>
                    <?php } ?>
                    <button type="submit" class="site-btn">ir para tela de compra</button>
                </form>
            </div>
        </div>
    </section>
</body>
