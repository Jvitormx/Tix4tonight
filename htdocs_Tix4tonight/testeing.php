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
		
		 <?php 
            $results = mysqli_query($conn,"SELECT * FROM ingresso WHERE idIngresso=112");
            $row = mysqli_fetch_array($results,MYSQLI_ASSOC);
            $plano1 = $row['preco'];
        ?>
            <div class="col__box">
              <h5><?php echo $plano1 ?></h5>
                <h6>Preço: <span> R$<?php echo $row['preco'] ?> </span> </h6>
				
        <div id="paymentResponse">
            
                <!-- Buy button -->
                <div id="buynow">
                    <button class="btn__default" id="payButton"> Adicionar </button>
                </div>
            </div>
    
			    <div id="total">
                    0
                </div>
				<div id="comprar">
                    <button class="btn__default" id="comprar"> Comprar </button>
                </div>
        </div>
    </div>  

<script>
var buyBtn = document.getElementById('payButton');
var comprar = document.getElementById('comprar');

var responseContainer = document.getElementById('paymentResponse'); 

var total = document.getElementById('total');
var resultado = 0;
var planos = [];
planos["1"] = 0;

buyBtn.addEventListener("click", function (evt) {
planos["1"] += 1;
resultado += 10;
total.innerHTML = "I - " + planos["1"] + " Total - " + resultado;
});

comprar.addEventListener("click", function (evt) {
    comprar.disabled = true;
    comprar.textContent = 'Processando...';

    createCheckoutSession().then(function (data) {
        if(data.sessionId){
            stripe.redirectToCheckout({
                sessionId: data.sessionId,
            }).then(handleResult3);
        }else{
            handleResult3(data);
        }
    });
});

var createCheckoutSession = function (stripe) {
    return fetch("stripe_charge.php", {
        method: "POST",
        headers: {
            "Content-Type": "aplication/json",
        },
        body: JSON.stringify({
            checkoutSession: 3,
            Planos: planos,
            Price: resultado,
        }),
    }).then(function (result3) {
        return result3.json();
    });
};

var handleResult3 = function (result3) {
    if (result3.error) {
        responseContainer.innerHTML = '<p>'+result3.error.message+'</p>';
    }
    comprar.disabled = false;
    comprar.textContent = 'Comprar';
};

// Chave pública usada pelo Stripe.js
var stripe = Stripe('<?php echo 'pk_test_51LICzTBPFZTTvEngdqR3XTBDXQeKf5OowAjPkDd0Uqslv2PCGaKDS5aiJOTFfH9On3cb1YYKbTU6fOX3KbAo8nj900bIDdGIhd'; ?>');

</script>

</body>
</html>