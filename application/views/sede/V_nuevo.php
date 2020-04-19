<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Mantenimientos</a>
        <a href="#!" class="breadcrumb">Sedes</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>sede/crear" method="post">
        <div class="row">
        
            <div class="input-field col s12 m6 l4">
                <input id="descripcion" type="text" name="descripcion" class="validate">
                <label class="active" for="descripcion">Descripcion</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="direccion" type="text" name="direccion" class="validate">
                <label class="active" for="direccion">Direccion</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="abreviatura" type="text" name="abreviatura" class="validate">
                <label class="active" for="abreviatura">Abreviatura</label> 
            </div>
            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
