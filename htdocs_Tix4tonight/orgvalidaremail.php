<?php
session_start();

//Dados do formulário
$campoemail1 = filter_input(INPUT_GET, 'id');
$validador1 = filter_input(INPUT_GET, 'validador');

//Faz a conexão com o BD.
require 'conexao.php';

//Sql que altera um registro da tabela usuários
$sql = "UPDATE organizador SET status='Ativo' WHERE status='aguardando' and email='" . $campoemail1 . "' and validador=" . $validador;

//Executa o sql e faz tratamento de erro.
if ($conn->query($sql) === TRUE) {
  echo "Registro atualizado.";
  
  //Grava alteração no log.
  include 'log.php';
  
} else {
  echo "Erro: " . $conn->error;
}

//Fecha a conexão.
	$conn->close();
	
?> 