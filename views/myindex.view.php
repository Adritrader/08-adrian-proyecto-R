<div class="container-fluid">
    <div class="row fila-ruta">
        <div class="col-5 col-ruta">
            <div><span>Estas aquí: </span><a href="/" class="active">Home</a></div>
        </div>
    </div>
</div>
</div>
<main>
    <!-- Slideshow container -->
    <div class="container-fluid slideshow-container">

        <!-- Full-width images with number and caption text -->



        <div class="mySlides fade">
            <div class="button-container">
                <?php

                use App\Core\App;

                $user = App::get("user");

                if(!empty($user) && ($user->getRole() === "ROLE_USER" || $user->getRole() === "ROLE_ADMIN")):?>
                    <a href="/reservas/create" class="button-three" alt="">Reservar cita</a>

                <?php else: ?>

                <?php endif;?>

                <img src="/images/design/carrousel-1.jpg" style="width:100%; height: 450px">
            </div>
        </div>

        <div class="mySlides fade">
            <div class="button-container">
                <?php

                if(!empty($user) && ($user->getRole() === "ROLE_USER" || $user->getRole() === "ROLE_ADMIN")):?>
                    <a href="/reserva-cita" class="button-three" alt="">Reservar cita</a>

                <?php else: ?>

                <?php endif;?>
                <img src="/images/design/carrousel-2.jpg" style="width:100%; height: 450px">
            </div>
        </div>

        <div class="mySlides fade">
            <div class="button-container">
                <?php

                if(!empty($user) && ($user->getRole() === "ROLE_USER" || $user->getRole() === "ROLE_ADMIN")):?>
                    <a href="/reserva-cita" class="button-three" alt="">Reservar cita</a>

                <?php else: ?>

                <?php endif;?>
                <img src="/images/design/fondo-estilo.jpg" style="width:100%; height: 450px">
            </div>
        </div>


        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>

    <!-- The dots/circles -->
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
    <div class="container-fluid">
        <div class="row fila-descripcion">
            <div class="col-4 imagen">
                <img src="/images/design/salon1.jpg" alt="salon" id="salon1">
            </div>
            <div class="col-4 texto">
                <p>En nuestro salón de peluquería podrá disfrutar de una experiencia única. Ofrecemos los mejores
                    servicios de calidad, con una atención personalizada e inmediata.
                    Utilizamos productos de las mejores marcas del mercado. Además usamos técnicas de peluquería en
                    tendencia, lograremos dejarle un acabado increíble. Contamos con
                    personal cualificado, con amplia experiencia en el sector.
                </p>
            </div>
        </div>
        <div class="row fila-descripcion">
            <div class="col-4 texto">
                <p>Contamos con unas instalaciones modernas, que le harán sentirse en el mejor ambiente. Cuidamos de
                    todos los detalles. Somos cuidadados a la hora de de aplicar los
                    productos. Cuidamos de su cabello y lo trataremos de la mejor forma.
                </p>
            </div>
            <div class="col-4 imagen">
                <img src="/images/design/salon2.jpg" alt="salon" id="salon2">
            </div>
        </div>
        <div class="row fila-descripcion fila-miniaturas">
            <div class="col-3">
                <img src="/images/design/miniatura1.jpg" alt="miniatura1">
                <p>Los mejores tratamientos de belleza, aplicamos las tendencias mas novedosas en el ámbito de los
                    tratamientos capilares.</p>
            </div>
            <div class="col-3">
                <img src="/images/design/miniatura2.jpg" alt="miniatura2">
                <p>Servicios de calidad. Relájese mientras nosotros nos encargamos de todo, disfrute de la
                    experiencia.</p>

            </div>
            <div class="col-3">
                <img src="/images/design/miniatura3.jpg" alt="miniatura3">
                <p>Atención personalizada e inmediata. Ofrecemos los mejores servicios, con los mejores productos a
                    un precio muy competitivo.</p>

            </div>
            <div class="col-3">
                <img src="/images/design/miniatura4.jpg" alt="miniatura4">
                <p>Disponemos de una amplia gama de productos para el tratamiento de su cabello. Seleccionamos las
                    mejores marcas para ofreceroslo.</p>

            </div>
        </div>
    </div>
</main>
<div class="container-fluid">
    <div class="row fila-reserva">
        <div class="col-12 boton-reserva">
            <a href="/reserva-cita"><button class="button-three">Reservar cita</button></a>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row fila-botones-precios">
                <div class="col-5">

                    <button class="button-four"
                            onclick="document.getElementById('myImage').src='/images/design/precios-mujer.jpg'">Mujer</button>
                    <button class="button-four"
                            onclick="document.getElementById('myImage').src='/images/design/precios-caballero.jpg'">Caballero</button>
                    <button class="button-four"
                            onclick="document.getElementById('myImage').src='/images/design/precios-manicura.jpg'">Manicura</button>
                    <button class="button-four"
                            onclick="document.getElementById('myImage').src='/images/design/precios-tratamientos.jpg'">Tratamientos</button>

                </div>
            </div>


            <div class="row fila-imagenes-precios">
                <div class="col-7">
                    <h1>Precios</h1>
                </div>
            </div>

            <div class="row fila-precios">
                <div class="col-5 col-precios">
                    <img src="/images/design/precios-mujer.jpg" alt="precios-mujer" id="myImage">
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row fila-imagenes-precios">
        <div class="col-7">
            <h1>Galería de imágenes</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 galeria-imagenes">
            <div class="container">
                <div class="gallery-container w-3 h-2">
                    <div class="gallery-item">
                        <div class="image">
                            <img src="/images/design/salon1.jpg" alt="nature">
                        </div>
                        <div class="text">Instalaciones modernas</div>
                    </div>
                </div>

                <div class="gallery-container w-3 h-3">
                    <div class="gallery-item">
                        <div class="image">
                            <img src="/images/design/servicios-9.jpg" alt="people">
                        </div>
                        <div class="text">Colores divertidos</div>
                    </div>
                </div>

                <div class="gallery-container h-3">
                    <div class="gallery-item">
                        <div class="image">
                            <img src="/images/design/servicios-4.jpg" alt="sport">
                        </div>
                        <div class="text">Tendencia</div>
                    </div>
                </div>

                <div class="gallery-container w-2">
                    <div class="gallery-item">
                        <div class="image">
                            <img src="/images/design/servicios-8.jpg" alt="fitness">
                        </div>
                        <div class="text">Caballero</div>
                    </div>
                </div>

                <div class="gallery-container w-4 h-2">
                    <div class="gallery-item">
                        <div class="image">
                            <img src="/images/design/servicios-7.jpg" alt="food">
                        </div>
                        <div class="text">Atención personalizada</div>
                    </div>
                </div>

                <div class="gallery-container h-2">
                    <div class="gallery-item">
                        <div class="image">
                            <img src="/images/design/servicios-10.jpg" alt="hair">
                        </div>
                        <div class="text">Estilo</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row fila-descripcion fila-miniaturas" id="partners">
    <h1>Marcas colaboradoras</h1>
    <div class="col-3">
        <img src="/images/design/pantene-partner.jpg" alt="pantene" class="partner">
    </div>
    <div class="col-3">
        <img src="/images/design/loreal-partner.jpg" alt="loreal" class="partner">
    </div>
    <div class="col-3">
        <img src="/images/design/sebastian-partner.jpg" alt="sebastian" class="partner">

    </div>
    <div class="col-3">
        <img src="/images/design/kerastase-partner.jpg" alt="kerastase" class="partner">

    </div>
</div>
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-circle-up"></i></button>