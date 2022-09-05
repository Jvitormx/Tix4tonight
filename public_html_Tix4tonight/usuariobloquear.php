<?php
session_start(); 

if(!isset ($_SESSION['nome']) || !isset ($_SESSION['cnpj']))
{
  unset($_SESSION['nome']);
  unset($_SESSION['cnpj']);
  header('location:index.html');
  exit;
}
 
//Faz a leitura do dado passado pelo link.
$campoid = filter_input(INPUT_GET, 'idCliente');
$campostatus = filter_input(INPUT_GET, 'status');
 
//Faz a conexão com o BD.
require 'conexao.php';

if($campostatus=="ativo"){

// Bloquear usuário o registro com o id
$sql = "UPDATE cliente SET status='inativo' WHERE idCliente=$campoid";

}else{
    
$sql = "UPDATE cliente SET status='ativo' WHERE idCliente=$campoid";
}

//Executa o sql e faz tratamento de erro.
if ($conn->query($sql) === TRUE) {
  echo "Cliente posto como não listado";
  
  include 'log.php';
  
   header('Location: usuarios.php?pag=1'); //Redireciona para o controle  
} else {
  echo "Erro: " . $conn->error;
}

//Fecha a conexão.
$conn->close();

?> 
 