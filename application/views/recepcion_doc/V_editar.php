<?php $fechaActual = new DateTime(); ?>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Visitantes</a>
        <a href="<?= base_url() ?>recepcion_doc" class="breadcrumb">Recepción de Documentos</a>
        <a href="#!" class="breadcrumb">Editar</a>
      </div>
    </div>
</nav>
<div class="section container">

    <input type="hidden" id="id" value="<?= $id ?>" />

    <div class="row">
        <div class="input-field col s12 m6 l2">
            <input id="fecha" type="text" class="datepicker" value="<?= $movdoc->MOVDOC_C_FECHA_RECEPCION ?>">
            <label for="fecha">Fecha</label>
        </div>
        <div class="input-field col s12 m6 l2">
            <input id="hora" type="text" class="timepicker" value="<?= $movdoc->MOVDOC_C_HORA_RECEPCION ?>">
            <label for="hora">Hora</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12 m6 l4">
            <input value="<?= $movdoc->RAZON_SOCIAL_DE ?>"  id="de" type="text" class="validate" readonly/>
            <label for="de">De</label>
        </div>	
        <div class="input-field col s12 m6 l8">
            <input value="<?= $movdoc->MOVDOC_C_NOMBRE_DE ?>" id="nombre_de" type="text" class="validate" readonly/>
            <label for="nombre_de">Nombre</label>
        </div>
        <div class="input-field col s12 m6 l4">
            <input value="<?= $movdoc->RAZON_SOCIAL_PARA ?>" id="para" type="text" class="validate" readonly/>
            <label for="para">Para</label>
        </div>
        <div class="input-field col s12 m6 l8">
            <input value="<?= $movdoc->CLICON_C_NOMBRE ?>" id="persona_contacto" type="text" class="validate" readonly/>
            <label for="persona_contacto">Perona contacto</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12 m6 l4">
            <select id="tipo_doc" required>
                <option value="0"><?= $movdoc->TIDORE_C_ABREVIATURA ?></option>
                <?php foreach ($tipo_documentos as $row): ?>
                    <option value="<?= $row->TIDORE_N_ID?>"> <?= $row->TIDORE_C_ABREVIATURA ?> </option>
                <?php endforeach; ?>
            </select>
            <label for="tipo_doc">Tipo de documentos</label>
        </div>
        <div class="input-field col s12 m6 l4" >
            <input id="nro_documento" type="text" value="<?= $movdoc->MOVDOC_C_NUMERO_DOCUMENTO?>" >
            <label class="active" for="nro_documento">Nro. Documento</label>
        </div>
        <div class="input-field col s12 m6 l4">
            <input id="vencimiento" type="text" value="<?= $movdoc->MOVDOC_D_FECHA_VENCIMIENTO?>" class="datepicker">
            <label for="vencimiento">Fecha vencimiento</label>
        </div>
        <div class="input-field col s12 m6 l12">
            <textarea id="observaciones" value="<?= $movdoc->MOVDOC_C_OBSERVACIONES?>" class="materialize-textarea"></textarea>
            <label for="observaciones">Observaciones</label>
        </div>
    </div>
    <div class=" left input-field col s4">
        <div class="btn-small" id="btnActualizar" onclick="actualizar()" >Actualizar</div>
    </div>
</div>

<script>

    function actualizar()
    {
        M.toast({html: 'Actualizando informacion...', classes: 'rounded'});
        let url = '<?= base_url() ?>api/execsp';
        let sp = "MOVIMIENTO_DOCUMENTO_EDIT_UPDATE";
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let id  = parseInt(document.getElementById("id").value);
        let tipo_doc = document.getElementById("tipo_doc").value;
        let nro_documento = document.getElementById("nro_documento").value;
        let vencimiento = document.getElementById("vencimiento").value;
        let observaciones = document.getElementById("observaciones").value;

        data = {sp,empresa,id,tipo_doc, nro_documento, vencimiento, observaciones};
        fetch(url, {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(function(response){
            return response.json();
        })
        .then(function(data){
            
            $('.preloader-background').css({'display': 'none'});   
            window.location.href= "<?= base_url() ?>recepcion_doc?id=" + id;                                         
        });	
    }	
    
    
    
    
</script>
