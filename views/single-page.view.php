<?php

use App\Entity\Producto;


?>
<div class="container-fluid">
        <div class="row fila-servicios">
            <div class="col-2">
                <div class="sidenav">
                    <a href="tienda.html">Inicio</a>
                    <button class="dropdown-btn">Categorias
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="categorias-champu.html">Champús</a>
                        <a href="categorias-tratamientos.html">Tratamientos</a>
                        <a href="categorias-accesorios">Accesorios</a>
                    </div>

                </div>
            </div>

            <div class="col-3 tienda-frontal">
                <div class="gallery-container w-3 h-3">
                    <?php

                    if (empty($errors)) : ?>
                    <div class="gallery-item">
                        <div class="image">
                            <?= generar_imagen_local('/' . Producto::IMAGEN_PATH . '/', $producto->getImagen(),
                                $producto->getNombre()) ?>
                        </div>
                        <div class="row fila-thumbnail">
                            <div class="col-4 col-texto-tienda">
                                <?= generar_imagen_local('/' . Producto::IMAGEN_PATH . '/', $producto->getImagen(),
                                    $producto->getNombre(), 300, 200) ?>
                            </div>
                            <div class="col-4 col-texto-tienda">
                                <?= generar_imagen_local('/' . Producto::IMAGEN_PATH . '/', $producto->getImagen(),
                                    $producto->getNombre(), 300, 200) ?>
                            </div>
                            <div class="col-4 col-texto-tienda">
                                <?= generar_imagen_local('/' . Producto::IMAGEN_PATH . '/', $producto->getImagen(),
                                    $producto->getNombre(), 300, 200) ?>
                            </div>
                        </div>
                        <div class="text">
                            <h1><?=$producto->getNombre()?></h1>
                            <?= $producto->getPrecio()?>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-4 descripcion-producto">

                <h2><?=$producto->getNombre()?></h2>

                <p class="descripcion-producto"><?= $producto->getDescripcion() ?>
</p>
                <h2 class="nombre-producto"><?= $producto->getPrecio() . " €"?></h2>
                <button class="button-three boton-carrito"><i class="fa fa-shopping-cart"></i>Añadir al carrito</button>


            </div>
            <div class="col-2">

            </div>

        </div>
    </div>

    <div class="container-fluid">
        <div class="row titulo-miniaturas-tienda">
            <div class="col-12">
                <h2>Destacados</h2>
                <hr>
                <div class="row productos-miniaturas">
                    <?php

                    foreach ($productos as $producto) { ?>

                        <div class="col-2 miniatura"><?= generar_imagen_local('/' . Producto::IMAGEN_PATH . '/', $producto->getImagen(),
                                $producto->getNombre(), 300, 200) ?>

                            <span><?= $producto->getPrecio() . " " . "€"?></span>
                            <p><?= $producto->getDescripcion() ?></p>
                            <button class="button-three"><i class="fas fa-info-circle"></i>Ver detalles</button>
                            <button class="button-three"><i class="fas fa-shopping-cart"></i>Añadir compra</button>
                        </div>
                        <?php
                    }
                    ?>
                    <?php else :?>

                        <?php foreach ($errors as $error) :?>
                            <h3><?= $error ?></h3>
                        <?php endforeach;?>
                    <?php endif ?>



    </div>
