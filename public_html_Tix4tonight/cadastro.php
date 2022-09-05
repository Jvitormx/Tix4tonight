<?php
session_start(); 

// Dados do Formulário
$camponome = filter_input(INPUT_POST, 'nome');
$campoemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$camposenha = password_hash($_POST["senha"], PASSWORD_BCRYPT);
   

//Verifica campos vazios. 
//Se o filtro encontrar caracter proibido, a variável estará em branco.
if(!$camponome || !$campoemail || !$camposenha){
	header("Location: usuariocadastrartela.php?erro=1");
	exit;
}

//Faz a conexão com o BD.
include ("conexao.php");

//Verifica email duplicado e retorna erro.
$sql = "Select * from cliente where email='$campoemail'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	header("Location: usuariocadastrartela.php?erro=2");
	exit;	
}

//Cria um número inteiro aleatório dentro do intervalo
$validador = rand(10000000,99999999);

//Insere na tabela os valores dos campos
$sql = "INSERT INTO cliente (nome, email, senha, acesso, status, validador) VALUES ('$camponome', '$campoemail', '$camposenha', 'Comum', 'aguardando', $validador)";

//Executa o SQL e faz tratamento de erros
if ($conn->query($sql) === TRUE) {
  header( "refresh:3;url=login.html" );
  echo "Wow agora você faz parte da comunidade!🌌";
  
  
  //Envie email para validar a conta.
require 'enviaremail.php';  

//Conteúdo do email de validação
$texto = "email: '$campoemail' // validador= '$validador'";

enviaremail($camponome, $campoemail, 'Validar conta', $validador);

} else {
  header( "refresh:5;url=tela_cadastro.html" );	
  echo "Error: " . $sql . "<br>" . $conn->error;
}

  //Abre o arquivo log.txt, a opção "a" é para adicionar 
  $log = fopen("log.txt", "a") or die("Não abriu");
  
  //Como será a String gravada no log
  $txt = $_POST['nome'] . " - $sql - " . 
  date("d/m/Y") . " - " . date("H:i:s") . "\n";

  //Escreve a String no objeto que representa o arquivo
  fwrite($log, $txt);
  
  //Fecha o objeto
  fclose($log);

        
//Fecha a conexão.
$conn->close();

?>