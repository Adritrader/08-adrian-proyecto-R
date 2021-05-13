<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>Borrar producto</h1>
            <?php if (!empty($errors)) : ?>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <h2>El producto <?= $producto->getNombre() ?> ha sido borrado con éxito</h2>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.row -->
</div>