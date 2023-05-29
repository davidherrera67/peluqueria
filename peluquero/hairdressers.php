<?php
    ob_start();
    session_start();

    include 'connect.php';
    include 'Includes/functions/functions.php';
    include 'Includes/templates/header.php';

    echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";

    if (isset($_SESSION['username_hairdressing_Ze422aVVwd1']) && isset($_SESSION['password_hairdressing_Ze422aVVwd1'])) {
?>
    <div class="container-fluid">
        <?php
            $accion = "";

            if (isset($_GET['accion']) && in_array($_GET['accion'], array('Agregar', 'Editar'))) {
                $accion = htmlspecialchars($_GET['accion']);
            } else {$accion = 'Administrar';}

            if ($accion == 'Administrar') {
                $stmt = $con->prepare("SELECT * FROM hairdressers");
                $stmt->execute();
                $peluqueros = $stmt->fetchAll();
        ?>
            <div class="card border-info">
            <div class="card-header bg-info"><h2 class="text-warning text-center">Peluqueros</h2></div>
                <div class="card-body">
                    <a href="hairdressers.php?accion=Agregar" class="btn btn-info btn-sm mb-3"><i class="fas fa-wrench"></i>Agregar Peluquero</a>
                    <div class="table-responsive">
                        <table id="tablabootstrap5" class="table table-striped ui celled table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-dark">Nombre</th>
                                    <th class="text-dark">Apellido</th>
                                    <th class="text-dark">Teléfono</th>
                                    <th class="text-dark">Correo</th>
                                    <th class="text-dark">Gestionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($peluqueros as $peluquero) {
                                    echo "<tr>";

                                    echo "<td>";
                                    echo $peluquero['nombre'];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $peluquero['apellido'];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $peluquero['telefono'];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $peluquero['correo'];
                                    echo "</td>";

                                    echo "<td>";
                                    $datos_borrar = "borrar_peluquero_" . $peluquero["id"];
                                ?>
                                    <ul class=" m-0 list-inline">
                                        <li class="list-inline-item" data-toggle="tooltip" title="Editar Peluquero">
                                            <button class="btn btn-success btn-sm">
                                                <a href="hairdressers.php?accion=Editar&id_peluquero=<?= $peluquero['id']; ?>"><i class="fas fa-user-edit"></i></a>
                                            </button>
                                        </li>

                                        <li class="list-inline-item" data-toggle="tooltip" title="Eliminar Peluquero">
                                            <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#<?= $datos_borrar; ?>" data-placement="top">
                                                <i class="fas fa-trash-alt text-primary"></i>
                                            </button>

                                            <div class="modal fade text-center"  tabindex="-1" role="dialog" id="<?= $datos_borrar; ?>" aria-labelledby="<?= $datos_borrar; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content text-center">
                                                        <div class="modal-header bg-info">
                                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Personal</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿Está seguro de que deseas eliminar el peluquero: (<?= $peluquero['nombre']." ".$peluquero['apellido']; ?>) de la base de datos de peluquería dacor?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <button type="button" data-id="<?= $peluquero['id']; ?>" class="btn btn-danger borrar_peluquero_btn">Eliminar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                <?php
                                    echo "</td>";  echo "</tr>";}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php
        } elseif ($accion == 'Agregar') {
        ?>

            <div class="card border-info">
                <div class="card-header bg-info">
                    <h5 class="m-0 text-warning text-center">Añadir Nuevo Peluquero</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="hairdressers.php?accion=Agregar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_peluquero">Nombre del Peluquero</label>
                                    <input type="text" class="form-control" value="<?= (isset($_POST['nombre_peluquero'])) ? htmlspecialchars($_POST['nombre_peluquero']) : '' ?>" placeholder="Nombre" name="nombre_peluquero">
                                    <?php
                                        $agregar_peluquero_form = 0;
                                        if (isset($_POST['agregar_peluquero'])) 
                                        {
                                            if (empty(ajustar_texto_introducido($_POST['nombre_peluquero']))) 
                                            {?>
                                                <div class="invalid-feedback" style="display: flex;">El nombre del peluquero es necesario</div>
                                                <?php
                                                $agregar_peluquero_form = 1;
                                            }
                                    }?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apellido_peluquero">Apellido Peluquero</label>
                                    <input type="text" class="form-control" value="<?= (isset($_POST['apellido_peluquero'])) ? htmlspecialchars($_POST['apellido_peluquero']) : '' ?>" placeholder="Apellido" name="apellido_peluquero">
                                    <?php
                                        if (isset($_POST['agregar_peluquero'])) {
                                            if (empty(ajustar_texto_introducido($_POST['apellido_peluquero']))) {
                                    ?>
                                            <div class="invalid-feedback" style="display: flex;">El Apellido del peluquero es necesario</div>
                                    <?php $agregar_peluquero_form = 1;
                                        }
                                    }?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono_peluquero">Teléfono del Peluquero</label>
                                    <input type="text" class="form-control" value="<?= (isset($_POST['telefono_peluquero'])) ? htmlspecialchars($_POST['telefono_peluquero']) : '' ?>" placeholder="Teléfono" name="telefono_peluquero">
                                    <?php
                                    if (isset($_POST['agregar_peluquero'])) {
                                        if (empty(ajustar_texto_introducido($_POST['telefono_peluquero']))) {
                                    ?>
                                            <div class="invalid-feedback" style="display: flex;">El Teléfono del peluquero es necesario</div>
                                    <?php $agregar_peluquero_form = 1;
                                        }
                                    }?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="correo_peluquero">Correo del Peluquero</label>
                                    <input type="text" class="form-control" value="<?= (isset($_POST['correo_peluquero'])) ? htmlspecialchars($_POST['correo_peluquero']) : '' ?>" placeholder="Correo" name="correo_peluquero">
                                    <?php
                                        if (isset($_POST['agregar_peluquero'])) {
                                            if (empty(ajustar_texto_introducido($_POST['correo_peluquero']))) {
                                    ?>
                                            <div class="invalid-feedback" style="display: block;">El Correo del peluquero es necesario</div>
                                    <?php $agregar_peluquero_form = 1;
                                        }
                                    }?>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="agregar_peluquero" class="btn btn-success">Añadir Peluquero</button>

                    </form>

                    <?php
                        if (isset($_POST['agregar_peluquero']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $agregar_peluquero_form == 0) {
                            $nombre_peluquero = ajustar_texto_introducido($_POST['nombre_peluquero']);
                            $apellido_peluquero = $_POST['apellido_peluquero'];
                            $telefono_peluquero = ajustar_texto_introducido($_POST['telefono_peluquero']);
                            $correo_peluquero = ajustar_texto_introducido($_POST['correo_peluquero']);

                            try {
                                $stmt = $con->prepare("insert into hairdressers(nombre,apellido,telefono,correo) values(?,?,?,?) ");
                                $stmt->execute(array($nombre_peluquero, $apellido_peluquero, $telefono_peluquero, $correo_peluquero));
                    ?>
                            <script type="text/javascript">
                                swal("Agregando nuevo Peluquero", "El/La nuev@ peluquer@ se ha agregado a la base de datos de la peluquería dacor exitosamente", "success").then((value) => {
                                    window.location.replace("hairdressers.php");});
                            </script>

                    <?php
                        } catch (Exception $e) {
                            echo "<div class = 'alert alert-danger'>";
                            echo $e->getMessage();
                            echo "</div>";
                        }
                    }?>
                </div>
            </div>
    <?php
        } elseif ($accion == 'Editar') {
            $id_peluquero = (isset($_GET['id_peluquero']) && is_numeric($_GET['id_peluquero'])) ? intval($_GET['id_peluquero']) : 0;

            if ($id_peluquero) {
                $stmt = $con->prepare("Select * from hairdressers where id = ?");
                $stmt->execute(array($id_peluquero));
                $peluquero = $stmt->fetch();
                $contar = $stmt->rowCount();

                if ($contar > 0) {
            ?>
                    <div class="card border-info">
                        <div class="card-header bg-info"><h2 class="m-0 font-weight-bold text-primary">Editar Peluquero</h2></div>
                        <div class="card-body">
                            <form method="POST" action="hairdressers.php?accion=Editar&id_peluquero=<?= $id_peluquero; ?>">
                            <input name="id_peluquero" type="hidden" value="<?= $peluquero['id']; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre_peluquero">Nombre del Peluquero</label>
                                            <input type="text" class="form-control" value="<?= $peluquero['nombre'] ?>" placeholder="Nombre" name="nombre_peluquero">
                                            <?php
                                                $editar_peluquero_form = 0;
                                                if (isset($_POST['editar_peluquero_enviar'])) 
                                                {
                                                    if (empty(ajustar_texto_introducido($_POST['nombre_peluquero']))) 
                                                    {?>
                                                    <div class="invalid-feedback" style="display: flex;">El campo nombre del peluquero es necesario</div>
                                                    <?php 
                                                    $editar_peluquero_form = 1;
                                                }
                                            }?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellido_peluquero">Apellido del Peluquero</label>
                                            <input type="text" class="form-control" value="<?= $peluquero['apellido'] ?>" placeholder="Apellido" name="apellido_peluquero">
                                            <?php
                                                if (isset($_POST['editar_peluquero_enviar'])) {
                                                    if (empty(ajustar_texto_introducido($_POST['apellido_peluquero']))) {
                                            ?>
                                                    <div class="invalid-feedback" style="display: block;">El campo Apellido del peluquero es necesario</div>
                                                <?php
                                                $editar_peluquero_form = 1;
                                                }
                                            }?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono_peluquero">Teléfono del Peluquero</label>
                                            <input type="text" class="form-control" value="<?= $peluquero['telefono'] ?>" placeholder="Teléfono" name="telefono_peluquero">
                                            <?php
                                                if (isset($_POST['editar_peluquero_enviar'])) {
                                                    if (empty(ajustar_texto_introducido($_POST['telefono_peluquero']))) {
                                            ?>
                                                    <div class="invalid-feedback" style="display: block;">El campo Teléfono del peluquero es necesario</div>
                                            <?php
                                                $editar_peluquero_form = 1;
                                                }
                                            }?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo_peluquero">Correo del Peluquero</label>
                                            <input type="text" class="form-control" value="<?= $peluquero['correo'] ?>" placeholder="Correo" name="correo_peluquero">
                                            <?php
                                                if (isset($_POST['editar_peluquero_enviar'])) {
                                                    if (empty(ajustar_texto_introducido($_POST['correo_peluquero']))) {
                                            ?>
                                                    <div class="invalid-feedback" style="display: flex;">El campo Correo del peluquero es necesario</div>
                                            <?php
                                                $editar_peluquero_form = 1;
                                                }
                                            }?>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="editar_peluquero_enviar" class="btn btn-primary">Editar peluquero</button>
                            </form>

                            <?php
                            if (isset($_POST['editar_peluquero_enviar']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $editar_peluquero_form == 0) {
                                $nombre_peluquero = ajustar_texto_introducido($_POST['nombre_peluquero']);
                                $apellido_peluquero = $_POST['apellido_peluquero'];
                                $telefono_peluquero = ajustar_texto_introducido($_POST['telefono_peluquero']);
                                $correo_peluquero = ajustar_texto_introducido($_POST['correo_peluquero']);
                                $id_peluquero = $_POST['id_peluquero'];

                                try {
                                    $stmt = $con->prepare("update hairdressers set nombre = ?, apellido = ?, telefono = ?, correo = ? where id = ? ");
                                    $stmt->execute(array($nombre_peluquero, $apellido_peluquero, $telefono_peluquero, $correo_peluquero, $id_peluquero));
                            ?>
                                    <script type="text/javascript">
                                        swal("Actualizando Peluquero", "El/La peluquer@ ha sido actualizad@ exitosamente", "success").then((value) => {
                                            window.location.replace("hairdressers.php");});
                                    </script>

                            <?php
                                } catch (Exception $e) {
                                    echo "<div class = 'alert alert-danger' style='margin:10px 0px;'>";
                                    echo $e->getMessage();
                                    echo "</div>";
                                }
                            }?>
                        </div>
                    </div>
        <?php
                } else {
                    header('Location: hairdressers.php');
                    exit();
                }
            } else {
                header('Location: hairdressers.php');
                exit();
            }
        }
        ?>
    </div>

<?php

        include 'Includes/templates/footer.php';
    } else {
        header('Location: login.php');
        exit();
    }
?>