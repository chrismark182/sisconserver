<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
       
        <a href="<?= base_url() ?>clientes" class="breadcrumb">Clientes</a>
        <a href="#!" class="breadcrumb">Editar</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>cliente/<?= $cliente->EMPRES_N_ID ?>/<?= $cliente->CLIENT_N_ID ?>/actualizar" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l3">
                <select id="t_documento" name="t_documento">
                    <option value="" disabled selected>Tipo de documento</option>
                    
                    <?php if($tdocumentos): ?>
                    <?php foreach($tdocumentos as $tdocumento): ?> 
                    <tr>
                    <option value="<?= $tdocumento->TIPDOC_N_ID ?>"><?= $tdocumento->TIPDOC_C_ABREVIATURA ?></option>
                    <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$tdocumentos</label>
                </select>
            </div>
            <div class="input-field col s12 m6 l3">
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" value ="<?= $cliente->CLIENT_C_DOCUMENTO ?>" class="validate">
                <label class="active" for="ndocumento">Numero de documento</label> 
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="razon_social" maxlength="250" type="text" name="razon_social" value ="<?= $cliente->CLIENT_C_RAZON_SOCIAL ?>" class="validate">
                <label class="active" for="razon_social">Razon Social</label> 
            </div>
            <div class="input-field col s12 m6 l12">
                <input id="direccion" maxlength="250" type="text" name="direccion" value ="<?= $cliente->CLIENT_C_DIRECCION ?>" class="validate">
                <label class="active" for="direccion">Direccion</label> 
            </div>
            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
