<?php
	function ajustar_texto_introducido($input) 
	{
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}

    
	function buscarDato($dato, $tabla, $valor)
	{
		global $con;
		$statment = $con->prepare("SELECT $dato FROM $tabla WHERE $dato = ? ");
		$statment->execute(array($valor));
		$cuenta = $statment->rowCount();
		return $cuenta;
	}
?>


