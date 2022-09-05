<?php
session_start();

//Dados do formulário
$campoid = filter_input(INPUT_POST, 'idIngresso');

//Faz a conexão com o BD.
require 'conexao.php';

//Sql que altera um registro da tabela usuários
$sql = "UPDATE `ingresso` SET `selecao` = 'selecionado' WHERE `ingresso`.`selecao` = 'aguardando' AND `ingresso`.`idIngresso` = $campoid;
";

//Executa o sql e faz tratamento de erro.
if ($conn->query($sql) === TRUE) {
  echo "Registro atualizado.";
  echo $campoid;
  
  //Grava alteração no log.
  include 'log.php';
  
} else {
  echo "Erro: " . $conn->error;
}

//Fecha a conexão.
	$conn->close();
	
?> 