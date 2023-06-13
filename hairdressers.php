<?php

include "connect.php";
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";
?>


    
    <h1 class="text-center px-6 py-3 text-primary">PELUQUEROS<img src="Design/images/teambg.png" style="width:55px; px-4 py-2" alt="icono"></h1>
    

<section class="container">
    
            <?php

                $stmt = $con->prepare("Select * from hairdressers");
                $stmt->execute();
                $totalPeluqueros =  $stmt->rowCount();
                $peluqueros = $stmt->fetchAll();
                if ($totalPeluqueros > 0) {
            ?>
            <table id="example" class="table table-striped table-hover ui celled table" style="">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>TELEFONO</th>
                        <th>CORREO</th>
                    </tr>
                </thead>
                <?php
                    foreach ($peluqueros as $peluquero){
                        ?>
                        <tr>
                            <td><?= $peluquero['nombre']?></td>
                            <td><?= $peluquero['apellido']?></td>
                            <td><?= $peluquero['telefono']?></td>
                            <td><?= $peluquero['correo']?></td>
                        </tr>
                        <?php 
                        } 
                    } 
                ?>
                        
                
            </table>
            <script>
                    $(document).ready(function () {
                        $('#example').DataTable();
                    });
            </script>
</section>

<?php

    include "Includes/templates/footer.php";

?>