<div class="container-fluid">
    <div class="row fila-ruta">
        <div class="col-5 col-ruta">
            <div><span>Estas aquí: </span><a href="/">Home</a><span><i
                            class="fa fa-caret-right"></i><a href="login"
                                                             class="active">Login</a></span><span></span></div>
        </div>
    </div>
</div>

<div class="row fila-formulario">
                <div class="form-style-3 col-4 col-formulario">
                    <?php
                    if(!empty($message)):?>

                        <div class="alert alert-success" role="alert">
                            <?= $message ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                    <?php endif;
                    ?>
                    <form method="post" novalidate>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control"
                                   name="username" id="username"
                                   value="<?= null ?? "" ?>"
                                   placeholder="Username:" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="text" class="form-control"
                                   name="password" id="password"
                                   value="<?= null ?? "" ?>"
                                   placeholder="Password:" required>
                        </div>
                        <input type="submit" value="Login">
                    </form>
                </div>
            <!-- FORM
            <form method="post" novalidate>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control"
                           name="username" id="username"
                           value="<?= null ?? "" ?>"
                           placeholder="Username:" required>
                </div>
                <div class="form-group">
                    <label for="password">Contrasenya</label>
                    <input type="text" class="form-control"
                           name="password" id="password"
                           value="<?= null ?? "" ?>"
                           placeholder="Password:" required>
                </div>
                <input type="submit" value="Login">
            </form>

            -->
</div>
