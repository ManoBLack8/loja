<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
    <form action="">
    <div class="row">
        <input type="text" id="Numerocartao">
        <div class="bandeira"></div>
        <div class=parcela>
            <select name="QtdParcelas" id="QtdParcelas">
            <option value="">selecione</option>
        </select>
        </div>
    </div>

    
    </form>

    </div>
</body>
<?php require_once("../Roda_pe.php"); ?>
<script type="text/javascript" src=
"https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script src="../js/pagseguro.js"></script>
</html>