<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>Nuevo Usuario</h1>
            <?php if (!empty($errors)) : ?>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php require __DIR__ . '/usuarios/form-create.view.php' ?>
            <?php else: ?>
                <h2>El usuario se ha guardado correctamente</h2>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.row -->
</div>