<?php
	session_start();

	if (isset($_SESSION['username_hairdressing_Ze422aVVwd1']) && isset($_SESSION['password_hairdressing_Ze422aVVwd1'])) {
		header('Location: index.php');
		exit();
	}

	include 'connect.php';
	include 'Includes/functions/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Peluqueria Dacor">
    <meta name="author" content="david herrera costa">
    <title>Administración Peluqueria Dacor</title>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    
	<link href="Design/fonts/css/all.min.css" rel="stylesheet" type="text/css">
	<!-- template start bootstrap 2 , v4.6.0-->
    <link href="Design/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="Design/css/main4.css" rel="stylesheet">
</head>

<body class="bg-gradient-success py-6 px-3">

    <div class="login">
		<form class="login-container validate-form py-6 px-3" name="login-form" method="POST" action="login.php" onsubmit="return validarFormInicioSesion()">
			<h2 class="login50-form-title text-primary">Admin Peluquería Dacor</h2>
			<?php

			if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['entrar'])) {
				$username = ajustar_texto_introducido($_POST['username']);
				$password = ajustar_texto_introducido($_POST['password']);
				$hashPass = md5($password);

				$stmt = $con->prepare("Select id, username,password from hairdressers_admin where username = ? and password = ?");
				$stmt->execute(array($username, $hashPass));
				$peluquero = $stmt->fetch();
				$cuenta = $stmt->rowCount();

				if ($cuenta > 0) {
					$_SESSION['username_hairdressing_Ze422aVVwd1'] = $username;
					$_SESSION['password_hairdressing_Ze422aVVwd1'] = $password;
					$_SESSION['admin_id_hairdressing_Ze422aVVwd1'] = $peluquero['id'];
					
					header('Location: index.php');
					die();
				} else {
			?>

					<div class="alert alert-warning">
						<button data-dismiss="alert" class="close close-sm" type="button">
							<span aria-hidden="true">X</span>
						</button>
						<div>
							<div>Nombre o contraseña incorrectos.</div>
						</div>
					</div>
						<?php
				}
			}?>

			<div >
				<span class="login-titulo-input">Usuario</span>
				<input type="text" name="username" class="form-control" oninput="getElementById('username_necesario').style.display = 'none'" autocomplete="off">
				<span class="invalid-feedback" id="username_necesario">¡Nombre OBLIGATORIO!</span>
			</div>

			<div>
				<span class="login-titulo-input">Contraseña</span>
				<input type="password" name="password" class="form-control" oninput="getElementById('password_necesario').style.display = 'none'" autocomplete="new-password">
				<span class="invalid-feedback" id="password_necesario">¡Contraseña OBLIGATORIA!</span>
			</div>

			<p>
				<button type="submit" name="entrar">Entrar</button>
			</p>


		</form>
	</div>

       <footer class="fixed-bottom sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span><p> Desarrollado por David Herrera Costa! &copy; <?=date('Y')?></span>
                </div>
            </div>
        </footer>

	<script src="Design/js/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="Design/js/bootstrap.bundle.min.js"></script>
	<script src="Design/js/sb-admin-2.min.js"></script>
	<script src="Design/js/principal3.js"></script>
</body>

</html>