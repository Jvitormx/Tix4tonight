<?php
session_start();
if (isset($_POST['promocao']))

// Dados do Formulário
$campopro = filter_input(INPUT_POST, 'promocao');
$campoing = filter_input(INPUT_POST, 'idIngresso');

//Faz a conexão com o BD.
require 'conexao.php';

//Cria o SQL (consulte tudo na tabela usuarios com o email digitado no form)
$sql = "SELECT * FROM ingresso where idIngresso='$campoing'";

//Executa o SQL
$result = $conn->query($sql);

// Cria uma matriz com o resultado da consulta
$row = $result->fetch_assoc();

//Se a consulta tiver resultados
if ($result->num_rows > 0) {
	
	
       if(strpos($campopro, $row["promocao"]) !== false){
                $_SESSION['idIngresso'] = $row["idIngresso"];						
				header('Location: sucessogratuito2.php');
				exit;
			  }else{
			  header( "refresh:5;url=index.html" );
				echo 'Puts senha Inválida... Tente novamente';  
				exit;  
			}
			
	//Se a consulta não tiver resultados  			
	} else {
		header('Location: index.html'); //Redireciona para o form
		exit; // Interrompe o Script
	}
//Fecha a conexão.
$conn->close();
?> 