<?php
session_start(); 

//Verifica o acesso.
require 'acesso.php';

// Dados do Formulário
$campoid = filter_input(INPUT_POST, 'idCliente');
$camponome = filter_input(INPUT_POST, 'nome');
$campoemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

//Faz a conexão com o BD.
include ("conexao.php");

//Sql que altera um registro da tabela usuários
$sql = "UPDATE cliente SET nome='" . $camponome . "', email='" . $campoemail . "' WHERE idCliente=" . $campoid;

//Executa o sql e faz tratamento de erro.
if ($conn->query($sql) === TRUE) {
  echo "Registro atualizado.";
  
  include 'log.php';
  
} else {
  echo "Erro: " . $conn->error;
}

        
//Fecha a conexão.
$conn->close();

?>