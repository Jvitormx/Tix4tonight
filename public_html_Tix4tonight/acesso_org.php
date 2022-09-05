<?php
//Verifica se o usuário logou.
if(!isset ($_SESSION['nome']) || !isset ($_SESSION['acesso']))
{
  unset($_SESSION['nome']);
  unset($_SESSION['acesso']);
  header('location:index.html');
  exit;
}else{
//Verifica se o acesso é Org
	if($_SESSION['acesso']!="Org"){
		    header('location:tela_criar_evento.php'); //Redireciona para o form
			exit; // Interrompe o Script
	}
}
?>