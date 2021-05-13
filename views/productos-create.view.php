<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>Nuevo Producto</h1>
            <?php if (!empty($errors)) : ?>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php require __DIR__ . '/productos/form-create.view.php' ?>
            <?php else: ?>
                <h2>El producto se ha insertado correctamente</h2>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.row -->
</div>