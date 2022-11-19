<?php
session_start();

//Faz a leitura do dado passado pelo link.
$campoid = filter_input(INPUT_GET, 'id');

//Faz a conexão com o BD.
require_once 'conexao.php'; 

//Cria o SQL (consulte tudo da tabela usuarios)
$sql = "SELECT * FROM evento WHERE id = $campoid";
$sql2 = "SELECT * FROM ingresso WHERE Evento_idEvento = $campoid";

$clienteId = $_SESSION['id'];

$sql3 = "SELECT * FROM cliente WHERE idCliente = '$clienteId'";

$sql4 = "SELECT * FROM comentario WHERE Evento_idEvento = $campoid ORDER BY idComentario DESC";
 

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>Paginadoevento</title>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
	   
	   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	   
	<!-- Iconos -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"><link rel="stylesheet" href="./style.css">
	   
	   

	   
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Fuentes de Google -->
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
	<!-- Iconos -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"><link rel="stylesheet" href="./style.css">

	   
<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<link rel="stylesheet" href="css/Tela_Evento2.css"/>
<script src="jquery-3.1.1.min.js"></script>
<script src="index44.js"></script>
<script src="index45.js"></script>

</head>
<!-- HTML !-->
<style>
.button-60 {
  align-items: center;
  appearance: none;
  background-color: #fff;
  border: 1px solid #dbdbdb;
  border-radius: .375em;
  box-shadow: none;
  box-sizing: border-box;
  color: #363636;
  cursor: pointer;
  display: inline-flex;
  font-family: BlinkMacSystemFont,-apple-system,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
  font-size: 1rem;
  height: 2.5em;
  justify-content: center;
  line-height: 1.5;
  padding: calc(.5em - 1px) 1em;
  position: relative;
  text-align: center;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: top;
  white-space: nowrap;
}

.button-60:active {
  border-color: #4a4a4a;
  outline: 0;
}

.button-60:focus {
  border-color: #485fc7;
  outline: 0;
}

.button-60:hover {
  border-color: #b5b5b5;
}

.button-60:focus:not(:active) {
  box-shadow: rgba(72, 95, 199, .25) 0 0 0 .125em;
}
</style>
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
            <script src="https://js.stripe.com/v3/"></script> 
            
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
          <?php
          $result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
  // output data of each row
  ($row = mysqli_fetch_object($result2));
          $aaa = ($row->preco);
          $ccc = ($row->promocao);
}

          if ($aaa != 0.00 && $ccc != NULL) {

        echo '<div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">';
          
           
          echo '<div class="card card-profile shadow">';
           echo '<h1>Ingressos</h1>';

echo '<div class="shopping-cart">';

  echo '<div class="column-labels">';
    
	
   echo '<label class="product-details">Product</label>';
    echo '<label class="product-price">Preço</label>';
    echo '<label class="product-quantity"></label>';
   echo '<label class="product-line-price"></label>';
  echo '</div>';


       
	
        
        $result = mysqli_query($conn, "SELECT ingresso.preco, ingresso.dataLimite, ingresso.idIngresso, tipodeingresso.Tipo FROM ingresso INNER JOIN tipodeingresso ON ingresso.TipodeIngresso_idTipodeIngresso = tipodeingresso.idTipodeIngresso WHERE Evento_idEvento = $campoid AND promocao = 'null'");
		
        while ($row = mysqli_fetch_object($result))
        {
           
            $preco2 = ($row->preco);
               $idzz = ($row->idIngresso);
               $iddata = ($row->dataLimite);
               $date = date('d-m-y h:i:s');
                if(strtotime($iddata) > strtotime($date))
{
    echo '<div class="product">';
	echo '<div class="product-details">';
	echo '<div class="product-title">' . ($row->Tipo) . '</div>';
	echo '</div>';
	echo '<div class="product-price">' . 'R$' . ($row->preco) . '</div>';
	echo '<div class="">';
	echo '</div>';
	echo '<div class="product-line-price"></div>';
	echo include 'selecionaringresso.php';
	echo '</div>';

		} else {
		 echo '<div class="product">';
	echo '<div class="product-details">';
	echo '<div class="product-title">' . ($row->Tipo) . '</div>';
	echo '</div>';
	echo '<div class="product-price">' . 'Ingresso esgotado :(' . '</div>';
	echo '<div class="">';
	echo '</div>';
	echo '<div class="product-line-price"></div>';
	echo include 'selecionaringresso.php';
	echo '</div>';
		}
		    
}
  
 echo '<div id="paymentResponse">';

            $results = mysqli_query($conn,"SELECT * FROM ingresso WHERE Evento_idEvento = $campoid AND selecao = 'selecionado'");
            $row = mysqli_fetch_array($results,MYSQLI_ASSOC);
      
  echo '<div class="totals">';
    echo '<div class="totals-item totals-item-total">';

$resultzz = mysqli_query($conn, "SELECT ingresso.idIngresso, ingresso.promocao, tipodeingresso.Tipo FROM ingresso INNER JOIN tipodeingresso ON ingresso.TipodeIngresso_idTipodeIngresso = tipodeingresso.idTipodeIngresso WHERE Evento_idEvento = $campoid");
		$row2 = mysqli_fetch_object($resultzz);

        if (($row2->promocao) == ($row2->promocao)) {
		
        while ($row2 = mysqli_fetch_object($resultzz))
        {

 echo '<div class="product">';
	echo '<div class="product-details">';
	echo '<div class="product-title">' . 'Cortesia' . '</div>';
	echo '</div>';
	echo '<div class="product-price"></div>';
	echo '<div class="">';
	echo '</div>';
	echo '<div class="product-line-price"></div>';
	   	   	echo include 'modalpromocao.php';
	echo '</div>';

}
}

    echo '</div>';
  echo '</div>';

echo '</div>';
echo '</div>';
} elseif (($row->preco) == 0.00) {
    echo '<div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">';
          
           
      echo '<div class="card card-profile shadow">';
          echo  '<h1>Ingressos gratuitos</h1>';
           
           echo '<div class="shopping-cart">';

 echo '<div class="column-labels">';
    
	
    echo '<label class="product-details">Product</label>';
    echo '<label class="product-price"></label>';
    echo '<label class="product-quantity"></label>';
    echo '<label class="product-line-price"></label>';
  echo '</div>';
		
		  $result = mysqli_query($conn, "SELECT ingresso.preco, ingresso.idIngresso, tipodeingresso.Tipo FROM ingresso INNER JOIN tipodeingresso ON ingresso.TipodeIngresso_idTipodeIngresso = tipodeingresso.idTipodeIngresso WHERE Evento_idEvento = $campoid");
		
        while ($row = mysqli_fetch_object($result))
        {
            
    echo '<div class="product">';
    echo '<form action="sucessogratuito.php" method="post" >';
	echo '<div class="product-details">';
	echo '<div class="product-title">' . ($row->Tipo) . '</div>';
	echo '</div>';
	echo '<div class="product-price"></div>';
	echo '<div class="">';
	echo '</div>';
	echo '<div class="product-line-price"></div>';
    echo '<input type="hidden" name="idIngresso" value=' . ($row->idIngresso) . '>';
	echo'<input type="submit" class="button-80" role="button" value="resgatar">';
	echo'</form>';
	echo '</div>';

		
        }

      
  echo '<div class="totals">';
    echo '<div class="totals-item totals-item-total">';

    echo '</div>';
  echo '</div>';

echo '</div>';
}
?>
 
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
              <?php
