
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

                <?php require __DIR__ . '/usuarios/form-delete.view.php' ?>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.row -->
</div>