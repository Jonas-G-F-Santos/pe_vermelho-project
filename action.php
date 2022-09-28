<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
if (isset($_POST['sendMailBtn'])){
  $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $assunto = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS);
  $mensagem = filter_input(INPUT_POST, 'msg', FILTER_SANITIZE_SPECIAL_CHARS);
  $mail = new PHPMailer(true);
  try {
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->CharSet = 'UTF-8';
      $mail->isSMTP();
      $mail->Host       = 'smtp.titan.email';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'atendimento@desentupidorapevermelho.com.br';
      $mail->Password   = 'qweasdzxc';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port       = 465;
      $mail->setFrom('atendimento@desentupidorapevermelho.com.br');
      $mail->addAddress('contato@desentupidorapevermelho.com.br');
      $mail->addAddress('pevermelhohidrojato@gmail.com');
      $body = "<b>Mensagem via Site. Segue as informações abaixo:</b><br>
      Nome: ".$nome."<br>
      E-mail: ".$email."<br>
      Assunto: ".$assunto."<br>
      Mensagem: <br>
        ".$mensagem;
      $mail->isHTML(true);
      $mail->Subject = 'Mensagem via Site - Pé vermelho';
      $mail->Body    = $body;
      $mail->AltBody = 'Utilize um navegador que aceite HTML para ler esta mensagem.';
      $mail->send();
      echo '<script>alert("E-mail enviado com sucesso!")</script>';
      echo '<script>window.location.href="index.php";</script>';
  } catch (Exception $e) {
      //echo "Message could not be sent.Mailer Error: {$mail->ErrorInfo}";
      echo 'Erro ao enviar mensagem';
  }
}else {
    echo "Acesso negado.";
    echo '<script>window.location.href="index.php";</script>';
};