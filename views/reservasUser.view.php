<a style="padding: 20px !important;" href="../<?=$id?>/show">
    <button type="button" class="btn"><i class="fas fa-chevron-circle-left"></i>Atrás</button>
</a>
<div class="container-fluid" style="padding: 50px !important;">
    <div class="row fila-inputs-productos">
        <p><?= $error ?? "" ?></p>
                <?php if (empty($registra)) : ?>
                    <h3>No se ha encontrado ninguna reserva</h3>
                <?php else: ?>

                    </div>
                    <table style="border: 2px solid black !important; width: 680px">
                        <tr>

                            <th>Servicio</th>
                            <th>Hora</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>

                        <?php foreach ($registra as $reserva) {
                            ?>
                            <tr>

                                <td><?php $servicio = $registraModel->getServicio($reserva->getServicioId());
                                    echo $servicio->getNombre()?></td>
                                <td><?= $reserva->getHoraCita()->format("H:i:s"); ?></td>
                                <td><?= $reserva->getFechaCita()->format("Y-m-d"); ?></td>
                                <td style="padding-left: 50px !important;"><a href="/reservas/<?= $reserva->getId(); ?>/edit">
                                        <button type="button" class="button-four"><i class="fa fa-edit"></i>Editar</button>
                                    </a>
                                    <a href="<?= $router->getUrl("reservas_delete", ["id" => $reserva->getId()]) ?>">
                                        <button type="button" class="button-four"><i class="fa fa-trash"></i>Borrar</button>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                <?php endif; ?>
        </div>
    </div>
