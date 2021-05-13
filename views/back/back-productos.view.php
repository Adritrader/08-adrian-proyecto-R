<?php use App\Entity\Producto; ?>
<div class="container-fluid">
    <div class="row fila-inputs-productos">
        <div class="col-4">
            <form method="post" action="<?= $router->getUrl("producto_filter")?>"
                  class="form-inline">
                <div class="form-group">
                    <input name="text"
                           value="<?= ($_POST["text"]) ?? "" ?>"
                           type="text" placeholder="Buscar" aria-label="Search">
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="optradio" id="nombre" value="nombre">&nbsp;Nombre                        &nbsp;
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-inline">
                        <input class="form-check-input" type="radio" name="optradio" id="descripcion" value="descripcion">&nbsp;Descripcion                        &nbsp;
                    </label></div>
                <div class="form-check-inline">
                    <label class="form-check-inline">
                        <input class="form-check-input" type="radio" name="optradio" id="both" value="both" checked>&nbsp;Ambos                        &nbsp;
                    </label>
                </div>
                <div class="form-group">
                    <button style="margin-top: 15px; margin-left: 0px" class="button-four" type="submit" name="botonFiltrar">Buscar</button>
                </div>
            </form>
        </div>

        <p><?= $error ?? ""
            ?></p>
    </div>
    <?php if (empty($productos)) : ?>

        <div class="col-8"><h3>No se ha encontrado ningún producto</h3></div>
    <?php else: ?>
    <div class="container">
        <div class="row">
            <div class="col-4">
            <div><a style="text-decoration: none; color: white" class="btn btn-primary" href="/productos/create"><button class="button-two">
                        <i class="fa fa-plus-circle">
                        </i> Añadir producto</button></a>
            </div>
        <table id="tabla-productos">
            <tr>
                <th>Imagen</th>
                <th>Nombre <a href="/movies?order=title&&tipo=ASC"><i
                            class="fa fa-arrow-down"></i></a>
                    <a href="/movies?order=title&&tipo=DESC"><i
                            class="fa fa-arrow-up"></i></a></th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($productos as $producto) { ?>
                <tr>
                    <td> <?= generar_imagen_local(Producto::IMAGEN_PATH . '/', $producto->getImagen(),
                            $producto->getNombre(), 300, 200) ?> </td>
                    <td><?= $producto->getNombre() ?></td>
                    <td><?= $producto->getCategoria() ?></td>
                    <td><?= $producto->getDescripcion() ?></td>
                    <td><?= $producto->getPrecio()?></td>
                    <td style="width: 140px"><a href="/productos/<?= $producto->getId() ?>/edit">
                            <button type="button" class="button-two"><i class="fa fa-edit"></i> Editar</button>
                        </a>
                        <a href="<?=$router->getUrl("productos_delete", ["id"=>$producto->getId()]) ?>">
                            <button type="button" class="button-two"><i class="fa fa-trash"></i> Borrar</button>
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
            </div>
        </div>
    <?php endif; ?>
</div>
</div>