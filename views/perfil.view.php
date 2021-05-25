<?php

use App\Entity\Usuario;

?>
<!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/public/css/perfil.css">


<div class="container">
    <h1>Perfil de usuario</h1>
    <div class="row d-flex justify-content-center">


    </div>
    <div class="row py-2 px-2 mx-2">
        <div class="col-12">
            <a href="/perfil/<?= $user->getId() ?>/verReservas"><button class="myButton"><i class="fa fa-edit mr-1"></i>Ver Reservas</button></a>
            <a href="/perfil/<?= $user->getId() ?>/verPedidos"><button class="myButton"><i class="fa fa-edit mr-1"></i>Ver Pedidos</button></a>
        </div>

        <?php
        if(!empty($message)):?>

            <div class="alert alerta-login" role="alert">
                <?= $message ?>

            </div>
        <?php endif;
        ?>

        <div class="card col-lg-9 col-md-6 py-2">
            <div class="card col-lg-3 col-md-6 py-2">
                <?= generar_imagen_local('/' . Usuario::AVATAR_PATH, $user->getAvatar(),
                    $user->getUsername(), 300,200) ?>
            </div>
            <input type="hidden" name="id" value="<?= $user->getId() ?>">
            <h2><strong>Nombre:</strong> <?= $user->getNombre()?></h2>
            <h2><strong>Apellidos:</strong> <?= $user->getApellidos()?></h2>
            <h2 class="card-title"><strong>Username:</strong><?= $user->getUsername()?></h2>
            <h2 class="text-muted mt-2"><strong>Email:</strong><?= $user->getEmail()?></h2>
            <h2><strong>Teléfono:</strong> <?= $user->getTelefono()?></h2>

        </div>


        <div class="col-12">
            <a href="/usuarios/<?= $user->getId() ?>/editPerfil"><button class="button-five"><i class="fa fa-edit mr-1"></i>Editar</button></a>
            <a href="/usuarios/<?= $user->getId() ?>/editPass"><button class="button-five"><i class="fa fa-edit mr-1"></i>Cambiar Password</button></a>
        </div>
        </div>
    </div>
</div>