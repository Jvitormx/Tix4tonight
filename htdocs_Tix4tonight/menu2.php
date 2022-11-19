<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
     
      <meta charset="utf-8">
      <title>Responsive Navbar with Search Box | CodingNepal</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	  <link rel="stylesheet" href="css/menu2.css"/>
   </head>
   <body>
      <nav>
         <div class="menu-icon">
         </div>
         <div class="logo">
           <a href="principal.php"><img src="logo7.svg"></a>
           
         </div>
         <div class="nav-items">
            <form action="#">
            <input type="search" class="search-data" placeholder=". . ." required>
            <button type="submit" class="fas fa-search"></button>
         </form>
           
         </div>
         <div class="search-icon">
            <span class="fas fa-search"></span>
         </div>
         <div class="cancel-icon">
            <span class="fas fa-times"></span>
         </div>
  <div class="User-area">
  <div class="User-avtar">
   <img src="http://f1s.000webhostapp.com/images/avatar/avatar5.png"/>
  </div>
    <ul class="User-Dropdown U-open">
	  <li><a>Usuário: <?php echo $logado;?></a></li>
      <li><a href="editar_cliente.php">Perfil</a></li> 
      <li><a href="deslogar.php">Deslogar</a></li>
    </ul>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script><script  src="./script2.js"></script>
          
                     <a class="cta" href="tela_criar_evento.php">Criar evento ⇪</a>
      </nav>
      
      <script>
         const menuBtn = document.querySelector(".menu-icon span");
         const searchBtn = document.querySelector(".search-icon");
         const cancelBtn = document.querySelector(".cancel-icon");
         const items = document.querySelector(".nav-items");
         const form = document.querySelector("form");
         menuBtn.onclick = ()=>{
           items.classList.add("active");
           menuBtn.classList.add("hide");
           searchBtn.classList.add("hide");
           cancelBtn.classList.add("show");
         }
         cancelBtn.onclick = ()=>{
           items.classList.remove("active");
           menuBtn.classList.remove("hide");
           searchBtn.classList.remove("hide");
           cancelBtn.classList.remove("show");
           form.classList.remove("active");
           cancelBtn.style.color = "#ff3d00";
         }
         searchBtn.onclick = ()=>{
           form.classList.add("active");
           searchBtn.classList.add("hide");
           cancelBtn.classList.add("show");
         }
      </script>
   </body>
</html>