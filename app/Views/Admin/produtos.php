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
                             <a href="produtos?funcao=imagens&id=<?= $produto["id"] ?>" class='btn btn-info' title='Inserir Imagens' onChange="carregarImg();"><i class='fa fa-images'></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
