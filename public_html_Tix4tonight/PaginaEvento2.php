<?php
session_start();

//Faz a leitura do dado passado pelo link.
$campoid = filter_input(INPUT_GET, 'id');

//Faz a conexão com o BD.
require_once 'conexao.php'; 

//Cria o SQL (consulte tudo da tabela usuarios)
$sql = "SELECT * FROM evento WHERE id = $campoid";
$sql2 = "SELECT * FROM ingresso WHERE Evento_idEvento = $campoid";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>Paginadoevento</title>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	  
<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="css/Tela_Evento2.css"/>
<script src="jquery-3.1.1.min.js"></script>
<script src="index44.js"></script>

</head>
<body>
  <div class="main-content">
    <!-- Top navbar -->
	
     
	
    <!-- Header -->
    
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style=" min-height: 600px; background-image: url(https://cdn.discordapp.com/attachments/498218254284750868/1012705444852142110/istockphoto-1191658515-612x612.png)">

	  <!-- Mask -->
      <span class=""></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <div class="container">
			<?php
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
 while ($row = mysqli_fetch_object($result))
        {
    echo '<div class="ishadow">' . '<img src="data:image/jpeg;base64,'.base64_encode($row->img) .'" data-blur="20" data-hover="true" />' . '</div>';
  }
} else {
  echo "0 results";
}
?>
  <div class="text-container">
    
  </div>
</div>
<!-- partial -->
  <script src='https://cdn.jsdelivr.net/gh/tunguskha/Image-shadow@latest/assets/js/image-shadow.js'></script><script  src="./script.js"></script>
            
            
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          
           
          <div class="card card-profile shadow">
           <h1>Ingressos</h1>
<script src="https://js.stripe.com/v3/"></script> 

<div class="shopping-cart">

  <div class="column-labels">
    
	
    <label class="product-details">Product</label>
    <label class="product-price">Preço</label>
    <label class="product-quantity">Quantidade</label>
    <label class="product-line-price"></label>
  </div>


        <!-- Display errors returned by checkout session -->
      
<?php
	
        
        $result = mysqli_query($conn, "SELECT ingresso.preco, ingresso.idIngresso, tipodeingresso.Tipo FROM ingresso INNER JOIN tipodeingresso ON ingresso.TipodeIngresso_idTipodeIngresso = tipodeingresso.idTipodeIngresso WHERE Evento_idEvento = $campoid");
		
        while ($row = mysqli_fetch_object($result))
        {
    echo '<div class="product">';
    echo '<form id="pagamento1">';
	echo '<div class="product-details">';
	echo '<div class="product-title">' . ($row->Tipo) . '</div>';
	echo '</div>';
	echo '<div class="product-price">' . 'R$' . ($row->preco) . '</div>';
	echo '<div class="">';
	echo '</div>';
	echo '<div class="product-line-price"></div>';
    echo '<input type="hidden" name="idIngresso" value=' . ($row->idIngresso) . '>';
	echo'<input type="button"  onClick="window.location.reload();" class="button-80" role="button" id="pagamento2" value="Selecionar">';
	echo'</form>';
	echo '</div>';

		}
    ?>
<div id="paymentResponse">
<?php 
            $results = mysqli_query($conn,"SELECT * FROM ingresso WHERE Evento_idEvento = $campoid AND selecao = 'selecionado'");
            $row = mysqli_fetch_array($results,MYSQLI_ASSOC);
        ?>
  <div class="totals">
    <div class="totals-item totals-item-total">

    </div>
  </div>
      <div id="buynow">
   <button class="btn__default" id="payButton"> Prosseguir para compra </button>
                </div>

</div>
</div>
 


<script>
var buyBtn = document.getElementById('payButton');

var responseContainer = document.getElementById('paymentResponse'); 

const container = document.getElementById('container');
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
            Quantity: "<?php echo $row['quantidadeTotal']; ?>",
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
    buyBtn.textContent = 'Prosseguir para compra';
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

          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
				<?php
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
 while ($row = mysqli_fetch_object($result))
        {
    echo '<h1 class="mb-0">' . ($row->title) . '</h1>';
     echo '-----------------------------';
	echo '<h3>' . date('d/m - H:i', strtotime($row->start)) . ' | ' . date('d/m - H:i', strtotime($row->end)) . '</h3>';
	 echo '<h1 class="mb-0">' . '</h1>';
	echo '<h3>' . 'Evento em ' . ($row->infLocal) . ', ' . ($row->cidade) . ' - ' . ($row->estado) . '</h3>';
  }
} else {
  echo "0 results";
}
?>
                </div>
                <div class="col-4 text-right">
                 
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">Descrição do evento</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                         <?php
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<p>$row[description]</p>";
  }
} else {
  echo "0 results";
}
?>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                   
                    
                  </div>
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Local do evento</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                         <?php
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<p><b>$row[infLocal]</b></p>";
    echo "<p> $row[rua], bairro $row[bairro], $row[cidade] - $row[estado]</p>";
     echo "<p>CEP: $row[cep]</p>";
  }
} else {
  echo "0 results";
}
?>
                      </div>
                    </div>
                  </div>
               
                </div>
                <hr class="my-4">
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">Sobre o Organizador</h6>
                <div class="pl-lg-4">
                  <div class="form-group focused">
                    
                    <p>org@gmail.com</p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
        
      </div>
    </div>
  </footer>
   <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script><script  src="./script.js"></script>
   <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src=""></script>
</body>