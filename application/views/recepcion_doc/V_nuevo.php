<?php $fechaActual = new DateTime(); ?>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Visitantes</a>
        <a href="<?= base_url() ?>recepcion_doc" class="breadcrumb">Recepción de Documentos</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container">
	<div class="row">
		<div class="input-field col s12 m6 l2">
			<input id="fecha" type="text" class="datepicker" value="<?= $fechaActual->format('m/d/Y') ?>">
			<label for="fecha">Fecha</label>
		</div>
        <div class="input-field col s12 m6 l2">
			<input id="hora" type="text" class="timepicker" value="<?= $fechaActual->format('H:i') ?>">
			<label for="hora">Hora</label>
		</div>
    </div>
    <div class="row">
        <div class="input-field col s12 m6 l4">
            <select id="cliente_de" required>
                <option value="0">Elige una opción</option>
                <?php foreach ($entidades as $row): ?>
                    <option value="<?= $row->CLIENT_N_ID?>"> <?= $row->CLIENT_C_RAZON_SOCIAL?> </option>
                <?php endforeach; ?>
            </select>
            <label>De</label>
        </div>
		<div class="input-field col s12 m6 l8">
			<input id="nombre_de" type="text" class="validate">
			<label for="nombre_de">Nombre</label>
		</div>
    </div>
    <div class="row">
        <div class="input-field col s12 m6 l4">
            <select id="cliente_para" onchange="buscarContactoCliente()" required>
                <option value="0">Elige una opción</option>
                <?php foreach ($clientes as $row): ?>
                    <option value="<?= $row->CLIENT_N_ID?>"> <?= $row->CLIENT_C_RAZON_SOCIAL?> </option>
                <?php endforeach; ?>
            </select>
            <label>Para</label>
        </div>
        <div class="input-field col s12 m6 l8">
            <select id="contacto" required>
                <option value="0">Elige una opción</option>				
            </select>
            <label>Persona de Contacto</label>
        </div>
    </div>
    <div class="row">
		<div class="input-field col s12 m6 l4">
			<select id="tipo_doc" required>
				<option value="0">Elige una opción</option>
				<?php foreach ($tipo_documentos as $row): ?>
					<option value="<?= $row->TIDORE_N_ID?>"> <?= $row->TIDORE_C_ABREVIATURA ?> </option>
				<?php endforeach; ?>
			</select>
			<label for="tipo_doc">Tipo de documentos</label>
		</div>
        <div class="input-field col s12 m6 l3" >
            <input id="nro_documento" type="text" value="" >
            <label class="active" for="nro_documento">Nro. Documento</label>
        </div>
        <input type="hidden" id="name_file">
        <div class="file-field input-field col s12 m6 l5">
            <div class="btn">
                <span>Archivo</span>
                <input id="archivo" type="file">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
        </div>
        <div class="input-field col s12 m6 l4">
			<input id="vencimiento" type="text" class="datepicker">
			<label for="vencimiento">Fecha vencimiento</label>
		</div>
        <div class="input-field col s12 m6 l8">
			<textarea id="observaciones" class="materialize-textarea"></textarea>
			<label for="observaciones">Observaciones</label>
        </div>
	</div>
	<div class="input-field col s4">
        <div class="btn-small" id="btnBuscar" onclick="validarUpload()" >Guardar</div>
    </div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		M.updateTextFields();
        var options = {
            twelveHour: false, 
            defaultTime: 'now'
        }
        var elems = document.querySelectorAll('.timepicker');
        var instances = M.Timepicker.init(elems, options);
	});

	function buscar()
    {
		M.toast({html: 'Buscando resultado...', classes: 'rounded'});
		let url = '<?= base_url() ?>api/execsp';
		let sp = "VISITANTE_NUEVO_LIS";
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let tipo_doc = document.getElementById("tipo_doc").value;
		let documento = document.getElementById("documento").value;

		data = {sp, empresa, tipo_doc, documento};
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
			if(data.length > 0 ){

				if(data[0].CANTIDAD_BLOQUEOS > 0){
					document.getElementById('bloqueado').innerHTML = 'BLOQUEADO';
				}
				console.log(data);
				document.getElementById('cliente_visita_id').value = data[0].CLIENT_N_ID;					
				document.getElementById('persona_id').value = data[0].PERSON_N_ID;	
				document.getElementById('nombre').value = data[0].PERSON_C_NOMBRE;
				document.getElementById('apellido').value = data[0].PERSON_C_APELLIDOS;
				document.getElementById('empresa').value = data[0].CLIENT_C_RAZON_SOCIAL;
				M.updateTextFields();
			}else{
				M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
			}

			$('.preloader-background').css({'display': 'none'});                            
		});	
	}	
	
	function buscarContactoCliente()
    {
		M.toast({html: 'Buscando resultado...', classes: 'rounded'});

		let url = '<?= base_url() ?>api/execsp';
		let sp = "CONTACTO_LIS";
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let cliente = parseInt(document.getElementById("cliente_para").value);
		let contacto = 0;
		let razon_social = '%';
		let ndocumento = '%';
		let nombres = '%';
		let apellidos = '%';

		data = {sp, empresa, cliente, contacto, razon_social, ndocumento, nombres, apellidos};
		
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
				$('#contacto').html(`<option value="" disabled selected>Elige una opción</option>`)
				if(data.length > 0 ){
					console.log(data)	
					M.toast({html: 'Datos encontrados', classes: 'rounded'});
					for (let index = 0; index < data.length; index++) {
						const element = data[index];				
						$('#contacto').append(`<option value="${element.CLICON_N_ID}">${element.CLICON_C_NOMBRE} ${element.CLICON_C_APELLIDOS}</option>`);
					}
				}else{
					M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
				}
				$('select').formSelect();		
				$('.preloader-background').css({'display': 'none'});                            
			});	
    }	

    async function validarUpload()
    {
        if(archivo.value != ''){
			await uploadFile('archivo')
			guardar();
        }else{
            guardar();
        }
    }

	function guardar()
    {
        M.toast({html: 'Grabando...', classes: 'rounded'});         
        let archivo = document.getElementById('archivo');
        let situacion = '0';
        if(archivo.value != ''){
            situacion = '1';
        }
		let url = '<?= base_url() ?>api/execsp';
		let sp = "MOVIMIENTO_DOCUMENTO_INS";
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let cliente_de = parseInt(document.getElementById("cliente_de").value);
        let nombre_de = document.getElementById("nombre_de").value;
        let cliente_para = parseInt(document.getElementById("cliente_para").value);
		let contacto = parseInt(document.getElementById("contacto").value);
		let tipo_doc = parseInt(document.getElementById("tipo_doc").value);
		let nro_documento = document.getElementById("nro_documento").value;
        let nameFile = document.getElementById("name_file").value;
		let vencimiento = document.getElementById("vencimiento").value;
		let observaciones = document.getElementById("observaciones").value;
        let usuario = <?= $this->data['session']->USUARI_N_ID ?>

		let data = {sp, empresa, cliente_de, nombre_de, cliente_para, contacto, tipo_doc, nro_documento, nameFile, vencimiento, observaciones, situacion, usuario};
		if(contacto != 0)
		{
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
				if(data.length > 0 ){
					console.log(data);
					setTimeout(() => {
						window.location.href= "<?= base_url() ?>recepcion_doc?id=" + data[0].ID;                
					}, 1000);
				}else{
					M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
				}
	
				$('.preloader-background').css({'display': 'none'});                            
			});	
		}else{
			M.toast({html: 'Debe llenar todos los campos', classes: 'rounded'});
		}
	}	
	
	function mostrarHoraActual()
	{
		// console.log(horaActual());
		document.getElementById("fecha").value = horaActual();
		//document.getElementById('numero_documento').value = horaActual();
		setTimeout(() => {
			mostrarHoraActual();
		}, 1000);
    }
    
    function sleep(miliseconds) {
        var currentTime = new Date().getTime();

        while (currentTime + miliseconds >= new Date().getTime()) {
        }
    }
</script>



