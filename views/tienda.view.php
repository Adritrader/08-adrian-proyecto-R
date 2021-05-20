<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

<div class="container-fluid">
    <div class="row fila-ruta">
        <div class="col-5 col-ruta">
            <div><span>Estas aquí: </span><a href="/">Home</a><span><i
                            class="fa fa-caret-right"></i><a href="tienda"
                                                             class="active">Tienda</a></span><span></span></div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row fila-servicios">
        <div class="col-2">
            <div class="sidenav">
                <a href="#">Inicio</a>
                <button class="dropdown-btn">Categorias
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                    <a href="#">Champús</a>
                    <a href="#">Tratamientos</a>
                    <a href="#">Accesorios</a>
                </div>

            </div>
        </div>
        <div class="col-4 tienda-frontal">
            <div class="gallery-container w-3 h-3">
                <div class="gallery-item">
                    <div class="image">
                        <img src="/images/design/productos/kerastase-kit.jpg" alt="people">
                    </div>
                    <div class="text"><p>Kerastase Kit</p>80,16 €</div>
                </div>
            </div>
        </div>

        <div class="col-2 fotos-tienda">
            <div class="gallery-container w-3 h-2">
                <div class="gallery-item">
                    <div class="image">
                        <img src="/images/design/productos/ghd-plancha-pro.jpg" alt="people">
                    </div>
                    <div class="text"><p>GHD Plancha Pro</p>244,95 €</div>
                </div>
            </div>
            <div class="gallery-container w-3 h-2">
                <div class="gallery-item">
                    <div class="image">
                        <img src="/images/design/productos/ghd-secador-helios.jpg" alt="people">
                    </div>
                    <div class="text"><p>GHD Secador Helio</p>179,95 €</div>
                </div>
            </div>
        </div>
        <div class="col-2 fotos-tienda">
            <div class="gallery-container w-3 h-2">
                <div class="gallery-item">
                    <div class="image">
                        <img src="/images/design/productos/kerastase-reflection.jpg" alt="people">
                    </div>
                    <div class="text"><p>Kerastase Reflection</p>25,95 €</div>
                </div>
            </div>

            <div class="gallery-container w-3 h-2">
                <div class="gallery-item">
                    <div class="image">
                        <img src="/images/design/productos/ghd-peine-rizado.jpg" alt="people">
                    </div>
                    <div class="text"><p>GHD Rizador cabello</p>124,95 €</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row fila-texto-tienda">
        <div class="col-7 col-texto-tienda">
            <p>Tenemos los mejores productos de las mejores marcas. Disfrute de una amplia gama de productos de alta calidad al mejor precio.</p>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row titulo-miniaturas-tienda">
        <div class="col-11">
            <h2>Destacados</h2>
            <hr>
            <div class="row productos-miniaturas">

                <form action="">

            <?php use App\Entity\Producto;


            foreach ($productos as $producto) { ?>

                <div class="col-2 miniatura"><?= generar_imagen_local(Producto::IMAGEN_PATH . '/', $producto->getImagen(),
                        $producto->getNombre(), 300, 200) ?>
                    <span><?= $producto->getPrecio() . " " . "€"?></span>
                    <p><?= $producto->getDescripcion() ?></p>
                    <a href="<?=$router->getUrl("producto_show", ["id"=>$producto->getId()])?>">
                        <button class="button-three"><i class="fas fa-info-circle"></i>Ver detalles</button></a>
                    <input type="hidden" value="<?=$producto->getId()?>">
                    <button type="submit" class="button-three" name="Submit1"><i class="fas fa-shopping-cart"></i>Añadir compra</button>

                </div>
                <?php
                $_SESSION["shoppingCart"] = array($producto);
                }


                var_dump($_SESSION["shoppingCart"]);
                ?>

                </form>

                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php

                        for ($i = 1; $i<= $totalPaginas; $i++ ){

                        ?>
                        <li class="page-item"><a class="page-link" href="<?=$router->getUrl("tienda", ["page"=>$i]) ?>"><?=$i ?></a></li>
                            <?php
                        } ?>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row titulo-miniaturas-tienda">
            <div class="col-11">
                <h2>Ofertas</h2>
                <hr>
                <div class="row productos-miniaturas">
                    <div class="col-2 miniatura"><img src="/images/design/productos/Acondicionador-B-Salerm-1000ml.jpg" alt="">
                        <span>15,55 €</span>
                        <p>Acondicionador Salerm para cabellos dañados y con poco brillo. Nutre de vitaminas el cabello. Repara y protege las zonas dañadas. Envase de 1000 ml.</p>

                        <button class="button-three"><i class="fas fa-info-circle"></i>Ver detalles</button>
                        <button class="button-three"><i class="fas fa-shopping-cart"></i>Añadir compra</button>
                    </div>
                    <div class="col-2 miniatura"><img src="/images/design/productos/acondicionante.jpg" alt="">
                        <span>21,95 €</span>
                        <p>Acondicionante para cabellos lisos. Crea una visión de gran volumen con el acondicionador Nexxus. Disponible en formato de 500ml.</p>
                        <button class="button-three"><i class="fas fa-info-circle"></i>Ver detalles</button>
                        <button class="button-three"><i class="fas fa-shopping-cart"></i>Añadir compra</button>

                    </div>
                    <div class="col-2 miniatura"><img src="/images/design/productos/ampolla-1.jpg" alt="">
                        <span>12 €</span>
                        <p>Ampolla anti-caida de cabello. Evita la caida de tu cabello con la aplicación de las ampollas Premium Mugella & Sulé. Contiene 6 uds.</p>
                        <button class="button-three"><i class="fas fa-info-circle"></i>Ver detalles</button>
                        <button class="button-three"><i class="fas fa-shopping-cart"></i>Añadir compra</button>

                    </div>
                    <div class="col-2 miniatura"><img src="/images/design/productos/kerastase-kit.jpg" alt="">
                        <span>94,75 €</span>
                        <p>Kit Kerastase incluye proteinas Kerastase-protein, champú antirrotura, serum capital de aceite de argán y mascarilla revitalizante.</p>
                        <button class="button-three"><i class="fas fa-info-circle"></i>Ver detalles</button>
                        <button class="button-three"><i class="fas fa-shopping-cart"></i>Añadir compra</button>
                    </div>
                    <div class="col-2 miniatura"><img src="/images/design/productos/kit-sebastian.jpg" alt="">
                        <span>112,15 €</span>
                        <p>Kit Sebastian profesional de peluquería. Acondicionador, serum, mascarilla , champú y cera brillante. Gama de productos Black-Pro.</p>
                        <button class="button-three"><i class="fas fa-info-circle"></i>Ver detalles</button>
                        <button class="button-three"><i class="fas fa-shopping-cart"></i>Añadir compra</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

if($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["Submit1"])) {

        var_dump($_SESSION["shoppingCart"][$producto->getId()]);

    }
}


