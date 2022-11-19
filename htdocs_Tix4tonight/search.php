<?php
session_start();
//Verifica se o usuário logou.
if(!isset ($_SESSION['nome']) || !isset ($_SESSION['acesso']))
{
  unset($_SESSION['nome']);
  unset($_SESSION['acesso']);
  header('location:login.html');
  exit;
}

//Cria variáveis com a sessão.
$logado = $_SESSION['nome'];
$acesso = $_SESSION['acesso'];

    if (isset($_POST['submit'])) {
        // Connect to the database
        $connection_string = new mysqli("127.0.0.1", "root", "", "id18872511_tix4tonightzz");
        
        // Escape the search string and trim
        // all whitespace
        $searchString = mysqli_real_escape_string($connection_string, trim(htmlentities($_POST['search'])));
         $searchString2 = mysqli_real_escape_string($connection_string, trim(htmlentities($_POST['search'])));

        // If there is a connection error, notify
        // the user, and Kill the script.
        if ($connection_string->connect_error) {
            echo "Failed to connect to Database";
            exit();
        }

        // Check for empty strings and non-alphanumeric
        // characters.
        // Also, check if the string length is less than
        // three. If any of the checks returns "true",
        // return "Invalid search string", and
        // kill the script

        // We are using a prepared statement with the
        // search functionality to prevent SQL injection.
        // So, we need to prepend and append the search
        // string with percent signs
        $searchString = "%$searchString%";
          $searchString2 = "%$searchString2%";

        // The prepared statement
        $sql = "SELECT * FROM evento WHERE title LIKE ? OR bairro LIKE ?"; 
        // Prepare, bind, and execute the query
        $prepared_stmt = $connection_string->prepare($sql);
        $prepared_stmt->bind_param('ss', $searchString, $searchString2);
        $prepared_stmt->execute();

        // Fetch the result
        $result = $prepared_stmt->get_result();
		
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
<link rel="stylesheet" href="css/menu4.css"/>
<link rel="stylesheet" href="css/search.css"/>
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet"> 
<link rel="stylesheet" href="css/principal.css"/>
    <link rel="icon" type="image/x-icon" href="/imagens/favicon.ico"> 
  
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css'>

      <title>Tix4tonight</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="icon" type="image/x-icon" href="/imagens/favicon.ico"> 

      <title>Tix4tonight</title>
       <script src="cont.js"></script>
	  
   </head>
   <body>
       <style>
.flex-container {
  display: flex;
  flex-wrap:wrap;
}

.item {
  height: 250px;
  width:250px;
  margin:30px;
  column-gap:20px;
}


.item:before {
  content:counter();
  counter-increment:;
}
body {
  font: 400 14px 'Arial', sans-serif;
  counter-reset:num;
}
</style>
      <nav>
         <div class="menu-icon">
         </div>
         <div class="logo">
           <a href="principal.php"><img src="logo7.svg"></a>
           
         </div>
         </div>
         <div class="nav-items">
            <form action="search.php" method="post">
            <input type="text" class="search-data" name="search" placeholder=". . ." required>
            <button type="submit" name="submit" class="fas fa-search"></button>
         </form>
           
         </div>
         <div class="search-icon">
            <span class="fas fa-search"></span>
         </div>
         <div class="cancel-icon">
            <span class=""></span>
         </div>
<div class="User-area">
  <div class="User-avtar">
   <img src="user77.svg">
  </div>
    <ul class="User-Dropdown ">
	  <li><a>Acesso: <?php echo $acesso;?></a></li>
	  <?php 
//Menu só aparece para os administradores.
if($_SESSION['acesso']=="Org"){
    echo "<li><a href='sidebar_org.php'>Perfil</a></li>";
} else {
	echo "<li><a href='sidebar_cliente.html'>Perfil</a></li>";
}
?>
      <li><a href="deslogar.php">Deslogar</a></li>
    </ul>
</div>

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script><script  src="./script2.js"></script>
          
                     <?php 
//Menu só aparece para os administradores.
if($_SESSION['acesso']=="Org"){
    echo "<a class='cta' href='tela_criar_evento.php'>Criar evento ⇪</a>";
} else {
	echo "<a class='cta' href='cadastro_Organizador.html'>Seja Organizador</a>";
}
?>
      </nav>
      <script>
          //total number of element
var elems = document.querySelectorAll('.item');
var n_t = elems.length;
//width of an element
var w = parseInt(document.querySelector('.item').offsetWidth);
//full width of element with margin
var m = document.querySelector('.item').currentStyle || window.getComputedStyle(document.querySelector('.item'));
w = w + parseInt(m.marginLeft) + parseInt(m.marginRight);
//width of container
var w_c = parseInt(document.querySelector('.flex-container').offsetWidth);
//padding of container
var c = document.querySelector('.flex-container').currentStyle || window.getComputedStyle(document.querySelector('.flex-container'));
var p_c = parseInt(c.paddingLeft) + parseInt(c.paddingRight);


var adjust = function(){
   //only the width of container will change
   w_c = parseInt(document.querySelector('.flex-container').offsetWidth);
   //Number of columns
   nb = Math.min(parseInt((w_c - p_c) / w),n_t);
   //Number of rows
   nc = Math.ceil(n_t/nb);
   for(var j = 0;j<nb;j++) {
     for(var i = 0;i<nc;i++) {
       if(j + i*nb >= n_t) /* we exit if we reach the number of elements*/
        break
       if(i%2!=1) 
         elems[j + i*nb].style.order=j + i*nb; /* normal flow */
       else
         elems[j + i*nb].style.order=(nb - j) + i*nb; /* opposite flow */
     }
    }
}

adjust()
window.addEventListener('resize', function(){adjust()})
      </script>
	  

	  
	  <?php

	  if ($result->num_rows > 0) {
		  while ($row = mysqli_fetch_object($result))
        {
            echo '<div class="flex-container">';
  echo ' <div class="item">';
		echo '<div class="card">';
  echo '<h4 id="id1"> Dta: ' . date('d/m - H:i', strtotime($row->start)) . '</h4>';
  echo '<div class="card-img">';
 echo '<img src="data:image/jpeg;base64,'.base64_encode($row->img) .'" />';
  echo '</div>';
  echo '<div class="card-text">';
    echo '<a href="PaginaEvento2.php?id=' . ($row->id) . '">' . '<h2 class="versionn-one">' . ($row->title) . '</h2>' . '</a>';
    echo '<p class="version-one">' . ($row->infLocal) . ' - ' . ($row->cidade) . '<p>';
  echo '</div>';
echo '</div>';
				  echo'</div>';
				  echo '</div>';
		}


        } else {
        exit();
    }
	  }
	  
	?>
