<?php

//Cria variáveis com a sessão.
$logado = $_SESSION['nome'];
$acesso = $_SESSION['cnpj'];

// Dados do evento
$campotipo = $_POST["Tipo"];

//Faz a conexão com o BD.
require 'conexao.php';

//Insere na tabela os valores dos campos
$sql = "INSERT INTO tipodeingresso (Tipo) VALUES ('$campotipo')";

//Executa o SQL e faz tratamento de erros
if ($conn->query($sql) === TRUE) {
//  header( "refresh:5;url=principal.php.html" );
  echo "<script>window.location='tela_criar_evento.html';alert('Ingresso criado');</script>";

} else {
  //header( "refresh:5;url=Tela_erro_2.html" );	
  echo "Error: " . $sql . "<br>" . $conn->error;
}

//Fecha a conexão.
$conn->close();


?>