<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/css/header.css">
    <link rel="stylesheet" type="text/css" href="/css/footer.css">
    <link rel="stylesheet" type="text/css" href="/css/template-grid3.css">
    <link rel="stylesheet" type="text/css" href="/css/formulario-reserva.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.13/css/all.css">
    <script src="js/app.js"></script>
    <title>Home | Juan Bisquert Peluqueros</title>
</head>

<body onload="docReady()">
<header>
    <div class="container-fluid headerContainer">
        <div class="row fila-header">
            <div class="col-3 header-logo">
                <a href=""><img class="logo" src="/images/design/logo-bueno.png" alt="logo"></a>
            </div>

            <div class="col-5 horario">

                <div class="row fila-banner">

                    <div class="col-3 reloj">
                        <div class="row fila-reloj">

                            <i class="fa fa-clock"></i>
                            <p>Lunes a Viernes</p>
                            <p>09:30 - 13:00</p>
                            <p>16:30 - 20:00</p>
                            <p>Sábados cerrados a mediodía</p>
                        </div>
                    </div>

                    <div class="col-3 reloj">
                        <div class="row fila-reloj">
                            <i class="fas fa-store-alt"></i>
                            <p>Calle Sagunto Nº 10</p>
                            <p>03700</p>
                            <p>Dènia</p>
                            <p>Alicante</p>
                        </div>
                    </div>
                    <div class="col-3 reloj">
                        <div class="row fila-reloj">
                            <i class="fas fa-phone"></i>
                            <p>Móvil: 645 45 45 11</p>
                            <p>Solo whatsapp</p>
                            <p>Fijo: 96 455 78 74</p>
                            <p>@juanbisquert</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-1 col-carrito">

                    <?php

                    use App\Core\App;
                    use App\Core\Router;
                    use App\Model\UsuarioModel;




                    $loggedUser = $_SESSION["loggedUser"]??[];

                if($loggedUser != []):?>
                            <?php $router = App::get(Router::class);
                                    $usuarioModel = App::getModel(UsuarioModel::class);
                                    $user = App::get("user");
                                    $usuario = $usuarioModel->find($user->getId());?>
                            <a id="bd-versions" aria-haspopup="false"
                               aria-expanded="false" href="/logout" class="button-two">
                                Log Out
                            </a>

                            <a href="/perfil/<?= $usuario->getId()?>/show"><i class="fa fa-user">Perfil</i></a>
                    <?php else: ?>

                            <a id="bd-versions" aria-haspopup="false"
                               aria-expanded="false" href="/login" class="button-two">
                                Log in
                            </a>
                            <a href="/usuarios/create" class="button-two">Sign Up</a>

                    <?php endif;?>


                <div class="row fila-carrito">
                    <div class="col-12 sidenav-shop">
                        <i class="fas fa-shopping-cart dropdown-btn"><span>0,00&nbsp;€</span></i>
                            <div class="dropdown-container-shop">
                                <?php
                                $shoppingCart = $_SESSION["shoppingCart"] ?? [];

                                if($shoppingCart != []):?>
                                <a href="#">Mujer</a>
                                <a href="#">Hombre</a>
                                <a href="#">Tratamientos</a>
                                <?php else: ?>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid container-barra-nav">
            <div class="row barra-nav">
                <div class="col-11 barra-nav-elementos">
                    <?php require_once '../inc/functions.php';?>
                    <a class="<?=isActiveOption(trim($_SERVER['REQUEST_URI'],  "/"), "");?>" href="/">Home</a>
                    <a class="<?=isActiveOption(trim($_SERVER['REQUEST_URI'],  "/"), "servicios");?>" href="/servicios">Servicios</a>
                    <a class="<?=isActiveOption(trim($_SERVER['REQUEST_URI'],  "/"), "quienes-somos");?>" href="/quienes-somos">Quiénes Somos</a>
                    <a class="<?=isActiveOption(trim($_SERVER['REQUEST_URI'],  "/"), "galeria");?>" href="/galeria">Galería</a>
                    <a class="<?=isActiveOption(trim($_SERVER['REQUEST_URI'],  "/"), "blog");?>" href="/blog">Blog</a>
                    <a class="<?=isActiveOption(trim($_SERVER['REQUEST_URI'],  "/"), "contacto");?>" href="/contacto">Contacto</a>
                    <a class="<?=isActiveOption(trim($_SERVER['REQUEST_URI'],  "/"), "tienda");?>" href="/tienda">Tienda</a>

                    <?php
                    $user = App::get("user");
                    if(!empty($user) && ($user->getRole() === "ROLE_ADMIN")):?>
                        <a href="/back-index">BackOffice</a>

                    <?php else: ?>

                    <?php endif;?>
                </div>
            </div>
        </div>

        <!-- Ruta -->




</header>

<?=$content?>

<footer style="margin-top: 800px;">
    <div class="container-fluid">
        <div class="row fila-footer">
            <div class="col-2 col-footer-enlaces enlaces-first">
                <a href="/">Home</a>
                <a href="/servicios">Servicios</a>
                <a href="/quienes-somos">Quiénes Somos</a>
                <a href="/galeria">Galería</a>
            </div>
            <div class="col-2 col-footer-enlaces">
                <a href="/reserva-cita">Reservar Cita</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
                <a href="/tienda">Tienda</a>

            </div>
            <div class="col-3 mapa">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d194.2393834628329!2d0.10468218085136947!3d38.83635088764253!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x129e1b237dbfec7f%3A0x4882a2521c7a073d!2sCarrer%20de%20Sagunt%2C%2010%2C%2003700%20D%C3%A9nia%2C%20Alacant!5e0!3m2!1ses!2ses!4v1608655685043!5m2!1ses!2ses"
                        width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                <p>C/ Sagunto Bajo 10</p>
                <p>Denia (Alicante)</p>
                <p>96 654 55 44</p>

            </div>
        </div>
        <div class="row fila-iconos-rrss">
            <div class="col-3 col-iconos-rrss">
                <a href="#"><img src="/images/design/facebook-logo.svg" alt="facebook"></a>
                <a href="#"><img src="/images/design/instagram-logo.svg" alt="instagram"></a>
                <a href="#"><img src="/images/design/whatsapp.svg" alt="whatsapp"></a>
            </div>
        </div>
        <div class="row fila-footer-politicas">
            <div class="col-3 col-footer-politicas">
                <span>© 2020 VaporDev Web Designs</span>
            </div>
            <div class="col-8 col-footer-avisos-legales">
                <a href="/sitemap">Sitemap</a>
                <a href="#">Política</a>
                <a href="#">Cookies</a>
                <a href="#">Aviso Legal</a>
                <a href="#">Tienda</a>
            </div>
        </div>
    </div>
</footer>
</body>

</html>