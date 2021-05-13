<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>Editar Usuario</h1>
            <?php if (!empty($errors) || ($isGetMethod)) : ?>
                <?php if (!empty($errors)) : ?>
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php require __DIR__ . '/usuarios/form-edit-pass.view.php' ?>
            <?php else: ?>
                <h2>El usuario ha sido actualizado correctamente</h2>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.row -->
</div>