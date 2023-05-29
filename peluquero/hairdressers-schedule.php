<?php
    session_start();

    include 'connect.php';
    include 'Includes/functions/functions.php';
    include 'Includes/templates/header.php';

    echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";

    if (isset($_SESSION['username_hairdressing_Ze422aVVwd1']) && isset($_SESSION['password_hairdressing_Ze422aVVwd1'])) {
?>

    <div class="container-fluid">
        <div class="card border-info "><div class="card-header bg-info"><h2 class="text-warning text-center">Horario de los peluqueros</h2></div>
            <div class="card-body">
                <div class="sb-entity-selector text-center">
                    <form action="hairdressers-schedule.php" method="POST">
                        <div class="form-group" style="margin:auto; ">
                            
                            <label class=" control-label text-center text-info" for="peluquero_select">Configurar Horario</label>
                            <div style="display:inline;">
                                <button type="submit" name="mostrar_horario_enviar"  class="btn btn-info"><i class="far fa-eye"></i></button>
                            </div>
                            <div class="mt-2" style="width:20%; margin:auto;">
                                <?php
                                    $stmt = $con->prepare('select * from hairdressers');
                                    $stmt->execute();
                                    $peluqueros = $stmt->fetchAll();

                                    echo "<select class='form-control' name='peluquero_seleccionado'>";
                                    foreach ($peluqueros as $peluquero) {
                                        echo "<option value=" . $peluquero['id'] . " " . ((isset($_POST['peluquero_seleccionado']) && $_POST['peluquero_seleccionado'] == $peluquero['id']) ? 'selected' : '') . ">" . $peluquero['nombre'] . " " . $peluquero['apellido'] . "</option>";
                                    }
                                    echo "</select>";
                                ?>
                            </div>
                        </div>
                        <hr>
                    </form>
                </div>

                <div class="sb-content">
                    <?php
                        if (isset($_POST['mostrar_horario_enviar'])) {
                    ?>
                        <form method="POST" action="hairdressers-schedule.php">
                            <input name="id_peluquero" value="<?= $_POST['peluquero_seleccionado']; ?>" type="hidden" hidden>
                            <div class="">
                                <?php
                                    $id_peluquero = $_POST['peluquero_seleccionado'];
                                    $stmt = $con->prepare('select * from hairdressers h, hairdressers_schedule hs where hs.id_peluquero = h.id and h.id = ?');
                                    $stmt->execute(array($id_peluquero));
                                    $peluqueros = $stmt->fetchAll();

                                    $dias = array(
                                        "1" => "Lunes",
                                        "2" => "Martes",
                                        "3" => "Miercoles",
                                        "4" => "Jueves",
                                        "5" => "Viernes",
                                        "6" => "Sabado",
                                        "7" => "Domingo"
                                    );


                                    $dias_disponibles = array();
                                    foreach ($peluqueros as $peluquero) {
                                        $dias_disponibles[] = $peluquero['id_dia'];
                                    }

                                    foreach ($dias as $key => $value) {
                                        echo "<div class='dia-horario row'>";

                                        if (in_array($key, $dias_disponibles)) {
                                            echo "<div class='col-md-4 ms-4 form-group'>";

                                            echo "<input name='" . $value . "' id='" . $key . "' class='sb-dia-horario-switch' type='checkbox' checked>";
                                            echo "<span class='text-primary ms-4' style='font-size: 20px; color: #253246;'>";
                                            echo $value;
                                            echo "</span>";

                                            echo "</div>";

                                            foreach ($peluqueros as $peluquero) {
                                                if (in_array($key, $dias_disponibles) && $peluquero['id_dia'] == $key) {
                                                    echo "<div class='tiempo_ col-md-8 row'>";

                                                    echo "<div class='col-md-6 form-group'>";
                                                    echo "<input type='time' name='" . $value . "-desde' value='" . $peluquero['desde_hora'] . "' class='form-control'>";
                                                    echo "</div>";

                                                    echo "<div class='col-md-6 form-group'>";
                                                    echo "<input type='time' name='" . $value . "-hasta' value='" . $peluquero['hasta_hora'] . "'  class='form-control'>";
                                                    echo "</div>";

                                                    echo "</div>";
                                                }
                                            }
                                        } else {
                                            echo "<div class='col-md-4 ms-4 form-group'>";

                                            echo "<input name='" . $value . "' id='" . $key . "' class='sb-dia-horario-switch' type='checkbox'>";
                                            echo "<span class='text-primary ms-4' style='font-size: 20px; color: #253246;'>";
                                            echo $value;
                                            echo "</span>";

                                            echo "</div>";

                                            echo "<div class='tiempo_ col-md-8 row' style='display:none;'>";

                                            echo "<div class=' col-md-6 form-group'>";
                                            echo "<input type='time' name='" . $value . "-desde' value = '10:00' class='form-control'>";
                                            echo "</div>";

                                            echo "<div class=' col-md-6 form-group'>";
                                            echo "<input type='time' name='" . $value . "-hasta' value = '18:00' class='form-control'>";
                                            echo "</div>";

                                            echo "</div>";
                                        }

                                        echo "</div>";
                                    }
                                ?>
                            </div>

                            <div class="form-group"><button type="submit" name="guardar_horario_enviar" class="btn btn-info">Guardar horario peluquero</button></div>
                        </form>
                    <?php
                    }?>
                </div>

                <?php

                    if (isset($_POST['guardar_horario_enviar'])) {
                        $dias = array(
                            "1" => "Lunes",
                            "2" => "Martes",
                            "3" => "Miercoles",
                            "4" => "Jueves",
                            "5" => "Viernes",
                            "6" => "Sabado",
                            "7" => "Domingo");
                        $stmt = $con->prepare("delete from hairdressers_schedule where id_peluquero = ?");
                        $stmt->execute(array($_POST['id_peluquero']));

                        foreach ($dias as $key => $value) {
                            if (isset($_POST[$value])) {
                                $stmt = $con->prepare("insert into hairdressers_schedule(id_peluquero,id_dia,desde_hora,hasta_hora) values(?, ?, ?,?)");
                                $stmt->execute(array($_POST['id_peluquero'], $key, $_POST[$value . '-desde'], $_POST[$value . '-hasta']));

                                $message = "Se ha actualizado el horario del peluquero exitosamente";
                ?>

                            <script type="text/javascript">
                                swal("Horario del peluquero establecido", "Se ha establecido el horario del peluquero exitosamente", "success").then((value) => {});
                            </script>
                <?php
                        }
                    }
                }?>
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