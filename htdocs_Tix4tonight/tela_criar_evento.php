<?php
session_start();
//Verifica se o usuário logou.
if(!isset ($_SESSION['nome']) || !isset ($_SESSION['cnpj']))
{
  unset($_SESSION['nome']);
  unset($_SESSION['cnpj']);
  header('location:login.html');
  exit;
}

//Cria variáveis com a sessão.
$logado = $_SESSION['nome'];
$acesso = $_SESSION['cnpj'];
 include 'conexao.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Criar evento :P</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/montserrat-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css/criar_evento.css"/>
   <link rel="icon" type="image/x-icon" href="/imagens/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	<style>
        .button--pandora {
	background: #000;
	font-weight: 700;
	padding: 0;
	border-radius: 5px;
}

.button--pandora span {
	display: block;
	background: #fff;
	padding: 50px, 25px, 30px, 40px;
  width:80px;
  height:65px;
	border: 2px solid #000;
	border-radius: 5px;
	transform: translate3d(-4px, -4px, 0);
	transition: transform 0.3s cubic-bezier(0.7, 0, 0.2, 1);
}

.button--pandora:hover span {
	transform: translate3d(-8px, -8px, 0);
}
        
        .required:after {
            content: "*";
            color: red;
        }
    </style>
</head>
<script src="jquery-3.1.1.min.js"></script>
<script src="index.js"></script>
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
<body class="form-v10">
	<div class="page-content">
		<div class="form-v10-content">
			<form class="form-detail" id="formulario"  enctype="multipart/form-data"> 
				<div class="form-left">
					<h2>Comece a criar seu evento</h2>
					<div class="form-row">
						<input type="text" name="title" id="titulo" class="input-text" placeholder="Título do evento" required>
						<span class="select-btn">
						  	<i class="zmdi zmdi-chevron-down"></i>
						</span>
					</div>
					<div class="form-group">
						<div class="form-row form-row-1">
							<label for="data">DATA-INÍCIO</label>
							<input type="datetime-local" name="start" id="data" class="input-text" placeholder="DATA-INÍCIO" required>
						</div>
						<div class="form-row form-row-2">
              <label for="data">DATA-TÉRMINO</label>
							<input type="datetime-local" name="end" id="hora" class="input-text" placeholder="DATA-TÉRMINO" required>
						</div>
					</div>
					<div class="form-row">
						<select name="Categoria_idCategoria">
						    <option value="" disabled selected>Selecione uma categoria para seu evento</option>
						    <option value="5">Festival/show</option>
						    <option value="6">Passeio ou tour</option>
						    <option value="7">Gastronomia</option>
						    <option value="8">Curso/workshop</option>
						     <option value="10">Feira/exposição</option>
						     <option value="9">Congresso ou palestra</option>
						      <option value="11">Outro</option>
						</select>
						<span class="select-btn">
						  	<i class="zmdi zmdi-chevron-down"></i>
						</span>
					</div>
					<div class="form-row">
						<textarea class="textarea--style-6" name="description" placeholder="Coloque uma descrição para seu evento"  rows="5" cols="80"></textarea>
					</div>
					<div class="form-group">
						<div class="form-row form-row-3">
							<input type="text" name="infLocal" class="inf" placeholder="Informação do local (estabelecimento, etc)" required>
							
							<input type="text" name="rua" id="rua" placeholder="Rua">
							<input type="text" name="cidade" id="cidade" placeholder="Cidade">
						</div>
            <div> 
						<div class="form-row form-row-4">
							<input name="cep" type="text" id="cep" value="" size="10" maxlength="9"
               onblur="pesquisacep(this.value);" autofocus placeholder="CEP" required>							
							 <input type="text" name="bairro" id="bairro" placeholder="Bairro">
							
						</div>
					</div>
				</div>
				
				
				<div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
    <div id="drag_upload_file">
        <p>Insira a imagem promocional do evento</p>
        <p>ou</p>
        <p><input type="file" name = "img" accept="image/jpeg" value="Selecione o arquivo" onclick="file_explorer();" /></p>
		<div class="img-content"></div>
    </div>
    </div>
<script src="custom.js"></script>

<div class="form-checkbox">
						<label class="container"><p>Eu aceito os <a href="#" class="text">Termos e condições</a> do site.</p>
						  	<input type="checkbox" value="on" name="termos">
						  	<span class="checkmark"></span>
						</label>
					</div>
					
					<div class="form-row-last">
						<input type="button" onclick="myFunction()" name="register" id="register" class="register" value="Criar evento">
						<script>
function myFunction() {
  alert("Evento criado com sucesso! ! !");
}
</script>
					</div>
				</form>	
				
				<div class="form-right">
          <h2>Criar ingresso</h2>
					<div class="form-group">
						<div class="form-row form-row-1">
                        <?php
	           include 'ingressomodal1.html';
              ?>
						</div>
          </div>
					<h2>Definir ingresso(s)</h2>
					<div class="form-group">
						<div class="form-row form-row-1">
						<?php

$campotipo = filter_input(INPUT_GET, 'Tipo');

//$_GET["Tipo"]

        $result = mysqli_query($conn, "SELECT * FROM tipodeingresso WHERE Tipo = '$campotipo'");




?>

	<?php
	           include 'ingressomodal22.html';
              ?>
						</div>
						<div class="form-row form-row-2">
                     <?php

$campotipo2 = filter_input(INPUT_GET, 'Tipo');

//$_GET["Tipo"]

        $result2 = mysqli_query($conn, "SELECT * FROM tipodeingresso WHERE Tipo = '$campotipo2'");

//Fecha a conexão.
$conn->close();


?>

	<?php
	           include 'ingressomodal24.html';
              ?>
						</div>
               <?php

$campotipo0 = filter_input(INPUT_GET, 'TipodeIngresso_idTipodeIngresso');
$campoquantidadez = filter_input(INPUT_GET, 'quantidadeTotal');




?>

	<?php
	           include 'ingressomodal23.html';
              ?>
						
					</div>
					     
					<div class="form-row">
					</div>
				<div class="form-row-last">
				    	<form action="sidebar_org.php">
						<input type="submit" class="register" value="Prosseguir">
					</div>
					</div>
				</div>
		</div>
	</div>
</body>
</html>