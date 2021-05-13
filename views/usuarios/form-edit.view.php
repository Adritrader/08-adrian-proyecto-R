<form class="form-style-3" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" novalidate>
    <input type="hidden" name="id" value="<?= $usuario->getId() ?>">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input id="nombre" class="form-control" type="text" name="nombre" value="<?= $usuario->getNombre() ?>" required>
    </div>
    <div class="form-group">
        <label for="apellidos">Apellidos:</label>
        <input id="apellidos" class="form-control" type="text" name="apellidos" value="<?= $usuario->getApellidos() ?>" required>
    </div>
    <div class="form-group">
        <label for="telefono">Telefono:</label>
        <input id="telefono" class="form-control" type="text" name="telefono" value="<?= $usuario->getTelefono() ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input id="email" class="form-control" type="email" name="email" value="<?= $usuario->getEmail() ?>" required>
    </div>
    <div class="form-group">
        <label for="username">Username:</label>
        <input id="username" class="form-control" type="text" name="username" value="<?= $usuario->getUsername() ?>" required>
    </div>

    <?php if(!empty($usuario) &&  $usuario->getRole() === "ROLE_ADMIN"):?>
        <div class="form-group">
            <label for="role">Role:
                <select name="role" id="role">
                    <option value="ROLE_USER">ROLE_USER</option>
                    <option value="ROLE_ADMIN">ROLE_ADMIN</option>
                </select></label>
        </div>

    <?php else: ?>

    <?php endif;?>
    <div class="form-group">
        <label for="avatar">Avatar:</label>
        <input id="avatar" class="form-control" type="file" name="avatar" value="<?= $usuario->getAvatar() ?>" required>
    </div>
    <div class="form-group text-right">
        <button type="submit" class="btn btn-primary">Guardar usuario</button>
    </div>
</form>