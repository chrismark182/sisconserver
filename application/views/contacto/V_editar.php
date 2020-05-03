<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
       
        <a href="<?= base_url() ?>contactos" class="breadcrumb">Contactos</a>
        <a href="#!" class="breadcrumb">Editar</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>contacto/<?= $contacto->EMPRES_N_ID ?>/<?= $contacto->CLIENT_N_ID ?>/<?= $contacto->CLICON_N_ID ?>/actualizar" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <input id="ndocumento" type="text" name="ndocumento" value ="<?= $contacto->CLICON_C_DOCUMENTO ?>" class="validate">
                <label class="active" for="ndocumento">Numero de documento</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="nombres" type="text" name="nombres" value ="<?= $contacto->CLICON_C_NOMBRE ?>" class="validate">
                <label class="active" for="nombres"> Nombre</label> 
            </div>
            
            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
