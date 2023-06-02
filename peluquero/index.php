<?php

session_start();

if (isset($_SESSION['username_hairdressing_Ze422aVVwd1']) && isset($_SESSION['password_hairdressing_Ze422aVVwd1'])) {
   
    include 'connect.php';
    include 'Includes/functions/functions.php';
    include 'Includes/templates/header.php';

    echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
?>



<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Nº Total de Citas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php 
                                    $stmt = $con->prepare("Select * from appointments");
                                    $stmt->execute();
                                    $totalCitas =  $stmt->rowCount();
                                ?>
                                <?= $totalCitas; ?>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-primary"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Nº Total de Servicios</div>
                            <div class="h5 mb-0 font-weight-bold ">
                                <?php 
                                    $stmt = $con->prepare("Select * from services");
                                    $stmt->execute();
                                    $totalServicios =  $stmt->rowCount();
                                ?>
                                <?= $totalServicios; ?>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fa-solid fa-2x fa-hand-scissors" style="color: #08d415;"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nº Total de Clientes</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold">
                                        <?php 
                                            $stmt = $con->prepare("Select * from clients");
                                            $stmt->execute();
                                            $totalClientes =  $stmt->rowCount();
                                        ?>
                                        <?= $totalClientes; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fa-solid fa-users fa-2x text-info"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Nº Total de Peluqueros</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php 
                                    $stmt = $con->prepare("Select * from hairdressers");
                                    $stmt->execute();
                                    $totalPeluqueros =  $stmt->rowCount();
                                ?>
                                <?= $totalPeluqueros; ?>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fa-solid fa-user-tie fa-2x text-warning"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header tab bg-success">
            <h1 class="text-center text-primary">
                Citas
            </h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tablabootstrap5" class="table table-bordered table-hover ui celled table-bordered tabcontent"  width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                Hora Inicio Cita
                            </th>
                            <th>
                                Hora Fin Cita
                            </th>
                            <th>
                                Servicios Reservados
                            </th>
                            <th>
                                Cliente
                            </th>
                            <th>
                                Peluquero
                            </th>
                            <th>
                                Endeudada
                            </th>
                            <th>
                                Cancelada
                            </th>
                            <th>
                                Gestionar Cita
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $stmt = $con->prepare("SELECT * FROM appointments a , clients c where inicio >= ? and a.id_cliente = c.id_cliente and a.cancelada = 0 order by inicio;");
                            $stmt->execute(array(date('Y-m-d H:i:s')));
                            $citas = $stmt->fetchAll();
                            $cuenta = $stmt->rowCount();

                            if ($cuenta == 0) {
                                echo "<tr>";

                                echo "<td  class='text-dark' style='text-align:center;'>";
                                echo "Aún no hay citas registradas";
                                echo "</td>";
                                echo "<td  class='text-dark' style='text-align:center;'>";
                                echo "Aún no hay citas registradas";
                                echo "</td>";
                                echo "<td  class='text-dark' style='text-align:center;'>";
                                echo "Aún no hay citas registradas";
                                echo "</td>";
                                echo "<td  class='text-dark' style='text-align:center;'>";
                                echo "Aún no hay citas registradas";
                                echo "</td>";
                                echo "<td  class='text-dark' style='text-align:center;'>";
                                echo "Aún no hay citas registradas";
                                echo "</td>";
                                echo "<td  class='text-dark' style='text-align:center;'>";
                                echo "Aún no hay citas registradas";
                                echo "</td>";
                                echo "<td  class='text-dark' style='text-align:center;'>";
                                echo "Aún no hay citas registradas";
                                echo "</td>";
                                echo "<td  class='text-dark' style='text-align:center;'>";
                                echo "Aún no hay citas registradas";
                                echo "</td>";
                                
                                

                                echo "</tr>";
                            } else {
                                foreach ($citas as $cita) {
                                    echo "<tr>";

                                    echo "<td>";
                                    echo $cita['inicio'];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $cita['fin'];
                                    echo "</td>";

                                    echo "<td>";
                                    $stmtServicios = $con->prepare("SELECT nombre from services s, services_reserved sr where s.id = sr.id_servicio and id_cita = ?");
                                    $stmtServicios->execute(array($cita['id_cita']));
                                    $citaServicios = $stmtServicios->fetchAll();

                                    $contador = 0;
                                    foreach ($citaServicios as $citaServicio) {
                                        $contador++;
                                        echo "$contador. " . $citaServicio['nombre'];
                                        if (next($citaServicios) == true)
                                          echo " <br> ";
                                    }
                                    echo "</td>";

                                    echo "<td>";
                                    echo $cita['nombre']." ".$cita['apellido'];
                                    echo "</td>";

                                    echo "<td>";
                                    $stmtPeluqueros = $con->prepare("SELECT nombre,apellido from hairdressers h, appointments a where h.id = a.id_peluquero and a.id_cita = ?");                         
                                    $stmtPeluqueros->execute(array($cita['id_cita']));
                                    $citasPeluqueros = $stmtPeluqueros->fetchAll();
                                    foreach ($citasPeluqueros as $citasPeluquero) {
                                        echo $citasPeluquero['nombre'] . " " . $citasPeluquero['apellido'];
                                    }
                                    echo "</td>";

                                    echo "<td>";
                                    if($cita['endeudar'] == 0){
                                        echo "No";
                                    }
                                    else echo "Sí";
                                    echo "</td>";

                                    echo "<td>";
                                    if($cita['cancelada'] == 0){
                                        echo "No";
                                    }
                                    else echo "Sí";
                                    echo "</td>";

                                    

                                    echo "<td>";
                                    $datos_cancelados = "cancelar_cita_" . $cita["id_cita"];
                                    $datos_endeudados = "endeudar_cita_" . $cita["id_cita"];
                            ?>
                        <ul class="list-inline m-0">
                            <?php
                                if($cita['endeudar'] == 1){
                                    echo "Endeudada";
                                }
                                else {
                            ?>
                            <li class="list-inline-item text-dark" data-toggle="tooltip" title="¿Desea endeudar la cita?">
                                <button class="btn btn-success btn-sm" type="button" data-toggle="modal"
                                    data-target="#<?= $datos_endeudados; ?>" data-placement="top">
                                    <i class="fas fa-money-bill-wave text-primary"></i>
                                </button>

                                <div class="modal fade" id="<?= $datos_endeudados; ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="<?= $datos_endeudados; ?>" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content text-center text-dark">
                                            <div class="modal-header bg-info text-center">
                                                <h5 class="modal-title text-warning text-center">Endeudar cita</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>¿Por qué quiere endeudar la cita?</label>
                                                    <textarea class="form-control" id=<?= "motivo_endeudacion_cita_" . $cita['id_cita'] ?>></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="button" data-id="<?= $cita['id_cita']; ?>" class="btn btn-danger btn_endeudar_cita">Aceptar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            
                            <li class="list-inline-item text-dark" data-toggle="tooltip" title="¿Desea cancelar la cita?">
                                <button class="btn btn-success btn-sm" type="button" data-toggle="modal"
                                    data-target="#<?= $datos_cancelados; ?>" data-placement="top">
                                    <i class="far fa-calendar-times text-primary"></i>
                                </button>

                                <div class="modal fade" id="<?= $datos_cancelados; ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="<?= $datos_cancelados; ?>" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content text-center text-dark">
                                            <div class="modal-header bg-info text-center">
                                                <h5 class="modal-title text-warning text-center">Cancelación de cita</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>¿Por qué quiere cancelar la cita?</label>
                                                    <textarea class="form-control" id=<?= "motivo_cancelacion_cita_" . $cita['id_cita'] ?>></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="button" data-id="<?= $cita['id_cita']; ?>" class="btn btn-danger btn_cancelar_cita">Aceptar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <?php
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }?>

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