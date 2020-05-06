<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
       
        <a href="<?= base_url() ?>clientes" class="breadcrumb">Clientes</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>cliente/crear" method="post">
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
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">Numero de Documento</label> 
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="razon_social" maxlength="250" type="text" name="razon_social" class="validate">
                <label class="active" for="razon_social">Razon Social</label> 
            </div>
            <div class="input-field col s12 m6 l12">
                <input id="direccion" maxlength="250" type="text" name="direccion" class="validate">
                <label class="active" for="direccion">Direccion</label> 
            </div>
            <div class="input-field col s12 m6 l4 left-align">       
                <p>
                    <label>
                        <input id="escliente" name="escliente" class="validate" type="checkbox"/>
                        <span>Es Cliente</span>
                    </label>
                </p>
                
                <p>
                    <label>
                        <input id="esproveedor" name="esproveedor" type="checkbox"/>
                        <span>Es proveedor</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input id="estransportista" name="estransportista" type="checkbox"/>
                        <span>Es Transportista</span>
                    </label>
                </p>
             
            </div>
            <div class="input-field col s12 m6 l4">
            <p>
                    <label>
                        <input  id="ordencompra" name="ordencompra" type="checkbox" disabled="disabled"/>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
        
