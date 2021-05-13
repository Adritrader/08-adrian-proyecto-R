<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Borrar Usuario</h1>
            <?php if (!empty($errors)) : ?>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <h2>El usuario <?= $usuario->getUsername() ?> ha sido eliminado de forma satisfactoria</h2>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.row -->
</div>