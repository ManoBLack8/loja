<?php 
$pag = "produtos";
require_once("../../conexao.php"); 
@session_start();
    //verificar se o usuário está autenticado
    if(@$_SESSION['id_usuario'] == null || @$_SESSION['nivel_usuario'] != 'admin'){
     echo "<script language='javascript'> window.location='../index.php' </script>";
    }

?>



<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?= $pag ?>&funcao=novo">Novo Produto</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none" href="index.php?pag=<?= $pag ?>&funcao=novo">+</a>
    
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Imagem</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                   <?php 

                   $query = $pdo->query("SELECT * FROM produtos order by id desc ");
                   $res = $query->fetchAll(PDO::FETCH_ASSOC);

                   for ($i=0; $i < count($res); $i++) { 
                      foreach ($res[$i] as $key => $value) {
                      }

                      $nomep = $res[$i]['nome'];
                      $imagem = $res[$i]['imagem'];
                      $preco = $res[$i]['valor'];
                      $id = $res[$i]['id'];


                      $preco = number_format($preco, 2, ',', '.');
                      ?>


                    <tr>
                        <td><?= $nomep ?></td>
                        <td><img src="../../img/produtos/<?= $imagem ?>" width="80"></td>
                        <td><?= $preco ?></td>
                       
                        

                        <td>
                             <a href="index.php?pag=<?= $pag ?>&funcao=editar&id=<?= $id ?>" class='text-primary mr-1' title='Editar Dados'><i class='far fa-edit'></i></a>
                            <a href="index.php?pag=<?= $pag ?>&funcao=excluir&id=<?= $id ?>" class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>
                            <a href="index.php?pag=<?= $pag ?>&funcao=imagens&id=<?= $id ?>" class='text-info mr-1' title='Inserir Imagens'><i class='fas fa-images'></i></a>
                        </td>
                    </tr>
<?php } ?>





                </tbody>
            </table>
        </div>
    </div>
</div>








