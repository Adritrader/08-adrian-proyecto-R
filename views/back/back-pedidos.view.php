<div class="container-fluid">
    <div class="row fila-inputs-productos">
        <div class="col-4">
            <form method="post" action="<?php use App\Entity\Pedido;
            $_SERVER["PHP_SELF"]; ?>"
                  class="form-inline">
                <div class="form-group">
                    <input name="text" id="text" value="<?= ($_POST["text"]) ?? "" ?>"
                           type="text" placeholder="Buscar" aria-label="Search">
                </div>

                <div class="row">
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="optradio" id="estado" value="estado">&nbsp;Estado
                            &nbsp;
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-inline">
                            <input class="form-check-input" type="radio" name="optradio" id="precio" value="precio">&nbsp;Precio
                            &nbsp;
                        </label></div>
                    <div class="form-check-inline">
                        <label class="form-check-inline">
                            <input class="form-check-input" type="radio" name="optradio" id="both" value="both" checked>&nbsp;Ambos
                            &nbsp;
                        </label>
                    </div></div>
                <div class="row">
                    <div class="form-group">
                        <button style="margin-top: 15px; margin-left: 0px" class="button-four" type="submit" name="botonFiltrar">
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <p><?= $error ?? "" ?></p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <?php if (empty($pedidos)) : ?>
                    <h3>No se ha encontrado ningun pedido</h3>
                <?php else: ?>
                    <div><a style="text-decoration: none; color: white" class="btn btn-primary" href="/reservas/create"><button class="button-two">
                                <i class="fa fa-plus-circle">
                                </i> Añadir reserva</button></a>
                    </div>
                    <table id="tabla-usuarios">
                        <tr>
                            <th>ID</th>
                            <th>Precio</th>
                            <th>Fecha pedido</th>
                            <th>Estado</th>
                            <th>REALIZA_id</th>
                            <th>REALIZA_USUARIO_id</th>
                            <th>Acciones</th>
                        </tr>

                        <?php foreach ($pedidos as $pedido) { ?>
                            <tr>
                                <td><?= $pedido->getId()?></td>
                                <td><?= $pedido->getPrecio() ?></td>
                                <td><?= $pedido->getFechaPedido()->format("Y-m-d")?></td>
                                <td><?= $pedido->getEstado() ?></td>
                                <td><?= $pedido->getREALIZAid() ?></td>
                                <td><?= $pedido->getREALIZAUSUARIOId()?></td>
                                <td><a href="/pedidos/<?= $pedido->getId() ?>/edit">
                                        <button type="button" class="button-two"><i class="fa fa-edit"></i>Editar</button>
                                    </a>
                                    <a href="<?= $router->getUrl("pedido_delete", ["id" => $pedido->getId()]) ?>">
                                        <button type="button" class="button-two"><i class="fa fa-trash"></i>Borrar</button>
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
    </div>
</div>