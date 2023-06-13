<?php

include "connect.php";
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";
?>
<h1 class="text-center px-6 py-3 text-primary">HORARIO CONTACTO<img src="Design/images/calendarbg.png" style="width:55px; px-4 py-2" alt="icono"></h1>
    
<section class="container">
    
<body background="Design/images/fondo.avif"  style="background-repeat: no-repeat; width:100%; height:100%; background-size: 100%;">
    
        <div class="container" style=" display:flex; justify-content:center;">
            
        <table id="example" class="text-dark table table-striped table-hover ui celled table">
                <thead>
                    <tr>
                    <th>Día</th>
                    <th>Horario</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Lunes     .................................</td>
                    <td>9:00 - 20:30</td>
                    </tr>
                    <tr>
                    <td>Martes     ..............................</td>
                    <td>9:00 - 20:30</td>
                    </tr>
                    <tr>
                    <td>Miércoles     ..........................</td>
                    <td>9:00 - 20:30</td>
                    </tr>
                    <tr>
                    <td>Jueves     .................................</td>
                    <td>9:00 - 20:30</td>
                    </tr>
                    <tr>
                    <td>Viernes     ................................</td>
                    <td>10:00 - 20:30</td>
                    </tr>
                    <tr>
                    <td>Sábado     .................................</td>
                    <td>8:30 - 15:00</td>
                    </tr>
                    <tr>
                    <td>Domingo     ............................</td>
                    <td>Cerrado</td>
                    </tr>
                </tbody>
            </table>
    
            <script>
                    $(document).ready(function () {
                        $('#example').DataTable();
                    });
            </script>
    </div>
</body>
        
</section>

<?php

    include "Includes/templates/footer.php";

?>