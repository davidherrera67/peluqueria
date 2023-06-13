<?php

include "connect.php";
include "Includes/functions/functions.php";
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";

?>

<link rel="stylesheet" href="Design/css/styles-appointment.css">

<section class="seccion_reserva sect" style="margin-top:150px;">
	
	<video src="Design/images/bg-web-mp4" autoplay="true" muted="true" loop="true">
	</video>
	
		<div class="container">
		<?php
			if (isset($_POST['enviar_form_reserva_cita']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
				
				// servicios seleccionados
				$servicios_seleccionados = $_POST['servicios_seleccionados'];

				// peluquero seleccionado
				$peluquero_seleccionado = $_POST['peluquero_seleccionado'];

				// fecha y hora seleccionada
				$fecha_hora_seleccionada = explode(' ', $_POST['fecha_hora_deseada']);

				$fecha_seleccionada = $fecha_hora_seleccionada[0];
				$inicio = $fecha_seleccionada . " " . $fecha_hora_seleccionada[1];
				$fin = $fecha_seleccionada . " " . $fecha_hora_seleccionada[2];
				
				// detalles del cliente que reserva la cita
				$cliente_nombre = ajustar_texto_introducido($_POST['cliente_nombre']);
				$cliente_apellido = ajustar_texto_introducido($_POST['cliente_apellido']);
				$cliente_telefono = ajustar_texto_introducido($_POST['cliente_telefono']);
				$cliente_correo = ajustar_texto_introducido($_POST['cliente_correo']);

				$con->beginTransaction();

				try {
					$stmtCheckClient = $con->prepare("SELECT * FROM clients WHERE cliente_correo = ?");
					$stmtCheckClient->execute(array($cliente_correo));
					$cliente_resultado = $stmtCheckClient->fetch();
					$cliente_contador = $stmtCheckClient->rowCount();

					if ($cliente_contador > 0) {
						$id_cliente = $cliente_resultado["id_cliente"];
					} else {
						$stmtIDClienteActual = $con->prepare("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'epiz_34332997_peluqueria' AND TABLE_NAME = 'clients'");
						$stmtIDClienteActual->execute();
						$id_cliente = $stmtIDClienteActual->fetch();

						$stmtCliente = $con->prepare("insert into clients(nombre,apellido,telefono,cliente_correo) 
										values(?,?,?,?)");
						$stmtCliente->execute(array($cliente_nombre, $cliente_apellido, $cliente_telefono, $cliente_correo));
					}

					$stmtIDCitaActual = $con->prepare("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'epiz_34332997_peluqueria' AND TABLE_NAME = 'appointments'");
					$stmtIDCitaActual->execute();
					$id_cita = $stmtIDCitaActual->fetch();

					$stmt_cita = $con->prepare("insert into appointments(fecha_cita_creada, id_cliente, id_peluquero , inicio, fin ) values(?, ?, ?, ?, ?)");
					if ($cliente_contador > 0) {
						$stmt_cita->execute(array(Date("Y-m-d H:i"), $id_cliente, $peluquero_seleccionado, $inicio, $fin));
					} else {
						$stmtClienteNuevo= $con->prepare("SELECT * FROM clients ORDER BY id_cliente DESC LIMIT 1");
						$stmtClienteNuevo->execute();
						$cliente_nuevo = $stmtClienteNuevo->fetch();
						$stmt_cita->execute(array(Date("Y-m-d H:i"), $cliente_nuevo["id_cliente"], $peluquero_seleccionado, $inicio, $fin));
					}

					foreach ($servicios_seleccionados as $servicio) {

						$stmtCitaNueva= $con->prepare("SELECT * FROM appointments ORDER BY id_cita DESC LIMIT 1");
						$stmtCitaNueva->execute();
						$cita_nueva = $stmtCitaNueva->fetch();
						
						$stmt = $con->prepare("insert into services_reserved(id_cita, id_servicio) values(?, ?)");
						$stmt->execute(array($cita_nueva["id_cita"], $servicio));
					}

					echo "<div class = 'alert alert-success text-dark'>";
					echo "La cita se ha creado, recibirá una notificación el mismo día de su cita";
					echo "</div>";

					$con->commit();

				} catch (Exception $e) {
					$con->rollBack();

					echo "<div class = 'alert alert-danger text-dark'>";
					echo $e->getMessage();
					echo "</div>";
				}
			}

		?>

		<!-- formulario de reserva de cita -->

		<form method="post" id="form_cita" action="appointment.php">

			<div class="select_services_div tab_reserva" id="services_tab">
				<div class="alert text-dark alert-warning" role="alert" style="display: none">
					Seleccione un servicio al menos para poder continuar!
				</div>
				<div class="header_texto">
					<span>
						1. Seleccione entre los servicio/s el/los que quiera:
					</span>
				</div>
				<!-- 1era pestaña: servicios -->
				<div class="objetos_tab">
					<?php
						$stmt = $con->prepare("Select * from services");
						$stmt->execute();
						$servicios = $stmt->fetchAll();

						foreach ($servicios as $servicio) {
							echo "<div class='listaElementoObjeto'>";

							echo "<div class = 'objeto_detalles'>";
							
							echo "<div>";
							echo $servicio['nombre'];
							echo "</div>";

							echo "<div class = 'objeto_parte_seleccionada'>";

							echo "<span class = 'duracion_campo'>";
							echo $servicio['duracion'] . " minutos";
							echo "</span>";

							echo "<div class = 'precio'>";

							echo "<span class = 'precio_campo'>";
							echo $servicio['precio'] . "€";
							echo "</span>";

							echo "</div>";
							?>
							<div class="btn_seleccion_objeto">
								<div class="btn-group-toggle" data-toggle="buttons">
									<label class="servicio_label objeto_label btn btn-primary">
										<input type="checkbox" name="servicios_seleccionados[]" value="<?php echo $servicio['id'] ?>"
											autocomplete="off">
											
									</label>
								</div>
							</div>
							<?php
							echo "</div>";

							echo "</div>";

							echo "</div>";
						}
					?>
				</div>
			</div>

			<!-- 2nda pestaña: peluquero -->

			<div class="select_hairdresser_div tab_reserva" id="hairdresser_tab">

				<div class="alert text-dark alert-warning " role="alert" style="display: none">Seleccione a un peluquero para poder continuar</div>

				<div class="header_texto">
					<span>2. Seleccione al peluquero de quien desea recibir el/los servicio/s:</span>
				</div>

				<div class="btn-group-toggle" data-toggle="buttons">
					<div class="objetos_tab">
						<?php
							$stmt = $con->prepare("Select * from hairdressers");
							$stmt->execute();
							$peluqueros = $stmt->fetchAll();

							foreach ($peluqueros as $peluquero) {
								echo "<div class='listaElementoObjeto'>";

								echo "<div class = 'objeto_detalles'>";

								echo "<div>";
								echo $peluquero['nombre'] . " " . $peluquero['apellido'];
								echo "</div>";

								echo "<div class = 'objeto_parte_seleccionada'>";
								?>
								<div class="btn_seleccion_objeto">
									<label class="objeto_label btn btn-primary active">
										<input type="radio" class="radio_peluquero_selecionado" name="peluquero_seleccionado"
											value="<?php echo $peluquero['id'] ?>">
											
									</label>
								</div>
								<?php
								echo "</div>";
								echo "</div>";
								echo "</div>";
							}
						?>
					</div>
				</div>
			</div>


			<!-- 3era pestaña: hora y dia -->

			<div class="select_date_time_div tab_reserva" id="calendario_tab">

				<div class="alert alert-warning" role="alert" style="display: none">
					Selecciona una hora disponible para poder continuar
				</div>

				<div class="header_texto"><span>3. Elección de hora y dia:</span></div>
	
				<div class="calendario_tab" id="calendario_tab_dentro">
					<div id="cargando_calendario">
						<img src="Design/images/Spinner-0.4s-200px.gif">
					</div>
				</div>
			</div>


			<!-- 4ta pestaña: cliente info -->

			<div class="cliente_detalles_div tab_reserva" id="cliente_tab">

				<div class="header_texto">
					<span class="header_texto">
						4. Rellene con sus datos para poder solicitar la reserva de cita:
					</span>
				</div>
				
				<div>
					<div class="form-group colum-row row">
						<div class="col-sm-6">
							<input type="text" name="cliente_nombre" id="cliente_nombre" class="form-control"
								placeholder="Nombre">
							<span class="invalid-feedback">El nombre es obligatorio</span>
						</div>
						<div class="col-sm-6">
							<input type="text" name="cliente_apellido" id="cliente_apellido" class="form-control"
								placeholder="Apellido">
							<span class="invalid-feedback">El apellido es obligatorio</span>
						</div>
						<div class="col-sm-6">
							<input type="email" name="cliente_correo" id="cliente_correo" class="form-control"
								placeholder="Correo">
							<span class="invalid-feedback">Dirección de correo incorrecta</span>
						</div>
						<div class="col-sm-6">
							<input type="text" name="cliente_telefono" id="cliente_telefono" class="form-control"
								placeholder="Teléfono">
							<span class="invalid-feedback">Número de teléfono incorrecta</span>
						</div>
					</div>
				</div>
			</div>

			<div class="buttons_over">
				<div style="float:right;">
					<input type="hidden" name="enviar_form_reserva_cita">
					<button type="button" id="prevBtn" class="next_prev_buttons"
						onclick="nextPrev(-1)"><i class="fas fa-chevron-left"></i></button>
					<button type="button" id="nextBtn" class="next_prev_buttons" onclick="nextPrev(1)"><i class="fas fa-angle-right"></i></button>
				</div>
			</div>

			<div class="pasos_centrar">
				<span class="paso"></span>
				<span class="paso"></span>
				<span class="paso"></span>
				<span class="paso"></span>
			</div>

		</form>
	</div>
</section>



<!-- aqui el tema del cliente correo mensaje-->
<?php ?>

<?php include "Includes/templates/footer.php"; ?>