<style>
    .show-modal {
        display: flex !important;
    }
</style>

<div class="modal overflow-auto" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Imagens do Produto</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="fecharModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="#form-img-produto" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="col-md-12 form-group">
                                <label>Imagens do Produto</label>
                                <input type="file" class="form-control-file" id="imgproduto" name="imgproduto[]" multiple onchange="carregarImagens()">
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="cmb-2" id="preview-img">
                                        <img src="../../src/img/produtos/sem-foto.png" alt="Carregue sua Imagem" id="targetImgProduto" width="100%">
                                    </div>
                                </div>
                            </div>
                            
                            

                        </div>
                        
                        <div class="col-md-7" id="listar-img">

                        </div>
                    </div>

                    <div class="col-md-12" align="right">
                        <button type="button" class="btn btn-secondary" onclick="fecharModal()" data-dismiss="modal" id="btn-cancelar-fotos">Cancelar</button>
                        
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

<script>
    window.addEventListener('load', function() {
        var modal = document.getElementById('modal');
        listarImagensProd(<?= $_GET['id'] ?>);
        modal.classList.add('show-modal');
        modal.removeAttribute('style');
        console.log('Modal style attribute removed and class added');
    });

    function fecharModal() {
        var modal = document.getElementById('modal');
        modal.classList.remove('show-modal');
    }

    // Função para pré-visualizar múltiplas imagens
    function carregarImagens() {
        var preview = document.getElementById('preview-img');
        preview.innerHTML = "";  // Limpa o preview anterior
        var files = document.querySelector("input[type=file]").files;
        
        if (files) {
            Array.from(files).forEach(file => {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = document.createElement("img");
                    img.src = e.target.result;
                    img.style.width = "100%";
                    img.classList.add("mb-2");
                    preview.appendChild(img);
                };

                reader.readAsDataURL(file);
            });
        }
    }
</script>
