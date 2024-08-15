function iniciarSessao()
{


    $.ajax({
        url:"pagseguro/pagcontrol.php",
        method:"post",
        dataType: "json",
        success: function(data) {
            PagSeguroDirectPayment.setSessionId(data.id);
            
        },
        complete: function(){
            
        }
    });

}

//lista bandeiras
// function listaMeiosPagamentos(){
//     PagSeguroDirectPayment.getPaymentMethods({
//         amount: 500.00,
//         success: function(data){
//             $.each(data.paymentMethods.CREDIT_CARD.options, function(i, obj){
//                 $('.credito').append("<div><img scr=https://stc.pagseguro.uol.com.br/"+obj.images.SMALL.path+">"+obj.name+"</div>")
//             });
//             $.each(data.paymentMethods.ONLINE_DEBIT.options, function(i, obj){
//                 $('.debito').append("<div>"+obj.name+"</div>")
//             });

//         },
//         complete: function(data){

//         }
//     });
// }
$('#Numerocartao').on('keyup',function(){
    var NumeroCartao = $(this).val();
    var QtdCaracteres = NumeroCartao.length;

    if (QtdCaracteres == 6){
        PagSeguroDirectPayment.getBrand({
            cardBin: NumeroCartao,
            success: function(response){
               var bandeira = response.brand.name;
               $('#bandeira').empty();
               $('#band').value(bandeira);
               getParcelas(bandeira);
            },
            error: function (response) {
                $('#bandeira').empty();
                $('#bandeira').html('Cartão não  reconhecido');
                
            }
        })
    }
})
function getParcelas(Bandeira) {
    PagSeguroDirectPayment.getInstallments({
        amount: 200.00,
        maxInstallmentNoInterest: 1,
        brand: Bandeira,
        success: function (response) {
            $.each(response.installments,function (i,obj) {
                $.each(obj,function (i2,obj2) {
                    var numbervalue = obj2.installmentAmount;
                    var number = "R$  "+numbervalue.toFixed(2).replace(".",",");
                    $('#QtdParcelas').show().append("<option value='"+number+"'>"+obj2.quantity+"x  de "+obj2.installmentAmount+" </option>")
                    
                })
                
            })
            
        }
    })
}
iniciarSessao();