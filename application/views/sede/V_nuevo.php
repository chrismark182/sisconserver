<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="<?= base_url() ?>sedes" class="breadcrumb">Sedes</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>sede/crear" method="post">
        <div class="row">        
            <div class="input-field col s12 m6 l4">
                <input id="descripcion" maxlength="100" type="text" name="descripcion" class="validate">
                <label class="active" for="descripcion">Sede</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="direccion" maxlength="200" type="text" name="direccion" class="validate">
                <label class="active" for="direccion">Dirección</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="abreviatura" maxlength="10" type="text" name="abreviatura" class="validate">
                <label class="active" for="abreviatura">Abreviatura</label> 
            </div>
        </div>
        <div class="row">        
            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
