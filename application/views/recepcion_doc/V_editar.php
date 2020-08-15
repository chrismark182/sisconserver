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

	<input type="hidden" id="<? echo $id  ?>" />

	<div class="row">
		<?php foreach ($list_movimiento_edit as $row): ?>
		<div class="input-field col s12 m6 l8">
			<input value="<?= $row->MOVDOC_C_FECHA_RECEPCION?>" id="fecha" type="text" class="validate" readonly/>
			<label for="fecha">Fecha</label>
		</div>
		<?php endforeach; ?>
    </div>
    <div class="row">
	<?php foreach ($list_movimiento_edit as $row): ?>
		<div class="input-field col s12 m6 l8">
			<input value="<?= $row->RAZON_SOCIAL_DE?>"  id="de" type="text" class="validate" readonly/>
			<label for="de">De</label>
		</div>
	<?php endforeach; ?>
	<?php foreach ($list_movimiento_edit as $row): ?>
		<div class="input-field col s12 m6 l8">
			<input value="<?= $row->MOVDOC_C_NOMBRE_DE ?>" id="nombre_de" type="text" class="validate" readonly/>
			<label for="nombre_de">Nombre</label>
		</div>
	<?php endforeach; ?>
	<?php foreach ($list_movimiento_edit as $row): ?>
		<div class="input-field col s12 m6 l8">
			<input value="<?= $row->RAZON_SOCIAL_PARA ?>" id="para" type="text" class="validate" readonly/>
			<label for="para">Para</label>
		</div>
	<?php endforeach; ?>
	<?php foreach ($list_movimiento_edit as $row): ?>
		<div class="input-field col s12 m6 l8">
			<input value="<?= $row->CLICON_C_NOMBRE ?>" id="persona_contacto" type="text" class="validate" readonly/>
			<label for="persona_contacto">Perona contacto</label>
		</div>
	<?php endforeach; ?>
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
				
	</div>
	<div class="row">
		<div class="input-field col s12 m6 l4">
			<input id="vencimiento" type="text" class="datepicker">
			<label for="vencimiento">Fecha vencimiento</label>
		</div>
    </div>
	<div class="row">
		<input type="hidden" id="name_file">
		<div class="input-field col s12 m6 l3" >
			<img src="<?php ?>"/>
		</div>
		<div class="input-field col s12 m6 l12">
			<textarea id="observaciones" class="materialize-textarea"></textarea>
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
		let
		let tipo_doc = document.getElementById("tipo_doc").value;
		let nro_documento = document.getElementById("nro_documento").value;
		let vencimiento = document.getElementById("vencimiento").value;
		let observaciones = document.getElementById("observaciones").value;

		data = {sp,empresa ,tipo_doc, nro_documento, vencimiento, observaciones};
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
		let observaciones = document.getElementById("observaciones").value;
        let usuario = <?= $this->data['session']->USUARI_N_ID ?>

		let data = {sp, empresa, cliente_de, nombre_de, cliente_para, contacto, tipo_doc, nro_documento, nameFile, observaciones, situacion, usuario};
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
	
	
</script>
