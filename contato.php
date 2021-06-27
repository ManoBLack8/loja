<?php require_once("cabecalho.php");?>

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Sua mensagem </h2>
                    </div>
                </div>
            </div>
            <form method="post">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" name="nomecontato" id="nomecontato" placeholder="Seu nome">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" name="emailcontato" id="emailcontato" placeholder="Seu email" >
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea name="msgcontato" id="msgcontato" placeholder="Sua mensagem"></textarea>
                        <button type="button" name="btncontato" id="btncontato" class="site-btn">Enviar</button>
                        <div  class="text-center mt-3"  id="mensagem-i"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->

 <?php require_once("Roda_pe.php");?>
<script type="text/javascript">
    $('#btncontato').click(function(event) {
    event.preventDefault();
    $('#mensagem-i').removeClass('text-success')
    $('#mensagem-i').removeClass('text-danger')
    $('#mensagem-i').addClass('text-info')
     $('#mensagem-i').text('Enviando...')
    $.ajax({
        url:"enviar.php",
        method:"post",
        data: $('form').serialize(),
        dataType: "text",
        success: function(msg) {
            if (msg.trim() === 'Enviado com Sucesso!') {
                $('#mensagem-i').removeClass('text-info')
                $('#mensagem-i').addClass('text-success')
                $('#mensagem-i').text(msg);
                $('#nomecontato').val('');
                $('#emailcontato').val('');
                $('#msgcontato').val('');
            }

            else{
                $('#mensagem-i').text(msg)

            }
        }
    })

})
</script>