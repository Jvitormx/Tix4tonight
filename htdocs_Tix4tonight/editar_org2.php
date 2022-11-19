<?php
session_start(); 
if(!isset ($_SESSION['nome']) || !isset ($_SESSION['cnpj']))
{
  unset($_SESSION['nome']);
  unset($_SESSION['cnpj']);
  header('location:login_org.html');
  exit;
} 

//Faz a conexão com o BD.
require 'conexao.php';

//Cria variáveis com a sessão.
$logado = $_SESSION['nome'];

// Dados do Formulário
$camponome1 = $_POST["nome"];
$campoemail1 = $_POST["email"];
$campocnpj = $_POST["cnpj"];
$camposenha1 = $_POST["senha"];
//$hash = password_hash($text, PASSWORD_BCRYPT);

//Sql que altera um registro da tabela usuários
$sql = "UPDATE organizador SET nome='" . $camponome1 . "', email='" . $campoemail1 . "', senha='" . $camposenha1 . "', cnpj='" . $campocnpj . "' WHERE nome = $logado";

//Executa o sql e faz tratamento de erro.
if ($conn->query($sql) === TRUE) {
  echo "Registro atualizado.";
  
  include 'log.php';
  
} else {
  echo "Erro: " . $conn->error;
}
    header('Location: editar_org.php'); //Redireciona para o form	

//Fecha a conexão.
	$conn->close();

?>