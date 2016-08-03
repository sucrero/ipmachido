<?php
    require '../clases/phpmailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->SMTPDebug = 2;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'cunaviche.tepuyserver.net';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'inscripciones@orientedeportivo.com';                 // SMTP username
    $mail->Password = '1.2.3.4.5.6';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->From = 'evento@orientedeportivo.com';
    $mail->FromName = 'Oriente Deportivo';
    $mail->addAddress('franco.oswaldo@gmail.com', 'Oswaldo');     // Add a recipient
//    $mail->addAddress('frances.espinoza@gmail.com','Frances');               // Name is optional
//    $responderA = 'correo_a_responder@dominio.com';
//    $mail->addReplyTo($responderA, 'Information');
//    $mail->addCC('franco.oswaldo@outlook.com');
//    $mail->addBCC('ofo04@yahoo.es');

//    $mail->addAttachment('/home/osfran/bvancos.ods', 'Algo adjunto');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML
    $asunto = 'aSUNTO DLE CORREO';
    $cuerpo = 'Otro correo con copia y copia oculta y replica <b>in bold!</b>';
    $mail->Subject = $asunto;
    $mail->Body    = $cuerpo;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
//    echo 'Message could not be sent.';
//    echo 'Mailer Error: ' . $mail->ErrorInfo;
    echo 0;
} else {
//    echo 'Message has been sent';
    echo 1;
}