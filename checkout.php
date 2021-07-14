<?php 
require_once("cabecalho.php");
$id2 = $_GET['id'];
$query = $pdo->query("SELECT * FROM produtos where id = '" . $id2 . "' ");
   $res = $query->fetchAll(PDO::FETCH_ASSOC);
   $nome2 = $res[0]['nome'];
   $imagem2 = $res[0]['imagem'];
   $tamanho2 = $res[0]['tamanho'];
   $desc2 = $res[0]['descricao'];
   $valor2 = $res[0]['valor'];
   $tamanhove2 = $res[0]['tamanho_veste'];
   $peso2 = $res[0]['peso'];
   $id = $res[0]['id'];
?>

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Detalhes da cobrança</h4>
                <form action="carrinho/endereco.php">
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
                                <input id="cep" type="text">
                            </div>
                            <div class="checkout__input">
                                <p>UF<span>*</span></p>
                                <input id="uf" type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Cidade<span>*</span></p>
                                <input id="cidade" type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Bairro<span>*</span></p>
                                <input id="bairro" type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Endereço<span>*</span></p>
                                <input type="text" id="rua" placeholder="Nome da Rua" class="checkout__input__add">

                                <input type="text" id="complemento" placeholder="Casa, Apartamento, Lote etc.. (optinal)">
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
                                <ul>
                                    <li><?= $nome2 ?><span></span></li>
                                    
                                </ul>
                                <div class="checkout__order__subtotal">Valor <span>R$<?= $valor2 ?></span></div>
                                <div class="checkout__order__frete">frete <span>R$<?= $valor2 ?></span></div>
                                <div class="checkout__order__total">Total <span>$total</span></div>
                                
                                
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
                                <form method="post" target="pagseguro"  
                                action="https://pagseguro.uol.com.br/v2/checkout/payment.html">  
                                
                                <!-- Campos obrigatórios -->  
                                <input name="receiverEmail" type="hidden" value="viniciusfe66@gmail.com">  
                                <input name="currency" type="hidden" value="BRL">  
                        
                                <!-- Itens do pagamento (ao menos um item é obrigatório) -->  
                                <input name="itemId1" type="hidden" value="<?= $id2 ?>">  
                                <input name="itemDescription1" type="hidden" value="<?= $nome2 ?>">  
                                <input name="itemAmount1" type="hidden" value="<?= $valor2 ?>">  
                                <input name="itemQuantity1" type="hidden" value=1>  
                                <input name="itemWeight1" type="hidden" value="<?= $peso2 ?>">     
                        
                                <!-- Código de referência do pagamento no seu sistema (opcional) -->  
                                <input name="reference" type="hidden" value="encontrei">  
                                <!-- submit do form (obrigatório) -->  
                                <input alt="Pague com PagSeguro" name="submit"  type="image" class="primary-btn"/>  
                                
                        </form>
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