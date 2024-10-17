<div class="entregas" width="200">
        <div class="formulario_entrega">
        <label class="label_entrega row" onclick="marcardesmarcar()">
        <input type="radio" class="marcar" name="fretes" id="frete" value=" 00.00, Sacolinha, Encontrei">
        <img src="icones e logos/Prancheta 2 cópia 2.png" class="img_entrega" alt="Sacolinha">
        <h4>Sacolinha</h4>
        <p>Reserva o produto por 2 meses</p>
        <h5>R$ 00.00</h5>
    </label>
        
        <?php
            if(isset($city)){
                if ($city == "Cuiabá" or $city == "Várzea Grande") {
                        $frete_price = "10.00";
                        if ($city == "Várzea Grande") {
                            $frete_price = "13.00";
                        }
                        $frete_name = "Motoboy";
                        $frete_company_name = "Encontrei";
                        $frete_picture_company = "icones e logos/Camada 1.png";
                        $frete_delivery_time = "aos sabados";
                        $day = "";

                        ?>
                        <label class="label_entrega row" onclick="marcardesmarcar()">
                            <input type="radio" class="marcar" name="fretes" id="frete" value="<?= $frete_price ?>,<?= $frete_name ?>,<?= $frete_company_name ?>">
                            <img src="<?= $frete_picture_company ?>" class="img_entrega" alt="<?= $frete_name ?>">
                            <h4><?= $frete_name ?></h4>
                            <p><?= $frete_delivery_time ?> <?= $day ?></p>
                            <h5>R$ <?= $frete_price ?></h5>
                        </label>
                     <?php } ?>
            <?php foreach ($response as $frete){
                $day = "dias";
                if (@$frete->error < 1) { ?>
                    <label class="label_entrega row" onclick="marcardesmarcar()">
                    <input type="radio" class="marcar" name="fretes" id="frete" value="<?= $frete->price ?>,<?= $frete->name ?>,<?= $frete->company->name ?>">
                    <img src="<?= $frete->company->picture ?>" class="img_entrega" alt="<?= $frete->name ?>">
                    <h4><?= $frete->name ?></h4>
                    <p><?= $frete->delivery_time ?> <?= $day ?></p>
                    <h5>R$ <?= $frete->price ?></h5>
                </label><?php } ?>
            <?php } ?>
        </div>
    <?php } ?>

    
</div>
</body>
<script>