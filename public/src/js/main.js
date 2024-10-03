'use strict';
(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $('.featured__controls li').on('click', function () {
            $('.featured__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.featured__filter').length > 0) {
            var containerEl = document.querySelector('.featured__filter');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Humberger Menu
    $(".humberger__open").on('click', function () {
        $(".humberger__menu__wrapper").addClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").addClass("active");
        $("body").addClass("over_hid");
    });

    $(".humberger__menu__overlay").on('click', function () {
        $(".humberger__menu__wrapper").removeClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").removeClass("active");
        $("body").removeClass("over_hid");
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*-----------------------
        Categories Slider
    ------------------------*/
    $(".latest-product__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: true,
        nav: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            0: {
                items: 1,
            }
        }
    });


    $('.hero__categories__all').on('click', function(){
        $('.hero__categories ul').slideToggle(400);
    });

    /*--------------------------
        Latest Product Slider
    ----------------------------*/
    $(".latest-product__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------------
        Product Discount Slider
    -------------------------------*/
    $(".product__discount__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 3,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            320: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 2,
            },

            992: {
                items: 3,
            }
        }
    });

    /*---------------------------------
        Product Details Pic Slider
    ----------------------------------*/
    $(".product__details__pic__slider").owlCarousel({
        loop: true,
        margin: 20,
        items: 4,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------
		Price Range Slider
	------------------------ */
    var rangeSlider = $(".price-range"),
        minamount = $("#minamount"),
        maxamount = $("#maxamount"),
        minPrice = rangeSlider.data('min'),
        maxPrice = rangeSlider.data('max');
    rangeSlider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            minamount.val('R$' + ui.values[0]);
            maxamount.val('R$' + ui.values[1]);
        }
    });
    minamount.val('R$' + rangeSlider.slider("values", 0));
    maxamount.val('R$' + rangeSlider.slider("values", 1));

    /*------------------
		Single Product
	--------------------*/
    $('.product__details__pic__slider img').on('click', function () {

        var imgurl = $(this).data('imgbigurl');
        var bigImg = $('.product__details__pic__item--large').attr('src');
        if (imgurl != bigImg) {
            $('.product__details__pic__item--large').attr({
                src: imgurl
            });
        }
    });

    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });
    


})(jQuery);