//Executa o SQL
$resultzxzx = $conn->query($sql3);

	//Se a consulta tiver resultados
	 if ($resultzxzx->num_rows > 0) {

// Cria uma matriz com o resultado da consulta
 $row3 = $resultzxzx->fetch_assoc();

        echo '<form id="comentario1">';
            echo '<div class="inputBox">';
                echo' <br>';
                
               echo '<input type="hidden" name="nome" value= ' . $row3["nome"] . '>';
                  
                 echo '<input type="hidden" name="idCliente" value= ' . $clienteId . '>';
                    
                  echo '<input type="hidden" name="idEvento" value= ' . $campoid . '>';
            echo '</div>';
            echo '<div class="inputBox">';
                echo '<label for="comentario">Campo de comentários --</label>';
               echo  '<br>'; 
               echo '<div class="form-floating">';
  echo'<textarea name="comentario" class="form-control" placeholder="..." id="floatingTextarea2" style="height: 100px"></textarea>';
  echo '<label for="floatingTextarea2">Comente algo bom ;)</label>';
echo '</div>';
            echo '</div>';
              echo '<div>';
                echo '<h1>‎</h1>';
                echo '</div>';
         echo '<button class="button-60" role="button" type="button" id="enviar1" onClick="window.location.reload();" >></button>';
        echo '</form>';
        echo '<hr>';
        echo '<div class="content" id="content">';
            
        echo '</div>';
	 }
        
        ?>
        
        
                    
                </div>
            </div>
        </div>
					
<style>
 /**
 * Oscuro: #283035
 * Azul: #03658c
 * Detalle: #c7cacb
 * Fondo: #dee1e3
 ----------------------------------*/
 * {
 	margin: 0;
 	padding: 0;
 	-webkit-box-sizing: border-box;
 	-moz-box-sizing: border-box;
 	box-sizing: border-box;
 }

 a {
 	color: #0D0C22;
 	text-decoration: none;
 }

ul {
	list-style-type: none;
}

body {
	font-family: 'Roboto', Arial, Helvetica, Sans-serif, Verdana;
	background: #dee1e3;
}

/** ====================
 * Lista de Comentarios
 =======================*/
.comments-container {
	margin: 60px auto 15px;
	width: 768px;
}

.comments-container h1 {
	font-size: 36px;
	color: #0D0C22;
	font-weight: 400;
}

.comments-container h1 a {
	font-size: 18px;
	font-weight: 700;
}

.comments-list {
	margin-top: 30px;
	position: relative;
}





