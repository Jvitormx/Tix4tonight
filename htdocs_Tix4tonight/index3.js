$(document).ready(function (){
    $("#definir2").click(function (){
       var form = new FormData($("#ingressotipo2")[0]);
       $.ajax({
           url: 'ingresso2.php',
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

