<?php
	//$dsn = 'mysql:host=localhost;dbname=peluqueria';
	//$user = 'root';
	//$pass = '';
	$dsn = 'mysql:host=sql106.epizy.com;dbname=epiz_34332997_peluqueria';
	$user = 'epiz_34332997';
	$pass = 'EYPBIhqYfGxjv3';
	try {
		$con = new PDO($dsn, $user, $pass);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $ex) {
		echo "Error al conectar a la bbdd ! " . $ex->getMessage();
		die();
	}
