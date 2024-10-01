<?php 
$titulo = isset($modal["categoria"]) ? "Editar Categoria" : "Cadastrar categoria";
?>
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= @$titulo ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nome</label>
                        <input value="<?= @$modal["categoria"][0]["nome"] ?>" type="text" class="form-control" id="nome-cat" name="nome-cat" placeholder="Nome" required>
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
</body>
