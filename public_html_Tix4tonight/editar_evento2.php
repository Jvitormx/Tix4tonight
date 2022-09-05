<?php
session_start(); 

//Verifica o acesso.
if(!isset ($_SESSION['nome']) || !isset ($_SESSION['cnpj']))
{
  unset($_SESSION['nome']);
  unset($_SESSION['cnpj']);
  header('location:login.html');
  exit;
}

// Dados do evento
$campoid = filter_input(INPUT_POST, 'Organizador_idOrganizador');
$campotitulo = $_POST["title"];
$campodatain = $_POST["start"];
$campodatafin = $_POST["end"];
$campocat = $_POST["Categoria_idCategoria"];
$campodes = $_POST["description"];
$campocep = $_POST["cep"];
$camporua = $_POST["rua"];
$campobairro = $_POST["bairro"];
$campocidade = $_POST["cidade"];
$campoinf = $_POST["infLocal"];
$img = $_FILES["img"];
$campotermos = $_POST["termos"];

//Faz a conexão com o BD.
include ("conexao.php");

//Sql que altera um registro da tabela usuários
$sql = "UPDATE evento SET title='" . $campotitulo . "', start='" . $campodatain . "' , end='" . $campodatafin . "' , description='" . $campodes . "' , cep='" . $campocep . "' , rua='" . $camporua . "' , bairro='" . $campobairro . "' , cidade='" . $campocidade . "' , infLocal='" . $campoinf . "' WHERE Organizador_idOrganizador=" . $campoid;

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