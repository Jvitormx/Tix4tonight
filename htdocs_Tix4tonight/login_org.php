<?php
session_start();
if (isset($_POST['senha'])){
// Dados do Formulário
$campoemail1 = $_POST["email"];
$camposenha1 = $_POST["senha"];
$hash = password_hash($camposenha1, PASSWORD_BCRYPT);

//Faz a conexão com o BD.
require 'conexao.php';

//Cria o SQL (consulte tudo na tabela usuarios com o email digitado no form)
$sql = "SELECT * FROM organizador where email='$campoemail1' and status='aguardando'";

//Executa o SQL
$result = $conn->query($sql);

// Cria uma matriz com o resultado da consulta
$row = $result->fetch_assoc();

// Verifica se o hash lido do bd corresponde a senha digitada no form
  //$resultado = password_verify($camposenha1, $row["senha"])

	//Se a consulta tiver resultados
	if ($result->num_rows > 0) {
		   
		   $verificado = password_verify($camposenha1, $row["senha"]);
		if($verificado){
				$_SESSION['nome'] = $row["nome"];
				$_SESSION['cnpj'] = $row["cnpj"];
				$_SESSION['acesso'] = $row["acesso"];
				header('Location: principal3.php');
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
//Se o usuário não usou o formulário
} else {
    header('Location: index.html'); //Redireciona para o form
    exit; // Interrompe o Script
}

//Fecha a conexão.
$conn->close();
?> 