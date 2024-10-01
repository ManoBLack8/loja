<?php
  $token_type = "Bearer";
  $expires_in = 2592000;
  $access_token = $_ENV["ACCESS_TOKEN_MELHOR_ENVIO"];
  $refresh_token = $_ENV["REFRESH_TOKEN_MELHOR_ENVIO"];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/calculate',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "from": {
        "postal_code": "78090000"
    },
    "to": {
        "postal_code": "01018020"
    },
    "products": [
        {
            "id": "1",
            "width": 11,
            "height": 17,
            "length": 11,
            "weight": 0.3,
            "insurance_value": 10.1,
            "quantity": 1
        },
        {
            "id": "2",
            "width": 16,
            "height": 25,
            "length": 11,
            "weight": 0.3,
            "insurance_value": 55.05,
            "quantity": 2
        },
        {
            "id": "3",
            "width": 22,
            "height": 30,
            "length": 11,
            "weight": 1,
            "insurance_value": 30,
            "quantity": 1
        }
    ]
}',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Content-Type: application/json',
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBkNDI2YmU5NWZkZTczN2UxNjMwODcwMjJhMzY1ZGRkOWViMjE1ZTkxODc2OWUxZjlmZGY2MDViZjM0Yzk2OWE5NjJkZTQ1YTMxMjMzY2FlIn0.eyJhdWQiOiIxNDM3IiwianRpIjoiMGQ0MjZiZTk1ZmRlNzM3ZTE2MzA4NzAyMmEzNjVkZGQ5ZWIyMTVlOTE4NzY5ZTFmOWZkZjYwNWJmMzRjOTY5YTk2MmRlNDVhMzEyMzNjYWUiLCJpYXQiOjE2MjY4MzE2MDEsIm5iZiI6MTYyNjgzMTYwMSwiZXhwIjoxNjI5NDIzNjAxLCJzdWIiOiI5ODkwYmEwZC1lMGNlLTRjZDUtYjJjYy01MjIzNmJjZTdlNjYiLCJzY29wZXMiOlsic2hpcHBpbmctY2FsY3VsYXRlIl19.prt5ShcJr6T9p_p-yZFbrMfyY_uIbBe20HG7B4bTmddMnR0a-o-HrKBdD14ZFC8ofgc_ezVz9N7w4hkO4t4I2hduP93ncI9BfuDZbfN_U26LXP9_oJP4yJZgKYjBuEwfyXqg6sozZ2uipx-k5Y5Mq-ldiD7vM8i8pmNsvKQWNIi7NgnCTZS6iBS1lFGZuvuVcZvS_SPf63KCZYBhiZAdvgzqnOEf5nOmJXOE4ygxueso6yhwqgJOCXO2dIEwxSS8IyYIDfFHj0SyD6M1DtuYPsic2DZwPFOw09YkiwTgPryBd2o2NR7FCkyky28D-82V84R5XH_Fj5yidvHLQNHe7ujoss6pecgmKIM_pKmdxSFB2TjY36XAGnzX6BfC4t5pOQrKc4vapeA5_bUgJNz9W5NvpADNigkIrBF2UutkcePi-VTZYZEtdBw_eP6VJbz4usfXtOtBjiFFuCObN40XoPV5OzT4LPFKEPM2N0wLQs7hZAV2dpDN1bLhPIfVgcUGuCjV9IljcOQz_bIkBOKQoCvl3NPUaLpmeM3Src0Pjho11oHTPTWDObPUVKeTXPOge6MCrWtyXhWqnz_856zaTpp8LUn5dFS1PUHOaauMd3zMXwv3_BRlt6udgSLEaj10xQg03A2w7EgAm4st4GvaN3OTFj46GFf1r4RS8yXmJG8',
    'User-Agent: Aplicação viniciusfe66@gmail.com'
  ),
));

$response = json_decode(curl_exec($curl));

curl_close($curl);
require_once("cabecalho.php");
?>
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
        