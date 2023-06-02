<?php include '../connect.php'; ?>
<?php include '../Includes/functions/functions.php'; ?>


<?php
	

	if(isset($_POST['accion']) && $_POST['accion'] == "Cancelar Cita")
	{
		$id_cita = $_POST['id_cita'];
		$motivo_cancelacion =  ajustar_texto_introducido($_POST['motivo_cancelacion']);
        $stmt = $con->prepare("UPDATE appointments set cancelada = 1, motivo_cita_cancelada = ? where id_cita = ?");
        $stmt->execute(array($motivo_cancelacion, $id_cita));    
	}


	if(isset($_POST['accion']) && $_POST['accion'] == "Endeudar Cita")
	{
		$id_cita = $_POST['id_cita'];
		$motivo_cancelacion =  ajustar_texto_introducido($_POST['motivo_endeudacion']);
        $stmt = $con->prepare("UPDATE appointments set endeudar = 1, motivo_cita_endeudada = ? where id_cita = ?");
        $stmt->execute(array($motivo_endeudacion, $id_cita)); 
	}
?>