<?php

include "connect.php";
include "Includes/templates/header.php";
include "Includes/templates/navbar.blade.php";

?>


    
    <h1 class="text-center px-6 py-3 text-primary">SERVICIOS<img src="Design/images/peineservice.png" style="width:55px; px-4 py-2" alt="icono"></h1>
    

<section class="container">
    
            <?php

                $stmt = $con->prepare("Select * from services");
                $stmt->execute();
                $totalServicios =  $stmt->rowCount();
                $servicios = $stmt->fetchAll();
                if ($totalServicios > 0) {
            ?>
            <div class="table-responsive">
            <table id="example" class="table table-striped table-hover ui celled table">
                <thead>
                    <tr>
                        <th>PRECIO</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th>DURACION</th>
                    </tr>
                </thead>
                <?php
                    foreach ($servicios as $servicio){
                        ?>
                        <tr>
                            <td><?= $servicio['precio']?>€</td>
                            <td><?= $servicio['nombre']?></td>
                            <td><?= $servicio['descripcion']?></td>
                            <td><?= $servicio['duracion']?> minutos</td>
                        </tr>
                        <?php 
                        } 
                    } 
                ?>
                        
                
                </table>
            </div>
            <script>
                    $(document).ready(function () {
                        $('#example').DataTable();
                    });
            </script>
</section>

<?php

    include "Includes/templates/footer.php";

?>