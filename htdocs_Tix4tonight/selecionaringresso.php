<style>
    #myform {
	 text-align: center;
	 padding: 5px;
	 border: 1px dotted #ccc;
	 margin: 2%;
}
 .qty {
	 width: 40px;
	 height: 25px;
	 text-align: center;
}
 input.qtyplus {
	 width: 25px;
	 height: 25px;
}
 input.qtyminus {
	 width: 25px;
	 height: 25px;
}
 
</style>

        <button type="button" class="button-80" role="button" data-bs-toggle="modal" data-bs-target="#myModal2"><span>Selecionar</span></button>
        <div class="modal" id="myModal2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Definir quantidade - Até <?php echo date('d/m', strtotime($iddata )) ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                       
                       
                       <form id='myform' class='quantity'>
  <input type='button' value='-' class="btn btn-primary" id="payButton2" field='quantity' />

  <input type='button' id="payButton" value='+' class="btn btn-primary" field='quantity' />
</form>
				
        <div id="paymentResponse">
            
            
            <form id='myform' class='quantity'>
  
  <div id="total">

                      0
                </div>

</form>
            
                <!-- Buy button -->
				<div id="comprar">
				     <div class="modal-footer">
                    <button class="btn btn-primary" id="comprar"> Comprar </button>
                    </div>
                </div>
                </div>
        
    </div>  
     </div>

<script>
var buyBtn = document.getElementById('payButton');
var buyBtn2 = document.getElementById('payButton2');
var comprar = document.getElementById('comprar');
 const  x = "<?php echo $preco2 ?>"
  var z = parseFloat(x);
  var  y = "<?php echo $idzz ?>"

var responseContainer = document.getElementById('paymentResponse'); 

var total = document.getElementById('total');
var resultado = 0;
var planos = [];
planos["1"] = 0;

buyBtn.addEventListener("click", function (evt) {
planos["1"] += 1;
resultado += z;
total.innerHTML = "Quantidade - " + planos["1"] + " Total: R$" + resultado;
});

buyBtn2.addEventListener("click", function (evt) {
planos["1"] -= 1;
resultado -= z;
total.innerHTML = "Quantidade - " + planos["1"] + " Total: R$" + resultado;
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
            Ingresso: y,
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
                    </div>
                    
                </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>