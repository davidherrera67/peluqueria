<?php
	$dsn = 'mysql:host=localhost;dbname=peluqueria';
	$user = 'root';
	$pass = '';
	try {
		$con = new PDO($dsn, $user, $pass);
	} catch (PDOException $e) {
		echo "Error al conectar a la bbdd " . $e->getMessage();
		die();
	}
