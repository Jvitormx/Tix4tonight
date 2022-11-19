<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Navbar</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/menu.css"/>
    <link rel="icon" type="image/x-icon" href="/imagens/favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <a class="logo" href="principal.php"><img src="imagens/Tix4tonightlogo2.webp"></a>
          <div class="wrap">
</div>
            <nav>
                <ul class="nav__links">
                    <?php 
//Menu só aparece para os administradores.
if($_SESSION['acesso']=="Admin"){
    echo "<li class='dropdown'><a href='javascript:void(0)' class='dropbtn'><a>⧉ Administrar eventos</a>";
echo "<div class='dropdown-content'><a href='controlar_usuarios.php?pag=1'>Controlar Usuários</a></li>";}  
?>
                    <li><a href="trending.php">⇪ Trending</a></li>
                    <li><a href="Tela_erro_2.html">⋆Favoritado<span>sz</span></a></li>
                      <li class="dropdown" style="float:right">
    <a href="javascript:void(0)" class="dropdown">Usuário: <?php echo $logado;?></a>
    <div class="dropdown-content">
      <a href="Tela_erro_2.html">Meus Ingressos</a>
      <a href="Tela_erro_2.html">Acessar conta</a>
      <a href="deslogar.php">Deslogar</a>
    </div>
  </li>
                </ul>
            </nav>
            <a class="cta" href="tela_criar_evento.php">Criar evento</a>
            <p class="menu">Menu</p>
        </header>
        <div id="mobile__menu" class="overlay">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <a href="#">Services</a>
                <a href="#">Projects</a>
                <a href="#">About</a>
            </div>
        </div>
        <script type="text/javascript" src="mobile.js"></script>
    </body>
</html>