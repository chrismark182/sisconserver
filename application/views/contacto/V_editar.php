<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
       
        <a href="<?= base_url() ?>contactos" class="breadcrumb">Contactos</a>
        <a href="#!" class="breadcrumb">Editar</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <select id="cliente" name="cliente" disabled>
    <option value="" disabled>Cliente </option>

        <?php if($clientes): ?>
        <?php foreach($clientes as $cliente): 
        $selected='';
        if($cliente->CLIENT_N_ID == $contacto->CLIENT_N_ID): 
            $selected='selected';
        endif;
        ?> 

        <option value="<?= $cliente->CLIENT_N_ID ?>" <?= $selected ?>><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
        <?php endforeach; ?> 
        <?php endif; ?>
    <label>$clientes</label>
    </select>
    <form action="<?= base_url() ?>contacto/<?= $contacto->EMPRES_N_ID ?>/<?= $contacto->CLIENT_N_ID ?>/<?= $contacto->CLICON_N_ID ?>/actualizar" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" value ="<?= $contacto->CLICON_C_DOCUMENTO ?>" class="validate">
                <label class="active" for="ndocumento">Numero de documento</label> 
            </div>
            <div class="input-field col s12 m6 l8">
                <input id="nombres" maxlength="100" type="text" name="nombres" value ="<?= $contacto->CLICON_C_NOMBRE ?>" class="validate">
                <label class="active" for="nombres"> Nombre</label> 
            </div>
            
            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
