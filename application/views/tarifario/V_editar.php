<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
       
        <a href="<?= base_url() ?>tarifas" class="breadcrumb">Tarifas</a>
        <a href="#!" class="breadcrumb">Editar</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <div class="row">                   
        <div class="input-field col s6 m6 l4">
            <select id="cliente" name="cliente" disabled>
                <option value="" disabled>Cliente </option>
                    <?php if($clientes): ?>
                    <?php foreach($clientes as $cliente): 
                    $selected='';
                    if($cliente->CLIENT_N_ID == $tarifa->CLIENT_N_ID): 
                        $selected='selected';
                    endif;
                    ?> 
                <option value="<?= $cliente->CLIENT_N_ID ?>" <?= $selected ?>><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                <?php endforeach; ?> 
                <?php endif; ?>
                <label>$clientes</label>
            </select>
        </div>
        <div class="input-field col s6 m6 l4">
            <select id="sede" name="sede" disabled>
                <option value="" disabled>Sede </option>

                    <?php if($sedes): ?>
                    <?php foreach($sedes as $sede): 
                    $selected='';
                    if($sede->SEDE_N_ID == $tarifa->SEDE_N_ID): 
                        $selected='selected';
                    endif;
                    ?> 

                <option value="<?= $sede->SEDE_N_ID ?>" <?= $selected ?>><?= $sede->SEDE_C_DESCRIPCION ?></option>
                <?php endforeach; ?> 
                <?php endif; ?>
                <label>$sedes</label>
            </select>
        </div>
        <div class="input-field col s6 m6 l4">
            <select id="servicio" name="servicio" disabled>
                <option value="" disabled>Servicio </option>

                    <?php if($servicios): ?>
                    <?php foreach($servicios as $servicio): 
                    $selected='';
                    if($servicio->SERVIC_N_ID == $tarifa->SERVIC_N_ID): 
                        $selected='selected';
                    endif;
                    ?> 

                <option value="<?= $servicio->SERVIC_N_ID ?>" <?= $selected ?>><?= $servicio->SERVIC_C_DESCRIPCION ?></option>
                <?php endforeach; ?> 
                <?php endif; ?>
                <label>$servicios</label>
            </select>
        </div>
        
        <form action="<?= base_url() ?>tarifa/<?= $tarifa->EMPRES_N_ID ?>/<?= $tarifa->TARIFA_N_ID ?>/actualizar" method="post">
            <div class="input-field col s6 m6 l4">
                <select id="moneda" name="moneda" >
                    <option value="" disabled>Moneda </option>

                        <?php if($monedas): ?>
                        <?php foreach($monedas as $moneda): 
                        $selected='';
                        if($moneda->MONEDA_N_ID == $tarifa->MONEDA_N_ID): 
                            $selected='selected';
                        endif;
                        ?> 

                    <option value="<?= $moneda->MONEDA_N_ID ?>" <?= $selected ?>><?= $moneda->MONEDA_C_SIMBOLO ?></option>
                    <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$monedas</label>
            </select>
        </div>
                                    
        <div class="input-field col s12 m6 l8">
            <input id="precio" type="number" min="1" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="precio" value ="<?= $tarifa->TARIFA_N_PRECIO_UNIT ?>" class="validate">
            <label class="active" for="precio"> Nombre</label> 
        </div>
        
                                        <div class="input-field col s12">
                                            <input class="btn-small" type="submit" value="Guardar">
                                        </div>
                                    </div>
                                </form>
    </div>
</div>
        
