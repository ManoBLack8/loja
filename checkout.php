<?php 
require_once("cabecalho.php");
$_SESSION['id_usuario'];
$nome_usuario = $_SESSION['nome_usuario'];
$email_usuario = $_SESSION['email_usuario'];
$cep = $_POST["cep"];
$fretes = explode(",",@$_POST['fretes']);
@$fretes_price = $fretes[0];
@$fretes_name = $fretes[1];
@$fretes_name_company = $fretes[2];
  //os 
if (@$_POST['fretes'] == "" or null) {
    echo "<script language='javascript'> window.location='Carrinho' </script>";
}
function addsitu($idc,$id2)
{
    global $pdo ;
    $queryy = $pdo->prepare("UPDATE carrinho SET situ = :situ where id_usuario = $id2 and id_produto =  $idc");
    $queryy->bindValue(":situ","excluido");
    $queryy->execute();
    echo "<script language='javascript'> window.location='Carrinho' </script>";
}
?>

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Detalhes da cobrança</h4>
                    <form method="post" action="https://pagseguro.uol.com.br/v2/checkout/payment.html">  
                        <div class="row">
                            <div class="col-lg-7 col-md-6">
                                <div class="checkout__input">
                                    <p>CEP<span>*</span></p>
                                    <input name="shippingAddressPostalCode" type="postalcode" value="<?= @$cep ?>">
                                </div>
                                <div class="checkout__input">
                                    <p>UF<span>*</span></p>
                                    <input name="shippingAddressState" id="uf" type="text" value="<?= @$estado ?>">
                                </div>
                                <div class="checkout__input">
                                    <p>Cidade<span>*</span></p>
                                    <input name="shippingAddressCity" id="cidade" type="text" value="<?= @$cidade ?>">  
                                </div>
                                <div class="checkout__input">
                                    <p>Bairro<span>*</span></p>
                                    <input name="shippingAddressDistrict" type="text" id="bairro" value="<?= @$bairro ?>"> 
                                </div>
                                <div class="checkout__input">
                                    <p>Endereço<span>*</span></p>
                                    <input name="shippingAddressStreet" placeholder="Nome da Rua" class="checkout__input__add" type="text" value="<?= @$rua ?>"> 
                                    <input class="col-md-2" name="shippingAddressNumber" placeholder="numero" type="text" value="<?= @$lote ?>">
                                </div>
                                <div class="checkout__input">
                                    <p>Complemento<span>*</span></p>
                                    <input name="shippingAddressComplement" type="text" value="<?= @$complemento ?>">  
                                </div>
                                
                                
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Telefone<span>*</span></p>
                                            <input name="senderPhone"
                                            id="ddd" class="checkout__input__number" type="text" value="<?= @$_SESSION["telefone_usuario"] ?>">

                                            <input name="senderAreaCode" type="text" id="telefone" class="checkout__input__add" placeholder="Numero de telefone" value="<?= @$_SESSION["ddd_usuario"] ?>">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        
                         
                        <div class="col-lg-5 col-md-6">
                        <div class="checkout__order">
                            <h4>Seu pedido</h4>
                            <div class="checkout__order__products">Produtos</div>
                            <?php
                            $id2 = $_SESSION['id_usuario'];
                            $query = $pdo->query("SELECT * FROM carrinho where situ = 'disponivel' and id_usuario =  $id2 order by id desc ");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);
                            
                            for ($i=0; $i < count($res); $i++) { 
                                
                            $idc = $res[$i]['id_produto'];
                            $id = $res[$i]['id'];
                            $query2 = $pdo->query("SELECT * FROM produtos where id = '" . $idc . "'");
                            @$ress = $query2->fetchAll(PDO::FETCH_ASSOC);
                            @$nomecar = $ress[0]['nome'];
                            @$imagemc = $ress[0]['imagem'];
                            @$valorcar = $ress[0]['valor'];
                            @$idp = $ress[0]['id'];
                            @$peso = $ress[0]['peso'];
                            @$total_produtos = $valorcar + $total_produtos;
                            $frete = 7.0;
                            $total = $fretes_price + $total_produtos;
                            // calculo porcentagem
                            $pctm = $_POST["desconto"];
                            $valor_descontado = $total - ($total / 100 * $pctm);
                            
                            $a = $i + 1;
                            
                            if ($idp == null) {
                                Addsitu($idp,$id2);
                            }?>

                            <input name="itemId<?=$a?>" type="hidden" value="<?= $idp ?>">
                            <input name="itemDescription<?=$a?>" type="hidden" value="<?= $nomecar?>">  
                            <input name="itemAmount<?=$a?>" type="hidden" value="<?= $valorcar?>">  
                            <input name="itemQuantity<?=$a?>" type="hidden" value="1"> 
                            <input name="itemWeight<?=$a?>" type="hidden" value="<?= $peso ?>">

                            <ul>
                                <li><?= $nomecar ?><span>R$ <?= $valorcar?></span></li>
                            </ul><?php } 
                            
                            $b = count($res) + 1;?>

                            <input name="itemId<?=$b?>" type="hidden" value="1">
                            <input name="itemDescription<?=$b?>" type="hidden" value="frete: <?= $fretes_name?> - <?= $fretes_name_company ?>">  
                            <input name="itemAmount<?=$b?>" type="hidden" value="<?= $fretes_price ?>">  
                            <input name="itemQuantity<?=$b?>" type="hidden" value="1">
                            
                            


                            <div class="checkout__order__subtotal">Valor<span>R$<?= $total_produtos ?></span></div>
                            <div class="checkout__order__frete">frete: <?= $fretes_name?> - <?=$fretes_name_company ?> <span>R$<?= $fretes_price ?></span></div>

                            <?php if ($_POST["desconto"]) {
                                $total = $valor_descontado; ?>
                                <div class="checkout__order__frete">Desconto <span>-<?= $_POST["desconto"] ?>%</span></div>
                           <?php } ?>
                            <div class="checkout__order__total">Total <span>R$<?= $total?></span></div>
                            
                            
                            <!-- Campos obrigatórios -->  
                            <input name="receiverEmail" type="hidden" value="viniciusfe66@gmail.com">  
                            <input name="currency" type="hidden" value="BRL">  
                            <!-- Código de referência do pagamento no seu sistema (opcional) -->  
                            <input name="reference" type="hidden" value="brecho">  
                            
                            <!-- Informações de frete (opcionais) -->  
                            <input name="shippingType" type="hidden" value="3">

                            <input name="shippingAddressCountry" type="hidden" value="BRA">    

                    
                            
                            <!-- Dados do comprador (opcionais) -->   
                            <input name="senderEmail" type="hidden" value="<?= @$_SESSION["email_usuario"] ?>">  
                            <input name="senderName" type="hidden" value="<?= @$_SESSION["nome_usuario"] ?>"> 
                            <!-- submit do form (obrigatório) -->  
                            <button class="site-btn" type="submit">Comprar com a Pagseguro</button>
                        </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
<?php require_once("Roda_pe.php");?>
<script>
$(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#complemento").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");
                $("#complemento").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                        $("#complemento").val("");
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});

</script>