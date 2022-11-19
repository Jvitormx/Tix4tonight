$(document).ready(function (){
    $("#submit01").click(function (){
       var form = new FormData($("#evento01")[0]);
       $.ajax({
           url: 'ingresso4.php',
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

