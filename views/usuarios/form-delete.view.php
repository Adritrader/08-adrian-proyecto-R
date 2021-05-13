<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="col-lg-3 col-md-6 my-4">
                <?= generar_imagen_local("/".$avatarPath, $usuario->getAvatar(),
                    $usuario->getNombre() , "rounded w-100") ?>
            </div>
            <h2>Nombre: <?= $usuario->getNombre() ?></h2>
            <h2>Apellidos: <?= $usuario->getApellidos()?></h2>
            <h2>Telefono: <?= $usuario->getTelefono() ?></h2>
            <h3>Email: <?= $usuario->getEmail() ?></h3>
            <h3>Username: <?= $usuario->getUsername() ?></h3>
            <h3>Role: <?= $usuario->getRole() ?></h3>
        </div>
    </div> <!-- /.row -->
<!-- /.container -->
<form action="<?=$router->getUrl("usuarios_destroy") ?>" method="post" novalidate>
    <input type="hidden" name="id" value="<?= $usuario->getId() ?>">
    <div class="form-group text-left">
        <h4>¿Estas seguro que quieres eliminar el usuario " <?= $usuario->getNombre() ?> "?</h4>
        <button type="submit" name="userAnswer" value="yes" class="btn btn-danger btn-lg">Si</button>
        <button type="submit" name="userAnswer" value="no" class="btn btn-info btn-lg">No</button>
    </div>
</form>
</div>



