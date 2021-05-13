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
            <?php else: ?>
                <h2>La reserva <?= $reserva->getId() ?> ha sido borrada con éxito</h2>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.row -->
</div>