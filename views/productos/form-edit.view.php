<form class="form-style-3" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" novalidate>
    <fieldset>
    <input type="hidden" name="id" value="<?= $producto->getId() ?>">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input id="nombre" class="form-control" type="text" name="nombre" value="<?= $producto->getNombre() ?>" required>
    </div>
    <div class="form-group">
        <label for="categoria">Categoria</label>
        <select class="form-control" name="categoria" id="categoria">
            <option id="tratamientos">Tratamientos</option>
            <option id="champus">Champús</option>
            <option id="acondicionador">Acondicionador</option>
            <option id="accesorios">Accesorios</option>
        </select>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripcion:</label>
        <textarea id="descripcion" name="descripcion" class="form-control rounded-0" rows="3"><?= $producto->getDescripcion() ?></textarea>
    </div>
    <div class="form-group">
        <label for="precio">Precio:</label>
        <input id="precio" class="form-control" value="<?= $producto->getPrecio() ?>" type="text" name="precio" required>
    </div>
    <div class="form-group">
        <label for="imagen">Imagen:</label>
        <input type="hidden" name="imagen" value="<?= $producto->getImagen() ?>">
        <input id="imagen" class="form-control" type="file" name="imagen" value="<?= $producto->getImagen() ?>" required>
        <small><?= $producto->getImagen() ?></small>
    </div>
    </fieldset>
    <div class="form-group text-right">
        <button type="submit" class="button-two">Guardar</button>
    </div>
</form>