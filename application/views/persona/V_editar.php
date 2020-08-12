<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="<?= base_url() ?>personas" class="breadcrumb">Personas Visitantes</a>
            <a href="#!" class="breadcrumb">Editar</a>
        </div>
    </div>
</nav>

<div class="section container center">
    <form action="<?= base_url() ?>persona/<?= $cliente->EMPRES_N_ID ?>/<?= $persona->PERSON_N_ID ?>/actualizar" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <select id="cliente" name="cliente" disabled>
                    <option value="" disabled>Empresa</option>
                        
                    <?php if($clientes): ?>
                        <?php foreach($clientes as $cliente): 
                            $selected='';
                            if($tdocumento->TIPDOC_N_ID == $cliente->TIPDOC_N_ID): 
                                $selected='selected';
                            endif;    
                            ?> 
                            <option value="<?= $cliente->CLIENT_N_ID ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Empresas</label>
            </div>

            <div class="input-field col s12 m6 l4">
                <select id="tdocumento" name="tdocumento" disabled>
                    <option value="" disabled>Tipo de Documento </option>
                    
                    <?php if($tdocumentos): ?>
                        <?php foreach($tdocumentos as $tdocumento): 
                            $selected='';
                            if($tdocumento->TIPDOC_N_ID == $cliente->TIPDOC_N_ID): 
                                $selected='selected';
                            endif;
                            ?> 

                            <option value="<?= $tdocumento->TIPDOC_N_ID ?>" <?= $selected ?>><?= $tdocumento->TIPDOC_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Tipo de Documento</label>
            </div>
                        
            <div class="input-field col s12 m6 l4">
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">Número de Documento</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="nombres" maxlength="100" type="text" name="nombres" class="validate">
                <label class="active" for="nombres">Nombres</label> 
            </div>
            <div class="input-field col s12 m6 l8">
                <input id="apellidos" maxlength="100" type="text" name="apellidos" class="validate">
                <label class="active" for="apellidos">Apellidos</label> 
            </div>
        
            <div class="input-field col s12 m6 l4">
                <input id="scrt_ini" type="text" value="" class="datepicker">
                <label class="active" for="scrt_ini">SCTR Inicio</label> 
            </div>
            
            <div class="input-field col s12 m6 l4">
                <input id="scrt_fin" type="text" value="" class="datepicker">
                <label class="active" for="scrt_fin">SCTR Vencimiento</label> 
            </div>

            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>


<script>

</script>
        
