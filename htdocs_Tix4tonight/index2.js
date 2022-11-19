$(document).ready(function (){
    $("#definir1").click(function (){
       var form = new FormData($("#ingressotipo")[0]);
       $.ajax({
           url: 'ingressomodal1.php',
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

