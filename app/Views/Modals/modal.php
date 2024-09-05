<style>
        .show-modal {
            display: flex !important;
        }
    </style>
<body>
    <div class="modal " style="display: flex;" id="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content border-3 border-<?= $alerta ?>">
                <div class="modal-header">
                    <h5 class="modal-title"><?= $texto ?></h5>
                    <button type="button" onclick="fecharModal()" class="btn-close" id="close-modal" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
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
