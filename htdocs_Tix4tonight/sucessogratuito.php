<?php
session_start();
// Include configuration file 
require_once 'conexao.php';

    $session_id = rand(10000000,99999999);  
    
   $um = 1;
   $clienteId =	$_SESSION['id'];
   $campolit = $_POST["dataLimite"];
   $campoing = $_POST["idIngresso"];

$sql = "INSERT INTO pedido(Cliente_idCliente, Ingresso_idIngresso, Valor, Status, Quantidade) VALUES($clienteId, $campoing, NULL, 'realizado', $um)"; 

$results = mysqli_query($conn,"SELECT * FROM ingresso WHERE idIngresso = $campoing");
            $row = mysqli_fetch_array($results,MYSQLI_ASSOC);

$x=1;  
$y=$row['quantidadeTotal'];  
$z=$y-$x;  
echo "Difference: ",$z;  

$sql2 = "UPDATE `ingresso` SET `quantidadeTotal` = '$z' WHERE `ingresso`.`quantidadeTotal` = '$y' AND `ingresso`.`idIngresso` = $campoing;
";

//Executa o sql e faz tratamento de erro.
if ($conn->query($sql) === TRUE) {
  echo "Registro atualizado.";
  
  include 'log.php';
  
} else {
  echo "Erro: " . $conn->error;
}

//Executa o SQL e faz tratamento de erros
if ($conn->query($sql2) === TRUE) {
  echo "Gravado com sucesso2.";
} else { 
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>

<?php
require_once 'vendor2/autoload.php';

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

$options = new QROptions(
  [
    'eccLevel' => QRCode::ECC_L,
    'outputType' => QRCode::OUTPUT_IMAGE_PNG,
    'version' => 5,
  ]
);
$codigo = rand(10000000,99999999);
$qrcode = (new QRCode($options))->render($codigo, 'QRcodes/qrcode2.png')
?>

<?php
//Import PHPMailer classes into the global namespace
//Sempre no topo do Script
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//No futuro, quando o gerenciador composer for usado, basta chamar o autoload. 
require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';



//Cria instância da Classe PHPMailer
$mail = new PHPMailer(true);

try {
    //Ative esta linha para usar o Debug e descobrir erros.
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    
    //Vamos usar o protocolo SMTP para o envio.
    $mail->isSMTP();
    
    //Este é o servidor do Gmail através do qual o email será enviado
    $mail->Host       = 'smtp.gmail.com';
    
    //Ativa autenticação. Sem isso o Gmail não realizará o envio.
    $mail->SMTPAuth   = true; 
    
    //Username. No caso do Gmail, é o endereço de email completo.
    $mail->Username   = 'tixtesteenvio2@gmail.com';
    
    //O Gmail exige uma Senha de aplicativo. A sua senha normal não vai funcionar.
    $mail->Password   = 'bwopeflakkjwodve';
    
    //Ativa a encriptação.
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    
    //Protocolo SMTP usa a porta 465 por padrão. Está sendo substituída pela 587.
    $mail->Port       = 465;

    //Remetente
    $mail->setFrom('tixtesteenvio2@gmail.com', 'tix');
    
    //Destinatário
    $mail->addAddress($_SESSION['email'], $_SESSION['nome']);

    //Conteúdo do Email
    
    //Vamos usar HTML.
    $mail->isHTML(true);
    
    //Assunto
    $mail->Subject = "assunto";
    $mail->AddEmbeddedImage("QRcodes/qrcode2.png", 'base64', 'data:image/png'); 
	
    //Corpo do Email
    $mail->Body    = "<img src='cid: " . $qrcode . " ' alt='QR Code' width='100' height='100'>";




    //Envio
    $mail->send();
    
    echo 'Messagem enviada';
} catch (Exception $e) {
    echo "Messagem não foi enviada. Mailer Error: {$mail->ErrorInfo}";
}

//Fecha a conexão.
$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
<title>Pagamento concluído</title>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Puts deu erro ;/</title>
  
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
				<h1>Resgate concluído</h1>
			</div>
			<h2>Obrigado por comprar conosco ;)</h2>
			<p>O ingresso foi encaminhado para seu email.</p>
			<a href="principal3.php">Prosseguir -></a>
		</div>
	</div>

</body>

</html>