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

function enviaremail($nomedestinatario, $emaildestinatario, $assunto, $texto){

//Cria instância da Classe PHPMailer
$mail = new PHPMailer(true);

try {
    //Ative esta linha para usar o Debug e descobrir erros.
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    
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
    $mail->addAddress($emaildestinatario, $nomedestinatario);

    //Conteúdo do Email
    
    //Vamos usar HTML.
    $mail->isHTML(true);
    
    //Assunto
    $mail->Subject = $assunto;
    
    //Corpo do Email
    $mail->Body    = $texto;

    //Envio
    $mail->send();
    
    echo 'Messagem enviada';
} catch (Exception $e) {
    echo "Messagem não foi enviada. Mailer Error: {$mail->ErrorInfo}";
}

}
?>