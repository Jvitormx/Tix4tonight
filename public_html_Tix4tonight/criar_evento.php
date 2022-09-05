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

$targetDir = "uploads/";
$campoimg = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $campoimg;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

// Dados do evento
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


$_SESSION['title'] = $_POST["title"];


//Faz a conexão com o BD.
include 'conexao.php';
		

if($img != NULL) {
	$nomeFinal = time().'.jpg';
	if (move_uploaded_file($img['tmp_name'], $nomeFinal)) {
		$tamanhoImg = filesize($nomeFinal);

		$mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg));


	
		
//Insere na tabela os valores dos campos
$sql = "INSERT INTO evento (title, start, end, Categoria_idCategoria, description, cep, rua, bairro, cidade, estado, infLocal, img, termos, Organizador_idOrganizador, status, color) VALUES ('$campotitulo', '$campodatain', '$campodatafin', '$campocat', '$campodes', '$campocep', '$camporua', '$campobairro', '$campocidade', 'RJ', '$campoinf', '$mysqlImg', '$campotermos', (SELECT idOrganizador from organizador WHERE nome='$logado'), '1', 'blue')";

unlink($nomeFinal);

//Executa o SQL e faz tratamento de erros
if ($conn->query($sql) === TRUE) {
 echo "<script>alert('Evento criado! ! !');</script>";

} else {
  header( "refresh:5;url=Tela_erro_2.html" );	
  echo "Error: " . $sql . "<br>" . $conn->error;
}
	}
}
//Fecha a conexão.
$conn->close();
		

?>

