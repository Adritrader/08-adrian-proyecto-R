<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-6 my-4">
            <?= generar_imagen_local("/".$productosPath, $producto->getImagen(),
                $producto->getNombre() , "rounded w-100") ?>
        </div>
        <div class="col-lg-9 col-md-6 my-5">
            <h1><?= $producto->getNombre() ?></h1>
            <p class="text-muted"><?= $producto->getCategoria()?></p>
            <h2><em><?= $producto->getDescripcion() ?>.</em></h2>
            <h5 class="text-muted">Precio</h5>
            <p><?= $producto->getPrecio() ?></p>
        </div>
    </div>
<form action="<?=$router->getUrl("productos_destroy") ?>" method="post" novalidate>
    <input type="hidden" name="id" value="<?= $producto->getId() ?>">
    <div class="form-group text-left">
        <h4>¿Estas seguro que quieres eliminar el producto " <?= $producto->getNombre() ?> "?</h4>
        <button type="submit" name="userAnswer" value="yes" class="btn btn-danger btn-lg">Si</button>
        <button type="submit" name="userAnswer" value="no" class="btn btn-info btn-lg">No</button>
    </div>
</form>
</div>


