$(document).ready(function (){
    $("#enviar1").click(function (){
       var form = new FormData($("#comentario1")[0]);
       $.ajax({
           url: 'inserecomment.php',
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