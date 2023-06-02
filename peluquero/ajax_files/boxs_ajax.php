<?php include '../connect.php'; ?>
<?php include '../Includes/functions/functions.php'; ?>


<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
	if(isset($_POST['accion']) && $_POST['accion'] == "Cerrar Caja")
	{
		$id_caja = $_POST['id_caja'];
        $saldo_final = $_POST['saldo_final'];
        $stmt_saldo_final = $con->prepare("UPDATE boxs set saldo_final = ?, fecha_cierre = ? where id = ?");
        $stmt_saldo_final->execute(array($saldo_final,date('Y-m-d H:i:s'),$id_caja));
        $con->beginTransaction();
        try {
            /*nueva caja*/
            $fecha_cita = date('Y-m-d 08:00:00');
            $stmt_nueva_caja = $con->prepare("insert into boxs(fecha_apertura, saldo_inicial) values(?,?)");
            $stmt_nueva_caja->execute(array(date('Y-m-d H:i:s', strtotime($fecha_cita . ' +1 day')), 100));

            $con->commit();


            /* ENVIAR NOTIFICACIÓN */
            
            require 'vendor/autoload.php';
           
        
            $email = new PHPMailer(true);
            try {
                $email->SMTPDebug = SMTP::DEBUG_SERVER;
                $email->isSMTP();
                $email->Host = 'smtp.gmail.com';
                $email->SMTPAuth = true;
                $email->Username = 'peluqueriadacor@gmail.com';
                $email->Password = 'david123...';
                $email->SMTPSecure = 'tls';
                $email->Port = 587;
        
                $email->setFrom('peluqueriadacor@gmail.com','CITA');
                $email->addAddress('herreracostadavid@gmail.com','Juan');
                //$email->addCC('');
                $email->isHTML(true);
                $email->Subject = 'Cita';
                $email->Body = 'Tiene cita en Peluqueria Dacor hoy';
                $email->send();
        
                echo "<div class = 'alert alert-success text-dark'>";
                echo 'correo enviado';
                echo "</div>";
            } catch (Exception $e) {
                //$con->rollBack();
        
                echo "<div class = 'alert alert-danger text-dark'>";
                echo $e->getMessage() .", " . $email->ErrorInfo;
                echo "</div>";
            }
        
        
        

            /*una vez se cierra la caja abro una nueva(si no pilla el id sin ponerle le puedo hacer auto increment a este id de la $_SESSION['caja'])*/
            /*meter con insert todos los datos menos fecha de fin,(tener que meter la fecha de cierre desde la web)*/
        } catch (Exception $e) {
            $con->rollBack();

            echo "<div class = 'alert alert-danger text-dark'>";
            echo $e->getMessage();
            echo "</div>";
        }
	}
?>