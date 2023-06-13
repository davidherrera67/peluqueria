<?php include '../connect.php'; ?>
<?php include '../Includes/functions/functions.php'; ?>


<?php
	

	if(isset($_POST['accion']) && $_POST['accion'] == "Borrar")
	{
		$id_producto = $_POST['id_producto'];
        $stmt = $con->prepare("DELETE from products where id = ?");
        $stmt->execute(array($id_producto));
	}
	
?>
