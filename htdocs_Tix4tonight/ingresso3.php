<?php
session_start();
//Verifica se o usuário logou.
if(!isset ($_SESSION['title']))
{
  unset($_SESSION['title']);
  header('location:tela_criar_evento.php');
  exit;
}

//Cria variáveis com a sessão.
$titulo = $_SESSION['title'];

// Dados do evento
$campotipo = $_POST["TipodeIngresso_idTipodeIngresso"];
$campoquant = $_POST["quantidadeTotal"];
$campolit = $_POST["dataLimite"];

//Faz a conexão com o BD.
include_once ("conexao.php");

//Insere na tabela os valores dos campos
$sql = "INSERT INTO ingresso (TipodeIngresso_idTipodeIngresso, preco, quantidadeTotal, dataLimite, statusIng, Evento_idEvento, selecao, promocao) VALUES ('$campotipo', 0.00, '$campoquant', '$campolit', '1', (SELECT id from evento WHERE title='$titulo'), 'aguardando', 'null')";

//Executa o SQL e faz tratamento de erros
if ($conn->query($sql) === TRUE) {
//  header( "refresh:5;url=principal.php.html" );
  echo "Evento criado!!!";

} else {
  //header( "refresh:5;url=Tela_erro_2.html" );	
  echo "Error: " . $sql . "<br>" . $conn->error;
}

//Fecha a conexão.
$conn->close();


?>