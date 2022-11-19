<!DOCTYPE html>
<head>
 <link rel="stylesheet" href="css/menu3.css"/>
</head>
<nav>
         <div class="menu-icon">
         </div>
         <div class="logo">
           <a href="principal3.php"><img src="logo7.svg"></a>
           
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
	  <?php 
//Menu só aparece para os administradores.
if($_SESSION['acesso']=="Org"){
    echo "<li><a href='sidebar_org.php'>Perfil | ". $acesso ."</a></li>";
} else {
	echo "<li><a href='sidebar_cliente.php'>Perfil | ". $acesso ."</a></li>";
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