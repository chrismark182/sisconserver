<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        
        <a href="<?= base_url()?>servicios" class="breadcrumb">Servicio</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>servicio/crear" method="post">
        <div class="row">
        
            <div class="input-field col s12 m6 l4">
                <input id="descripcion" maxlength="100" type="text" name="descripcion" class="validate">
                <label class="active" for="descripcion">Descripcion</label> 
            </div>  
            <div class="input-field col s12 m6 l4 left-align">     
                <p>
                    <label>
                        <input id="requiereos" name="requiereos" class="validate" type="checkbox"/>
                        <span>Requiere OS</span>
                    </label>
                </p>
                
                <p>
                    <label>
                        <input id="afectoigv" name="afectoigv" type="checkbox"/>
                        <span>afecto IGV</span>
                    </label>
                </p>
            </div>
            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
