<?php
session_start();
//Verifica se o usuário logou.
if(!isset ($_SESSION['nome']) || !isset ($_SESSION['acesso']))
{
  unset($_SESSION['nome']);
  unset($_SESSION['acesso']);
  header('location:index.html');
  exit;
} 

//Cria variáveis com a sessão.
$logado = $_SESSION['nome'];
$acesso = $_SESSION['acesso'];
require 'conexao.php';
?>

<html lang="pt-br" > 
<head>
   <meta charset="UTF-8">
   
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet"> 
<link rel="stylesheet" href="css/principal.css"/>
    <link rel="icon" type="image/x-icon" href="/imagens/favicon.ico"> 
  
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css'>

      <title>Tix4tonight</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <nav>
         <div class="menu-icon">
         </div>
         <div class="logo">
           <a href="principal3.php"><img src="logo72.svg"></a>
           
         </div>
         </div>
         <div class="nav-items">
            <form action="search.php" method="post">
            <input type="text" class="search-data" name="search" placeholder=". . ." required>
            <button type="submit" name="submit" class="fas fa-search"></button>
         </form>
           
           <div class="nav-items">
            <a href="eventoscontrolar.html"><img src="calendar.svg"></a>
           
         </div>
           
         </div>
         
          
         <div class="search-icon">
            <span class="fas fa-search"></span>
         </div>
         <div class="cancel-icon">
            <span class=""></span>
         </div>
<div class="User-area">
  <div class="User-avtar">
   <img src="user88.svg">
  </div>
    <ul class="User-Dropdown ">
	  <?php 
