<?php
session_start();
if (isset($_POST['senha']))

// Dados do Formulário
$campoemail = filter_input(INPUT_POST, 'email');
$camposenha = filter_input(INPUT_POST, 'senha');
$hash = password_hash($camposenha, PASSWORD_BCRYPT);

//Faz a conexão com o BD.
require 'conexao.php';

//Cria o SQL (consulte tudo na tabela usuarios com o email digitado no form)
$sql = "SELECT * FROM cliente where email='$campoemail' and status='aguardando'";

//Executa o SQL
$result = $conn->query($sql);

// Cria uma matriz com o resultado da consulta
$row = $result->fetch_assoc();

//Se a consulta tiver resultados
if ($result->num_rows > 0) {
	$loc = $row["localizacao"];
	$null = 'nulo';
	
        $verificado = password_verify($camposenha, $row["senha"]);
		if($loc == $null){
				$_SESSION['nome'] = $row["nome"];
				$_SESSION['acesso'] = $row["acesso"];
				$_SESSION['id'] = $row["idCliente"];
                $_SESSION['email'] = $row["email"];						
				header('Location: cadastropart2.php');
				exit;
			  } elseif ($loc !== $null){
			 	$_SESSION['nome'] = $row["nome"];
				$_SESSION['acesso'] = $row["acesso"];
				$_SESSION['id'] = $row["idCliente"];
                $_SESSION['email'] = $row["email"];						
				header('Location: principal3.php');
				exit;
			} else {
				header('Location: cadastro_org.html');
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