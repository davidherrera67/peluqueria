<?php
session_start();

    include 'connect.php';
    include 'Includes/functions/functions.php';
    include 'Includes/templates/header.php';

    if (isset($_SESSION['username_hairdressing_Ze422aVVwd1']) && isset($_SESSION['password_hairdressing_Ze422aVVwd1'])) {
?>

    <?php
        $stmt = $con->prepare("SELECT * FROM clients");
        $stmt->execute();
        $clientes = $stmt->fetchAll();
    ?>
    
    <div class="container-fluid">
        <div class="card border-info">
            <div class="card-header bg-info">
                <h2 class="text-warning text-center">Clientes</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tablabootstrap5" class="table table-striped ui celled table-bordered">
                        <thead>
                            <tr>
                                <th class="text-dark">ID</th>
                                <th class="text-dark">Nombre</th>
                                <th class="text-dark">Apellido</th>
                                <th class="text-dark">Teléfono</th>
                                <th class="text-dark">Correo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($clientes as $cliente) {
                                echo "<tr>";

                                echo "<td>";
                                echo $cliente['id_cliente'];
                                echo "</td>";

                                echo "<td>";
                                echo $cliente['nombre'];
                                echo "</td>";

                                echo "<td>";
                                echo $cliente['apellido'];
                                echo "</td>";

                                echo "<td>";
                                echo $cliente['telefono'];
                                echo "</td>";

                                echo "<td>";
                                echo $cliente['cliente_correo'];
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