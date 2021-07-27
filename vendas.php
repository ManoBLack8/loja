<?php
require_once("cabecalho.php");
?>
<body>
<section>
    <div class="container">
        <div class="entregas">
            <?php foreach ($response as $frete){ ?>
                <label class="">
                    <img src="<?= $frete->company->picture; ?>" alt="">
                    <h3><?= $frete->name; ?></h3>
                    <p><?= $frete->price; ?></p>
                    <p><?= $frete->company->name; ?></p>
                    <p><?= $frete->discount ?></p>
                    <input type="radio"  name="frete" value="<?= $frete->price ?>">
                </label>
            <?php } ?>

        </div>
    </div>
</section>
</body>