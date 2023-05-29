<?php
    session_start();

    include 'connect.php';
    include 'Includes/functions/functions.php';
    include 'Includes/templates/header.php';

    if (isset($_SESSION['username_hairdressing_Ze422aVVwd1']) && isset($_SESSION['password_hairdressing_Ze422aVVwd1'])) {
?>
    <div class="container-fluid">
        <?php
            $stmt = $con->prepare("SELECT * FROM services_category");
            $stmt->execute();
            $categorias = $stmt->fetchAll();
        ?>
        <div class="card border-info mb-4">
            <div class="card-header bg-info"><h2 class="text-warning text-center">Categorías de Servicio</h2></div>
            
            <div class="card-body">
                <button class="btn btn-info btn-sm" style="margin-bottom: 10px;" type="button" data-toggle="modal" data-target="#agregar_nueva_categoria" data-placement="top">
                <i class="fas fa-wrench"></i>Añadir Categoría</button>

                <div class="modal fade" id="agregar_nueva_categoria" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-center text-warning">
                                <h5 class="modal-title-xl">Añadir Nueva Categoría</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombre_categoria">Nombre de Categoría</label>
                                    <input type="text" id="input_nombre_categoria" class="form-control" placeholder="Nombre de Categoría" name="nombre_categoria">
                                    <div class="invalid-feedback" id="nombre_categoria_necesario" style="display: none;">El campo: (nombre) de la categoría es necesario</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-success" id="btn_agregar_categoria">Añadir Categoría</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="tablabootstrap5" class="table table-hover ui celled table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Gestionar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($categorias as $categoria) {
                                    echo "<tr>";

                                    echo "<td style='width:33%;'>";
                                    echo $categoria['id_categoria'];
                                    echo "</td>";

                                    echo "<td style='width:33%;'>";
                                    echo $categoria['nombre_categoria'];
                                    echo "</td>";

                                    echo "<td>";
                                    if (strtolower($categoria["nombre_categoria"]) != "sincategorizar") {
                                        $datos_eliminar = "delete_" . $categoria["id_categoria"];
                                        $datos_editar = "edit_" . $categoria["id_categoria"];
                            ?>
                                    <ul>
                                        <li class="list-inline-item" data-toggle="tooltip" title="Editar">
                                            <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#<?= $datos_editar; ?>" data-placement="top"><i class="fas fa-user-edit text-primary"></i></button>

                                            <div class="modal fade" id="<?= $datos_editar; ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $datos_editar; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Editar Categoría</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="nombre_categoria">Nombre</label>
                                                                <input type="text" class="form-control" id="<?= "input_nombre_categoria_" . $categoria["id_categoria"]; ?>" value="<?= $categoria["nombre_categoria"]; ?>">
                                                                <div class="invalid-feedback" id="<?= "entrada_incorrecta_" . $categoria["id_categoria"]; ?>">El campo: (nombre) de la categoría es necesario</div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <button type="button" data-id="<?= $categoria['id_categoria']; ?>" class="btn btn-success btn_editar_categoria">Guardar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="list-inline-item" data-toggle="tooltip" title="Eliminar">
                                            <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#<?= $datos_eliminar; ?>" data-placement="top"><i class="fas fa-trash-alt text-primary"></i></button>

                                            <div class="modal fade" id="<?= $datos_eliminar; ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $datos_eliminar; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Categoría</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">¿Desea eliminar la categoría: (<?= $categoria['nombre_categoria']; ?>)?</div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <button type="button" data-id="<?= $categoria['id_categoria']; ?>" class="btn btn-danger btn_borrar_categoria">Eliminar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                            <?php
                                }
                                echo "</td>";
                                echo "</tr>";}
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php

    //Include Footer
    include 'Includes/templates/footer.php';
} else {
    header('Location: login.php');
    exit();
}

?>