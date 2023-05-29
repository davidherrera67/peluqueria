<?php
    include "connect.php";
    include "Includes/templates/header.php";
    include "Includes/templates/navbar.blade.php";
?>

<section id="content">
    <div class="content px-6 py-3">
        <div id="carouselExampleIndicators" class="carousel slide text-center">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner px-6 py-3">
                <div class="carousel-item active ">
                    <img src="Design/images/Carruselfoto1.jpg" class="w-50" alt="foto1 pelu carrusel">
                    <h3 class="text-primary">ESTÉTICA #BELLEZANATURAL</h3>
                    <p>Tu eres perfect@, por eso te cuidamos con los mejores tratamientos, técnicas y tecnologia
                        avanzada.<br>
                        <a target="_blank" class="btn btn-outline-secondary" href="">¿Quieres un cambio a mejor?</a>
                    </p><br>
                </div>
                <div class="carousel-item">
                    <img src="Design/images/Carruselfoto2.jpg" class="w-50" alt="foto2 pelu carrusel">
                    <h3 class="text-primary">PELUQUERÍA #ESTILOBELIA</h3>
                    <p>Ya sea un cambio de look, dar color, extender tu melena o mantener el cabello sano.<br>
                        <a target="_blank" class="btn btn-outline-warning" href="">Disfruta del estilo que mereces</a>
                    </p><br>
                </div>
                <div class="carousel-item">
                    <img src="Design/images/Carruselfoto3.jpg" class="w-50" alt="foto3 pelu carrusel">
                    <h3 class="text-primary">PRODUCTOS #COSMETICABELLA</h3>
                    <p> Para un cuidado preciso y sano , reserva o compra algún producto en nuestra web online.<br>
                        <a target="_blank" class="btn btn-outline-info" href="">Ponte guap@</a>
                    </p><br>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previo</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>




    <hr class="hr hr-blurry" style="border-top: 10px solid green; border-radius: 8px;" />



    <div class="container px-6 py-3 ">

        <div class="row">
            <h2 class="text-center px-6 py-3 font-weight-bold text-info">MEJORES PELUQUEROS DE TODOS LOS TIEMPOS</h2>
            <div class="col px-6 py-3">
                <img src="Design/images/peluquero5.jpg" class="w-50 " alt="foto1 pelu carrusel">
                <h3>FELIPE, DIRECTOR CREATIVO</h3>
            </div>
            <div class="col px-6 py-3">
                <img src="Design/images/peluquero2.jpg" class="w-50 h-50" alt="foto1 pelu carrusel">
                <h3>FRAN, TEAM MANAGER</h3>
            </div>
        </div>
        <div class="row">
            <div class="col px-8 py-4">
                <img src="Design/images/peluquero3.jpg" class="w-50" alt="foto2 pelu carrusel">
                <h3>ALBERTO, ESTILISTA SENIOR</h3>
            </div>
            <div class="col px-2 py-1">
                <img src="Design/images/peluquero4.jpg" class="w-50" alt="foto1 pelu carrusel">
                <h3>ANDRÉS, ESTÉTICA</h3>
            </div>
            <div class="col px-8 py-4">
                <img src="Design/images/peluquero1.jpg" class="w-50" alt="foto1 pelu carrusel">
                <h3>PEPE, ESTILISTA JR</h3>
            </div>
        </div>
    </div>



    <hr class="hr hr-blurry" style="border-top: 10px solid green; border-radius: 8px;" />



    <section class="newsletter px-6 py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="font-weight-bold text-primary ">Newsletter</h2>
                    <p class="newsletter px-5">Aprovecha nuestras ofertas de Verano. ¡Apúntate ya!</p>
                </div>
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="info-comercial" required>
                            <label class="form-check-label" for="info-comercial">Acepto que me envíes información
                                comercial sobre productos y/o servicios *</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="terminos" required>
                            <label class="form-check-label" for="terminos">He leído y acepto los términos y condiciones
                                *</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Suscribirse</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <hr class="hr hr-blurry" style="border-top: 10px solid green; border-radius: 8px;" />

    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <div class="container px-6 py-3 text-dark">
        <div class="row">
            <div class="col-sm">
                <h2 class="text-primary font-weight-bold ">¿NECESITAS PEDIR CITA POR TELÉFONO?</h2>
                <p class="text-black px-5">TELF: 902 23 14 12</p>
            </div>
            <div class="col-sm">
                <h2 class="text-primary font-weight-bold">Dirección</h2>
                <p class="text-black px-5">RES. SANTA ANA<br>C. Sierra Pila<br> 30005 Murcia (Murcia)</p>
            </div>
            <div class="col-sm">
                <h2 class="text-primary px-1">Mapa</h2>
                <div id="map ">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12578.344642175836!2d-1.1473898971562224!3d37.98678614340233!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6381f72694954b%3A0x1dec2cc34fe59eea!2sEstaci%C3%B3n%20de%20Autobuses%20de%20Murcia!5e0!3m2!1ses!2ses!4v1684356462750!5m2!1ses!2ses"
                        width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <!-- Incluimos los archivos JS de Bootstrap y Google Maps -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

        </div>
</section>


<?php include "./Includes/templates/footer.php"; ?>