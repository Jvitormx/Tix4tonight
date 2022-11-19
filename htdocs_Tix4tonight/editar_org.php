<?php
session_start();
//Verifica se o usuário logou.
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

//Cria o SQL (consulte tudo da tabela usuarios)
$sql = "SELECT * FROM organizador WHERE nome = $logado";

?>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastro \0/</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/opensans-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/line-awesome/css/line-awesome.min.css">
	<!-- Jquery -->
	<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css/cadastro_org.css"/>
</head>
<body class="form">
	<div class="page-content">
		<div class="form-v4-content">
			<div class="form-left">
			<form class="form-detail" method="POST" action="editar_org2.php">
				<h2>Crie sua conta de Organizador</h2>
				<div class="form-group">
					<div class="form-row form-row-1">
						<label for="first_name">Seu nome...</label>
						<input type="text" name="nome" value="<?php echo $row["nome"]; ?>" class="input-text">
					</div>
          					<div class="form-row form-row-1">
						<label for="first_name">CNPJ</label>
						<input type="text" name="cnpj" value="<?php echo $row["cnpj"]; ?>" class="form-control cep-mask" maxlength="8" autocomplete="off">
					</div>
				</div>
				<div class="form-row">
					<label for="your_email">Seu email...</label>
					<input type="email" name="email" value="<?php echo $row["email"]; ?>" class="input-text" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
				</div>
				<div class="form-group">
					<div class="form-row form-row-1 ">
						<label for="password">Crie uma senha</label>
						<input type="password" name="senha" value="<?php echo $row["senha"]; ?>" id="password" class="input-text" required>
					</div>

				</div>
				<div class="form-row-last">
					<input type="submit" name="registro" class="register" value="Alterar">
				</div>
			 </form>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	</div>
</body>
</html>