<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Mantenimientos</a>
        <a href="#!" class="breadcrumb">Ubicaciones</a>
        <a href="#!" class="breadcrumb">Editar</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>ubicacion/<?= $ubicacion->EMPRES_N_ID ?>/<?= $ubicacion->SEDE_N_ID ?>/<?= $ubicacion->UBICAC_N_ID ?>/actualizar" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <input id="descripcion" type="text" name="descripcion" value="<?= $ubicacion->UBICAC_C_DESCRIPCION ?>" class="validate">
                <label class="active" for="descripcion">Descripción</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="metro" type="number" name="metro" value ="<?= $ubicacion->UBICAC_N_M2 ?>" class="validate">
                <label class="active" for="metro">Metros Cuadrados</label> 
            </div>
            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
