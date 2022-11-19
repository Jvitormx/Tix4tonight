<?php

//Faz a conexão com o BD.
require 'conexao.php';

$idevento = 99;
$id_cliente = 27;
echo $_SESSION['id'];
//Cria o SQL (consulte tudo da tabela usuarios)
$sql = "SELECT * FROM cliente WHERE idCliente = $id_cliente";

//Executa o SQL
$result = $conn->query($sql);

	//Se a consulta tiver resultados
	 if ($result->num_rows > 0) {

// Cria uma matriz com o resultado da consulta
 $row = $result->fetch_assoc();
 
?>
<!DOCTYPE html>
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
    <link rel="stylesheet" href="css/editar_cliente.css"/>
</head>
<body class="form">
	<div class="page-content">
		<div class="form-v4-content">
			<div class="form-left">
			<form class="form-detail" method="POST" action="inserecomment.php">
				<h2>Visualizar/Atualizar Perfil</h2>
				<div class="form-group">
					<div class="form-row form-row-1">
						<label for="first_name">*Nome</label>
						<input type="hidden" name="nome" value="<?php echo $row["nome"]; ?>" class="input-text" >
						 <input type="hidden" name="idCliente" value="<?php echo $row["idCliente"]; ?>">
					</div>
				</div>
				<div class="form-row">
					<label for="your_email">*Email</label>
					<input type="hidden" name="idEvento" value="<?php echo $idevento; ?>" class="input-text">
					<textarea name="comentario" ></textarea>
				</div>
				<div class="form-group">
					

				</div>
				<div class="form-row-last">
					<input type="submit" class="register" value="Atualizar">
				</div>
			 </form>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	<script>
		// just for the demos, avoids form submit
		jQuery.validator.setDefaults({
		  	debug: true,
		  	success:  function(label){
        		label.attr('id', 'valid');
   		 	},
		});
		$( "#myform" ).validate({
		  	rules: {
			    password: "required",
		    	comfirm_password: {
		      		equalTo: "#password"
		    	}
		  	},
		  	messages: {
		  		first_name: {
		  			required: "Please enter a firstname"
		  		},
		  		last_name: {
		  			required: "Please enter a lastname"
		  		},
		  		your_email: {
		  			required: "Please provide an email"
		  		},
		  		password: {
	  				required: "Please enter a password"
		  		},
		  		comfirm_password: {
		  			required: "Please enter a password",
		      		equalTo: "Wrong Password"
		    	}
		  	}
		});
	</script>
	</div>
</body>
<?php
	//Coloca o rodapé que está no arquivo
	include 'sidebar_cliente.php';
?>
</html>
<?php
	//Se a consulta não tiver resultados  			
	} else {
		echo "<h1>Nenhum resultado foi encontrado.</h1>";
	}

	//Fecha a conexão.	
	$conn->close();
	


?> 