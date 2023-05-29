<?php include '../connect.php'; ?>
<?php include '../Includes/functions/functions.php'; ?>


<?php
	

	if(isset($_POST['accion']) && $_POST['accion'] == "Borrar")
	{
		$id_peluquero = $_POST['id_peluquero'];
        $stmt = $con->prepare("DELETE from hairdressers where id = ?");
        $stmt->execute(array($id_peluquero));
	}
	
?>