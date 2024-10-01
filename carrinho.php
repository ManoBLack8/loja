<?php require_once("cabecalho.php");
$id2 = @$_SESSION['id_usuario'];
?>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="content-type" content="application/x-www-form-urlencoded; charset=ISO-8859-1"/>

    <!-- Shoping Cart Section Begin -->

    <section class="shoping-cart spad">
        <div class="container">
        <?php if($id2 != null){
        ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Produtos</th>
                                    <th>Preço</th>
                                    <th>fechar</th>
                                </tr>
                            </thead>
                            <?php 

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
                            @$total = $valorcar + $total;
                            if ($idp == null) {
                                $queryy = $pdo->prepare("UPDATE carrinho SET situ = :situ where id_usuario = $id2 and id_produto =  $idc");
                                $queryy->bindValue(":situ","excluido");
                                $queryy->execute();
                                echo "<script language='javascript'> window.location='Carrinho' </script>";
                            }
                      ?>
                            <tbody>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="img/produtos/<?= $imagemc ?>"  alt="">
                                        <h5><?= $nomecar ?></h5>
                                    </td>
                                    
                                    <td class="shoping__cart__total">
                                        R$<?= $valorcar ?>
                                    </td>
                                    <td>
                                    <a width="120" href="Carrinho?funcao=delcarrinho&id=<?= $id ?>" class='text-danger mr-1' title="Excluir registro"><i class="fa fa-2x fa-times"></i></a>
                                    </td>
                                </tr>
                                
                            </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="Shop" class="primary-btn cart-btn">CONTINUE COMPRANDO</a>
                        <a href="Carrinho" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Atualizar carrinho</a>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Codigos de desconto</h5>
                            <form action="#">
                                <input type="text" name="cupom" placeholder="Adicione seu cupom">
                                <button type="submit" id="btn-cupom" class="site-btn">Aplicar desconto</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Calcular frete</h5>
                            <form action="checkout.php" method="POST">
                                <input type="postalcode" width="20" name="cep" placeholder="Adicione seu cupom" id="cep">
                                <input type="hidden" width="20" name="city" placeholder="Adicione seu cupom" id="cidade">
                                <button type="submit" id="btn-calcular"
                                class="site-btn">Calcular</button>
                                <div id="cupom"></div>
                            <div id="entregas"></div> 
                        </div>
                    </div>
                    <div class="shoping__checkout">
                        <h5>Total Carrinho</h5>
                        <ul>
                            <li>Total de produtos <span>R$<?= $total ?></span></li>
                        </ul>
                        <button type="submit" class="site-btn">Tela de vendas</button>
                    </div></form>
                </div>
            </div>
            <?php }else { ?>
            <div class="text-center">
                <h2>Você não está logado</h2>
                <p>Para acessar o carrinho é necessario estar logado</p>
                <a href="sistema" class="site-btn">Ir para tela de Login</a>
                <a href="./" class="site-btn">Ir para pagina prncipal</a>
          </div>
        <?php } ?>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
 <div class="modal" id="modal-deletar-carrinho" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Excluir este Registro?</p>

                <div align="center" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id"  name="id" value="<?= @$_GET['id'] ?>" required>

                    <button type="button" id="btn-deletar" name="btn-deletar" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal-entregas" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tipos de entregas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="container">
           <div class="entregas" width="200">
           <div></div>
                
            </div>
        </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id"  name="id" value="<?= @$_GET['id'] ?>" required>

                    <button type="button" id="btn-deletar" name="btn-deletar" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require_once("Roda_pe.php");  
if (@$_GET['funcao'] == 'delcarrinho' ){
    echo "<script>$('#modal-deletar-carrinho').modal('show');</script>";
}
?>
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"       integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
 crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

  <script src="../js/mascara.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn-deletar').click(function (event) {
            event.preventDefault();
            $.ajax({
                url: "carrinho/excluir_Carrinho",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (mensagem) {

                    if (mensagem.trim() === 'Excluído com Sucesso!!') {


                        $('#btn-cancelar-excluir').click();
                        window.location = "Carrinho";
                    }

                    $('#mensagem_excluir').text(mensagem)



                },

            })
        })
    })
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn-calcular').click(function (event) {
            event.preventDefault();
            sleep(10)
            $.ajax({
                url: "entregas.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (data) {
                    $('#entregas').html(data)
                    
                    
                    
                },

            })
        })
    })

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn-cupom').click(function (event) {
            event.preventDefault();
            
            

            $.ajax({
                url: "Controller/CupomController.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (data) {
                    $('#cupom').html(data)
                },

            })
        })
    })

</script>
<script>
$(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#cidade").val("");
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
                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#cidade").val(dados.localidade);
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


function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

</script>
