<?php
	include "connect.php";
	if(isset($_POST['peluquero_seleccionado']) && isset($_POST['servicios_seleccionados']))
	{
?>

<link rel="stylesheet" href="Design/css/calendar-style.css">

<div class="horas_de_reserva_disponibles_tabla" style="min-width: 700px; ">
    <div class="dias_de_citas">
        <?php
            $fecha_cita = date('Y-m-d');
            for($dia = 0; $dia < 14; $dia++)
            {
                
                $fecha_cita = date('Y-m-d', strtotime($fecha_cita . ' +1 day'));
                echo "<div class = 'dia_cita'>";
                echo date('D', strtotime($fecha_cita));

                echo "<br>";

                echo date('d', strtotime($fecha_cita))." ".date('M', strtotime($fecha_cita));
                echo "</div>";
            } 
        ?>
    </div>


    <div class = 'horas_de_reserva_disponibles'>
        <?php
            $servicios_seleccionados = $_POST['servicios_seleccionados'];
            $peluquero_seleccionado = $_POST['peluquero_seleccionado'];

            $duracion_servicio = 0;
            foreach($servicios_seleccionados as $servicio)
            {
                $stmtServicios = $con->prepare("select duracion from services where id = ?");
                $stmtServicios->execute(array($servicio));
                $servicios=$stmtServicios->fetch();
                $duracion_servicio = $duracion_servicio + $servicios['duracion'];
                
            }


            $duracion_servicio = date('H:i',mktime(0,$duracion_servicio));
            $segundos = strtotime($duracion_servicio)-strtotime("00:00:00");


            $tiempo_apertura = date('H:i',mktime(8,0,0));
            $tiempo_cierre = date('H:i',mktime(21,0,0));

            $inicio = $tiempo_apertura;

            $segundos = strtotime($duracion_servicio)-strtotime("00:00:00");
            $resultado = date("H:i:s",strtotime($inicio)+$segundos);


            $fecha_cita = date('Y-m-d');

            for($i = 0; $i < 14; $i++)
            {
                    echo "<div class='horas_disponibles_de_reserva'>";
                    $fecha_cita = date('Y-m-d', strtotime($fecha_cita . ' +1 day'));
                    $inicio = $tiempo_apertura;
                    $segundos = strtotime($duracion_servicio)-strtotime("00:00:00");
                    $resultado = date("H:i:s",strtotime($inicio) + $segundos);
                    $id_dia = date('w',strtotime($fecha_cita));
                    
                    while($inicio >= $tiempo_apertura && $resultado <= $tiempo_cierre)
                    {
                        
                        $stmt_peluquero = $con->prepare("Select id_peluquero from hairdressers_schedule where id_peluquero = ? and id_dia = ? and ? between desde_hora and hasta_hora and ? between desde_hora and hasta_hora");
                        $stmt_peluquero->execute(array($peluquero_seleccionado,$id_dia,$inicio, $resultado));
                        $stmt_peluquero->fetchAll();

                        if($stmt_peluquero->rowCount() != 0)
                        {
                            $stmt = $con->prepare("Select * from appointments a where date(inicio) = ? and a.id_peluquero = ? and cancelada = 0 and (time(inicio) between ? and ? or time(fin) between ? and ?)");
                            
                            $stmt->execute(array($fecha_cita,$peluquero_seleccionado,$inicio,$resultado,$inicio,$resultado));
                            $stmt->fetchAll();
                
                            if($stmt->rowCount() != 0)
                            {}
                            else
                            {
                            ?>
                                <input type="radio" id="<?= $fecha_cita." ".$inicio; ?>" name="fecha_hora_deseada" value="<?php echo $fecha_cita." ".$inicio." ".$resultado; ?>">
                                <label class="hora_de_reserva_disponible" for="<?= $fecha_cita." ".$inicio; ?>">
                                    <?= $inicio; ?>
                                </label>
                                <?php
                            }
                        }
                        
                        $inicio = strtotime("+15 minutes", strtotime($inicio));
                        $inicio =  date('H:i', $inicio);

                        $segundos = strtotime($duracion_servicio)-strtotime("00:00:00");
                        $resultado = date("H:i",strtotime($inicio)+$segundos);
                    }
                echo "</div>";
            }
        ?>
    </div>
</div>  
	<?php
	}
    else
    {
        header('location: index.php');
        exit();
    }
?>