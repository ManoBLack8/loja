<?php 
require_once("cabecalho.php");

function Addsitu($idc,$id2)
{
    global $pdo ;
    $queryy = $pdo->prepare("UPDATE carrinho SET situ = :situ where id_usuario = $id2 and id_produto =  $idc");
    $queryy->bindValue(":situ","excluido");
    $queryy->execute();
    echo "<script language='javascript'> window.location='carrinho.php' </script>";
}
?>

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Detalhes da cobrança</h4>
                <form method="post" target="pagseguro"  action="https://pagseguro.uol.com.br/v2/checkout/payment.html">  
                        <div class="row">
                            <div class="col-lg-8 col-md-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Seu nome<span>*</span></p>
                                            <input type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Seu sobrenome<span>*</span></p>
                                            <input type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout__input">
                                    <p>CEP<span>*</span></p>
                                    <input id="cep" name="shippingAddressPostalCode" type="text">
                                </div>
                                <div class="checkout__input">
                                    <p>UF<span>*</span></p>
                                    <input id="uf" name="shippingAddressState" type="text">
                                </div>
                                <div class="checkout__input">
                                    <p>Cidade<span>*</span></p>
                                    <input id="cidade" name="shippingAddressCity" type="text">
                                </div>
                                <div class="checkout__input">
                                    <p>Bairro<span>*</span></p>
                                    <input id="bairro" name="shippingAddressDistrict" type="text">
                                </div>
                                <div class="checkout__input">
                                    <p>Endereço<span>*</span></p>
                                        <input type="text" id="rua" name="shippingAddressStreet" placeholder="Nome da Rua" class="checkout__input__add">
                                    <input type="text" id="complemento" name="shippingAddressNumber" placeholder="" class="checkout__input__number">
                                </div>
                                <div class="checkout__input">
                                    <p>Complemento<span>*</span></p>
                                    <input id="bairro" name="shippingAddressComplement" type="text">
                                </div>
                                
                                
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Telefone<span>*</span></p>
                                            <input type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Email<span>*</span></p>
                                            <input type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="acc">
                                    Crie a sua conta aqui?
                                        <input type="checkbox" id="acc">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>Crie uma conta inserindo as informações abaixo.
                                Se você é um cliente antigo, faça o login no topo da página</p>
                                <div class="checkout__input">
                                    <p>Senha da conta<span>*</span></p>
                                    <input type="text">
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="diff-acc">
                                        Enviar para um endereço diferente
                                        <input type="checkbox" id="diff-acc">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input">
                                    <p>Notas de pedidos<span>*</span></p>
                                    <input type="text"
                                        placeholder="Notas sobre seu pedido.">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="checkout__order">
                                    <h4>Seu pedido</h4>
                                    <div class="checkout__order__products">Produtos</div>
                                    <?php
                                $id2 = $_SESSION['id_usuario'];
                                $query = $pdo->query("SELECT * FROM carrinho where situ = 'disponivel' and id_usuario =  $id2 order by id desc ");
                                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                
                                for ($i=0; $i < count($res); $i++) { 
                                    foreach ($res[$i] as $key => $value) {
                                    }
                                    
                                $idc = $res[$i]['id_produto'];
                                $id = $res[$i]['id'];
                                $query2 = $pdo->query("SELECT * FROM produtos where id = '" . $idc . "'");
                                @$ress = $query2->fetchAll(PDO::FETCH_ASSOC);
                                @$nomecar = $ress[0]['nome'];
                                @$imagemc = $ress[0]['imagem'];
                                @$valorcar = $ress[0]['valor'];
                                @$idp = $ress[0]['id'];
                                @$total_produtos = $valorcar + $total_produtos;
                                $frete = 7.0;
                                $total = $frete + $total_produtos;
                                
                                if ($idp == null) {
                                    Addsitu($idp,$id2);
                                }?>
                                    <ul>
                                        <li><?= $nomecar ?><span></span></li>
                                        
                                    </ul><?php } ?>
                                    <div class="checkout__order__subtotal">Valor <span>R$<?= $total_produtos ?></span></div>
                                    <div class="checkout__order__frete">frete <span>R$<?= $frete?></span></div>
                                    <div class="checkout__order__total">Total <span>R$<?= $total?></span></div>
                                    
                                    
                                    <div class="checkout__input__checkbox">
                                        <label for="acc-or">
                                            Entrega
                                            <input type="radio" id="tipo_entrega">
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="payment">
                                        Sacolina
                                            <input type="radio" id="tipo_entrega">
                                        
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="paypal">
                                            Retirada
                                            <input type="radio" id="tipo_entrega">
                                
                                        </label>
                                    </div>
                                    
                                            
                                            <!-- Campos obrigatórios -->  
                                            <input name="receiverEmail" type="hidden" value="suporte@lojamodelo.com.br">  
                                            <input name="currency" type="hidden" value="BRL">  
                                    
                                            <!-- Itens do pagamento (ao menos um item é obrigatório) -->  
                                            <input name="itemId1" type="hidden" value="0001">  
                                            <input name="itemDescription1" type="hidden" value="Notebook Prata">  
                                            <input name="itemAmount1" type="hidden" value="24300.00">  
                                            <input name="itemQuantity1" type="hidden" value="1">  
                                            <input name="itemWeight1" type="hidden" value="1000">  
                                            <input name="itemId2" type="hidden" value="0002">  
                                            <input name="itemDescription2" type="hidden" value="Notebook Rosa">  
                                            <input name="itemAmount2" type="hidden" value="25600.00">  
                                            <input name="itemQuantity2" type="hidden" value="2">  
                                            <input name="itemWeight2" type="hidden" value="750">  
                                    
                                            <!-- Código de referência do pagamento no seu sistema (opcional) -->  
                                            <input name="reference" type="hidden" value="REF1234">  
                                            
                                            <!-- Informações de frete (opcionais) -->  
                                            <input name="shippingType" type="hidden" value="3">
                                            <input name="shippingAddressCountry" type="hidden" value="BRA">  
                                    
                                            <!-- Dados do comprador (opcionais) -->  
                                            <input name="senderName" type="hidden" value="José Comprador">  
                                            <input name="senderAreaCode" type="hidden" value="11">  
                                            <input name="senderPhone" type="hidden" value="56273440">  
                                            <input name="senderEmail" type="hidden" value="comprador@uol.com.br">  
                                    
                                            <!-- submit do form (obrigatório) -->  
                                            <input alt="Pague com PagSeguro" name="submit"  type="image"/>  
                                            
                                     
                                </div>
                            </div>
                        </div>
                    </form> 
                </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
<?php require_once("Roda_pe.php")?>
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