<!-- Modal --> 
<div class="modal fade bd-example-modal-lg" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php 
                if (@$_GET['funcao'] == 'editar') {
                    $titulo = "Editar Registro";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM produtos where id = '" . $id2 . "' ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $nome2 = $res[0]['nome'];
                    $imagem2 = $res[0]['imagem'];
                    $tamanho2 = $res[0]['tamanho'];
                    $tamanhoveste2 = $res[0]['tamanho_veste'];
                    $preco2 = $res[0]['valor'];
                    $nome_cat2 =$res[0]['idcategoria'];
                    $situ2 = $res[0]['statu'];
                    $desc2 = $res[0]['descricao'];
                    $palavras2 = $res[0]['tags'];
                    $peso2 = $res[0]['peso'];
                    $altura2 = $res[0]['altura'];
                    $largura2 = $res[0]['largura'];
                    $comprimento2 = $res[0]['comprimento'];

                    $peso2 =  number_format($peso2, 2, ',', '.');
                    $altura2 =  number_format($altura2, 2, ',', '.');
                    $largura2 =  number_format($largura2, 2, ',', '.');
                    $comprimento2 =  number_format($comprimento2, 2, ',', '.');                   
                    $preco2 = number_format($preco2, 2, ',', '.');                    

                } else {
                    $titulo = "Inserir Registro";

                }


                ?>
                
                <h5 class="modal-title" id="exampleModalLabel"><?= $titulo ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label >Imagem</label>
                        <input type="file" value="<?= @$imagem2 ?>"  class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
                    </div>

                    <?php if(@$imagem2 != ""){ ?>
                    	 <img src="../../img/<?= $imagem2 ?>" width="200" id="target">
                 	<?php  }else{ ?>
                    <img src="../../src/img/produtos/sem-foto.png" width="200" id="target">
                	<?php } ?>
                    <div class = "row">
                    <div class="form-group">
                        <label >Nome</label>
                        <input value="<?= @$nome2 ?>" type="text" class="form-control" id="nomep" name="nomep" placeholder="Nome">
                    </div>

                    <div class="form-group ml-3">
                        <label >Tamanho</label>
                        <input type="text" value="<?= @$tamanho2 ?>"  class="form-control" id="tamanho" name="tamanho" >
                    </div>
                    <div class="form-group ml-3">
                        <label >Tamanho veste</label>
                        <input type="text" value="<?= @$tamanhoveste2 ?>"  class="form-control" id="tamanhove" name="tamanhove">
                    </div>
                    <div class="form-group">
                        <label >Valor</label>
                        <input type="text" value="<?= @$preco2 ?>"  class="form-control" id="preco" name="preco">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Categoria</label>
                            <select class="form-control form-control-sm" name="categoria" id="categoria">
                                <?php 
                                if (@$_GET['funcao'] == 'editar') {
                                    $query = $pdo->query("SELECT * from categorias where id = '$nome_cat2' ");
                                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                    $nomeCat = $res[0]['nome'];
                                    echo "<option value='".$nome_cat2."' >" . $nomeCat . "</option>";
                                }

                                $query2 = $pdo->query("SELECT * from categorias order by nome asc ");
                                $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                                for ($i=0; $i < count($res2); $i++) { 
                                    foreach ($res2[$i] as $key => $value) {
                                    }

                                    if(@$nomeCat != $res2[$i]['nome']){
                                       echo "<option value='".$res2[$i]['id']."' >" . $res2[$i]['nome'] . "</option>"; 
                                   }


                               }


                               ?>
                           </select>
                           <input  type="hidden" id="txtCat" name="txtCat">
                           <input value="<?= $sub_cat2 ?>" type="hidden" id="txtSub" name="txtSub">
                       </div>
                   </div>
                    <div class="form-group">
                        <label for="">Situação</label>
                        <select class="form-control form-control-sm" name="statu" id="statu">
                            <option value="1">Disponivel</option>
                            <option value="0">Indisponivel</option>
                        </select>    
                    </div>  
                    </div>                  
                    <div class="form-group">
                        <label >Descrição</label>
                        <textarea  class="form-control form-control-sm" id="desc" name="desc" ><?= @$desc2 ?></textarea>
                    </div>
                    <div class="form-group">
                        <label >Palavras Chaves</label>
                        <input value="<?= @$palavras2 ?>" type="text" class="form-control form-control-sm" id="tags" name="tags" placeholder="Palavras Chave">
               
                    </div>

                    <div class="row">
            <div class="col-md-3">
                 <div class="form-group">
                    <label >Peso</label>
                    <input value="<?= @$peso2 ?>" type="text" class="form-control form-control-sm" id="peso" name="peso" placeholder="Peso">
               
                </div>
            </div>

             <div class="col-md-3">
                 <div class="form-group">
                    <label >Largura</label>
                    <input value="<?= @$largura2 ?>" type="text" class="form-control form-control-sm" id="largura" name="largura" placeholder="Largura">
               
                </div>
            </div>


            <div class="col-md-3">
                 <div class="form-group">
                    <label >Altura</label>
                    <input value="<?= @$altura2 ?>" type="text" class="form-control form-control-sm" id="altura" name="altura" placeholder="Altura">
               
                </div>
            </div>


            <div class="col-md-3">
                 <div class="form-group">
                    <label >Comprimento</label>
                    <input value="<?= @$comprimento2 ?>" type="text" class="form-control form-control-sm" id="comprimento" name="comprimento" placeholder="Comprimento">
               
                </div>
            </div>
        </div>
                    



                   

                    <small>
                        <div id="mensagem">

                        </div>
                    </small> 

                </div>



                <div class="modal-footer">



                <input value="<?= @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">
                <input value="<?= @$nome2 ?>" type="hidden" name="antigo" id="antigo">

                    <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="btn-salvar" id="btn-salvar" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>






