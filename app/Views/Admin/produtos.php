<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="produtos?funcao=novo">Novo Produto</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none" href="produtos?funcao=novo">+</a>
    
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
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                   <?php foreach($data["produtos"] as $produto){  ?>
                    <tr>
                        <td><?= $produto["nome"] ?></td>
                        <td><img src="../../src/img/produtos/<?= $produto["imagem"] ?>" width="80"></td>
                        <td><?= $produto["valor"] ?></td>
                        <td><?= $produto["status"] ?></td>
                        <td>
                             <button class="btn btn-primary"><i class="fa fa-edit" ></i></button>
                             <button class="btn btn-danger"><i class="fa fa-trash" ></i></button>
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

                    @$query = $pdo->query("SELECT * FROM produtos where id = '" . $id2 . "' ");
                    @$res = $query->fetchAll(PDO::FETCH_ASSOC);

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
                
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label >Imagem</label>
                        <input type="file" value="<?php echo @$imagem2 ?>"  class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
                    </div>

                    <?php if(@$imagem2 != ""){ ?>
                    	 <img src="../../img/<?php echo $imagem2 ?>" width="200" id="target">
                 	<?php  }else{ ?>
                    <img src="../../src/img/produtos/sem-foto.png" width="200" id="target">
                	<?php } ?>
                    <div class = "row">
                    <div class="form-group">
                        <label >Nome</label>
                        <input value="<?php echo @$nome2 ?>" type="text" class="form-control" id="nomep" name="nomep" placeholder="Nome">
                    </div>

                    <div class="form-group ml-3">
                        <label >Tamanho</label>
                        <input type="text" value="<?php echo @$tamanho2 ?>"  class="form-control" id="tamanho" name="tamanho" >
                    </div>
                    <div class="form-group ml-3">
                        <label >Tamanho veste</label>
                        <input type="text" value="<?php echo @$tamanhoveste2 ?>"  class="form-control" id="tamanhove" name="tamanhove">
                    </div>
                    <div class="form-group">
                        <label >Valor</label>
                        <input type="text" value="<?php echo @$preco2 ?>"  class="form-control" id="preco" name="preco">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Categoria</label>
                            <select class="form-control form-control-sm" name="categoria" id="categoria">
                           </select>
                           <input  type="hidden" id="txtCat" name="txtCat">
                           <input value="<?php echo $sub_cat2 ?>" type="hidden" id="txtSub" name="txtSub">
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
                        <textarea  class="form-control form-control-sm" id="desc" name="desc" ><?php echo @$desc2 ?></textarea>
                    </div>
                    <div class="form-group">
                        <label >Palavras Chaves</label>
                        <input value="<?php echo @$palavras2 ?>" type="text" class="form-control form-control-sm" id="tags" name="tags" placeholder="Palavras Chave">
               
                    </div>

                    <div class="row">
            <div class="col-md-3">
                 <div class="form-group">
                    <label >Peso</label>
                    <input value="<?php echo @$peso2 ?>" type="text" class="form-control form-control-sm" id="peso" name="peso" placeholder="Peso">
               
                </div>
            </div>

             <div class="col-md-3">
                 <div class="form-group">
                    <label >Largura</label>
                    <input value="<?php echo @$largura2 ?>" type="text" class="form-control form-control-sm" id="largura" name="largura" placeholder="Largura">
               
                </div>
            </div>


            <div class="col-md-3">
                 <div class="form-group">
                    <label >Altura</label>
                    <input value="<?php echo @$altura2 ?>" type="text" class="form-control form-control-sm" id="altura" name="altura" placeholder="Altura">
               
                </div>
            </div>


            <div class="col-md-3">
                 <div class="form-group">
                    <label >Comprimento</label>
                    <input value="<?php echo @$comprimento2 ?>" type="text" class="form-control form-control-sm" id="comprimento" name="comprimento" placeholder="Comprimento">
               
                </div>
            </div>
        </div>
                    



                   

                    <small>
                        <div id="mensagem">

                        </div>
                    </small> 

                </div>



                <div class="modal-footer">



                <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">
                <input value="<?php echo @$nome2 ?>" type="hidden" name="antigo" id="antigo">

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

                    <input type="hidden" id="id"  name="id" value="<?php echo @$_GET['id'] ?>" required>

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

                        <div class="col-md-7" id="listar-img" on">

                        </div>




                    </div>

                    <div class="col-md-12" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-fotos">Cancelar</button>
                        
                        <input type="hidden" id="id"  name="id" value="<?php echo @$_GET['id'] ?>">

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