<?php
    session_start();

    include 'connect.php';
    include 'Includes/functions/functions.php';
    include 'Includes/templates/header.php';

    if (isset($_SESSION['username_hairdressing_Ze422aVVwd1']) && isset($_SESSION['password_hairdressing_Ze422aVVwd1'])) {
?>

    <?php
        $stmt = $con->prepare("SELECT * FROM purchases ");
        $stmt->execute();
        $compras = $stmt->fetchAll();
    ?>
    
    <div class="container-fluid">
        <div class="card border-info">
            <div class="card-header bg-info">
                <h2 class="text-warning text-center">Registro de Compras</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tablabootstrap5" class="table table-striped ui celled table-bordered">
                        <thead>
                            <tr>
                                <th class="text-dark">ID</th>
                                <th class="text-dark">Fecha Compra</th>
                                <th class="text-dark">Cliente</th>
                                <th class="text-dark">Producto</th>
                                <th class="text-dark">Pago Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($compras as $compra) {

                                
                                $stmtClientes = $con->prepare("SELECT * FROM clients where id_cliente = ?");
                                $stmtClientes->execute(array($compra['id_cliente']));
                                $clientes = $stmtClientes->fetchAll();
                            
                                $stmtProductos = $con->prepare("SELECT * FROM products where id = ?");
                                $stmtProductos->execute(array($compra['id_producto']));
                                $productos = $stmtProductos->fetchAll();
                            
                                echo "<tr>";

                                echo "<td>";
                                echo $compra['id'];
                                echo "</td>";

                                echo "<td>";
                                echo $compra['fecha'];
                                echo "</td>";

                                

                                foreach ($clientes as $cliente) {
                                    echo "<td>";
                                    echo $cliente['nombre']." ".$cliente['apellido'];
                                    echo "</td>";
                                }
                                

                                foreach ($productos as $producto) {
                                    echo "<td>";
                                    echo $producto['nombre'];
                                    echo "</td>";
                                }

                                    echo "<td>";
                                    echo $compra['pago']." €";
                                    echo "</td>";

                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php
    include 'Includes/templates/footer.php';
} else {
    header('Location: login.php');
    exit();
}

?>