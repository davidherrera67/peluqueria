<?php include '../connect.php'; ?>
<?php include '../Includes/functions/functions.php'; ?>


<?php
    
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

        } catch (Exception $e) {
            $con->rollBack();

            echo "<div class = 'alert alert-danger text-dark'>";
            echo $e->getMessage();
            echo "</div>";
        }
	}
?>