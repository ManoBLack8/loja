<?php
require_once("cabecalho.php");
$id_usuario = $_SESSION['id_usuario'];
$query2 = $pdo->query("SELECT * FROM andress where id_usuario = '" . $id_usuario . "'");
@$ress = $query2->fetchAll(PDO::FETCH_ASSOC);
@$cep = $ress[0]['cep'];
  $token_type = "Bearer";
  $expires_in = 2592000;
  $access_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBkNDI2YmU5NWZkZTczN2UxNjMwODcwMjJhMzY1ZGRkOWViMjE1ZTkxODc2OWUxZjlmZGY2MDViZjM0Yzk2OWE5NjJkZTQ1YTMxMjMzY2FlIn0.eyJhdWQiOiIxNDM3IiwianRpIjoiMGQ0MjZiZTk1ZmRlNzM3ZTE2MzA4NzAyMmEzNjVkZGQ5ZWIyMTVlOTE4NzY5ZTFmOWZkZjYwNWJmMzRjOTY5YTk2MmRlNDVhMzEyMzNjYWUiLCJpYXQiOjE2MjY4MzE2MDEsIm5iZiI6MTYyNjgzMTYwMSwiZXhwIjoxNjI5NDIzNjAxLCJzdWIiOiI5ODkwYmEwZC1lMGNlLTRjZDUtYjJjYy01MjIzNmJjZTdlNjYiLCJzY29wZXMiOlsic2hpcHBpbmctY2FsY3VsYXRlIl19.prt5ShcJr6T9p_p-yZFbrMfyY_uIbBe20HG7B4bTmddMnR0a-o-HrKBdD14ZFC8ofgc_ezVz9N7w4hkO4t4I2hduP93ncI9BfuDZbfN_U26LXP9_oJP4yJZgKYjBuEwfyXqg6sozZ2uipx-k5Y5Mq-ldiD7vM8i8pmNsvKQWNIi7NgnCTZS6iBS1lFGZuvuVcZvS_SPf63KCZYBhiZAdvgzqnOEf5nOmJXOE4ygxueso6yhwqgJOCXO2dIEwxSS8IyYIDfFHj0SyD6M1DtuYPsic2DZwPFOw09YkiwTgPryBd2o2NR7FCkyky28D-82V84R5XH_Fj5yidvHLQNHe7ujoss6pecgmKIM_pKmdxSFB2TjY36XAGnzX6BfC4t5pOQrKc4vapeA5_bUgJNz9W5NvpADNigkIrBF2UutkcePi-VTZYZEtdBw_eP6VJbz4usfXtOtBjiFFuCObN40XoPV5OzT4LPFKEPM2N0wLQs7hZAV2dpDN1bLhPIfVgcUGuCjV9IljcOQz_bIkBOKQoCvl3NPUaLpmeM3Src0Pjho11oHTPTWDObPUVKeTXPOge6MCrWtyXhWqnz_856zaTpp8LUn5dFS1PUHOaauMd3zMXwv3_BRlt6udgSLEaj10xQg03A2w7EgAm4st4GvaN3OTFj46GFf1r4RS8yXmJG8";
  $refresh_token = "def502005b7d2e9e0830f9d1c777b1737cd3db8c037768300ef56f504d9a9ad1ffd181fe07dc51bfc69cf9390ee3e6a996febd42ec30a52d65fbc7d92a3773e00fc14dae3a47dd3e3b2f267d5d7d63f3d0bda22cfeb02bb771a8659b46bedcc578fd3122acc7805b1fa7e19a3d549c07082ecce6d33b28cf64e1159588455a74166f360b75662f79c7912886eb95f5d0a2c8210d505e3870cec6c4bd07479a0d57e3a163899adf0d180591820349a324e002ce546d657c3ebd8e0c16ba5a07af7da1b3299072807c4ac661faf3d5ac1335ac443c124272563446b88698ad688f32478cb010585a06a5f0c586e89584e3c4a8baea7a2a557ed4f93f16d39d9b277786b317e7dbf41d8142760d8b80e005bbeaa03adfa9c3227eea55bdf7376810ecb25c6521dedcb360fd894174816f9ac8075a7fafa9f12463ece0453cf6dfac4a33e8591abe2fc3d102ceab521fe31b071bf6645c8d08e5ca5b02685532a1a32206fcf4d739ae8a78de99e0b92060a8095669436b930321551b30f837331be052045d0ec83e918fc70b81f5c7f6f85c0e3ce7f2ce085c7c1137ee7eed";

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
        "postal_code": "'.$cep.'"
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

?>
<body>
    <section>
        <div class="container">
            <div class="entregas" width="200">
                <form action="venda.php" method="POST">
                    <div class="formulario_entrega">
                        <?php foreach ($response as $frete){
                            if (@$frete->error < 1) { ?>
                            <label class="label_entrega" onclick="marcardesmarcar()">
                                <img src="<?= $frete->company->picture ?>" class="img_entrega" alt="<?= $frete->name ?>">
                                <h3 class="mt-3"><?= $frete->name ?></h3>
                                <h5><?= $frete->price ?></h5>
                                <h6><?= $frete->company->name ?></h6>
                                <p><?= $frete->delivery_time ?> dias</p>
                                <input type="radio" class="marcar" name="fretes[]" id="frete" value="<?= $frete->price ?>">
                                <input type="radio"  class="marcar" name="fretes[1]" value="<?= $frete->name ?>" id="frete">
                                
                            </label><?php } ?>
                        <?php } ?>
                    </div>
                    <button type="submit" class="site-btn entrega-btn">ir para tela de compra</button>
                </form>
                
            </div>
        </div>
    </section>
</body>
<script>
 function marcardesmarcar(){
    radio

   
}
</script>