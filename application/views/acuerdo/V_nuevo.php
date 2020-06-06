<?php $fecha = new DateTime(); ?>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="<?= base_url() ?>acuerdos" class="breadcrumb">Acuerdos de alquiler</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>acuerdo/crear" method="post">
        <div class="row">
            <div class="input-field col s12 m6">
                <input id="id" maxlength="15" type="text" name="id" class="right-align validate" value="<?= $nextId ?>" disabled>
                <label class="active" for="id">ID Alquiler</label> 
            </div>
            <div class="input-field col s12 m6">
                <input id="fecha" type="text" name="fecha" class="datepicker right-align validate" value="<?= $fecha->format('m/d/Y') ?>">
                <label class="active" for="fecha">Fecha</label> 
            </div>    
            <div class="input-field col s12">
                <select id="cliente" name="cliente">
                    <option value="" disabled selected>Escoge una opción</option>
                    <?php foreach ($clientes as $row): ?>
                        <option value="<?= $row->CLIENT_N_ID ?>"><?= $row->CLIENT_C_RAZON_SOCIAL ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Cliente</label>
            </div> 
            <div class="input-field col s12">
                <select id="sede" name="sede">
                    <option value="" disabled selected>Escoge una opción</option>
                    <?php foreach ($sedes as $row): ?>
                        <option value="<?= $row->SEDE_N_ID ?>"><?= $row->SEDE_C_DESCRIPCION ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Sede</label>
            </div> 
            <div class="input-field col s12">
                <select id="ubicacion" name="ubicacion" onchange="obtenerUbicacion()">
                    <option value="" disabled selected>Escoge una opción</option>
                </select>
                <label>Ubicación</label>
            </div> 
            <div class="input-field col s12 m6">
                <input id="tipo_almacen" type="text" name="tipo_almacen" class="validate" disabled>
                <label class="active" for="tipo_almacen">Tipo de Almacén</label> 
            </div>
            <div class="input-field col s12 m6 l6">
                <p>
                    <label>
                        <input type="checkbox" name="facturable" />
                        <span>Facturable</span>
                    </label>
                </p>
            </div>
            <div class="input-field col s12 m6">
                <input id="fecha_inicio" maxlength="15" type="text" name="fecha_inicio" class="right-align datepicker validate" required>
                <label class="active" for="fecha_inicio">Fecha Inicio</label> 
            </div>    
            <div class="input-field col s12 m6">
                <input id="fecha_termino" maxlength="15" type="text" name="fecha_termino" class="right-align datepicker validate" required>
                <label class="active" for="fecha_termino">Fecha Termino</label> 
            </div>   
            <div class="input-field col s12 m6">
                <input id="area" maxlength="15" type="text" name="area" class="right-align" onchange="calcularTotal()">
                <label class="active" for="area">Area M2</label> 
            </div> 
            <div class="input-field col s12 m6">
                <input id="precio" maxlength="15" type="text" name="precio" class="right-align validate" onchange="calcularTotal()">
                <label class="active" for="precio">Precio x M2</label> 
            </div>
            <div class="input-field col s12 m6">
                <select name="moneda">
                    <option value="" disabled selected>Escoge una opción</option>
                    <?php foreach ($monedas as $row): ?>
                        <option value="<?= $row->MONEDA_N_ID ?>"><?= $row->MONEDA_C_DESCRIPCION ?> (<?= $row->MONEDA_C_SIMBOLO ?>)</option>
                    <?php endforeach; ?>
                </select>
                <label>Moneda</label>
            </div>  
            <div class="input-field col s12 m6">
                <input id="total" maxlength="15" type="text" name="total" class="right-align validate" disabled>
                <label class="active" for="total">Total</label> 
            </div>
            <div class="input-field col s12">
                <textarea id="observaciones" name="observaciones" class="materialize-textarea"></textarea>
                <label for="observaciones">Observaciones</label>
            </div>
            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
            
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            format: 'dd/mm/yyyy',
            autoClose: true, 
            setDefaultDate: true
        }
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, options);

        var sede = document.getElementById("sede"); 
        sede.addEventListener("change", ubicaciones, false); 

        M.textareaAutoResize($('#observaciones'));

    });
    function ubicaciones()
    {
        M.toast({html: 'Cargando ubicaciones', classes: 'rounded'});
        $('#ubicacion').html(`<option value="" disabled selected>Cargando ubicaciones...</option>`)
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
        var url =  '<?= base_url() ?>api/ubicacion';
        var data = {empresa: <?= $empresa->EMPRES_N_ID ?>, 
                    sede: document.getElementById("sede").value,
                    ubicacion: 0};
        fetch(url, {
                    method: 'POST', // or 'PUT'
                    body: JSON.stringify(data), // data can be `string` or {object}!
                    headers:{
                        'Content-Type': 'application/json'
                        }
                    })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) 
        {            
            $('#ubicacion').html(`<option value="" disabled selected>Escoge una opción</option>`)
            for (let index = 0; index < data.length; index++) {
                const element = data[index];            
                $('#ubicacion').append(`<option value="${element.UBICAC_N_ID}">${element.UBICAC_C_DESCRIPCION}</option>`)
            }
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
    }
    function obtenerUbicacion()
    {
        console.log('Ubicación')
        M.toast({html: 'Cargando datos de la Ubicación...', classes: 'rounded'});
        var url =  '<?= base_url() ?>api/ubicacion';
        var data = {empresa: <?= $empresa->EMPRES_N_ID ?>, 
                    sede: document.getElementById("sede").value,
                    ubicacion: document.getElementById("ubicacion").value};
        fetch(url, {
                    method: 'POST', // or 'PUT'
                    body: JSON.stringify(data), // data can be `string` or {object}!
                    headers:{
                        'Content-Type': 'application/json'
                        }
                    })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) 
        {
            console.log(data)
            document.getElementById('tipo_almacen').value = data[0].TIPALM_C_DESCRIPCION
            if(data[0].TIPALM_N_ID == 1)
            {
                console.log('techado')
                document.getElementById("area").readOnly = true;
            }
            else if(data[0].TIPALM_N_ID == 2)
            {
                console.log('patio')
                document.getElementById("area").readOnly = false;
            }
            document.getElementById('area').value = data[0].UBICAC_N_M2

            M.updateTextFields();
        });
    }
    function calcularTotal()
    {
        console.log('Total')
        var area = document.getElementById("area").value,
            precio = document.getElementById("precio").value,
            total = parseFloat(area) * parseFloat(precio)
        
        document.getElementById("total").value = total
        console.log(total)
        M.updateTextFields();
    }
</script>
        
