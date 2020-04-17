<div class="section container center">
    <form action="<?= base_url() ?>cliente/<?= $cliente->EMPRES_N_ID ?>/<?= $cliente->CLIENT_N_ID ?>/actualizar" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">

            <div class="input-field col s12 m6 l4">
                <select id="tdocumento" name="tdocumento">
                    <option value="" disabled selected>Escoge una opcion</option>
                    
                    <?php if($tdocumentos): ?>
                    <?php foreach($tdocumentos as $tdocumento): ?> 
                    <tr>
                    <option value="<?= $cliente->TIPDOC_N_ID ?>"><?= $cliente->TIPDOC_C_DESCRIPCION ?></option>
                    <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$tdocumentos</label>
                </select>
        </div>



            
                <input id="tdocumento" type="text" name="tdocumento" value="<?= $cliente->TIPDOC_N_ID ?>" class="validate">
                <label class="active" for="tdocumento">Numero de Documento</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="metro" type="text" name="metro" value ="<?= $ubicacion->UBICAC_N_M2 ?>" class="validate">
                <label class="active" for="metro">Metros Cuadrados</label> 
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





            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
