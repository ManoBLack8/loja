<?php 
require_once("cabecalho.php");
require_once("Controller/ShopController.php");
?>
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="hero__categories">
                            <div class="hero__categories__all">
                                <i class="fa fa-bars"></i>
                                <span>Categorias</span>
                            </div>
                            <ul>
                                <li><a href="?pag=<?= @$_GET['pag'] ?>&cat=&tamanho=<?= @$_GET['tamanho']?>&funcao=<?= @$_GET['funcao'] ?>&id=<?= @$_GET['id'] ?>">Todas</a></li>
                            <?php
                            $query = $pdo->query("SELECT * FROM categorias order by id asc ");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);
                        for ($i=0; $i < count($res); $i++) {                
                            $nome = $res[$i]['nome'];
                            $id = $res[$i]['id'];
                            
                            ?>
                                <li><a href="?pag=<?= @$_GET['pag'] ?>&cat=<?= $id ?>&tamanho=<?= @$_GET['tamanho']?>&funcao=<?= @$_GET['funcao'] ?>&id=<?= @$_GET['id'] ?>"><?= $nome?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Tamanho</h4>
                            <a href="?pag=<?= @$_GET['pag'] ?>&cat=<?= @$_GET['cat'] ?>&tamanho=&funcao=<?= @$_GET['funcao'] ?>&id=<?= @$_GET['id'] ?>" class="sidebar__item__size">Todos</a>
                            <?php
                            for ($i=0; $i < count($res4); $i++) {
                                $tamanho = $res4[$i]['tamanho'];
                                if($tamanho != ""){
                                 
                                
                                ?>
                            <a href="?pag=<?= @$_GET['pag'] ?>&cat=<?= @$_GET['cat'] ?>&tamanho=<?= $tamanho?>&funcao=<?= @$_GET['funcao'] ?>&id=<?= @$_GET['id'] ?>" class="sidebar__item__size"><?= $tamanho ?></a>
                            <?php 
                                }
                        } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span><?= count($res3) ?></span>Produtos encontrados</h6>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                    <?php 

                   for ($i=0; $i < count($res3); $i++) { 
                      foreach ($res3[$i] as $key => $value) {
                      }
                      
                      $nome = $res3[$i]['nome'];
                      $valor = $res3[$i]['valor'];
                      $imagem = $res3[$i]['imagem'];
                      $desc = $res3[$i]['descricao'];
                      $id = $res3[$i]['id'];
                      $nomeurl = $res3[$i]['nome_url'];

                      $valor = number_format($valor, 2, ',', '.');
                   
                  

                      
                      ?>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic">
                                <img src="img/produtos/<?php echo $imagem ?>" alt="">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="shop-detalhes.php?id=<?php echo $id ?>"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="?pag=<?= @$_GET['pag'] ?>&cat=<?= @$_GET['cat']?>&tamanho=<?= @$_GET['tamanho']?>&funcao=carrinho&id=<?=$id ?>" ><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="shop-detalhes.php?id=<?php echo $id ; ?>"><?php echo $nome ?></a></h6>
                                    <h5>R$<?php echo $valor ?></h5>
                                </div>
                            </div>
                        </div>
<?php } ?>
                       
                    </div>
                    <div class="product__pagination">
                        <?php
                        if ($pc>1) {
                            echo " <a href='?pag=$anterior'><-</a> ";
                        }
                        for($p=0; $p< $tp; $p++){?>
                            <a href="?pag=<?= $p+1 ?>&cat=<?= @$_GET['cat']?>&tamanho=<?= @$_GET['tamanho']?>&funcao=<?= @$_GET['funcao'] ?>&id=<?= @$_GET['id'] ?>"><?= $p+1 ?></a>
                        
                   <?php }
                   if ($pc<$tp) {
                    echo " <a href='?pag=$proximo'>-></a>";
                    }
                   ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- Modal -->
<div class="modal" id="modalCarrinho" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <?php
                   $query = $pdo->query("SELECT * FROM produtos where id = '" . @$_GET["id"]. "' ");
                   $res = $query->fetchAll(PDO::FETCH_ASSOC);
                   $nome2 = $res[0]['nome'];
                   
?>
                <h5 class="modal-title">Carrinho de compras</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja adicionar <?php echo $nome2 ?> ao carrinho</p>

                <div align="center" id="mensagem_excluir" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-cancelar-excluir">Não</button>
                <form method="post">

                    <input type="hidden" id="id"  name="id" value="<?= @$_GET['id'] ?>" required>

                    <button type="button" id="btn-deletar" name="btn-deletar" class="btn btn-success">Sim</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once("Roda_pe.php");  
if (@$_GET['funcao'] == 'carrinho' ){
    echo "<script>$('#modalCarrinho').modal('show');</script>";
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn-deletar').click(function (event) {
            event.preventDefault();

            $.ajax({
                url: "carrinho/inserir_Carrinho",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (mensagem) {

                    if (mensagem.trim() === 'Cadastrado com Sucesso!') {


                        $('#btn-cancelar-excluir').click();
                        window.location = "Shop";
                    }

                    $('#mensagem_excluir').text(mensagem)



                },

            })
        })
    })
</script>
