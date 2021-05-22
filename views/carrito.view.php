<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-title">

                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table">
                                <tbody>
                                <form action="" method="post" novalidate>


                                    <?php

                                    use App\Entity\Producto;

                                    $shoppingCart = $_SESSION["shoppingCart"] ?? [];


                                    if($shoppingCart != []){

                                        foreach ($shoppingCart as $producto) { ?>
                                        <tr class="mb-2">
                                            <td width="90">
                                                <div class="cart-product-imitation">
                                                    <?= generar_imagen_local("../" . Producto::IMAGEN_PATH, $producto->getImagen(),
                                                        $producto->getNombre(), 60, 60, 60) ?>
                                                </div>
                                            </td>
                                            <td class="desc">
                                                <h3>
                                                    <a href="#" class="text-navy">
                                                        <?= $producto->getNombre()?>
                                                    </a>
                                                </h3>
                                                <p class="small">
                                                    <?= $producto->getDescripcion()?>
                                                </p>


                                                <div class="m-t-sm">
                                                    <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                                                    |
                                                    <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                                </div>
                                            </td>


                                            <td>
                                                <h4>
                                                    <?= $producto->getPrecio()?> €
                                                </h4>
                                            </td>
                                        </tr>


                                        <?php }
                                        ?><?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="ibox-content mt-1">
                        <button type="submit" class="button-three pull-right"><i class="fa fa fa-shopping-cart"></i> Checkout</button>
                        <a href="/tienda"><button class="btn btn-white"><i class="fa fa-arrow-left"></i> Continue shopping</button></a>

                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

