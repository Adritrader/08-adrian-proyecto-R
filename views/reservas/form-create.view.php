<div class="container-fluid">
        <div class="row fila-formulario">

            <div class="form-style-3 col-4 col-formulario">
                <form action="" method="post" enctype="multipart/form-data" novalidate>
                    <fieldset>
                        <legend>Datos Personales</legend>
                        <input type="hidden" name="USUARIO_id" value="<?= $user->getId() ?>">
                        <label for="field1"><span>Nombre <span class="required">*</span></span><input type="text"
                                                                                                      class="input-field" name="nombre" value="<?= $user->getNombre() ?>"/></label>
                        <label for="field2"><span>Apellido <span class="required">*</span></span><input type="text"
                                                                                                        class="input-field" name="apellido" value="<?= $user->getApellidos()?>" /></label>
                        <label for="field3"><span>Telefono <span class="required">*</span></span><input type="text"
                                                                                                        class="input-field" name="telefono" value="<?= $user->getTelefono()?>" /></label>
                        <label for="field4"><span>Servicio<span class="required">*</span></span>
                            <select name="SERVICIO_id" id="servicio">
                                <?php foreach ($servicios as $servicio): ?>
                                    <option value="<?=$servicio->getId() ?>"><?=$servicio->getNombre() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </fieldset>
                    <fieldset>
                        <legend>Detalles cita</legend>
                        <label for="field6"><span>Fecha <span class="required">*</span></span><input name="fecha_cita" id="fecha"
                                    type="date"></label>
                        <label for="field7"><span>Hora <span class="required">*</span></span>
                            <select name="hora_cita" id="hora">
                                <option value="09:30:00">09:30:00</option>
                                <option value="11:00:00">11:00:00</option>
                                <option value="12:00:00">12:00:00</option>
                                <option value="16:30:00">16:30:00</option>
                                <option value="18:00:00">18:00:00</option>
                                <option value="19:00:00">19:00:00</option>
                            </select></label>
                        <label><span></span><input type="submit" value="Submit" /></label>
                    </fieldset>
                </form>
            </div>

            <div class="row">

            </div>
        </div>
    </div>
</div>
</div>

