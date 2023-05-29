<?php
	$dsn = 'mysql:host=localhost;dbname=peluqueria';
	$user = 'root';
	$pass = '';
	try {
		$con = new PDO($dsn, $user, $pass);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $ex) {
		echo "Error al conectar a la bbdd ! " . $ex->getMessage();
		die();
	}
