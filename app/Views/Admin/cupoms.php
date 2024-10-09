<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="?funcao=novo">Nova Categoria</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none" href="?funcao=novo">+</a>
    
</div>
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Codigo</th>
                        <th>ativo</th>
                        <th>ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data["cupoms"] as $cupom){ ?>
                    <tr>
                        <td><?= $cupom["id"] ?></td>
                        <td><?= $cupom["codigo"] ?></td>
                        <td><?= $cupom["status"] ?></td>
                        <td>
                            <a href="?funcao=editar&id=<?= $cupom["id"] ?>" class='text-primary mr-1' title='Editar Dados'><i class='far fa-edit'></i></a>
                            <a href="?funcao=excluir&id=<?= $cupom["id"] ?>" class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>