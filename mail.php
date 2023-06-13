<?php include 'connect.php'; ?>
<?php include 'Includes/functions/functions.php'; ?>
<?php
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
?>

<?php

    
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '11233535@alu.murciaeduca.es';                     //SMTP username
        $mail->Password   = 'Blackops4';                          //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('11233535@alu.murciaeduca.es', 'Peluqueria Dacor');

        
        $stmt = $con->prepare("Select * from clients");
        $stmt->execute();
        $clientes = $stmt->fetchAll();
        foreach ($clientes as $cliente) {
            $id_cliente = $cliente['id_cliente'];  
            $fecha_cita = date('Y-m-d 08:00:00');

            $stmt = $con->prepare("Select * from appointments WHERE id_cliente = ? AND inicio >= ?");
            $stmt->execute(array($id_cliente,date('Y-m-d H:i:s', strtotime($fecha_cita . ' +1 day'))));
            $cita_cliente = $stmt->fetchAll();
   
        foreach ($cita_cliente as $cita) {
            $mail->addAddress($cliente['cliente_correo'], $cliente['nombre']);     //Add a recipient
            }
        }
        //$mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Cita Peluqueria Dacor';
        $mail->Body    = 'Tiene mañana una cita concertada con nosotros, muchas gracias y te esperamos con ganas<b> <3! </b>';
        $mail->AltBody = 'Tiene mañana una cita concertada con nosotros, muchas gracias y te esperamos con ganas<b> <3! </b>';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

?>
<script>
    window.location.replace("peluquero/boxs.php");
</script>
