<?php
ob_start();
session_start();

include "connect.php";
include "Includes/functions/functions.php";
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";
echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";

?>

<!-- Bootstrap icons-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<!-- Core theme CSS (includes Bootstrap)-->

<!-- Header-->
<header class="py-1" style="">
	<div class="container px-4 my-3">
		<div class="text-center ">
			<p class="lead fw-normal text-primary mb-0">Peluquería Dacor</p>
		</div>
	</div>
</header>
<!-- Section-->
<section class="py-3">

	<?php
	$accion = "";
	if (isset($_GET['accion']) && in_array($_GET['accion'], array('Comprar'))) {
		$accion = htmlspecialchars($_GET['accion']);
	} else {
		$accion = 'Administrar';
	}

	if ($accion == 'Administrar') {
		$stmt = $con->prepare("Select * from products");
		$stmt->execute();
		$productos = $stmt->fetchAll();
		?>

		<div class="container px-4 px-lg-5 mt-5">
			<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center ">

				<?php


				foreach ($productos as $producto) {
					echo "<div class='col mb-5'>";

					echo "<div class = 'card h-100 text-white mb-1'>";
					if($producto['nombre'] == "gel") {
						?>
					<img class="card-img-top" src="Design/images/gelshop.png" alt="peine"
						style="height:228.5px; widht:228.5px;" /><?php
					}else if($producto['nombre'] == "peine"){
						?>
						<img class="card-img-top" src="Design/images/peineshop.png" alt="peine"
							style="height:228.5px; widht:228.5px;" /><?php
					}
					else if($producto['nombre'] == "secador"){
						?>
						<img class="card-img-top" src="Design/images/secador.jpg" alt="peine"
							style="height:228.5px; widht:228.5px;" /><?php
					}else{
						?>
						<img class="card-img-top" src="Design/images/Spinner-0.4s-200px.gif" alt="peine"
							style="height:228.5px; widht:228.5px;" /><?php
					}
						echo "<div class='card-body p-4 bg-dark'>";

						echo "<div class='text-center mb-1'>";
						echo "Producto: " . $producto['nombre'];
						echo "</div>";

						echo "<div class='text-center mb-1'>";
						echo "Precio: " . $producto['precio'] . "€";
						echo "</div>";

						echo "<div class='text-center mb-1'>";
						echo "Descripcion: " . $producto['descripcion'];
						echo "</div>";

						?><div class="d-flex justify-content-center mb-1">Valoración:
						<div class="bi-star-fill text-warning"></div>
						<div class="bi-star-fill text-warning"></div>
						<div class="bi-star-fill text-warning"></div>
						<div class="bi-star-fill text-warning"></div>
						<div class="bi-star-fill text-warning"></div>
					</div>
					<?php

					echo "<div class='text-center'>";
					if ($producto['stock'] > 0){
						echo "Stock: Sí, hay ". $producto['stock'] ." unidades de este producto!";
						?>
						<!-- Se le da al boton de comprar y te manda a una nueva ventana / clase buy.php que le pasamos el id del producto 
						y en buy.php recogemos como en el appointment.php los datos del cliente 
						y así lo que haremos sera crear una compra en la tabla "compra" cogiendo el id del producto , el id del cliente gracias a esa clase que tiene los dos-->

						<div class="card-footer pt-0 text-center bg-transparent">
						<button class="btn btn-success btn-xl mt-1 ">
							<a href="products.php?accion=Comprar&id_producto=<?= $producto['id']; ?>">Comprar <i
									class="fa-solid fa-bag-shopping"></i></a>

						</button>
					</div>
					<?php
					}
					else{
						echo "Stock: No hay stock disponible"; ?><i class="fa-solid fa-face-sad-cry fa-flip fa-xl text-info"></i><?php
						}
					echo "</div>";
					echo "</div>";

					echo "</div>";
					echo "</div>";


				}
				?>
			</div>
		</div>
		<?php
	} elseif ($accion == 'Comprar') {
		$id_producto = (isset($_GET['id_producto']) && is_numeric($_GET['id_producto'])) ? intval($_GET['id_producto']) : 0;

		if ($id_producto) {
			$stmtProductos = $con->prepare("Select * from products where id = ?");
			$stmtProductos->execute(array($id_producto));
			$producto = $stmtProductos->fetch();
			$contar = $stmtProductos->rowCount();
			if ($contar > 0) {
				?>
				<div style="display:flex;" class="w-50 m-auto card card border-info">
					<div class="card-header bg-info">
						<h2 class="text-warning text-center py-1">Comprar Producto</h2>
					</div>
					<div class="card-body">
						<form method="POST" action="products.php?accion=Comprar&id_producto=<?= $id_producto; ?>">

							<input name="id_producto" value="<?= $producto['id']; ?>" type="hidden">

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="cliente_nombre">Nombre del Cliente</label>
										<input type="text" class="form-control" name="cliente_nombre" id="cliente_nombre"
											placeholder="Nombre">
										<span class="invalid-feedback">El nombre es obligatorio</span>
										<?php
										$comprar_producto_form = 0;
										if (isset($_POST['comprar_producto_enviar'])) {
											if (empty(ajustar_texto_introducido($_POST['cliente_nombre']))) { ?>
												<div class="invalid-feedback" style="display: flex;">El campo nombre del cliente es
													necesario.</div>
												<?php
												$comprar_producto_form = 1;
											}
										} ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="cliente_apellido">Apellido del Cliente</label>
										<input type="text" class="form-control" name="cliente_apellido" id="cliente_apellido"
											placeholder="Apellido">
										<span class="invalid-feedback">El apellido es obligatorio</span>
										<?php

										if (isset($_POST['comprar_producto_enviar'])) {
											if (empty(ajustar_texto_introducido($_POST['cliente_apellido']))) { ?>
												<div class="invalid-feedback" style="display: flex;">El campo apellido del cliente es
													necesario.</div>
												<?php
												$comprar_producto_form = 1;
											}
										} ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="cliente_correo">Correo del Cliente</label>
										<input type="text" class="form-control" name="cliente_correo" id="cliente_correo"
											placeholder="Correo">
										<span class="invalid-feedback">El correo es obligatorio</span>
										<?php

										if (isset($_POST['comprar_producto_enviar'])) {
											if (empty(ajustar_texto_introducido($_POST['cliente_correo']))) { ?>
												<div class="invalid-feedback" style="display: flex;">El campo correo del cliente es
													necesario.</div>
												<?php
												$comprar_producto_form = 1;
											}
										} ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="cliente_telefono">Telefono del Cliente</label>
										<input type="text" class="form-control" name="cliente_telefono" id="cliente_telefono"
											placeholder="Telefono">
										<span class="invalid-feedback">El correo es obligatorio</span>
										<?php

										if (isset($_POST['comprar_producto_enviar'])) {
											if (empty(ajustar_texto_introducido($_POST['cliente_telefono']))) { ?>
												<div class="invalid-feedback" style="display: flex;">El campo telefono del cliente es
													necesario.</div>
												<?php
												$comprar_producto_form = 1;
											}
										} ?>
									</div>
								</div>
							</div>
							
							<button type="submit" name="comprar_producto_enviar" class="btn btn-success">Comprar</button>
						</form>

						<?php

                            if (isset($_POST['comprar_producto_enviar']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $comprar_producto_form == 0) {
                                
								$id_producto = $_POST['id_producto'];
                               
                                
								// detalles del cliente
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

										$stmtCliente = $con->prepare("insert into clients(nombre,apellido,telefono,cliente_correo) values(?,?,?,?)");
										$stmtCliente->execute(array($cliente_nombre, $cliente_apellido, $cliente_telefono, $cliente_correo));
									} 
									
									$stmtProductoPrecio = $con->prepare("SELECT * FROM products WHERE id = ?");
									$stmtProductoPrecio->execute(array($id_producto));
									$productos_resultado = $stmtProductoPrecio->fetchAll();

									foreach ($productos_resultado as $producto_resultado) {

										$stmt_compra = $con->prepare("insert into purchases(fecha,id_cliente,id_producto,pago) values(?,?,?,?)");
										if ($cliente_contador > 0) {
											$stmt_compra->execute(array(Date("Y-m-d H:i"), $id_cliente, $id_producto,$producto_resultado['precio']));
											
										} else {
											$stmtClienteNuevo= $con->prepare("SELECT * FROM clients ORDER BY id_cliente DESC LIMIT 1");
											$stmtClienteNuevo->execute();
											$cliente_nuevo = $stmtClienteNuevo->fetch();
											$stmt_compra->execute(array(Date("Y-m-d H:i"), $cliente_nuevo["id_cliente"], $id_producto,$producto_resultado['precio']));
										}

										try {
											$stmt = $con->prepare("update products set stock = ? where id = ? ");
											$stmt->execute(array($producto_resultado['stock']-1, $id_producto));?>
											
									<?php
		
										} catch (Exception $e) {
											echo "<div class = 'alert alert-danger'";
											echo $e->getMessage();
											echo "</div>";
										}

								}
									
									$con->commit();
									?>		
                                    
                                    <script type="text/javascript">swal("Compra realizada!", "La compra ha sido realizada exitosamente y registrada en la base de datos de la peluqueria dacor", "success").then((value) => {
                                            window.location.replace("products.php");
                                        });
                                    </script>
									
                            <?php

                                } catch (Exception $e) {
									$con->rollBack();
                                    echo "<div class = 'alert alert-danger'";
                                    echo $e->getMessage();
                                    echo "</div>";
                                }
                            }
                            ?>
					</div>
				</div>
				<?php
			} else {
				header('Location: products.php');
				exit();
			}
		} else {
			header('Location: products.php');
			exit();
		}
	} ?>
</section>

<?php include "Includes/templates/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>