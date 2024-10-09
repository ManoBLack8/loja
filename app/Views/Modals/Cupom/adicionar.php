<?php 
$titulo = isset($modal["id"]) ? "Editar Desconto" : "Cadastrar Desconto";
?>
<style>
    .show-modal {
        display: flex !important;
    }
</style>

<div class="modal overflow-auto" id="modal" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= @$titulo ?></h5>
                <button type="button" class="close" data-dismiss="modal" onclick="fecharModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" action="" method="POST">
                <div class="modal-body">
                    <div class="row form-group m-2">
                        <div class="form-group mr-2">
                            <label>Código</label>
                            <input value="<?= @$modal["codigo"] ?>" type="text" class="form-control" id="codigo" name="codigo" placeholder="Código" required>
                        </div>
                        <div class="form-group mr-2">
                            <label>Tipo de Desconto</label>
                            <input value="<?= @$modal["tipo_desconto"] ?>" type="text" class="form-control" id="tipo_desconto" name="tipo_desconto" placeholder="Tipo de Desconto" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Valor do Desconto</label>
                            <input value="<?= @$modal["valor_desconto"] ?>" type="number" step="0.01" class="form-control" id="valor_desconto" name="valor_desconto" placeholder="Valor do Desconto" required>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="form-group mr-2">
                            <label>Data de Validade Início</label>
                            <input value="<?= @$modal["data_validade_inicio"] ?>" type="date" class="form-control" id="data_validade_inicio" name="data_validade_inicio" required>
                        </div>

                        <div class="form-group">
                            <label>Data de Validade Fim</label>
                            <input value="<?= @$modal["data_validade_fim"] ?>" type="date" class="form-control" id="data_validade_fim" name="data_validade_fim" required>
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <label>Uso Máximo</label>
                        <input value="<?= @$modal["uso_maximo"] ?>" type="number" class="form-control" id="uso_maximo" name="uso_maximo" placeholder="Uso Máximo" required>
                    </div>

                    <div class="form-group">
                        <label>Uso por Cliente</label>
                        <input value="<?= @$modal["uso_por_cliente"] ?>" type="number" class="form-control" id="uso_por_cliente" name="uso_por_cliente" placeholder="Uso por Cliente" required>
                    </div>

                    <div class="form-group">
                        <label>Valor Mínimo do Pedido</label>
                        <input value="<?= @$modal["valor_minimo_pedido"] ?>" type="number" step="0.01" class="form-control" id="valor_minimo_pedido" name="valor_minimo_pedido" placeholder="Valor Mínimo do Pedido" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="ativo" <?= @$modal["status"] == 'ativo' ? 'selected' : '' ?>>Ativo</option>
                            <option value="inativo" <?= @$modal["status"] == 'inativo' ? 'selected' : '' ?>>Inativo</option>
                        </select>
                    </div>

                    <small>
                        <div id="mensagem"></div>
                    </small> 
                </div>

                <div class="modal-footer">
                    <input value="<?= @$_GET['id'] ?>" type="hidden" name="id" id="id">
                    <input value="<?= $_GET['funcao'] ?>" type="hidden" name="acao" id="acao">

                    <button type="button" id="btn-fechar" class="btn btn-secondary" onclick="fecharModal()" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="btn-salvar" id="btn-salvar" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', function() {
        var modal = document.getElementById('modal');
        modal.classList.add('show-modal');
        modal.removeAttribute('style');
        console.log('Modal style attribute removed and class added');
    });

    function fecharModal() {
        var modal = document.getElementById('modal');
        modal.classList.remove('show-modal');
    }
</script>
