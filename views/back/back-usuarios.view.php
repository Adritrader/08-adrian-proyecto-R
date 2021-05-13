<?php

use App\Entity\Usuario;

?>
<div class="container-fluid">
    <div class="row fila-inputs-productos">
        <div class="col-4">
            <form method="post" action="<?= $router->getUrl("usuario_filter")?>"
                  class="form-inline">
                <div class="form-group">
                    <input name="text" id="text" value="<?= ($_POST["text"]) ?? "" ?>"
                           type="text" placeholder="Buscar" aria-label="Search">
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="optradio" id="nombre" value="username">&nbsp;Username
                        &nbsp;
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-inline">
                        <input class="form-check-input" type="radio" name="optradio" id="email" value="email">&nbsp;Email
                        &nbsp;
                    </label></div>
                <div class="form-check-inline">
                    <label class="form-check-inline">
                        <input class="form-check-input" type="radio" name="optradio" id="both" value="both" checked>&nbsp;Ambos
                        &nbsp;
                    </label>
                </div>
                <div class="form-group">
                    <button style="margin-top: 15px; margin-left: 0px" class="button-four" type="submit" name="botonFiltrar">
                        Buscar
                    </button>
                </div>
            </form>
        </div>
        <p><?= $error ?? "" ?></p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-4">
    <?php if (empty($usuarios)) : ?>
        <h3>No se ha encontrado ningún usuario</h3>
    <?php else: ?>


        <table id="tabla-usuarios">
            <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Username</th>
                <th>Roles</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($usuarios as $usuario) { ?>
                <tr>
                    <td><?= $usuario->getId() ?></td>
                    <td><?= generar_imagen_local('/' . Usuario::AVATAR_PATH . '/', $usuario->getAvatar(),
                            $usuario->getUsername(), 150, 150) ?></td>
                    <td><?= $usuario->getNombre() ?></td>
                    <td><?= $usuario->getApellidos() ?></td>
                    <td><?= $usuario->getTelefono() ?></td>
                    <td><?= $usuario->getEmail() ?></td>
                    <td><?= $usuario->getUsername() ?></td>
                    <td><?= $usuario->getRole() ?></td>
                    <td><a href="/usuarios/<?= $usuario->getId() ?>/edit">
                            <button type="button" class="button-two"><i class="fa fa-edit"></i>Editar</button>
                        </a>
                        <a href="<?= $router->getUrl("usuarios_delete", ["id" => $usuario->getId()]) ?>">
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