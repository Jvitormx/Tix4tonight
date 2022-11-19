<?php
// Conexão com o BD  
require_once 'conexao.php'; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>Selecione o seu plano</title>
<meta charset="utf-8">
<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>
</head>
<body class="App">
    <h1>Pagamento</h1>
    <div class="wrapper">
        <!-- Display errors returned by checkout session -->
        <div id="paymentResponse">
        <?php 
            $results = mysqli_query($conn,"SELECT * FROM ingresso WHERE idIngresso=10");
            $row = mysqli_fetch_array($results,MYSQLI_ASSOC);
        ?>
            <div class="col__box">

                <h6>Preço: <span> R$<?php echo $row['preco'] ?> </span> </h6>
            <?php echo $row['idIngresso'] ?>
			 <?php echo $row['preco'] ?>
                <!-- Buy button -->
                <div id="buynow">
                    <button class="btn__default" id="payButton"> Assinar agora </button>
                </div>
            </div>
            
        </div>
    </div>  

<script>
var buyBtn = document.getElementById('payButton');

var responseContainer = document.getElementById('paymentResponse'); 

// Aciona o stripe_charge e passa dados
var createCheckoutSession = function (stripe) {
    return fetch("stripe_charge.php", {
        method: "POST",
        headers: {
            "Content-Type": "aplication/json",
        },
        body: JSON.stringify({
            checkoutSession: 1,
            ID:"<?php echo $row['idIngresso']; ?>",
            Price:"<?php echo $row['preco']; ?>",
        }),
    }).then(function (result) {
        return result.json();
    });
};


// Exibe erros retornados pelo Checkout
var handleResult = function (result) {
    if (result.error) {
        responseContainer.innerHTML = '<p>'+result.error.message+'</p>';
    }
    buyBtn.disabled = false;
    buyBtn.textContent = 'Assinar agora';
};

// Chave pública usada pelo Stripe.js
var stripe = Stripe('pk_test_51LICzTBPFZTTvEngdqR3XTBDXQeKf5OowAjPkDd0Uqslv2PCGaKDS5aiJOTFfH9On3cb1YYKbTU6fOX3KbAo8nj900bIDdGIhd');

buyBtn.addEventListener("click", function (evt) {
    buyBtn.disabled = true;
    buyBtn.textContent = 'Processando...';
    createCheckoutSession().then(function (data) {
        if(data.sessionId){
            stripe.redirectToCheckout({
                sessionId: data.sessionId,
            }).then(handleResult);
        }else{
            handleResult(data);
        }
    });
});
</script>

</body>
</html>