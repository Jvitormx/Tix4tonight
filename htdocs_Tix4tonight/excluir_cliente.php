 <?php
session_start(); 

//Cria variáveis com a sessão.
$logado = $_SESSION['nome'];
 
//Faz a leitura do dado passado pelo link.
$campoid = filter_input(INPUT_GET, 'idCliente');
 
//Faz a conexão com o BD.
require 'conexao.php';

// Apagar da tabela usuários o registro com o id
$sql = "DELETE FROM cliente WHERE idCliente=$campoid";

//Executa o sql e faz tratamento de erro.
if ($conn->query($sql) === TRUE) {
  echo "Evento apagado";
  
  include 'log.php';
  
   header('Location: usuarios.php?pag=1'); //Redireciona para o controle  
} else {
  echo "Erro: " . $conn->error;
}

//Fecha a conexão.
$conn->close();

?> 