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
                $stmt = $con->prepare("SELECT * FROM services s, services_category sc where s.id_categoria = sc.id_categoria");
                $stmt->execute();
                $servicios = $stmt->fetchAll();
        ?>
        <div class="card border-info">
            <div class="card-header bg-info">
                <h2 class="text-warning text-center">Servicios</h2>
            </div>
                <div class="card-body">
                    <a class="btn btn-info btn-sm mb-3" href="services.php?accion=Agregar"><i class="fas fa-wrench"></i>Añadir un Servicio</a>
                    <div class="table-responsive">
                        <table id="tablabootstrap5" class="table table-hover ui celled table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-dark">Nombre de Servicio</th>
                                    <th class="text-dark">Categoría de Servicio</th>
                                    <th class="text-dark">Descripción</th>
                                    <th class="text-dark">Precio</th>
                                    <th class="text-dark">Duración</th>
                                    <th class="text-dark">Gestionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($servicios as $servicio) {
                                    echo "<tr>";

                                    echo "<td>";
                                    echo $servicio['nombre'];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $servicio['nombre_categoria'];
                                    echo "</td>";

                                    echo "<td style = 'width:50%'>";
                                    echo $servicio['descripcion'];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $servicio['precio']." €";
                                    echo "</td>";

                                    echo "<td>";
                                    echo $servicio['duracion']." minutos";
                                    echo "</td>";

                                    echo "<td>";
                                    $datos_borrar = "borrar_" . $servicio["id"];
                                ?>
                                    <ul class="m-0 list-inline">
                                        <li class="list-inline-item" data-toggle="tooltip" title="Editar Servicio">
                                            <button class="btn btn-success btn-sm">
                                                <a href="services.php?accion=Editar&id_servicio=<?= $servicio['id'];?>"><i class="fas fa-user-edit"></i></a>
                                            </button>
                                        </li>

                                        <li class="list-inline-item" data-toggle="tooltip" title="Eliminar Servicio">
                                            <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#<?= $datos_borrar; ?>" data-placement="top">
                                                <i class="fas fa-trash-alt text-primary"></i>
                                            </button>

                                            <div class="modal fade text-center" tabindex="-1" role="dialog" id="<?= $datos_borrar; ?>" aria-labelledby="<?php echo $datos_borrar; ?>" aria-hidden="true">
                                                <div class="modal-dialog " role="document">
                                                    <div class="modal-content text-center">
                                                        <div class="modal-header bg-info ">
                                                            <h5 class="modal-title text-warning" id="exampleModalLabel">Eliminar Servicio</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿Estas seguro de que deseas eliminar el servicio: (<?= $servicio['nombre']; ?>) de la base de datos de peluquería dacor?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <button type="button" data-id="<?= $servicio['id']; ?>" class="btn btn-danger borrar_servicio_btn">Eliminar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                <?php
                                    echo "</td>"; echo "</tr>";}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php
        } 
        elseif ($accion == 'Agregar')
        {
        ?>
            <div class="card border-info">
                <div class="card-header bg-info">
                    <h5 class="m-0 text-warning text-center">Añadir Servicio</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="services.php?accion=Agregar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_servicio">Nombre Servicio</label>
                                    <input type="text" class="form-control" value="<?= (isset($_POST['nombre_servicio'])) ? htmlspecialchars($_POST['nombre_servicio']) : '' ?>"  name="nombre_servicio" placeholder="Nombre Servicio">
                                    <?php
                                        $agregar_servicio_form = 0;
                                        if (isset($_POST['agregar_servicio']))
                                        {
                                            if (empty(ajustar_texto_introducido($_POST['nombre_servicio'])))
                                            {?>
                                                <div class="invalid-feedback" style="display: flex;">El nombre del servicio es necesario</div>
                                                <?php
                                                $agregar_servicio_form = 1;
                                            }
                                        }?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php
                                    $stmt = $con->prepare("SELECT * FROM services_category");
                                    $stmt->execute();
                                    $categorias = $stmt->fetchAll();
                                ?>
                                <div class="form-group">
                                    <label for="categoria_servicios">Categoría de Servicio</label>
                                    <select class="custom-select" name="categoria_servicios">
                                        <?php
                                            foreach ($categorias as $categoria) {
                                                echo "<option value = '" . $categoria['id_categoria'] . "'>";
                                                echo $categoria['nombre_categoria'];
                                                echo "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="duracion_servicio">Duración del Servicio</label>
                                    <input type="text" class="form-control" name="duracion_servicio" value="<?php echo (isset($_POST['duracion_servicio'])) ? htmlspecialchars($_POST['duracion_servicio']) : '' ?>" placeholder="Duración de Servicio">
                                    <?php
                                        if (isset($_POST['agregar_servicio'])) {
                                            if (empty(ajustar_texto_introducido($_POST['duracion_servicio']))) {
                                        ?>
                                                <div class="invalid-feedback" style="display: flex;">La duración del servicio es necesaria</div>
                                            <?php $agregar_servicio_form = 1;
                                            } elseif (!ctype_digit(ajustar_texto_introducido($_POST['duracion_servicio']))) {?>
                                            <div class="invalid-feedback" style="display: flex;">El formato del campo duración es incorrecto</div>
                                            <?php $agregar_servicio_form = 1;}
                                    }?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="precio_servicio">Precio del Servicio</label>

                                    <input type="text" class="form-control" name="precio_servicio" value="<?= (isset($_POST['precio_servicio'])) ? htmlspecialchars($_POST['precio_servicio']) : '' ?>" placeholder="Precio del Servicio">
                                    <?php
                                        if (isset($_POST['agregar_servicio'])) {
                                            if (empty(ajustar_texto_introducido($_POST['precio_servicio']))) {?>
                                                <div class="invalid-feedback" style="display: flex;">El precio del servicio es necesario</div>
                                            <?php $agregar_servicio_form = 1;
                                            } elseif (!is_numeric(ajustar_texto_introducido($_POST['precio_servicio']))) {?>
                                                <div class="invalid-feedback" style="display: flex;">El formato del campo precio es incorrecto</div>
                                        <?php $agregar_servicio_form = 1;}
                                    }?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion_servicio">Descripción de Servicio</label>

                                    <textarea class="form-control" name="descripcion_servicio" style="resize: none;"><?php echo (isset($_POST['descripcion_servicio'])) ? htmlspecialchars($_POST['descripcion_servicio']) : ''; ?></textarea>
                                    <?php
                                    if (isset($_POST['agregar_servicio'])) {
                                        if (empty(ajustar_texto_introducido($_POST['descripcion_servicio']))) {?>
                                            <div class="invalid-feedback" style="display: flex;">La descripcion del servicio es necesario</div>
                                        <?php $agregar_servicio_form = 1;
                                        } elseif (strlen(ajustar_texto_introducido($_POST['descripcion_servicio'])) > 255) {?>
                                            <div class="invalid-feedback" style="display: flex;">El formato del campo descripción debe contener como máximo 255 letras.</div>
                                    <?php $agregar_servicio_form = 1;}
                                }?>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="agregar_servicio" class="btn btn-success">Añadir Servicio</button>
                    </form>

                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar_servicio']) && $agregar_servicio_form == 0) {
                            $nombre_servicio = ajustar_texto_introducido($_POST['nombre_servicio']);
                            $categoria_servicios = $_POST['categoria_servicios'];
                            $duracion_servicio = ajustar_texto_introducido($_POST['duracion_servicio']);
                            $precio_servicio = ajustar_texto_introducido($_POST['precio_servicio']);
                            $descripcion_servicio = ajustar_texto_introducido($_POST['descripcion_servicio']);

                            try {
                                $stmt = $con->prepare("insert into services(nombre,descripcion,precio,duracion,id_categoria) values(?,?,?,?,?)");
                                $stmt->execute(array($nombre_servicio, $descripcion_servicio, $precio_servicio, $duracion_servicio, $categoria_servicios));?>
                            <script type="text/javascript">swal("Nuevo servicio agregado", "Nuevo servicio agregado exitosamente a la base de datos de la peluqueria dacor", "success").then((value) => {
                                    window.location.replace("services.php");});
                            </script>
                    <?php
                            } catch (Exception $e) {
                                echo "<div class = 'alert alert-danger'>";
                                echo $e->getMessage();
                                echo "</div>";
                            }
                        }
                    ?>
                </div>
            </div>

    <?php
        } elseif ($accion == "Editar") {
            $id_servicio = (isset($_GET['id_servicio']) && is_numeric($_GET['id_servicio'])) ? intval($_GET['id_servicio']) : 0;

            if ($id_servicio) {
                $stmt = $con->prepare("Select * from services where id = ?");
                $stmt->execute(array($id_servicio));
                $servicio = $stmt->fetch();
                $contar = $stmt->rowCount();
                if ($contar > 0) {
            ?>
                    <div class="card card border-info">
                    <div class="card-header bg-info"><h2 class="text-warning text-center">Editar Servicios</h2></div>
                        <div class="card-body">
                            <form method="POST" action="services.php?accion=Editar&id_servicio=<?= $id_servicio; ?>">

                            <input name="id_servicio" value="<?= $servicio['id']; ?>" type="hidden">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre_servicio">Nombre del Servicio</label>
                                            <input  type="text" class="form-control" value="<?= $servicio['nombre'] ?>" name="nombre_servicio" placeholder="Nombre de Servicio">
                                            <?php
                                                $editar_servicio_form = 0;
                                                if (isset($_POST['editar_servicio_enviar'])) 
                                                {
                                                    if (empty(ajustar_texto_introducido($_POST['nombre_servicio']))) 
                                                    {?>
                                                    <div class="invalid-feedback" style="display: flex;">El campo nombre del servicio es necesario.</div>
                                                    <?php 
                                                    $editar_servicio_form = 1;
                                                }
                                            }?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                            $stmt = $con->prepare("SELECT * FROM services_category");
                                            $stmt->execute();
                                            $categorias = $stmt->fetchAll();
                                        ?>
                                        <div class="form-group">
                                            <label for="categoria_servicios">Categoría de Servicio</label>
                                            <select name="categoria_servicios" class="custom-select">
                                                <?php
                                                    foreach ($categorias as $categoria) {
                                                        if ($categoria['id_categoria'] == $servicio['id_categoria']) {
                                                            echo "<option value = '" . $categoria['id_categoria'] . "' selected>";
                                                            echo $categoria['nombre_categoria'];
                                                            echo "</option>";
                                                        } else {
                                                            echo "<option value = '" . $categoria['id_categoria'] . "'>";
                                                            echo $categoria['nombre_categoria'];
                                                            echo "</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="duracion_servicio">Duración del Servicio</label>
                                            <input type="text" class="form-control" value="<?php echo $servicio['duracion'] ?>" placeholder="Duración de Servicio" name="duracion_servicio">
                                            <?php
                                                if (isset($_POST['editar_servicio_enviar'])) {
                                                    if (empty(ajustar_texto_introducido($_POST['duracion_servicio']))) {
                                            ?>
                                                    <div class="invalid-feedback" style="display: flex;">La duración del servicio es necesaria</div>
                                                <?php $editar_servicio_form = 1;
                                                } elseif (!ctype_digit(ajustar_texto_introducido($_POST['duracion_servicio']))) {?>
                                                    <div class="invalid-feedback" style="display: flex;">El formato del campo duración es incorrecto</div>
                                            <?php $editar_servicio_form = 1;}
                                            }?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="precio_servicio">Precio del Servicio</label>
                                            <input type="text" class="form-control" name="precio_servicio" value="<?php echo $servicio['precio'] ?>" placeholder="Precio de Servicio" >
                                            <?php
                                                if (isset($_POST['editar_servicio_enviar'])) {
                                                    if (empty(ajustar_texto_introducido($_POST['precio_servicio']))) {?>
                                                        <div class="invalid-feedback" style="display: flex;">El precio del servicio es necesario</div>
                                                    <?php $editar_servicio_form = 1;
                                                    } elseif (!is_numeric(ajustar_texto_introducido($_POST['precio_servicio']))) {?>
                                                        <div class="invalid-feedback" style="display: flex;">El formato del campo precio es incorrecto</div>
                                                <?php $editar_servicio_form = 1;}
                                            }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion_servicio">Descripción del Servicio</label>
                                            <textarea class="form-control" name="descripcion_servicio" style="resize: none;"><?php echo $servicio['descripcion']; ?></textarea>
                                            <?php
                                            if (isset($_POST['editar_servicio_enviar'])) {
                                                if (empty(ajustar_texto_introducido($_POST['descripcion_servicio']))) {?>
                                                    <div class="invalid-feedback" style="display: flex;">La descripcion del servicio es necesario</div>
                                                <?php $editar_servicio_form = 1;
                                                } elseif (strlen(ajustar_texto_introducido($_POST['descripcion_servicio'])) > 255) {?>
                                                    <div class="invalid-feedback" style="display: flex;">El formato del campo descripción debe contener como máximo 255 letras.</div>
                                            <?php $editar_servicio_form = 1;}
                                            }?>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="editar_servicio_enviar" class="btn btn-success">Guardar</button>
                            </form>

                            <?php

                            if (isset($_POST['editar_servicio_enviar']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $editar_servicio_form == 0) {
                                $id_servicio = $_POST['id_servicio'];
                                $nombre_servicio = ajustar_texto_introducido($_POST['nombre_servicio']);
                                $categoria_servicios = $_POST['categoria_servicios'];
                                $duracion_servicio = ajustar_texto_introducido($_POST['duracion_servicio']);
                                $precio_servicio = ajustar_texto_introducido($_POST['precio_servicio']);
                                $descripcion_servicio = ajustar_texto_introducido($_POST['descripcion_servicio']);

                                try {
                                    $stmt = $con->prepare("update services set nombre = ?, descripcion = ?, precio = ?, duracion = ?, id_categoria = ? where id = ? ");
                                    $stmt->execute(array($nombre_servicio, $descripcion_servicio, $precio_servicio, $duracion_servicio, $categoria_servicios, $id_servicio));?>
                                    
                                    <script type="text/javascript">swal("Servicio actualizado", "El servicio ha sido actualizado exitosamente en la base de datos de la peluqueria dacor", "success").then((value) => {
                                            window.location.replace("services.php");
                                        });
                                    </script>
                            <?php

                                } catch (Exception $e) {
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
                    header('Location: services.php');
                    exit();
                }
            } else {
                header('Location: services.php');
                exit();
            }
        }?>
    </div>
<?php
        include 'Includes/templates/footer.php';
    } else {
        header('Location: login.php');
        exit();
    }

?>