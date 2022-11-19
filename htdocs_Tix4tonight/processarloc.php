<?php
session_start(); 

// Dados do Formulário
$campoloc = filter_input(INPUT_POST, 'bairro');

$campoid = 	$_SESSION['id'];


//Faz a conexão com o BD.
include ("conexao.php");

//Insere na tabela os valores dos campos
$sql = "UPDATE `cliente` SET `localizacao` = '$campoloc' WHERE `cliente`.`localizacao` = 'nulo' AND `cliente`.`idCliente` = $campoid;
";

//Executa o sql e faz tratamento de erro.
if ($conn->query($sql) === TRUE) {
  header( "refresh:3;url=principal3.php" );
  echo "Localização definida🌌";
  
  //Grava alteração no log.
  include 'log.php';
  
} else {
  echo "Erro: " . $conn->error;
}
        
//Fecha a conexão.
$conn->close();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<title>Localização definida</title>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,900" rel="stylesheet">

	<!-- Custom stlylesheet -->
<link rel="stylesheet" href="css/Tela_erro_2.css"/>
<link rel="icon" type="imagens/x-icon" href="/imagens/favicon.ico">
</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>Localização definida </h1>
			</div>
		</div>
	</div>

</body>

</html>