$(document).ready(function() {

    // COMEÇO DA PAGINA DE CHECKOUT
    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#complemento").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");
                $("#complemento").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                        $("#complemento").val("");
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
    // FIM DA PAGINA DE CHECKOUT

    //COMEÇO DA PAGINA DE CARRINHO 
    $('#btn-deletar').click(function (event) {
        event.preventDefault();
        $.ajax({
            url: "carrinho/excluir_Carrinho",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function (mensagem) {

                if (mensagem.trim() === 'Excluído com Sucesso!!') {


                    $('#btn-cancelar-excluir').click();
                    window.location = "Carrinho";
                }

                $('#mensagem_excluir').text(mensagem)



            },

        })
    });

    $('#btn-calcular').click(function (event) {
        event.preventDefault();
        sleep(10)
        $.ajax({
            url: "entregas.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function (data) {
                $('#entregas').html(data)
                
                
                
            },

        })
    });

    $('#btn-cupom').click(function (event) {
        event.preventDefault();
        
        

        $.ajax({
            url: "Controller/CupomController.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function (data) {
                $('#cupom').html(data)
            },

        })
    });

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#cidade").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#cidade").val(dados.localidade);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
    //FIM DA PAGINA DE CARRINHO


    //COMECO DE CONTATO
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
    
    });
    // FIM DE CONTATO

    //COMECO DE SHOP 
    $(document).ready(function () {
        $('#btn-deletar').click(function (event) {
            event.preventDefault();

            $.ajax({
                url: "carrinho/inserir_Carrinho",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (mensagem) {

                    if (mensagem.trim() === 'Cadastrado com Sucesso!') {


                        $('#btn-cancelar-excluir').click();
                        window.location = "Shop";
                    }

                    $('#mensagem_excluir').text(mensagem)



                },

            })
        })
    });
    //FIM DE SHOP

    //COMEÇO ADMIN 
    $('#btn-salvar-perfil').click(function(event){
        event.preventDefault();
        
        $.ajax({
            url:"editar-perfil.php",
            method:"post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg){
               if(msg.trim() === 'Salvo com Sucesso!'){
                                        
                    $('#btn-fechar-perfil').click();
                    window.location='index.php';

                    }
                 else{
                    $('#mensagem-perfil').addClass('text-danger')
                    $('#mensagem-perfil').text(msg);
                   

                 }
            }
        })
    })
    // FIM ADMIN

    //COMECO CATEGORIA 
     $('#btn-deletar-categoria').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: "/excluir.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function (mensagem) {

                if (mensagem.trim() === 'Excluído com Sucesso!!') {


                    $('#btn-cancelar-excluir').click();
                    window.location = "index.php?pag=" + pag;
                }

                $('#mensagem_excluir').text(mensagem)



            },

        })
    });

    $("#form").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "/back_escola.php",
            type: 'POST',
            data: formData,

            success: function (mensagem) {

                $('#mensagem').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!!") {
                    
                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php"

                } else {

                    $('#mensagem').addClass('text-danger')
                }

                $('#mensagem').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });

    $('#btn-deletar-categoria').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: "/excluir.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function (mensagem) {

                if (mensagem.trim() === 'Excluído com Sucesso!!') {


                    $('#btn-cancelar-excluir').click();
                    window.location = "index.php?pag=" + pag;
                }

                $('#mensagem_excluir').text(mensagem)



            },

        })
    })

    function carregarImg() {

        var target = document.getElementById('target');
        var file = document.querySelector("input[type=file]").files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);


        } else {
            target.src = "";
        }
    }
    $('#dataTable').dataTable({
        "ordering": false
    })
    // FIM CATEGORIA 

    // COMECO PRODUTOS
    $("#form").submit(function () {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "api/inserir.php",
            type: 'POST',
            data: formData,

            success: function (mensagem) {

                $('#mensagem').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!!") {
                    
                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pag="+pag;

                } else {

                    $('#mensagem').addClass('text-danger')
                }

                $('#mensagem').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });

    $('#btn-deletar').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: pag + "/excluir.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function (mensagem) {

                if (mensagem.trim() === 'Excluído com Sucesso!!') {


                    $('#btn-cancelar-excluir').click();
                    window.location = "index.php?pag=" + pag;
                }

                $('#mensagem_excluir').text(mensagem)



            },

        })
    });

    $("#form-img-produto").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "api/inserirImagensProduto",
            type: 'POST',
            data: formData,

            success: function (mensagem) {

                $('#mensagem').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!!") {

                   $('#mensagem_fotos').addClass('text-success')
                   $('#mensagem_fotos').text(mensagem)
                   listarImagensProd();

                } else {

                    $('#mensagem_fotos').addClass('text-danger')
                }

                $('#mensagem_fotos').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });

    $.ajax({
        url: pag + "/listar-imagens.php",
        method: "post",
        data: $('form').serialize(),
        dataType: "html",
        success: function (result) {

            $('#listar-img').html(result);
        }
    })
    function listarImagensProd() {
        $.ajax({
            url: pag + "/listar-imagens.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "html",
            success: function (result) {

                $('#listar-img').html(result);
            }
        })
    }
    $('#btn-deletar-img').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: pag + "/excluir-imagem.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function (mensagem) {

                if (mensagem.trim() === 'Excluído com Sucesso!!') {


                    $('#btn-cancelar-excluir').click();
                    window.location = "index.php?pag=" + pag;
                }

                $('#mensagem_excluir').text(mensagem)



            },

        })
    })

    function carregarImg() {

        var target = document.getElementById('target');
        var file = document.querySelector("input[type=file]").files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);


        } else {
            target.src = "";
        }
    }

    function deletarImg(img) {

        document.getElementById('id_foto').value = img;
        $('#modalDeletarImg').modal('show');

    }
    
    $(document).ready(function () {
        $('#dataTable').dataTable({
            "ordering": false
        })

    });

});
