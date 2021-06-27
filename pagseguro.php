<?php require_once("cabecalho.php"); ?>
<body>
    <div class="container">
    <form action="">
        <div class="row">
        <label for="">Numero do cartão</label>
        <input type="text" name="Numerocartao" id="Numerocartao">
        <label for="">Bandeira do Cartão</label>
        <input type="text" id="bandeira" name="bandeira" value="">
        </div>
        <div class="band"></div>
        <div class="row">
        <label for="">CVV</label>
        <input type="text" id="cvv" name="cvv">
        <label for="">Mês de Validade</label>
        <input type="text" id="mesvalidade" name="mesvalidade" >
       </div>
        <label for="">Ano de Validade </label>
        <input type="text" id="anovalidade" name="anovalidade" >
        <div class=parcela>
            <select name="QtdParcelas" id="QtdParcelas">
            <option value="">selecione</option>
        </select>
        </div>

    
    </form>
        <div class="pau"></div>
    </div>
    
</body>
</html>
<?php require_once("Roda_pe.php"); ?>
<script type="text/javascript" src=
"https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script src="js/pagseguro.js"></script>
