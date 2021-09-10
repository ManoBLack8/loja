<?php
require_once("cabecalho.php");


$id_usuario = $_SESSION['id_usuario'];
$query2 = $pdo->query("SELECT * FROM andress where id_usuario = '" . $id_usuario . "'");
@$ress = $query2->fetchAll(PDO::FETCH_ASSOC);
@$cep = $ress[0]['cep'];
@$rua = $ress[0]['rua'];
@$bairro = $ress[0]['bairro'];
@$cidade = $ress[0]['cidade'];
@$estado = $ress[0]['estado'];
@$lote = $ress[0]['lote'];
@$complemento = $ress[0]['complemento'];




?>
<body>
<section>
    <div class="container">
        <div class="venda_tela">
            <form action="https://pagseguro.uol.com.br/v2/checkout/payment.html" method="post">
                
            </form>

        </div>
    </div>
</section>
</body>