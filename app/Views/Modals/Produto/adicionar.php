<style>
    .show-modal {
        display: flex !important;
    }
</style>

<body>
    <div class="modal overflow-auto" id="modal" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <?php
                    $titulo = "Cadastrar Produtos";
                    $opc = "cadastro"; 
                    if (isset($modal["produtos"]) && count($modal["produtos"]) > 0) {
                        $opc = "edicao";
                        foreach ($modal["produtos"] as $produto) {
                            $titulo = "Editar Produtos";
                            $imagem2 = $produto["imagem"];
                            $nome2 = $produto["nome"];
                            $tamanho2 = $produto["tamanho"];
                            $tamanhoveste2 = $produto["tamanhoVeste"];
                            $preco2 = $produto["valor"];
                            $id_categoria2 = $produto["idcategoria"];
                            $situ2 = $produto["status"];
                            $descricao2 = $produto["descricao"];
                            $palavras2 = $produto["tags"];
                            $peso2 = $produto["peso"];
                            $largura2 = $produto["largura"];
                            $altura2 = $produto["altura"];
                            $comprimento2 = $produto["comprimento"];
                        }
                    }
                    ?>
                    <h5 class="modal-title" id="exampleModalLabel"><?= $titulo ?></h5>
                    <button type="button" class="close" onclick="fecharModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="form" name="" action="" method="POST">
                    <input type="hidden" name="acao" value="<?= $opc ?>">
                    <div class="modal-body">
                        <!-- Imagem -->
                        <div class="form-group">
                            <label for="imagem">Imagem</label>
                            <input type="file" class="form-control-file" id="imagem" name="imagem" onchange="carregarImg();">
                        </div>

                        <!-- Preview da imagem -->
                        <?php if (!empty($imagem2)) { ?>
                            <img src="../../src/img/produtos/<?= $imagem2 ?>" width="200" id="target">
                        <?php } else { ?>
                            <img src="../../src/img/produtos/sem-foto.png" width="200" id="target">
                        <?php } ?>

                        <!-- Informações do produto -->
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="nomep">Nome</label>
                                <input value="<?= @$nome2 ?>" type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="tamanho">Tamanho</label>
                                <input value="<?= @$tamanho2 ?>" type="text" class="form-control" id="tamanho" name="tamanho" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="tamanhove">Tamanho veste</label>
                                <input value="<?= @$tamanhoveste2 ?>" type="text" class="form-control" id="tamanhoVeste" name="tamanhoVeste">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="preco">Valor</label>
                                <input value="<?= @$preco2 ?>" type="number" class="form-control" id="valor" name="valor" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="categoria">Categoria</label>
                                <select class="form-control form-control-sm" name="categoria_id" id="categoria_id" required>
                                    <?php foreach($modal["categorias"] as $categorias){ ?>
                                    <option value="<?= $categorias["id"] ?>" <?= @$categoria2 == $categorias["id"] ? 'selected' : '' ?>><?= $categorias["nome"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="situacao">Situação</label>
                                <select class="form-control form-control-sm" name="status" id="status">
                                    <option value="Excluido" <?= @$situ2 == 1 ? 'selected' : '' ?>>Excluido</option>
                                    <option value="Disponível" <?= @$situ2 == 1 ? 'selected' : '' ?>>Disponível</option>
                                    <option value="Indisponível" <?= @$situ2 == 0 ? 'selected' : '' ?>>Indisponível</option>
                                    <option value="Não Visivel" <?= @$situ2 == 1 ? 'selected' : '' ?>>Não Visivel</option>
                                    <option value="Sacolinha" <?= @$situ2 == 1 ? 'selected' : '' ?>>Sacolinha</option>
                                    <option value="Aguardado Pagamneto" <?= @$situ2 == 1 ? 'selected' : '' ?>>Aguardado Pagamento</option>
                                    <option value="Vendido" <?= @$situ2 == 1 ? 'selected' : '' ?>>Vendido</option>
                                </select>
                            </div>
                        </div>

                        <!-- Descrição -->
                        <div class="form-group">
                            <label for="desc">Descrição</label>
                            <textarea class="form-control form-control-sm" id="descricao" name="descricao"><?= @$descricao2 ?></textarea>
                        </div>

                        <!-- Palavras Chaves -->
                        <div class="form-group">
                            <label for="tags">Palavras Chaves</label>
                            <input value="<?= @$palavras2 ?>" type="text" class="form-control form-control-sm" id="tags" name="tags" placeholder="Palavras Chave">
                        </div>

                        <!-- Dimensões -->
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="peso">Peso</label>
                                <input value="<?= @$peso2 ?>" type="text" class="form-control form-control-sm" id="peso" name="peso" placeholder="Peso">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="largura">Largura</label>
                                <input value="<?= @$largura2 ?>" type="text" class="form-control form-control-sm" id="largura" name="largura" placeholder="Largura">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="altura">Altura</label>
                                <input value="<?= @$altura2 ?>" type="text" class="form-control form-control-sm" id="altura" name="altura" placeholder="Altura">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="comprimento">Comprimento</label>
                                <input value="<?= @$comprimento2 ?>" type="text" class="form-control form-control-sm" id="comprimento" name="comprimento" placeholder="Comprimento">
                            </div>
                        </div>

                        <!-- Mensagem de erro ou sucesso -->
                        <small>
                            <div id="mensagem"></div>
                        </small>
                    </div>

                    <!-- Rodapé do modal -->
                    <div class="modal-footer">
                        <input value="<?= @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">
                        <input value="<?= @$nome2 ?>" type="hidden" name="antigo" id="antigo">

                        <button type="button" id="btn-fechar" class="btn btn-secondary" onclick="fecharModal()">Cancelar</button>
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
