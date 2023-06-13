<?php
	$dsn = 'mysql:host=localhost;dbname=peluqueria';
	$user = 'root';
	$pass = '';
	//$dsn = 'mysql:host=sql213.infinityfree.com;dbname=if0_34413122_peluqueria';
	//$user = 'if0_34413122';
	//$pass = 'TGIGwKtbM3DJN';
	try {
		$con = new PDO($dsn, $user, $pass);
	} catch (PDOException $e) {
		echo "Error al conectar a la bbdd " . $e->getMessage();
		die();
	}
