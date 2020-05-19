<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        
        <a href="<?= base_url() ?>ordenes" class="breadcrumb">Orden Servicio</a>
        <a href="#!" class="breadcrumb">Editar</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>ordenservicio/<?= $ordenes->EMPRES_N_ID ?>/<?= $ordenes->SEDE_N_ID ?>/actualizar" method="post">
        <div class="row">        
            <div class="input-field col s12 m6 l6">
                <select id="sede" name="sede" disabled>
                    <option value="" disabled>Sede </option>
                    
                    <?php if($sedes): ?>
                        <?php foreach($sedes as $sede): 
                            $selected='';
                            if($sede->SEDE_N_ID == $ordenes->SEDE_N_ID): 
                                $selected='selected';
                            endif;
                            ?> 
                            <option value="<?= $sede->SEDE_N_ID ?>" <?= $selected ?>><?= $sede->SEDE_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$sede</label>
                </select>
            </div>
            <div class="input-field col s12 m6 l6">
                <select id="cliente" name="cliente">
                    <option value="" disabled selected>Escoge una cliente</option>
                    
                    <?php if($clientes): ?>
                        <?php foreach($clientes as $cliente): ?> 
                            <tr>
                            <option value="<?= $cliente->CLIENT_N_ID ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$clientes</label>
                </select>
            </div>

            <div class="input-field col s12 m6 l6">
                <select id="servicio" name="servicio">
                    <option value="" disabled selected>Escoge un servicio</option>
                    
                    <?php if($servicios): ?>
                        <?php foreach($servicios as $servicio): ?> 
                            <tr>
                            <option value="<?= $servicio->SERVIC_N_ID ?>"><?= $servicio->SERVIC_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$servicios</label>
                </select>
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="solicitante" maxlength="100" type="text" name="solicitante" class="validate">
                <label class="active" for="solicitante">Solicitante</label> 
            </div>

            <div class="input-field col s12 m6 l6">
                <input id="numerofisico" maxlength="10" type="text" name="numerofisico" class="validate">
                <label class="active" for="numerofisico">Número OS Físico</label> 
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="codproyecto" maxlength="20" type="text" name="codproyecto" class="validate">
                <label class="active" for="codproyecto">Código Proyecto</label> 
            </div>

            <div class="input-field col s12 m6 l6">
                <input id="tarifa" maxlength="100" type="text" name="tarifa" readonly="false" class="validate">
                <label class="active" for="tarifa">Tarifa</label> 
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="horas" type="number" min="1" maxlength="2" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="horas" class="validate">
                <label class="active" for="horas">Horas</label> 
            </div>

            <div class="input-field col s12 m6 l6">
                <select id="moneda" name="moneda" enabled="true">
                    <option value="" disabled selected>Escoge una moneda</option>
                    
                    <?php if($monedas): ?>
                        <?php foreach($monedas as $moneda): ?> 
                            <tr>
                            <option value="<?= $moneda->MONEDA_N_ID ?>"><?= $moneda->MONEDA_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$monedas</label>
                </select>
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="preciounitario" type="number" readonly="false" placeholder="1.00" step="0.01" min="1" maxlength="6" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="preciounitario" class="validate">
                <label class="active" for="preciounitario">Precio Unitario</label> 
            </div>

            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
