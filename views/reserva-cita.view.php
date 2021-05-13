<div class="container-fluid">
    <div class="row titulo-formulario">
        <div class="col-5">
            <h1>Reserva una cita</h1>
        </div>


        <div class="row fila-formulario">
            <div class="form-style-3 col-4 col-formulario">
                <form action="" method="post">
                    <fieldset>
                        <legend>Datos Personales</legend>
                        <label for="field1"><span>Nombre <span class="required">*</span></span><input type="text"
                                                                                                      class="input-field" name="field1" value="" /></label>
                        <label for="field2"><span>Apellido <span class="required">*</span></span><input type="text"
                                                                                                        class="input-field" name="field2" value="" /></label>
                        <label for="field3"><span>Telefono <span class="required">*</span></span><input type="text"
                                                                                                        class="input-field" name="field3" value="" /></label>
                        <label for="field4"><span>Servicio<span class="required">*</span></span>
                            <select name="servicios" id="servicios">
                                <?php foreach ($servicios as $servicio): ?>
                                    <option value="<?=$servicio->getId() ?>"><?=$servicio->getNombre() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </fieldset>
                    <fieldset>
                        <legend>Detalles cita</legend>
                        <label for="field6"><span>Fecha <span class="required">*</span></span><input
                                type="date"></label>
                        <label for="field7"><span>Hora <span class="required">*</span></span>
                            <select name="servicios" id="servicios">
                                <option value="1">09:30</option>
                                <option value="2">11:00</option>
                                <option value="3">12:00</option>
                                <option value="4">16:30</option>
                                <option value="5">18:00</option>
                                <option value="6">19:00</option>
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

