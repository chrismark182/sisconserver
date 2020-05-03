<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
       
        <a href="<?= base_url() ?>ubicaciones"  class="breadcrumb">Ubicaciones</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>ubicacion/crear" method="post">
        <div class="row">
        
        <div class="input-field col s12 m6 l4">
                <select id="sede" name="sede">
                    <option value="" disabled selected>Escoge una sede</option>
                    
                    <?php if($sedes): ?>
                    <?php foreach($sedes as $sede): ?> 
                    <tr>
                    <option value="<?= $sede->SEDE_N_ID ?>"><?= $sede->SEDE_C_DESCRIPCION ?></option>
                    <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$sedes</label>
                </select>
        </div>

            <div class="input-field col s12 m6 l4">
            <select id="talmacen" name="talmacen">
                    <option value="" disabled selected>Escoge una Ubicacion</option>
                    
                    <?php if($talmacenes): ?>
                    <?php foreach($talmacenes as $talmacen): ?> 
                    <tr>
                    <option value="<?= $talmacen->TIPALM_N_ID ?>"><?= $talmacen->TIPALM_C_DESCRIPCION ?></option>
                    <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$Tipo de Almacen</label>
                </select>
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="descripcion" type="text" name="descripcion" class="validate">
                <label class="active" for="descripcion">Descripcion</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="metro" type="number" min="1" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="metro" class="validate">
                <label class="active" for="metro">Metro Cuadrado</label> 
            </div>
            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
