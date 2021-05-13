<form class="form-style-3" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" novalidate>
    <input type="hidden" name="id" value="<?= $usuario->getId() ?>">
    <h1>Cambia la password</h1>


    <div class="form-group">
        <label for="password">Nueva password:</label>
        <input id="password" class="form-control" type="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="repitePassword">Repite Password:</label>
        <input id="repitePassword" class="form-control" type="password" name="repitePassword" required>
    </div>

    <div class="form-group text-right">
        <button type="submit" class="btn btn-primary">Guardar password</button>
    </div>
</form>