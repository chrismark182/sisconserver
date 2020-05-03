<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        
        <a href="<?= base_url() ?>contactos" class="breadcrumb">Contactos</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>contacto/crear" method="post">
        <div class="row">
        
            <div class="input-field col s12 m6 l4">
                    <select id="cliente" name="cliente">
                        <option value="" disabled selected>Cliente</option>
                        
                        <?php if($clientes): ?>
                        <?php foreach($clientes as $cliente): ?> 
                        <tr>
                        <option value="<?= $cliente->CLIENT_N_ID ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                        <?php endforeach; ?> 
                        <?php endif; ?>
                        <label>$clientes</label>
                    </select>
            </div>

            <div class="input-field col s12 m6 l4">
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
            <div class="input-field col s12 m6 l4">
                <input id="ndocumento" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">Numero de Documento</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="nombres" type="text" name="nombres" class="validate">
                <label class="active" for="nombres">Nombres</label> 
            </div>
            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
