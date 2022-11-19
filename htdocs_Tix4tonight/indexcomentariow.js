$(document).ready(function (){
    $("#enviar").click(function (){
       var form = new FormData($("#comentario")[0]);
       $.ajax({
           url: 'selectcomentario.php',
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

