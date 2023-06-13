<?php
	$dsn = 'mysql:host=localhost;dbname=peluqueria';
	$user = 'root';
	$pass = '';
	//$dsn = 'mysql:host=sql213.infinityfree.com;dbname=if0_34413122_peluqueria';
	//$user = 'if0_34413122';
	//$pass = 'TGIGwKtbM3DJN';
	try {
		$con = new PDO($dsn, $user, $pass);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $ex) {
		echo "Error al conectar a la bbdd ! " . $ex->getMessage();
		die();
	}
