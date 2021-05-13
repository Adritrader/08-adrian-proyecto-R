<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>Editar Producto</h1>
            <?php if (!empty($errors) || ($isGetMethod)) : ?>
                <?php if (!empty($errors)) : ?>
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php require __DIR__ . '/productos/form-edit.view.php' ?>
            <?php else: ?>
                <h2>El producto ha sido actualizado correctamente</h2>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.row -->
</div>