 <?php
session_start(); 
 
//Faz a leitura do dado passado pelo link.
$campoid = filter_input(INPUT_GET, 'id');
$campostatus = filter_input(INPUT_GET, 'status');
 
//Faz a conexão com o BD.
require 'conexao.php';

if($campostatus=="1"){

// Bloquear usuário o registro com o id
$sql = "UPDATE evento SET status='0' WHERE id=$campoid";

}else{
    
$sql = "UPDATE evento SET status='1' WHERE id=$campoid";
}

//Executa o sql e faz tratamento de erro.
if ($conn->query($sql) === TRUE) {
  echo "Evento posto como não listado";
  
  include 'log.php';
  
   header('Location: controlar_eventos.php?pag=1'); //Redireciona para o controle  
} else {
  echo "Erro: " . $conn->error;
}

//Fecha a conexão.
$conn->close();

?> 
 