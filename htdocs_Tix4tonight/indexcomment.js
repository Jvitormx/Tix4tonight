$(document).ready(function (){
    $("#comentarioo2").click(function (){
       var form = new FormData($("#comentarioo")[0]);
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

