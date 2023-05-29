<?php include '../connect.php'; ?>
<?php include '../Includes/functions/functions.php'; ?>


<?php
	

	if(isset($_POST['accion']) && $_POST['accion'] == "Borrar")
	{
		$id_servicio = $_POST['id_servicio'];
        $stmt = $con->prepare("DELETE from services where id = ?");
        $stmt->execute(array($id_servicio));
	}
	
?>


