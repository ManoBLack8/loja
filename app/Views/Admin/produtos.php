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
                        <th>Selecione</th>
                        <th>Nome</th>
                        <th>Imagem</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                   <?php foreach($data["produtos"] as $produto){  
                    ?>
                    <tr>
                        <td><input type="checkbox" name="id_produto[]" id="id_produto[]"></td>
                        <td><?= $produto["nome"] ?></td>
                        <?php if (!empty($imagem2)) { ?>
                           <td><img src="../../src/img/produtos/<?= $imagem2 ?>" width="200" id="target"></td> 
                        <?php } else { ?>
                            <td><img src="../../src/img/produtos/sem-foto.png" width="200" id="target"></td>
                        <?php } ?>
                        <td><?= $produto["valor"] ?></td>
                        <td><?= $produto["status"] ?></td>
                        <td>
                             <a href="produtos?funcao=editar&id=<?= $produto["id"] ?>"><button class="btn btn-primary"><i class="fa fa-edit" ></i></button></a>
                             <a href="produtos?funcao=deletar&id=<?= $produto["id"] ?>"><button class="btn btn-danger"><i class="fa fa-trash" ></i></button></a>
                             <a href="produtos?funcao=imagens&id=<?= $produto["id"] ?>" class='btn btn-info' title='Inserir Imagens'><i class='fa fa-images'></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<<<<<<< HEAD
</div>








<!-- Modal 
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

                        <div class="col-md-7" id="listar-img" on">

                        </div>




                    </div>

                    <div class="col-md-12" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-fotos">Cancelar</button>
                        
                        <input type="hidden" id="id"  name="id" value="<?= @$_GET['id'] ?>">

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
</div> -->
=======
</div>
>>>>>>> 34308f421c061bcada8cd3c39a97c39b93b9cfa0
