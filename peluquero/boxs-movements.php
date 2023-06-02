<?php
session_start();

    include 'connect.php';
    include 'Includes/functions/functions.php';
    include 'Includes/templates/header.php';

    if (isset($_SESSION['username_hairdressing_Ze422aVVwd1']) && isset($_SESSION['password_hairdressing_Ze422aVVwd1'])) {
?>

        
    <?php

        if (isset($_GET['id'])) {

            /* AÑADIR MOVIMIENTOS A CAJA */

            $dia_hoy = date('Y-m-d');
            /* SELECT * FROM appointments WHERE endeudar = 0 && inicio LIKE "2023-06-01%"; dia de inicio de cita */
            $stmtCitas = $con->prepare("SELECT * FROM appointments WHERE endeudar = 0 && registrada = 0 && inicio LIKE ?");
            $stmtCitas->execute(array("$dia_hoy%"));
            $citas = $stmtCitas->fetchAll();
            print_r($citas);
            $totalPrecio = 0;

            foreach ($citas as $cita) {
                if ($cita['registrada'] == 0){
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
                                $stmt_nuevo_movimiento_caja->execute(array($servicio['precio'],0,$servicio['nombre'].": ".$servicio['descripcion'],$_GET['id']));
                                
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

            echo $totalPrecio;


            $stmt = $con->prepare("SELECT * FROM boxs_movements WHERE id_caja=?");
            $stmt->execute(array($_GET['id']));
            $movimientos_cajas = $stmt->fetchAll();

            /*suma*/
            $stmtSuma = $con->prepare("SELECT * FROM boxs_movements WHERE id_caja=? AND tipo=0");
            $stmtSuma->execute(array($_GET['id']));
            $movimientos_cajas_suma = $stmtSuma->fetchAll();

            $cantidadsuma = 0;
            foreach ($movimientos_cajas_suma as $cantidad_a_sumar) {
                $cantidadsuma = $cantidadsuma + $cantidad_a_sumar['cantidad'];
            }
            

            /*resta*/
            $stmtResta = $con->prepare("SELECT * FROM boxs_movements WHERE id_caja=? AND tipo=1");
            $stmtResta->execute(array($_GET['id']));
            $movimientos_cajas_resta = $stmtResta->fetchAll();

            $cantidadresta = 0;
            foreach ($movimientos_cajas_resta as $cantidad_a_restar) {
                $cantidadresta = $cantidadresta + $cantidad_a_restar['cantidad'];
            }
            

            $cantidadFinal = $cantidadsuma - $cantidadresta;
            

            $_SESSION['caja'] = $_GET['id'];
            

            if(!isset($_SESSION['cantidadFinal'])){
                $_SESSION['cantidadFinal'] = 0;
            }else{
                $_SESSION['cantidadFinal'] = $cantidadFinal;
            }

            


            /*de appointments saco el id_cita , de services_reserved saco el id_servicio usando el id_cita de antes, de servicios saco el precio con el id_serivico de antes */
            /* recuperar las citas de ese dia y a esas citas cogerle el campo endeudar si es 0(no) de esa deuda el precio del servicio lo cojo( consulta con dos tablas mirar) */
            /* una vez tengo el precio creo un box_movement con ese precio poniendoselo ademas de el tipo 0 = entrada , descripcion 
            y caja asociada (que lo puedo sacar haciendo un select y sacando cual es la unica caja con fecha null o con un if o con ambos)*/
            
        } else {
            header('Location: boxs.php');
        }
 
    ?>
    
    <div class="container-fluid">
        <div class="card border-info">
            <div class="card-header bg-info">
                <h2 class="text-warning text-center">Movimientos caja</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tablabootstrap5" class="table table-striped ui celled table-bordered">
                        <thead>
                            <tr>
                                <th class="text-dark">ID</th>
                                <th class="text-dark">Cantidad</th>
                                <th class="text-dark">Tipo de arqueo</th>
                                <th class="text-dark">Descripción</th>
                                <th class="text-dark">Caja</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($movimientos_cajas as $movimientos_caja) {

                                echo "<tr>";

                                echo "<td>";
                                echo $movimientos_caja['id_movimiento'];
                                echo "</td>";

                                echo "<td>";
                                if($movimientos_caja['tipo'] == 0)
                                echo "+".$movimientos_caja['cantidad']." €";
                                else
                                echo "-".$movimientos_caja['cantidad']." €";
                                echo "</td>";

                                echo "<td>";
                                if($movimientos_caja['tipo'] == 0)
                                echo "Entrada";
                                else 
                                echo "Salida";
                                echo "</td>";

                                echo "<td>";
                                echo $movimientos_caja['descripcion'];
                                echo "</td>";

                                echo "<td>";
                                echo $movimientos_caja['id_caja'];
                                echo "</td>";
                                echo "</tr>";
                               
                            }
                            ?>
                        </tbody>
                    </table>
                        <ul class="mt-2 list-inline" style="float:right;">
                            <li class="list-inline-item" data-toggle="tooltip" title="Volve a las Cajas">
                                <button class="btn btn-success btn-sm" >
                                    <a href="boxs.php" >Volver a Cajas <i class="fas fa-sign-out-alt"></i></a>
                                </button>
                            </li>
                        </ul>
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