<div class="section container center">
    <form action="<?= base_url() ?>servicio/<?= $servicio->EMPRES_N_ID ?>/<?= $servicio->SERVIC_N_ID ?>/actualizar" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <input id="descripcion" type="text" name="descripcion" value="<?= $servicio->SERVIC_C_DESCRIPCION ?>" class="validate">
                <label class="active" for="descripcion">Descripción</label> 
            </div>

            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
