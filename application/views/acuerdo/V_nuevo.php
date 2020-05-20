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
    <form action="<?= base_url() ?>cliente/crear" method="post">
        <div class="row">
            <div class="input-field col s12 m6">
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">ID Alquiler</label> 
            </div>
            <div class="input-field col s12 m6">
                <input id="fecha" type="text" name="fecha" class="datepicker right-align validate" value="<?= $fecha->format('m/d/Y') ?>">
                <label class="active" for="ndocumento">Fecha</label> 
            </div>    
            <div class="input-field col s12">
                <select>
                    <option value="" disabled selected>Escoge una opción</option>
                    <?php foreach ($clientes as $row): ?>
                        <option value="<?= $row->CLIENT_N_ID ?>"><?= $row->CLIENT_C_RAZON_SOCIAL ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Cliente</label>
            </div> 
            <div class="input-field col s12">
                <select id="sede">
                    <option value="" disabled selected>Escoge una opción</option>
                    <?php foreach ($sedes as $row): ?>
                        <option value="<?= $row->SEDE_N_ID ?>"><?= $row->SEDE_C_DESCRIPCION ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Sede</label>
            </div> 
            <div class="input-field col s12">
                <select id="ubicacion">
                    <option value="" disabled selected>Escoge una opción</option>
                </select>
                <label>Ubicación</label>
            </div> 
            <div class="input-field col s12 m6">
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">Tipo de Almacén</label> 
            </div>
            <div class="input-field col s12 m6 l6">
                <p>
                    <label>
                        <input type="checkbox" />
                        <span>Facturable</span>
                    </label>
                </p>
            </div>
            <div class="input-field col s12 m6">
                <input id="fecha" maxlength="15" type="text" name="fecha" class="datepicker validate">
                <label class="active" for="ndocumento">Fecha Inicio</label> 
            </div>    
            <div class="input-field col s12 m6">
                <input id="fecha" maxlength="15" type="text" name="fecha" class="datepicker validate">
                <label class="active" for="ndocumento">Fecha Termino</label> 
            </div>   
            <div class="input-field col s12 m6">
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">Area M2</label> 
            </div> 
            <div class="input-field col s12 m6">
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">Precio x M2</label> 
            </div>
            <div class="input-field col s12 m6">
                <select>
                    <option value="" disabled selected>Escoge una opción</option>
                </select>
                <label>Moneda</label>
            </div>  
            <div class="input-field col s12 m6">
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">Total</label> 
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

        var ubicacion = document.getElementById("ubicacion"); 
        ubicacion.addEventListener("change", ubicacion, false); 
    });
    function ubicaciones()
    {
        var url =  '<?= base_url() ?>api/ubicacion';
        var data = {empresa: <?= $empresa->EMPRES_N_ID ?>, 
                    sede: document.getElementById("sede").value,
                    ubicacion: 0};
        
        console.log(data)
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
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                console.log(element)                
                $('#ubicacion').append(`<option value="${element.UBICAC_N_ID}">${element.UBICAC_C_DESCRIPCION}</option>`)
            }
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
    }
    function ubicacion()
    {
        console.log('Ubicación')
        var url =  '<?= base_url() ?>api/ubicacion';
        var data = {empresa: <?= $empresa->EMPRES_N_ID ?>, 
                    sede: document.getElementById("sede").value,
                    ubicacion: document.getElementById("ubicacion").value};
        
        console.log(data)
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
            
        });
    }
</script>
        
