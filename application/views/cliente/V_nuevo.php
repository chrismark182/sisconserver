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
    <form action="<?= base_url() ?>cliente/crear" method="post">
        <div class="row">
        
            <div class="input-field col s12 m6 l4">
                <select id="t_documento" name="t_documento">
                    <option value="" disabled selected>Escoge una opcion</option>
                    
                    <?php if($tdocumentos): ?>
                    <?php foreach($tdocumentos as $tdocumento): ?> 
                    <tr>
                    <option value="<?= $tdocumento->TIPDOC_N_ID ?>"><?= $tdocumento->TIPDOC_C_DESCRIPCION ?></option>
                    <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$tdocumentos</label>
                </select>
            </div>
            
            <div class="input-field col s12 m6 l4">
                <input id="ndocumento" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">Numero de Documento</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="razon_social" type="text" name="razon_social" class="validate">
                <label class="active" for="razon_social">Razon Social</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="direccion" type="text" name="direccion" class="validate">
                <label class="active" for="direccion">Direccion</label> 
            </div>
            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
