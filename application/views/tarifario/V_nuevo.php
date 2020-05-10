<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
       
        <a href="<?= base_url() ?>tarifas" class="breadcrumb">Tarifas</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>tarifa/crear" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l8">
                    <select id="cliente" name="cliente">
                        <option value="" disabled selected>Clientes</option>
                        
                        <?php if($clientes): ?>
                        <?php foreach($clientes as $cliente): ?> 
                        <tr>
                        <option value="<?= $cliente->CLIENT_N_ID ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                        <?php endforeach; ?> 
                        <?php endif; ?>
                        <label>$clientes</label>
                    </select>
            </div>
            <div class="input-field col s6 m6 l4">
                <select id="sede" name="sede">
                    <option value="" disabled selected>Sedes</option>
                    
                    <?php if($sedes): ?>
                    <?php foreach($sedes as $sede): ?> 
                    <tr>
                    <option value="<?= $sede->SEDE_N_ID ?>"><?= $sede->SEDE_C_ABREVIATURA ?></option>
                    <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$sedes</label>
                </select>
            </div>
            <div class="input-field col s6 m6 l5">
                <select id="servicio" name="servicio">
                    <option value="" disabled selected>Servicios</option>
                    
                    <?php if($servicios): ?>
                    <?php foreach($servicios as $servicio): ?> 
                    <tr>
                    <option value="<?= $servicio->SERVIC_N_ID ?>"><?= $servicio->SERVIC_C_DESCRIPCION ?></option>
                    <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$servicios</label>
                </select>
            </div>
            <div class="input-field col s6 m6 l3">
                <select id="moneda" name="moneda">
                    <option value="" disabled selected>Monedas</option>
                    
                    <?php if($monedas): ?>
                    <?php foreach($monedas as $moneda): ?> 
                    <tr>
                    <option value="<?= $moneda->MONEDA_N_ID ?>"><?= $moneda->MONEDA_C_SIMBOLO ?></option>
                    <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$monedas</label>
                </select>
            </div>
            
            
            <div class="input-field col s6 m6 l4">
                <input id="precio" type="number" min="1" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="precio" class="validate">
                <label class="active" for="precio">Precio Unitario</label> 
            </div>
            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>


        
