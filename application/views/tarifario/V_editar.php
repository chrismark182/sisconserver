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
        <div class="input-field col s6 m6 l8 " >
            <input disabled id="cliente" type="text" name="cliente" value ="<?= $tarifa->CLIENT_C_RAZON_SOCIAL ?>" class="validate">
            <label class="active" for="cliente">Cliente</label> 
        </div>
        <div class="input-field col s6 m6 l4">
        <input disabled id="sede" type="text" name="sede" value ="<?= $tarifa->SEDE_C_DESCRIPCION ?>" class="validate">
            <label class="active" for="sede">Sede</label> 
        </div>
        <div class="input-field col s6 m6 l5">
            <input disabled id="servicio" type="text" name="servicio" value ="<?= $tarifa->SERVIC_C_DESCRIPCION ?>" class="validate">
            <label class="active" for="servicio">Servicio</label> 
        </div>
        
        <form action="<?= base_url() ?>tarifa/<?= $tarifa->EMPRES_N_ID ?>/<?= $tarifa->TARIFA_N_ID ?>/actualizar" method="post">
            <div class="input-field col s6 m6 l3">
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
                    
            </select>
            <label>Monedas</label>
        </div>
                                    
        <div class="input-field col s12 m6 l4">
            <input id="precio" type="number" min="1" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="precio" value ="<?= $tarifa->TARIFA_N_PRECIO_UNIT ?>" class="validate">
            <label class="active" for="precio">Precio Unitario</label> 
        </div>
        
                                        <div class="input-field col s12">
                                            <input class="btn-small" type="submit" value="Guardar">
                                        </div>
                                    </div>
                                </form>
    </div>
</div>
        
