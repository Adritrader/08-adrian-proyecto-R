<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>Borrar reserva</h1>
            <?php if (!empty($errors)) : ?>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?else: ?>
                <?php require __DIR__ . '/reservas/form-delete.view.php' ?>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.row -->
</div>