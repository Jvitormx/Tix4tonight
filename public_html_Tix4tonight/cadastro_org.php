<?php
session_start(); 

// Dados do Formulário
$camponome1 = $_POST["nome"];
$campoemail1 = $_POST["email"];
$campocnpj = $_POST["cnpj"];
$camposenha1 = password_hash($_POST["senha"], PASSWORD_BCRYPT);

//Verifica campos vazios. 
//Se o filtro encontrar caracter proibido, a variável estará em branco.
if(!$camponome1 || !$campoemail1 || !$camposenha1){
	header("Location: usuariocadastrartela.php?erro=1");
	exit;
}

//Faz a conexão com o BD.
include ("conexao.php");


//Verifica email duplicado e retorna erro.
$sql = "Select * from organizador where email='$campoemail1'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	header("Location: usuariocadastrartela.php?erro=2");
	exit;	
}

//Cria um número inteiro aleatório dentro do intervalo
$validador = rand(10000000,99999999);

//Insere na tabela os valores dos campos
$sql = "INSERT INTO organizador (nome, email, senha, cnpj, acesso, status, validador) VALUES ('$camponome1', '$campoemail1', '$camposenha1', '$campocnpj', 'Org', 'aguardando', $validador )";

//Executa o SQL e faz tratamento de erros
if ($conn->query($sql) === TRUE) {
  header( "refresh:5;url=login_org.html" );
  echo "Wow agora você faz parte da comunidade!🌌";

 //Envie email para validar a conta.
require 'enviaremailOrg.php';  

//Conteúdo do email de validação
$texto = "email: '$campoemail1' // validador= '$validador'";

enviaremail($camponome1, $campoemail1, 'Validar conta', $validador);

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