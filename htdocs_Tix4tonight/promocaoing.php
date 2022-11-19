<?php
session_start();
if (isset($_POST['idIngresso']))

// Dados do Formulário
   $campoing = $_POST["idIngresso"];
   $campopro = $_POST["promocao"];
   
//Faz a conexão com o BD.
require 'conexao.php';

echo $campoing;
echo $campopro;

//Cria o SQL (consulte tudo na tabela usuarios com o email digitado no form)
$sql = "SELECT * FROM ingresso where idIngresso = '$campoing' and promocao = '$campopro'";

//Executa o SQL
$result = $conn->query($sql);

// Cria uma matriz com o resultado da consulta
$row = $result->fetch_assoc();

//Se a consulta tiver resultados
if ($result->num_rows > 0) {

	
 if(strpos($campopro, $row["promocao"]) !== false){
     echo $row["idIngresso"];
     	$_SESSION['idIngresso'] = $row["idIngresso"];
				header('Location: sucessogratuito2.php');
exit();
			  }else {
  header( "refresh:5;url=index.html" );
				echo 'Puts senha Inválida... Tente novamente';  
				exit;  
}
			}
			
//Fecha a conexão.
$conn->close();
?> 