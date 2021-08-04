<?php 
require_once("cabecalho.php");
$_SESSION['id_usuario'];
$nome_usuario = $_SESSION['nome_usuario'];
$email_usuario = $_SESSION['email_usuario'];
function addsitu($idc,$id2)
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
                    <form method="post" action="carrinho/endereco.php">  
                        <div class="row">
                            <div class="col-lg-8 col-md-6">
                                <div class="checkout__input">
                                    <p>CEP<span>*</span></p>
                                    <input id="cep" name="cep" type="postalcode">
                                </div>
                                <div class="checkout__input">
                                    <p>UF<span>*</span></p>
                                    <input id="uf" name="uf" type="text">
                                </div>
                                <div class="checkout__input">
                                    <p>Cidade<span>*</span></p>
                                    <input id="cidade" name="cidade" type="text">
                                </div>
                                <div class="checkout__input">
                                    <p>Bairro<span>*</span></p>
                                    <input id="bairro" name="bairro" type="text">
                                </div>
                                <div class="checkout__input">
                                    <p>Endereço<span>*</span></p>
                                        <input type="text" id="rua" name="rua" placeholder="Nome da Rua" class="checkout__input__add">
                                    <input type="text" id="numero" name="numero" placeholder="" class="checkout__input__number">
                                </div>
                                <div class="checkout__input">
                                    <p>Complemento<span>*</span></p>
                                    <input id="complemento" name="complemento" type="text">
                                </div>
                                
                                
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Telefone<span>*</span></p>
                                            <input type="text" id="ddd" name="ddd" placeholder="DDD" class="checkout__input__number">

                                            <input type="text" name="senderPhone" id="telefone" class="checkout__input__add" placeholder="Numero de telefone">
                                        </div>
                                    </div>
                                </div>                                
                                <button type="submit" class="btn-checkout site-btn">Proximo <span class="fa fa-arrow-right"></span></button>
                            </div>
                        </div>
                    </form> 
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