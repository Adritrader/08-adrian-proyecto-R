<div class="container">
    <div class="row">
        <div class="col-11">

            <?php


            use App\Entity\Producto;

            $shoppingCart = $_SESSION["shoppingCart"] ?? [];

            if($shoppingCart != []){

                foreach ($shoppingCart as $producto) { ?>

                    <tr><td class="cell"><?= generar_imagen_local(Producto::IMAGEN_PATH . '/', $producto->getImagen(),
                                $producto->getNombre(), 60, 60, 60) ?></td>
                        <td style="font-size: 12px"><?= $producto->getNombre()?></td>
                        <td style="padding: 15px; font-size: 12px"><?= $producto->getPrecio()?>€</td>

                    </tr>
                <?php }
                ?><tr><td><a href="/shopping-cart"><button class="button-two">Checkout</button></td></tr></a><?php
            } ?>

        </div>
    </div>

</div>

