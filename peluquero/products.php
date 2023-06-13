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
                $stmt = $con->prepare("SELECT * FROM products");
                $stmt->execute();
                $productos = $stmt->fetchAll();
        ?>
        <div class="card border-info">
            <div class="card-header bg-info">
                <h2 class="text-warning text-center">Productos</h2>
            </div>
                <div class="card-body">
                    <a class="btn btn-info btn-sm mb-3" href="products.php?accion=Agregar"><i class="fas fa-wrench"></i>Añadir un Producto</a>
                    <div class="table-responsive">
                        <table id="tablabootstrap5" class="table table-hover ui celled table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-dark">Nombre de Producto</th>
                                    <th class="text-dark">Descripcion</th>
                                    <th class="text-dark">Precio</th>
                                    <th class="text-dark">Stock</th>
                                    <th class="text-dark">Gestionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($productos as $producto) {
                                    echo "<tr>";

                                    echo "<td>";
                                    echo $producto['nombre'];
                                    echo "</td>";


                                    echo "<td style = 'width:50%'>";
                                    echo $producto['descripcion'];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $producto['precio']." €";
                                    echo "</td>";

                                    echo "<td>";
                                    echo $producto['stock']." unidades";
                                    echo "</td>";

                                    echo "<td>";
                                    $datos_borrar = "borrar_" . $producto["id"];
                                ?>
                                    <ul class="m-0 list-inline">
                                        <li class="list-inline-item" data-toggle="tooltip" title="Editar Producto">
                                            <button class="btn btn-success btn-sm">
                                                <a href="products.php?accion=Editar&id_producto=<?= $producto['id'];?>"><i class="fas fa-user-edit"></i></a>
                                            </button>
                                        </li>

                                        <li class="list-inline-item" data-toggle="tooltip" title="Eliminar Producto">
                                            <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#<?= $datos_borrar; ?>" data-placement="top">
                                                <i class="fas fa-trash-alt text-primary"></i>
                                            </button>

                                            <div class="modal fade text-center" tabindex="-1" role="dialog" id="<?= $datos_borrar; ?>" aria-labelledby="<?php echo $datos_borrar; ?>" aria-hidden="true">
                                                <div class="modal-dialog " role="document">
                                                    <div class="modal-content text-center">
                                                        <div class="modal-header bg-info ">
                                                            <h5 class="modal-title text-warning" id="exampleModalLabel">Eliminar Producto</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿Estas seguro de que deseas eliminar el producto: (<?= $producto['nombre']; ?>) de la base de datos de peluquería dacor?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <button type="button" data-id="<?= $producto['id']; ?>" class="btn btn-danger borrar_producto_btn">Eliminar</button>
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
                    <h5 class="m-0 text-warning text-center">Añadir Producto</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="products.php?accion=Agregar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_producto">Nombre Producto</label>
                                    <input type="text" class="form-control" value="<?= (isset($_POST['nombre_producto'])) ? htmlspecialchars($_POST['nombre_producto']) : '' ?>"  name="nombre_producto" placeholder="Nombre Producto">
                                    <?php
                                        $agregar_producto_form = 0;
                                        if (isset($_POST['agregar_producto']))
                                        {
                                            if (empty(ajustar_texto_introducido($_POST['nombre_producto'])))
                                            {?>
                                                <div class="invalid-feedback" style="display: flex;">El nombre del producto es necesario</div>
                                                <?php
                                                $agregar_producto_form = 1;
                                            }
                                        }?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion_producto">Descripcion Producto</label>
                                    <input type="text" class="form-control" value="<?= (isset($_POST['descripcion_producto'])) ? htmlspecialchars($_POST['descripcion_producto']) : '' ?>"  name="descripcion_producto" placeholder="Descripcion Producto">
                                    <?php
                                        $agregar_producto_form = 0;
                                        if (isset($_POST['agregar_producto']))
                                        {
                                            if (empty(ajustar_texto_introducido($_POST['descripcion_producto'])))
                                            {?>
                                                <div class="invalid-feedback" style="display: flex;">La descripcion del producto es necesaria</div>
                                                <?php
                                                $agregar_producto_form = 1;
                                            }
                                        }?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="precio_producto">Precio del Producto</label>

                                    <input type="text" class="form-control" name="precio_producto" value="<?= (isset($_POST['precio_producto'])) ? htmlspecialchars($_POST['precio_producto']) : '' ?>" placeholder="Precio del Producto">
                                    <?php
                                        if (isset($_POST['agregar_producto'])) {
                                            if (empty(ajustar_texto_introducido($_POST['precio_producto']))) {?>
                                                <div class="invalid-feedback" style="display: flex;">El precio del producto es necesario</div>
                                            <?php $agregar_producto_form = 1;
                                            } elseif (!is_numeric(ajustar_texto_introducido($_POST['precio_producto']))) {?>
                                                <div class="invalid-feedback" style="display: flex;">El formato del campo precio es incorrecto</div>
                                        <?php $agregar_producto_form = 1;}
                                    }?>
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stock_producto">Stock del Producto</label>

                                        <input type="text" class="form-control" name="stock_producto" value="<?= (isset($_POST['stock_producto'])) ? htmlspecialchars($_POST['stock_producto']) : '' ?>" placeholder="Stock del Producto">
                                        <?php
                                            if (isset($_POST['agregar_producto'])) {
                                                if (empty(ajustar_texto_introducido($_POST['stock_producto'])) && $_POST['stock_producto'] != 0) {?>
                                                    <div class="invalid-feedback" style="display: flex;">El stock del producto es necesario</div>
                                                <?php $agregar_producto_form = 1;
                                                } elseif (!is_numeric(ajustar_texto_introducido($_POST['stock_producto']))) {?>
                                                    <div class="invalid-feedback" style="display: flex;">El formato del campo stock es incorrecto</div>
                                            <?php $agregar_producto_form = 1;}
                                        }?>
                                    </div>
                                </div>
                        </div>
                        <button type="submit" name="agregar_producto" class="btn btn-success">Añadir Producto</button>
                    </form>

                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar_producto']) && $agregar_producto_form == 0) {
                            $nombre_producto = ajustar_texto_introducido($_POST['nombre_producto']);
                            $descripcion_producto = ajustar_texto_introducido($_POST['descripcion_producto']);
                            $precio_producto = ajustar_texto_introducido($_POST['precio_producto']);
                            $stock_producto = ajustar_texto_introducido($_POST['stock_producto']);
                            

                            try {
                                $con->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
                                $stmt = $con->prepare("insert into products(precio,nombre,descripcion,stock) values(?,?,?,?)");
                                $stmt->execute(array($precio_producto,$nombre_producto, $descripcion_producto,$stock_producto));?>
                            <script type="text/javascript">swal("Nuevo producto agregado", "Nuevo producto agregado exitosamente a la base de datos de la peluqueria dacor", "success").then((value) => {
                                    window.location.replace("products.php");});
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
            $id_producto = (isset($_GET['id_producto']) && is_numeric($_GET['id_producto'])) ? intval($_GET['id_producto']) : 0;

            if ($id_producto) {
                $stmt = $con->prepare("Select * from products where id = ?");
                $stmt->execute(array($id_producto));
                $producto = $stmt->fetch();
                $contar = $stmt->rowCount();
                if ($contar > 0) {
            ?>
                    <div class="card card border-info">
                    <div class="card-header bg-info"><h2 class="text-warning text-center">Editar Productos</h2></div>
                        <div class="card-body">
                            <form method="POST" action="products.php?accion=Editar&id_producto=<?= $id_producto; ?>">

                            <input name="id_producto" value="<?= $producto['id']; ?>" type="hidden">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre_producto">Nombre del Producto</label>
                                            <input  type="text" class="form-control" value="<?= $producto['nombre'] ?>" name="nombre_producto" placeholder="Nombre de Producto">
                                            <?php
                                                $editar_producto_form = 0;
                                                if (isset($_POST['editar_producto_enviar'])) 
                                                {
                                                    if (empty(ajustar_texto_introducido($_POST['nombre_producto']))) 
                                                    {?>
                                                    <div class="invalid-feedback" style="display: flex;">El campo nombre del producto es necesario.</div>
                                                    <?php 
                                                    $editar_producto_form = 1;
                                                }
                                            }?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="precio_producto">Precio del Producto</label>
                                            <input  type="text" class="form-control" value="<?= $producto['precio'] ?>" name="precio_producto" placeholder="Precio de Producto">
                                            <?php
                                                $editar_producto_form = 0;
                                                if (isset($_POST['editar_producto_enviar'])) 
                                                {
                                                    if (empty(ajustar_texto_introducido($_POST['precio_producto']))) 
                                                    {?>
                                                    <div class="invalid-feedback" style="display: flex;">El campo precio del producto es necesario.</div>
                                                    <?php 
                                                    $editar_producto_form = 1;
                                                }
                                            }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="descripcion_producto">Descripcion del Producto</label>
                                            <textarea class="form-control" name="descripcion_producto" style="resize: none;"><?php echo $producto['descripcion']; ?></textarea>
                                            <?php
                                            if (isset($_POST['editar_producto_enviar'])) {
                                                if (empty(ajustar_texto_introducido($_POST['descripcion_producto']))) {?>
                                                    <div class="invalid-feedback" style="display: flex;">La descripcion del producto es necesario</div>
                                                <?php $editar_producto_form = 1;
                                                } elseif (strlen(ajustar_texto_introducido($_POST['descripcion_producto'])) > 255) {?>
                                                    <div class="invalid-feedback" style="display: flex;">El formato del campo descripcion debe contener como máximo 255 letras.</div>
                                            <?php $editar_producto_form = 1;}
                                            }?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stock_producto">Stock del Producto</label>
                                            <textarea class="form-control" name="stock_producto" style="resize: none;"><?php echo $producto['stock']; ?></textarea>
                                            <?php
                                            if (isset($_POST['editar_producto_enviar'])) {
                                                if (empty(ajustar_texto_introducido($_POST['stock_producto'])) && $_POST['stock_producto'] != 0) {?>
                                                    <div class="invalid-feedback" style="display: flex;">El Stock del producto es necesario</div>
                                                <?php $editar_producto_form = 1;
                                                } elseif (strlen(ajustar_texto_introducido($_POST['stock_producto'])) > 255) {?>
                                                    <div class="invalid-feedback" style="display: flex;">El formato del campo stock debe contener como máximo 255 letras.</div>
                                            <?php $editar_producto_form = 1;}
                                            }?>
                                        </div>
                                    </div>
                                    
                                </div>

                                <button type="submit" name="editar_producto_enviar" class="btn btn-success">Guardar</button>
                            </form>

                            <?php

                            if (isset($_POST['editar_producto_enviar']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $editar_producto_form == 0) {
                                $id_producto = $_POST['id_producto'];
                                $nombre_producto = ajustar_texto_introducido($_POST['nombre_producto']);
                                $precio_producto = ajustar_texto_introducido($_POST['precio_producto']);
                                $descripcion_producto = ajustar_texto_introducido($_POST['descripcion_producto']);
                                $stock_producto = ajustar_texto_introducido($_POST['stock_producto']);

                                try {
                                    $con->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
                                    $stmt = $con->prepare("update products set nombre = ?, descripcion = ?, precio = ?, stock = ? where id = ? ");
                                    $stmt->execute(array($nombre_producto, $descripcion_producto, $precio_producto, $stock_producto, $id_producto));?>
                                    
                                    <script type="text/javascript">swal("Producto actualizado", "El producto ha sido actualizado exitosamente en la base de datos de la peluqueria dacor", "success").then((value) => {
                                            window.location.replace("products.php");
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
                    header('Location: products.php');
                    exit();
                }
            } else {
                header('Location: products.php');
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