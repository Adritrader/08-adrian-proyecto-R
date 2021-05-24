<div class="container-fluid"><a style="padding: 20px !important;" href="../<?= $id ?>/show">
    <button type="button" class="btn"><i class="fas fa-chevron-circle-left"></i>Atrás</button>
</a>
<div class="container">
    <div class="row fila-inputs-productos">
        <div class="col-12">
            <form method="post" action="<?php $_SERVER["PHP_SELF"]; ?>"
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
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <button style="margin-top: 15px; margin-left: 0px" class="button-four" type="submit"
                                name="botonFiltrar">
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <p><?= $error ?? "" ?></p>
    </div>
    <div class="container-fluid" >
        <div class="row">
            <?php if (empty($pedidoModel)) : ?>
                <h3>No se ha encontrado ningun pedido</h3>
            <?php else: ?>

            <table style="border: 2px solid black !important; width: 900px; max-height: 800px !important;">
                <tr>
                    <th>Precio</th>
                    <th>Fecha pedido</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>

                <?php foreach ($pedidoModel as $pedido) { ?>
                    <tr>
                        <td style="font-size: 12px !important; padding-left: 30px !important;"><?= $pedido->getPrecio() ?></td>
                        <td style="font-size: 12px !important; padding-left: 65px !important;"><?= $pedido->getFechaPedido()->format("Y-m-d") ?></td>
                        <td style="font-size: 12px !important; padding-left: 90px !important;"><?= $pedido->getEstado() ?></td>
                        <td style="font-size: 12px !important; padding-left: 120px !important;"><a href="/pedidos/<?= $pedido->getId() ?>/edit">
                                <button type="button" class="button-four"><i class="fa fa-edit"></i>Ver Pedido</button>
                            </a>

                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>

        </div>
    </div>

    <nav aria-label="Page navigation example" style="padding: 20px">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php

            for ($i = 1; $i <= $totalPaginas; $i++) {

                ?>
                <li class="page-item"><a class="page-link"
                                         href="<?= $router->getUrl("usuario_pedidos", ["page" => $i]) ?>"><?= $i ?></a>
                </li>
                <?php
            } ?>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>


</div>
</div>
<style>
    footer {

        margin-top: 2250px !important;

    }
</style>