.reply-list:before, .reply-list:after {display: none;}
.reply-list li:before {
	content: '';
	width: 60px;
	height: 2px;
	background: #0D0C22;;
	position: absolute;
	top: 25px;
	left: -55px;
}


.comments-list li {
	margin-bottom: 15px;
	display: block;
	position: relative;
}

.comments-list li:after {
	content: '';
	display: block;
	clear: both;
	height: 0;
	width: 0;
}

.reply-list {
	padding-left: 88px;
	clear: both;
	margin-top: 15px;
}
/**
 * Avatar
 ---------------------------*/
.comments-list .comment-avatar {
	width: 65px;
	height: 65px;
	position: relative;
	z-index: 99;
	float: left;
	border: 3px solid #0D0C22;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	overflow: hidden;
}

.comments-list .comment-avatar img {
	width: 100%;
	height: 100%;
}

.reply-list .comment-avatar {
	width: 50px;
	height: 50px;
}

.comment-main-level:after {
	content: '';
	width: 0;
	height: 0;
	display: block;
	clear: both;
}
/**
 * Caja del Comentario
 ---------------------------*/
.comments-list .comment-box {
	width: 680px;
	float: right;
	position: relative;
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.15);
	-moz-box-shadow: 0 1px 1px rgba(0,0,0,0.15);
	box-shadow: 0 1px 1px rgba(0,0,0,0.15);
}

.comments-list .comment-box:before, .comments-list .comment-box:after {
	content: '';
	height: 0;
	width: 0;
	position: absolute;
	display: block;
	border-width: 10px 12px 10px 0;
	border-style: solid;
	border-color: transparent #0D0C22;
	top: 8px;
	left: -11px;
}

.comments-list .comment-box:before {
	border-width: 11px 13px 11px 0;
	border-color: transparent rgba(0,0,0,0.05);
	left: -12px;
}

.reply-list .comment-box {
	width: 610px;
}
.comment-box .comment-head {
	background: #FCFCFC;
	padding: 10px 12px;
	border-bottom: 1px solid #E5E5E5;
	overflow: hidden;
	-webkit-border-radius: 4px 4px 0 0;
	-moz-border-radius: 4px 4px 0 0;
	border-radius: 4px 4px 0 0;
}

.comment-box .comment-head i {
	float: right;
	margin-left: 14px;
	position: relative;
	top: 2px;
	color: #A6A6A6;
	cursor: pointer;
	-webkit-transition: color 0.3s ease;
	-o-transition: color 0.3s ease;
	transition: color 0.3s ease;
}

.comment-box .comment-head i:hover {
	color: #03658c;
}

.comment-box .comment-name {
	color: #283035;
	font-size: 14px;
	font-weight: 700;
	float: left;
	margin-right: 10px;
}

.comment-box .comment-name a {
	color: #283035;
}

.comment-box .comment-head span {
	float: left;
	color: #999;
	font-size: 13px;
	position: relative;
	top: 1px;
}

.comment-box .comment-content {
	background: #FFF;
	padding: 12px;
	font-size: 15px;
	color: #595959;
	-webkit-border-radius: 0 0 4px 4px;
	-moz-border-radius: 0 0 4px 4px;
	border-radius: 0 0 4px 4px;
}

.comment-box .comment-name.by-author, .comment-box .comment-name.by-author a {color: #03658c;}
.comment-box .comment-name.by-author:after {
	background: #03658c;
	color: #FFF;
	font-size: 12px;
	padding: 3px 5px;
	font-weight: 700;
	margin-left: 10px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}

/** =====================
 * Responsive
 ========================*/
@media only screen and (max-width: 766px) {
	.comments-container {
		width: 480px;
	}

	.comments-list .comment-box {
		width: 390px;
	}

	.reply-list .comment-box {
		width: 320px;
	}
}
</style>
					
					<div class="comments-container">

    <ul id="comments-list" class="comments-list">
        
				<?php
				
				  $resultzzzc = mysqli_query($conn, $sql4);

    if (mysqli_num_rows($resultzzzc) > 0) {
        while ($row4 = mysqli_fetch_assoc($resultzzzc)) {
            
			echo	'<li>';
		echo	'<div class="comment-main-level">';
					echo '<div class="comment-box">';
						echo '<div class="comment-head">';
						echo 	'<h6 class="comment-name by-author">' . $row4['nome'] . ' | ' . date('d/m/Y', strtotime($row4['comentario_data'] )). ' </a></h6>';
						echo 	'<span' . date('d/m/Y', strtotime($row4['comentario_data'] )). '</span>';
					echo	'</div>';
					echo	'<div class="comment-content">';
						echo $row4['comentario'];
						echo'</div>';
				echo	'</div>';
        }
    
				
			echo	'</div>';
			echo	'</li>';
			

				?>
			
		</ul>
	</div>

      </div>
      
     <?php
     
     	//Se a consulta não tiver resultados  			
	} else {
		echo "<h1>Nenhum resultado foi encontrado.</h1>";
	}

	//Fecha a conexão.	
	$conn->close();
	
     
     ?>
    </div>
  </footer>
   <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script><script  src="./script.js"></script>
   <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src=""></script>
</body>