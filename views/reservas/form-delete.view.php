<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-6 my-5">
            <h1><?=$servicio->getNombre() ?></h1>
            <p class="text-muted"><?= $registra->getHora()?></p>
            <h2><em><?= $registra->getFecha() ?>.</em></h2>
        </div>
    </div> <!-- /.row -->
</div> <!-- /.container -->
<form action="<?=$registra->getUrl("reserva_destroy") ?>" method="post" novalidate>
    <input type="hidden" name="id" value="<?= $registra->getId() ?>">
    <div class="form-group text-left">
        <h4>¿Estas seguro que quieres eliminar la reserva " <?= $registra->getNombre() ?> "?</h4>
        <button type="submit" name="userAnswer" value="yes" class="btn btn-danger btn-lg">Si</button>
        <button type="submit" name="userAnswer" value="no" class="btn btn-info btn-lg">No</button>
    </div>
</form>
<br><br>