//Menu só aparece para os administradores.
if($_SESSION['acesso']=="Org"){
    echo "<li><a href='sidebar_org.php'>Perfil | ". $acesso ."</a></li>";
} elseif ($_SESSION['acesso']=="Comum") {
	echo "<li><a href='sidebar_cliente.php'>Perfil | ". $acesso ."</a></li>";
} else {
    echo "<li><a href='sidebar_adm.php'>Perfil | ". $acesso ."</a></li>";
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
<body>
<!-- partial:index.partial.html -->
<?php

//Faz a conexão com o BD.
require 'conexao.php';

?>

<section class="game-section">
  <h2 id="id1" class="line-title">Ultimos eventos</h2>
  <div class="owl-carousel custom-carousel owl-theme">
    
	<?php
	
        $result = mysqli_query($conn, "SELECT * FROM evento ORDER BY id DESC");
		
        while ($row = mysqli_fetch_object($result))
        {
			echo '<div class="item active" style="background-image: url(data:image/jpeg;base64,'.base64_encode($row->img) .'); ">';
			 echo '<div class="item-desc">';
			 echo '<a href="PaginaEvento2.php?id=' . ($row->id) . '">' . '<h3 id=id2>' . ($row->title) . '</h3>' . '</a>';
			echo '<p>' . date('d/m - H:i', strtotime($row->start)) . '</p>';
			echo '<p>' . ($row->description)  . '</p>';
			echo '</div>';
            echo ' </div>';
			}
          ?>

  </div>
  </div>
</section>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script><script  src="./roll2.js"></script>
  
  <?php

//Faz a conexão com o BD.
require 'conexao.php';

?>

<div class="wrapper">

	<h2 class=versionzero><strong>Festivais e shows<span></span></strong></h2>

	<div class="cards">

		<div class="slider">
  <button id="prev" class="btn">
    <i class="las la-angle-left"></i>
  </button>
<div class="card-content">


<?php
	
        $result = mysqli_query($conn, "SELECT * FROM evento WHERE Categoria_idCategoria = '5' ORDER BY id DESC");
		
        while ($row = mysqli_fetch_object($result))
        {
			
    echo '<div class="card">';
  echo '<h4 id="id1"> Dta: ' . date('d/M', strtotime($row->start)) . ' > ' . date('d/M', strtotime($row->end)) . '</h4>';
  echo '<div class="card-img">';
 echo '<img src="data:image/jpeg;base64,'.base64_encode($row->img) .'" />';
  echo '</div>';
  echo '<div class="card-text">';
    echo '<a href="PaginaEvento2.php?id=' . ($row->id) . '">' . '<h2 class="versionn-one">' . ($row->title) . '</h2>' . '</a>';
    echo '<p class="version-one">' . ($row->infLocal) . ' - ' . ($row->cidade) . '<p>';
  echo '</div>';
echo '</div>';

		}
    ?>

   
  </div>
<button id="next" class="btn">
    <i class="las la-angle-right"></i>
  </button>
</div>

	</div>
  
  
  <h2 class=versionzero><strong>Passeios e tours<span></span></strong></h2>

	<div class="cards">

		<div class="slider">
  <button id="prev" class="btn">
    <i class="las la-angle-left"></i>
  </button>
  
<div class="card-content">


    <?php
	
        $result = mysqli_query($conn, "SELECT * FROM evento WHERE Categoria_idCategoria = '6' ORDER BY id DESC");
		
        while ($row = mysqli_fetch_object($result))
        {
			
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

		}
    ?>
    
    
    
  </div>
<button id="next" class="btn">
    <i class="las la-angle-right"></i>
  </button>
</div>

	</div>
	
	<h2 class=versionzero><strong>Gastronomia<span></span></strong></h2>

	<div class="cards">

		<div class="slider">
  <button id="prev" class="btn">
    <i class="las la-angle-left"></i>
  </button>
  
<div class="card-content">


    <?php
	
        $result = mysqli_query($conn, "SELECT * FROM evento WHERE Categoria_idCategoria = '7' ORDER BY id DESC");
		
        while ($row = mysqli_fetch_object($result))
        {
			
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

		}
    ?>
    
    
    
  </div>
<button id="next" class="btn">
    <i class="las la-angle-right"></i>
  </button>
</div>

	</div>
	
	<h2 class=versionzero><strong>Feiras e exposições<span></span></strong></h2>

	<div class="cards">

		<div class="slider">
  <button id="prev" class="btn">
    <i class="las la-angle-left"></i>
  </button>
  
<div class="card-content">


    <?php
	
        $result = mysqli_query($conn, "SELECT * FROM evento WHERE Categoria_idCategoria = '10' ORDER BY id DESC");
		
        while ($row = mysqli_fetch_object($result))
        {
			
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

		}
    ?>
    
    
    
  </div>
<button id="next" class="btn">
    <i class="las la-angle-right"></i>
  </button>
</div>

	</div>
	
	<h2 class=versionzero><strong>Cursos e workshops<span></span></strong></h2>

	<div class="cards">

		<div class="slider">
  <button id="prev" class="btn">
    <i class="las la-angle-left"></i>
  </button>
  
<div class="card-content">


    <?php
	
        $result = mysqli_query($conn, "SELECT * FROM evento WHERE Categoria_idCategoria = '8' ORDER BY id DESC");
		
        while ($row = mysqli_fetch_object($result))
        {
			
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

		}
    ?>
    
    
    
  </div>
<button id="next" class="btn">
    <i class="las la-angle-right"></i>
  </button>
</div>

	</div>
    
    <h2 class=versionzero><strong>Congressos e palestras<span></span></strong></h2>

	<div class="cards">

		<div class="slider">
  <button id="prev" class="btn">
    <i class="las la-angle-left"></i>
  </button>
<div class="card-content">

    <?php

        $result = mysqli_query($conn, "SELECT * FROM evento WHERE Categoria_idCategoria = '9' ORDER BY id DESC");
		
        while ($row = mysqli_fetch_object($result))
        {
			
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

		}
    ?>
    
    
  </div>
<button id="next" class="btn">
    <i class="las la-angle-right"></i>
  </button>
</div>

	
    
     </div>
	 <script src="roll.js"></script>
	 </div>
    
    <div>
        <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
*{
    margin: 0;
    padding-top: 0px;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
footer{
    background-color: #0D0C22;
    padding: 75px 30px;
    position:relative;
     bottom: -100px;
}
.container-footer{
    max-width: 1400px;
    padding: 45 4%;
    padding-top: 15px;
    margin: auto;
   position: relative;
  bottom: -20px;
}
.row-footer{
    display: flex;
    flex-wrap: wrap;
}


.footer-col{
    width: 25%;
    padding: 0 15px;
}
.footer-col h4{
    font-size: 22px;
    color: #1EFFBC;
    margin-bottom: 20px;
    font-weight: 500;
    position: relative;
    text-transform: uppercase;
  
}
.footer-col ul{
    list-style: none;
}
.footer-col ul li{
    margin: 10px 0;
}
.footer-col ul li a{
    font-size: 16px;
    text-transform: capitalize;
    color: #B5B5BF;
    text-decoration: none;
    font-weight: 300;
    display: block;
    transition: all 0.3s ease;
}
.footer-col p{
    font-size: 15px;
    color: white;
  text-align: left;
    font-weight: 300;
  
    display: block;
  position: relative;
}
.footer-col ul li a:hover{
    color: #cecdcd;
    padding-left: 10px;
}
.footer-col .medias-socias{
    margin-top: 30px;
}
.footer-col .medias-socias a{
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 40px;
    width: 40px;
    margin: 0 10px 10px 0;
    text-decoration: none;
    border-radius: 50%;
    color: white;
    border: 1px solid white;
    transition: all 0.5s ease;
}
.footer-col .medias-socias a i{
    font-size: 20px;
}

.footer-col .medias-socias a:hover{
    color: #415aca;
    background-color: white;
}
.footer-col .form-sub input{
    width: 100%;
    padding: 10px;
    font-size: 15px;
    outline: none;
    border: 1px solid white;
    color: white;
    background-color: #415aca;
}
.footer-col .form-sub input::placeholder{
    color: white;
}
.footer-col .form-sub button{
    width: 100%;
    margin-top: 10px;
    padding: 10px; 
    font-size: 17px;
    outline: none;
    border: none;
    cursor: pointer;
    color: #415aca;
    border-radius: 3px;
    font-weight: bold;
    background-color: white;        
}
/* Responsivo */
@media (max-width: 800px) {
    .footer-col{
        width: 50%;
        margin-bottom: 30px;
    }
}
@media (max-width:600px) {
    .footer-col{
        width: 100%;
    }
}
  </style>
<body>
    <footer>
        <div class="container-footer">
            <div class="row-footer">
                <!-- footer col-->
                <div class="footer-col">
                    <h4>Sobre</h4>
                    <p class="text-justify">Tix4tonight.com é uma plataforma que oferece serviço de <i>ticketing</i> para clientes que estão em busca de eventos, assim como a possibilidade de criação e manutenção desses <i>tickets</i> para organizadores de eventos. A plataforma atua na região do estado do Rio de Janeiro, Brasil .</p>
                </div>
                <!--end footer col-->
                <!-- footer col-->
                <div class="footer-col">
                    
                </div>
                <!--end footer col-->
                <!-- footer col-->
                <div class="footer-col">
                   <h4> Eventos</h4>
                    <ul>
                        <li><a href="#">Festivais</a></li>
                        <li><a href="#">Congressos</a></li>
                        <li><a href="#">Feiras</a></li>
                        <li><a href="#">Gastronomia</a></li>
                        <li><a href="#">Tour</a></li>
                    </ul>
                </div>
                <!--end footer col-->
                <!-- footer col-->
                <div class="footer-col">
                    
 <h4>Links úteis</h4>
                    <ul>
                        <li><a href="#">Cadastro cliente</a></li>
                        <li><a href="#">Cadastro organizador</a></li>
                        <li><a href="#">Calendário</a></li>
                        <li><a href="#">tix4tonightt@gmail.com</a></li>
                    </ul>
                  
                    

                </div>
                <!--end footer col-->
            </div>
        </div>
    </footer>
    </div>

</body>
</html>
