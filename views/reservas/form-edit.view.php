<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" novalidate>
    <input type="hidden" name="id" value="<?= $registra->getId() ?>">
    <div class="form-group">
        <label for="nombre">Servicio:</label>
        <select class="form-control" name="nombre" id="nombre"
        <?php foreach ($servicios as $servicio): ?>
            <option value="<?=$servicio->getId() ?>"><?=$servicio->getNombre() ?></option>
        <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <select class="form-control" name="hora" id="hora"
        <?php foreach ($horas as $hora): ?>
            <option value="<?=$hora->getId() ?>"><?=$hora->getHora() ?></option>
        <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="fecha">Fecha:</label>
        <input id="fecha" class="form-control" type="date" name="fecha" required>
    </div>
    <div class="form-group text-right">
        <button type="submit" class="btn btn-primary">Reservar</button>
    </div>
</form>