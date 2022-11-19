$(document).ready(function (){
    $("#pagamento2").click(function (){
       var form = new FormData($("#pagamento1")[0]);
       $.ajax({
           url: 'selecionar.php',
           type: 'post',
           dataType: 'json',
           cache: false,
           processData: false,
           contentType: false,
           data: form,
           timeout: 8000,
           success: function(resultado){
           }
       });
    });
});

