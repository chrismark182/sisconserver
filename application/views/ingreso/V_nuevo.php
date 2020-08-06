<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Visitantes</a>
        <a href="<?= base_url() ?>ingreso" class="breadcrumb">Ingreso</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container">
	<div class="row">
		<div class="input-field col s12 m6 l4">
			<input placeholder=" " id="fecha" type="text" class="validate" readonly >
			<label for="fecha">Fecha</label>
		</div>
		<div class="input-field col s12 m6 l4">
			<select id="tipo_doc" required>
				<option value="0">Todos</option>
				<?php foreach ($misdoc as $row): ?>
					<option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
				<?php endforeach; ?>
			</select>
			<label for="tipo_doc">Tipo de documentos</label>
		</div>	
		<div class="input-field col s12 m6 l4">
			<input id="documento" type="text" class="validate" onchange="buscar()" onfocusout="buscar()">
			<label for="documento">Documento</label>
		</div>
	</div>
	<div class="row">
		<div class="col s8">
			<div class="input-field col s12" >
				<input type="hidden" id="persona_id">
				<input  id="apellido" type="text" value="" readonly >
				<label class="active" for="apellido">Apellidos</label>
			</div>
			<div class="input-field col s12"  >
				<input class="ancho" id="nombre" type="text" value="" readonly>
				<label class="active" for="nombre">Nombres</label>
			</div>
			<div class="input-field col s12" >
				<input type="hidden" id="cliente_visita_id">
				<input class="ancho" id="empresa" type="text" value="" readonly>
				<label class="active" for="empresa">Empresa</label>
			</div>			
			<div class="input-field col s12">
				<select id="tipo_ingreso" required>
					<option value="0">Elige una opción</option>
					<?php foreach ($tipo_ingreso as $row): ?>
						<option value="<?= $row->EMPRES_N_ID?>">  <?= $row->TIPING_C_DESCRIPCION ?> </option>
					<?php endforeach; ?>
				</select>
				<label>Tipo Ingreso </label>
			</div>

			<div class="input-field col s12  ">
				<select id="motivo" required>
				<option value="0">Elige una opción</option>
					<?php foreach ($motivo_visita as $row): ?>
						<option value="<?= $row->EMPRES_N_ID ?>"><?= $row->MOTVIS_C_DESCRIPCION ?></option>
					<?php endforeach; ?>
				</select>
				<label>Ingreso Como </label>
			</div>

	
			<div class="input-field col s12 ">
				<select id="cliente" onchange="buscarContactoCliente()" required>
					<option value="0">Elige una opción</option>
					<?php foreach ($clientes as $row): ?>
						<option value="<?= $row->CLIENT_N_ID?>"> <?= $row->CLIENT_C_RAZON_SOCIAL?> </option>
					<?php endforeach; ?>
				</select>
				<label>Cliente</label>
			</div>
			<div class="input-field col s12  ">
				<select id="contacto" required>
					<option value="0">Elige una opción</option>				
				</select>
				<label>Persona de Contacto</label>
			</div>
		</div>
		<div class="col s4">
			<img style="width:100%"  src="<?= base_url()?>assets/images/sin-imagen.jpg"/>
			<p id="sctr" ></p>
			<p style="font-weight:bold"  class="center red-text text-darken-4"  id="bloqueado" ></p>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12 m6 l4">
			<input id="remision" type="text">
			<label class="active" for="remision">Guia Remision</label>
		</div>
		<div class="input-field col s12 m6 l4">
			<input id="obra" type="text">
			<label class="active"  for="obra">Obra</label>
		</div>
		<div class="input-field col s12 m6 l4">
			<input id="orden_compra" type="text">
			<label class="active"  for="orden-compra" >Orden de compra</label>
		</div>
		<div class="input-field col s12">
			<textarea id="observaciones" class="materialize-textarea"></textarea>
			<label for="observaciones">Observaciones</label>
        </div>
	</div>
	<div class="input-field col s4">
        <div class="btn-small" id="btnBuscar" onclick="guardar()" >Guardar</div>
    </div>
</div>



<script>
	document.addEventListener('DOMContentLoaded', function() {
		M.updateTextFields();
		mostrarHoraActual();
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
		let cliente = parseInt(document.getElementById("cliente").value);
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
				if(data.length > 0 ){
					console.log(data)	
					M.toast({html: 'Datos encontrados', classes: 'rounded'});
					$('#contacto').html(`<option value="" disabled selected>Elije una opción</option>`)
					for (let index = 0; index < data.length; index++) {
						const element = data[index];
						$('#contacto').append(`<option value="${element.CLICON_N_ID}">${element.CLICON_C_NOMBRE} ${element.CLICON_C_APELLIDOS}</option>`);
					}
					$('select').formSelect();		
				}else{
					M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
				}

				$('.preloader-background').css({'display': 'none'});                            
			});	
	}	
	function guardar()
    {
		M.toast({html: 'Buscando resultado...', classes: 'rounded'});

		let url = '<?= base_url() ?>api/execsp';
		let sp = "MOVIMIENTO_PERSONA_INS";
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let cliente_visitante = parseInt(document.getElementById("cliente_visita_id").value);
		let persona_id = parseInt(document.getElementById("persona_id").value);
		let tipo_ingreso = parseInt(document.getElementById("tipo_ingreso").value);
		let motivo = parseInt(document.getElementById("motivo").value);
		let cliente = parseInt(document.getElementById("cliente").value);
		let contacto = parseInt(document.getElementById("contacto").value);
		let remision = document.getElementById("remision").value;
		let obra = document.getElementById("obra").value;
		let orden_compra = document.getElementById("orden_compra").value;
		let observaciones = document.getElementById("observaciones").value;
		let usuario = <?= $this->data['session']->USUARI_N_ID ?>

		data = {sp, empresa, cliente_visitante, persona_id, tipo_ingreso, motivo, cliente, contacto, remision, obra, orden_compra, observaciones, usuario};
		
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
					window.location.href= "<?= base_url() ?>ingreso?id=" + data[0].ID;                
				}, 1000);
			}else{
				M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
			}

			$('.preloader-background').css({'display': 'none'});                            
		});	
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
</script>



