<div class="section container center">
    <form action="<?= base_url() ?>sede/<?= $sede->EMPRES_N_ID ?>/<?= $sede->SEDE_N_ID ?>/actualizar" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <input id="descripcion" type="text" name="descripcion" value="<?= $sede->SEDE_C_DESCRIPCION ?>" class="validate">
                <label class="active" for="descripcion">Descripción</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="direccion" type="text" name="direccion" value="<?= $sede->SEDE_C_DIRECCION ?>" class="validate">
                <label class="active" for="direccion">Direccion</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="abreviatura" type="text" name="abreviatura" value="<?= $sede->SEDE_C_ABREVIATURA ?>" class="validate">
                <label class="active" for="abreviatura">Abreviatura</label> 
            </div>

            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
