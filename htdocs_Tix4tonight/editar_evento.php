
<?php

//Faz a conexão com o BD.
require 'conexao.php';

$campoid = filter_input(INPUT_GET, 'id');

//Cria o SQL (consulte tudo da tabela usuarios)
$sql = "SELECT title, description, start, end, infLocal, cep, rua, bairro, cidade, estado, Organizador_idOrganizador  FROM evento WHERE id = '$campoid'";

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
<script>
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
            document.getElementById('ibge').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            document.getElementById('ibge').value=(conteudo.ibge);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>
<body class="form">
	<div class="page-content">
		<div class="form-v4-content">
			<div class="form-left">
			<form class="form-detail" method="POST" action="editar_evento2.php">
				<h2>Visualizar/Atualizar Perfil</h2>
				<div class="form-group">
					<div class="form-row form-row-1">
						<label for="first_name">*Título</label>
						<input type="text" name="title" value="<?php echo $row["title"]; ?>" class="input-text" >
						 <input type="hidden" name="Organizador_idOrganizador" value="<?php echo $row["Organizador_idOrganizador"]; ?>">
					</div>
				</div>
				<div class="form-row">
					<label for="your_email">*Data-Início</label>
					<input type="datetime-local" name="start" value="<?php echo $row["start"]; ?>" class="input-text" >
				</div>
					<div class="form-row">
					<label for="your_email">*Data-Término</label>
					<input type="datetime-local" name="end" value="<?php echo $row["end"]; ?>" class="input-text" >
				</div>
<div class="form-group">
					<div class="form-row">
					<label for="your_email">*Descrição</label>
					<textarea name="description" value="<?php echo $row["description"]; ?>" class="input-text" rows="4" cols="50"></textarea>
				</div>
				
</div>				
<div class="form-group">

<div class="form-row form-row-1">
						<label for="first_name">*CEP</label>
						<input type="text" name="cep" id="cep" onblur="pesquisacep(this.value);" value="<?php echo $row["cep"]; ?>" class="input-text" >
						 
					</div>
					
				<div class="form-row form-row-1">
						<label for="first_name">*cidade</label>
						<input type="text" name="cidade" id="cidade" value="<?php echo $row["cidade"]; ?>" class="input-text" >
						 
					</div>

				
				
				<div class="form-row form-row-1">
						<label for="first_name">*bairro</label>
						<input type="text" name="bairro" id="bairro" value="<?php echo $row["bairro"]; ?>" class="input-text" >
						 
					</div>
</div>
				
			<div class="form-group">	
				<div class="form-row form-row-1">
						<label for="first_name">*rua</label>
						<input type="text" name="rua" id="rua" value="<?php echo $row["rua"]; ?>" class="input-text" >
						 
					</div>

				
				
				<div class="form-row form-row-1">
						<label for="first_name">*Informação do local</label>
						<input type="text" name="infLocal" value="<?php echo $row["infLocal"]; ?>" class="input-text" >
						 
					</div>
</div>
				
				<div class="form-row-last">
					<input type="submit" name="registro" class="register" value="Atualizar">
				</div>
			 </form>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	
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