<?php require_once("cabecalho.php");
?>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="content-type" content="application/x-www-form-urlencoded; charset=ISO-8859-1"/>

    <!-- Shoping Cart Section Begin -->

    <section class="shoping-cart spad">
        <div class="container">
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
                            @$total = $valorcar + $total;
                            $totaltotal = $total + @$desconto;

                            if ($idp == null) {
                                $queryy = $pdo->prepare("UPDATE carrinho SET situ = :situ where id_usuario = $id2 and id_produto =  $idc");
                                $queryy->bindValue(":situ","excluido");
                                $queryy->execute();
                                echo "<script language='javascript'> window.location='carrinho.php' </script>";
                            }
                      ?>
                            <tbody>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="img/produtos/<?php echo $imagemc ?>"  alt="">
                                        <h5><?php echo $nomecar ?></h5>
                                    </td>
                                    
                                    <td class="shoping__cart__total">
                                        R$<?php echo $valorcar ?>
                                    </td>
                                    <td>
                                    <a width="120" href="carrinho.php?funcao=delcarrinho&id=<?php echo $id ?>" class='text-danger mr-1' title="Excluir registro"><i class="fa fa-2x fa-times"></i></a>
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
                        <a href="shop.php" class="primary-btn cart-btn">CONTINUE COMPRANDO</a>
                        <a href="carrinho.php" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Atualizar carrinho</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Codigos de desconto</h5>
                            <form action="#">
                                <input type="text" placeholder="Adicione seu cupom">
                                <button type="submit" class="site-btn">Aplicar desconto</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Total Carrinho</h5>
                        <ul>
                            <li>Total de produtos <span>R$<?php echo $total ?></span></li>
                            <li>Total <span>R$<?= $totaltotal ?></span></li>
                        </ul>
                        <a href="checkout.php" class="site-btn">Tela de vendas</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal" id="modal_entrega" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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

                <div align="center" id="mensagem_excluir" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id"  name="id" value="<?php echo @$_GET['id'] ?>" required>

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
<script src="js/pagseguro.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn-deletar').click(function (event) {
            event.preventDefault();

            $.ajax({
                url: "carrinho/excluir_carrinho.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (mensagem) {

                    if (mensagem.trim() === 'Excluído com Sucesso!!') {


                        $('#btn-cancelar-excluir').click();
                        window.location = "carrinho.php";
                    }

                    $('#mensagem_excluir').text(mensagem)



                },

            })
        })
    })
</script>


