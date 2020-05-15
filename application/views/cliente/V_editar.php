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
                    <option value="" disabled>Tipo de documento </option>
                    
                    <?php if($tdocumentos): ?>
                    <?php foreach($tdocumentos as $tdocumento): 
                        $selected='';
                        if($tdocumento->TIPDOC_N_ID == $cliente->TIPDOC_N_ID): 
                            $selected='selected';
                        endif;
                        ?> 

                    <option value="<?= $tdocumento->TIPDOC_N_ID ?>" <?= $selected ?>><?= $tdocumento->TIPDOC_C_ABREVIATURA ?></option>
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
            <div class="input-field col s12 m6 l4 left-align">       
            <?php   $checked='';
                    
                    if($cliente->CLIENT_C_ESCLIENTE=='1'):
                        $checked='checked';
                         
                     endif; ?>
                <p>
                    <label>
                    <input  <?= $checked ?> id="escliente" name="escliente" class="validate" type="checkbox"/>
                        <span>Es Cliente</span>
                        
                    </label>
                </p>
               <?php  
                $checked='';
                    
                    if($cliente->CLIENT_C_ESPROVEEDOR=='1'):
                        $checked='checked';
                         
                     endif; ?>
                <p>
                    <label>
                        <input <?= $checked ?> id="esproveedor" name="esproveedor" type="checkbox"/>
                        <span>Es proveedor</span>
                    </label>
                </p>
                <?php  
                $checked='';
                    
                    if($cliente->CLIENT_C_ESTRANSPORTISTA=='1'):
                        $checked='checked';
                         
                     endif; ?>
                <p>
                    <label>
                        <input <?= $checked ?> id="estransportista" name="estransportista" type="checkbox"/>
                        <span>Es Transportista</span>
                    </label>
                </p>
             
            </div>
            <div class="input-field col s12 m6 l4">
            <p>
            <?php  $checked='';
                    
                    if($cliente->CLIENT_C_REQUIERE_OC =='1'):
                        $checked='checked';
                         
                     endif; ?>
                    <label>
                        <input <?= $checked ?> id="ordencompra" name="ordencompra" type="checkbox" disabled="disabled"/>
                        <span>Requiere Orden de Compra</span>
                    </label>
                </p>
            </div>
            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>


<script>
        
        // Si se hace click sobre el input de tipo checkbox con id checkb
        $('#escliente').click(function() {
            // Si esta seleccionado (si la propiedad checked es igual a true)
            if ($(this).prop('checked')) {
                // Selecciona cada input que tenga la clase .checar
                $('#ordencompra').prop('disabled', false);
            } else {
                // Deselecciona cada input que tenga la clase .checar
                $('#ordencompra').prop('disabled', true);
            }
        });
    </script>
        
