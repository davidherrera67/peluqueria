<?php

session_start();

include 'connect.php';
include 'Includes/functions/functions.php';
include 'Includes/templates/header.php';

if (isset($_SESSION['username_hairdressing_Ze422aVVwd1']) && isset($_SESSION['password_hairdressing_Ze422aVVwd1'])) {?>
<?php
    $stmtcajas = $con->prepare("SELECT * FROM boxs");
    $stmtcajas->execute();
    $cajas_abiertas = $stmtcajas->fetchAll();

    foreach ($cajas_abiertas as $caja_abierta) {
        /* AÑADIR MOVIMIENTOS A CAJA */
        if (isset($caja_abierta['id']) && !isset($caja_abierta['fecha_cierre'])) {
            $dia_hoy = date('Y-m-d');
            /* SELECT * FROM appointments WHERE endeudar = 0 && inicio LIKE "2023-06-01%"; dia de inicio de cita */
            $stmtCitas = $con->prepare("SELECT * FROM appointments WHERE endeudar = 0 && registrada = 0 && inicio LIKE ?");
            $stmtCitas->execute(array("$dia_hoy%"));
            $citas = $stmtCitas->fetchAll();

            $totalPrecio = 0;

            foreach ($citas as $cita) {
                if ($cita['registrada'] == 0) {
                    $id_cita = $cita['id_cita'];

                    $stmtServiciosReservados = $con->prepare("SELECT * FROM services_reserved WHERE id_cita=?");
                    $stmtServiciosReservados->execute(array($id_cita));
                    $servicios_reservados = $stmtServiciosReservados->fetchAll();

                    foreach ($servicios_reservados as $servicio_reservado) {
                        $id_servicio = $servicio_reservado['id_servicio'];

                        $stmtServicios = $con->prepare("SELECT * FROM services WHERE id=?");
                        $stmtServicios->execute(array($id_servicio));
                        $servicios = $stmtServicios->fetchAll();

                        foreach ($servicios as $servicio) {
                            $totalPrecio = $totalPrecio + $servicio['precio'];

                            $stmtServiciosReservadosVerificar = $con->prepare("SELECT * FROM services_reserved WHERE id_cita=?");
                            $stmtServiciosReservadosVerificar->execute(array($id_cita));

                            $con->beginTransaction();
                            try {
                                /* añadir un campo boolean "registrada" a las citas y solo si es 0 = "no registrada" crear un nuevo movimiento . el select solo de las citas que tienen el registrada en 0.*/
                                /*nuevo movimiento de caja*/


                                $stmt_nuevo_movimiento_caja = $con->prepare("insert into boxs_movements(cantidad,tipo,descripcion,id_caja) values(?,?,?,?)");
                                $stmt_nuevo_movimiento_caja->execute(array($servicio['precio'], 0, $servicio['nombre'] . ": " . $servicio['descripcion'], $caja_abierta['id']));


                                $stmt_cita_registrada = $con->prepare("UPDATE appointments set registrada = 1 where id_cita = ?");
                                $stmt_cita_registrada->execute(array($id_cita));

                                $con->commit();


                            } catch (Exception $e) {
                                $con->rollBack();

                                echo "<div class = 'alert alert-danger text-dark'>";
                                echo $e->getMessage();
                                echo "</div>";
                            }
                        }

                    }
                }
            }
        }
    } ?>

    <div class="container-fluid">
        <div class="card border-info">
            <div class="card-header bg-info">
                <h2 class="text-warning text-center">Caja</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tablabootstrap5" class="table table-striped ui celled table-bordered">
                        <thead>
                            <tr>
                                <th class="text-dark">ID</th>
                                <th class="text-dark">Fecha Apertura</th>
                                <th class="text-dark">Fecha Cierre</th>
                                <th class="text-dark">Saldo Inicial</th>
                                <th class="text-dark">Saldo Final</th>
                                <th class="text-dark">Movimientos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $con->prepare("SELECT * FROM boxs");
                            $stmt->execute();
                            $cajas = $stmt->fetchAll();

                            foreach ($cajas as $caja) {
                                /* añadir un boton y si se le da al boton que cierre la caja y haga esto */
                                if (isset($caja['id']) && !isset($caja['fecha_cierre'])) {
                                    /*suma*/
                                    $stmtSuma = $con->prepare("SELECT * FROM boxs_movements WHERE id_caja=? AND tipo=0");
                                    $stmtSuma->execute(array($caja['id']));
                                    $movimientos_cajas_suma = $stmtSuma->fetchAll();

                                    $cantidadsuma = 0;
                                    foreach ($movimientos_cajas_suma as $cantidad_a_sumar) {
                                        $cantidadsuma = $cantidadsuma + $cantidad_a_sumar['cantidad'];
                                    }


                                    /*resta*/
                                    $stmtResta = $con->prepare("SELECT * FROM boxs_movements WHERE id_caja=? AND tipo=1");
                                    $stmtResta->execute(array($caja['id']));
                                    $movimientos_cajas_resta = $stmtResta->fetchAll();

                                    $cantidadresta = 0;
                                    foreach ($movimientos_cajas_resta as $cantidad_a_restar) {
                                        $cantidadresta = $cantidadresta + $cantidad_a_restar['cantidad'];
                                    }


                                    $cantidadFinal = $cantidadsuma - $cantidadresta;


                                    $_SESSION['caja'] = $caja['id'];


                                    if (!isset($_SESSION['cantidadFinal'])) {
                                        $_SESSION['cantidadFinal'] = 0;
                                    } else {
                                        $_SESSION['cantidadFinal'] = $cantidadFinal;
                                    }

                                    $caja['saldo_final'] = $caja['saldo_inicial'] + $cantidadFinal;
                                    $_SESSION['saldoFinal'] = $caja['saldo_final'];


                                }

                                echo "<tr>";

                                echo "<td>";
                                echo $caja['id'];
                                echo "</td>";

                                echo "<td>";
                                echo $caja['fecha_apertura'];
                                echo "</td>";

                                echo "<td>";
                                echo $caja['fecha_cierre'];
                                echo "</td>";

                                echo "<td>";
                                echo $caja['saldo_inicial'] . " €";
                                echo "</td>";

                                echo "<td>";
                                echo $caja['saldo_final'] . " €";
                                echo "</td>";

                                echo "<td>";
                                $datos_caja = "cerrar_caja_" . $caja["id"];

                                ?>

                                <ul class="m-0 list-inline">
                                    <li class="list-inline-item" data-toggle="tooltip" title="Ver Movimientos Caja">
                                        <button class="btn btn-success btn-sm">
                                            <a href="boxs-movements.php?id=<?= $caja['id']; ?>"><i
                                                    class="fas fa-user-edit"></i></a>
                                        </button>
                                    </li>
                                    <?php
                                    if (isset($caja['fecha_cierre'])) {
                                        echo "Cerrada";
                                    } else {
                                        ?>
                                        <li class="list-inline-item text-dark" data-toggle="tooltip" title="¿Desea cerrar la caja?">
                                            <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                data-target="#<?= $datos_caja; ?>" data-placement="top">
                                                <i class="far fa-calendar-times text-primary"></i>
                                            </button>

                                            <div class="modal fade" id="<?= $datos_caja; ?>" tabindex="-1" role="dialog"
                                                aria-labelledby="<?= $datos_caja; ?>" aria-hidden="true">
                                                <div class="modal-dialog " role="document">
                                                    <div class="modal-content text-center text-dark">
                                                        <div class="modal-header bg-info text-center">
                                                            <h5 class="modal-title text-warning text-center">Cancelación de cita
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>¿Seguro que desea cerrar la caja con este saldo
                                                                    final?</label>
                                                                <textarea readonly class="form-control" id=<?= "cerrar_" . $caja['id'] ?>><?= $caja['saldo_final']; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancelar</button>
                                                            <button name="caja" type="button" data-id="<?= $caja['id']; ?>"
                                                                value="<?= $caja['id']; ?>"
                                                                class="btn btn-danger btn_cerrar_caja">Aceptar</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <?php
                                    }
                            }

                            echo "</td>";

                            echo "</tr>";
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