<div class="modal" id="modal-deletar" tabindex="-1" role="dialog">
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

                    <input type="hidden" id="id"  name="id" value="<?= @$_GET['id'] ?>" required>

                    <button type="button" id="btn-deletar" name="btn-deletar" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-imagens" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Imagens do Produto</h5>
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-fotos" method="POST" enctype="multipart/form-data" >
                    <div class="row">
                        <div class="col-md-5">
                            <div class="col-md-12 form-group">
                                <label>Imagem do Produto</label>
                                <input type="file" class="form-control-file" id="imgproduto" name="imgproduto" onchange="listarImagensProd();">

                            </div>

                            <div class="col-md-12 mb-2">
                                <img src="../../src/img/produtos/sem-foto.png" alt="Carregue sua Imagem" id="targetImgProduto" width="100%">
                            </div>

                        </div>

                        <div class="col-md-7" id="listar-img">

                        </div>
                    </div>

                    <div class="col-md-12" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-fotos">Cancelar</button>
                        
                        <input type="hidden" id="id_produto_img"  name="id" value="<?= @$_GET['id'] ?>">

                        <button type="submit" id="btn-fotos" name="btn-fotos" class="btn btn-info">Salvar</button>

                    </div>


                    <small>     
                        <div align="center" id="mensagem_fotos" class="">

                        </div>
                    </small>   
                </form>
            </div>

        </div>
    </div>
</div>   







<div class="modal" id="modalDeletarImg" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Imagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Excluir esta Imagem?</p>

                <div align="center" id="mensagem_excluir_img" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-img">Cancelar</button>
                <form method="post">
                    <input type="hidden" name="id_foto" id="id_foto">                  
                    <button type="button" id="btn-deletar-img" name="btn-deletar-img" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>








<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

<?php 

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "novo") {
    echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
    echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir") {
    echo "<script>$('#modal-deletar').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "imagens") {
    echo "<script>$('#modal-imagens').modal('show');</script>";
}

?>


<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
    $("#form").submit(function () {
        var pag = "<?=$pag?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST',
            data: formData,

            success: function (mensagem) {

                $('#mensagem').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!!") {
                    
                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pag="+pag;

                } else {

                    $('#mensagem').addClass('text-danger')
                }

                $('#mensagem').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });
</script>





<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
    $(document).ready(function () {
        var pag = "<?=$pag?>";
        $('#btn-deletar').click(function (event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/excluir.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (mensagem) {

                    if (mensagem.trim() === 'Excluído com Sucesso!!') {


                        $('#btn-cancelar-excluir').click();
                        window.location = "index.php?pag=" + pag;
                    }

                    $('#mensagem_excluir').text(mensagem)



                },

            })
        })
    })
</script>

<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
    $("#form-fotos").submit(function () {
        var pag = "<?=$pag?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/inserir-imagens.php",
            type: 'POST',
            data: formData,

            success: function (mensagem) {

                $('#mensagem').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!!") {

                   $('#mensagem_fotos').addClass('text-success')
                   $('#mensagem_fotos').text(mensagem)
                   listarImagensProd();

                } else {

                    $('#mensagem_fotos').addClass('text-danger')
                }

                $('#mensagem_fotos').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });
</script>


<script type="text/javascript">
    var pag = "<?=$pag?>";
    $.ajax({
        url: pag + "/listar-imagens.php",
        method: "post",
        data: $('form').serialize(),
        dataType: "html",
        success: function (result) {

            $('#listar-img').html(result);
        }
    })
    function listarImagensProd() {
        var pag = "<?=$pag?>";
        $.ajax({
            url: pag + "/listar-imagens.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "html",
            success: function (result) {

                $('#listar-img').html(result);
            }
        })
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var pag = "<?=$pag?>";
        $('#btn-deletar-img').click(function (event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/excluir-imagem.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (mensagem) {

                    if (mensagem.trim() === 'Excluído com Sucesso!!') {


                        $('#btn-cancelar-excluir').click();
                        window.location = "index.php?pag=" + pag;
                    }

                    $('#mensagem_excluir').text(mensagem)



                },

            })
        })
    })
</script>

<!--SCRIPT PARA CARREGAR IMAGEM -->
<script type="text/javascript">

    function carregarImg() {

        var target = document.getElementById('target');
        var file = document.querySelector("input[type=file]").files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);


        } else {
            target.src = "";
        }
    }

</script>


<!--FUNCAO PARA CHAMAR MODAL DE DELETAR IMAGEM DAS FOTOS -->
<script type="text/javascript">
    function deletarImg(img) {

        document.getElementById('id_foto').value = img;
        $('#modalDeletarImg').modal('show');

    }
</script>



<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTable').dataTable({
            "ordering": false
        })

    });
</script>



