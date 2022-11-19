$(document).ready(function (){
    $("#submit0").click(function (){
       var form = new FormData($("#evento0")[0]);
       $.ajax({
           url: 'ingresso3.php',
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

