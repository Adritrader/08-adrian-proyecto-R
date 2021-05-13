<header>
    <!--<audio autoplay loop id="audio" src="audio/cancion.mp3"></audio>-->
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

                <button onclick="document.getElementById('id01').style.display='block'"
                        class="button-two">Login</button>
                <div id="id01" class="modal">
                        <span onclick="document.getElementById('id01').style.display='none'" class="close"
                              title="Close Modal">&times;</span>

                    <!-- Modal Content -->
                    <form class="modal-content animate" action="/action_page.php">
                        <div class="imgcontainer">
                            <img src="images/design/avatar.jpeg" alt="Avatar" class="avatar">
                        </div>

                        <div class="container2">
                            <label for="uname"><b>Usuario</b></label>
                            <input type="text" placeholder="Enter Username" name="uname" required>

                            <label for="psw"><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="psw" required>
                            <input type="checkbox" checked="checked" id="remember"> Recuerdame
                            <span>¿Se ha olvidado su <a href="#">password?</a></span>
                        </div>


                        <div class="container2" style="background-color:#f1f1f1">
                            <button type="submit" class="loginbtn">Login</button>
                            <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                    class="cancelbtn">Cancelar</button>
                        </div>

                    </form>
                </div>

                <a href="/signup" class="button-two">Sign Up</a>

                <div class="row fila-carrito">
                    <div class="col-12">
                        <i class="fas fa-shopping-cart"><span>0,00&nbsp;€</span></i>
                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid container-barra-nav">
            <div class="row barra-nav">
                <div class="col-11 barra-nav-elementos">
                    <a href="/">Home</a>
                    <a href="/servicios">Servicios</a>
                    <a href="/quienes-somos">Quiénes Somos</a>
                    <a href="/galeria">Galería</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                    <a href="/tienda">Tienda</a>
                </div>
            </div>
        </div>

        <!-- Ruta -->

        <div class="container-fluid">
            <div class="row fila-ruta">
                <div class="col-5 col-ruta">
                    <div><span>Estas aquí: </span><a href="" class="active">Home</a></div>
                </div>
            </div>
        </div>
    </div>


</header>

<!--------------------------------------------------------------------->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Movie FX</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/blog.html">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/partners">Partners</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/movies">Movies</a>
                </li>
            </ul>

            <ul class="nav navbar-nav ml-auto">.

                <?php

                $loggedUser = $_SESSION["loggedUser"]??[];

                if($loggedUser != []):?>

                <li class="nav-item ">
                    <a class="nav-item nav-link mr-md-2" id="bd-versions" aria-haspopup="false"
                       aria-expanded="false" href="/logout">
                        Log Out
                    </a>

                </li>
                <?php else: ?>


                <li class="nav-item ">
                    <a class="nav-item nav-link mr-md-2" id="bd-versions" aria-haspopup="false"
                       aria-expanded="false" href="/login">
                        Log in
                    </a>
                </li>

                <?php endif;?>
                <li class="nav-item">
                    <a class="nav-item nav-link" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"
                       href="/signup">
                        Register
                    </a>

                </li>
                <li class="nav-item">
                </li>
            </ul>
            <form class="form-inline ml-2 my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
</nav>