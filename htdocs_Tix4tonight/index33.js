$(document).ready(function (){
    $("#submit").click(function (){
       var form = new FormData($("#evenoo")[0]);
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

