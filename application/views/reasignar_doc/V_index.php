<?php 
    $fechaDesde = new DateTime();
    $fechaHasta = new DateTime();
?>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Reasignacion de Documentos</a>
        </div>
        <ul id="nav-mobile" class="right">
            <div class="input-field col s6 left-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total Registros: 
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2">0</span>
                    </b>
					
                </div>
            </div>
        </ul>
    </div>
</nav>

<div class="section container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="center-align">ID </th>
                <th class="center-align">RECEPCIÓN</th>
                <th class="left-align">DE</th>
				<th class="left-align">PARA</th>
				<th class="left-align">CONTACTO PARA</th>
				<th class="left-align">DOCUMENTO</th>
				<th class="left-align">NÚMERO</th>
				<th class="center-align">VER ADJUNTO</th>
				<th class="center-align">VENCIMIENTO</th>
				<th class="center-align">SITUACION</th>
            </tr>
        </thead>
        <tbody id="resultados">   
        </tbody>
    </table>
</div>

<!-- Modal Structure -->

<div id="modalUpload" class="modal modal-fixed-footer">
    <div class="modal-content" >
		<h4>Adjuntar archivo</h4>
		<div class="row">
			<input type="hidden" id="id_movimiento">
			<input type="hidden" id="name_file">
			<div class="file-field input-field">
				<div class="btn">
					<span>Archivo</span>
					<input id="archivo" type="file">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
			</div>
		</div>
    </div>
	<div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat" onclick="validarUpload()">Aceptar</a>
    </div>
</div> 


<div id="modalReasignarDoc" class="modal">
    <div class="modal-content">
        <h4>Reasignar Documento</h4>
		<div class="row">

		<input id="documento_id" type="hidden"/>
			<div class="input-field col s12">
				<select id="empresa_para" onchange="buscarContactoCliente()">
					<option value="0" disabled selected >Elige una opción</option>
					<?php foreach ($clientes as $row): ?>
						<option value="<?= $row->CLIENT_N_ID ?>"> <?= $row->CLIENT_C_RAZON_SOCIAL ?> </option>
					<?php endforeach; ?>
				</select>
				<label>Empresa Para</label>
			</div>
			<div class="input-field col s12">
				<select id="contacto_para" required>
					<option value="0" disabled selected >Elige una opción</option>
				</select>
				<label>Contacto Para</label>
			</div>
		</div>
    </div>
    <div class="modal-footer">
        <a id="btnConfirmar" href="#!" onclick="reasignaDoc()" class="modal-close waves-effect waves-green btn">MODIFICAR</a>
    </div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', function() {
	    buscar()
	});

	function buscar(){
		M.toast({html: 'Buscando resultado...', classes: 'rounded'});
		$('.preloader-background').css({'display': 'block'});
		let url = '<?= base_url() ?>api/execsp';

		let sp = 'REASIGNACION_DOC_LIS';
		
		
		let data = {sp};
        
        $('#resultados').html('');
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
			$('#total').html(data.length);
			
			if(data.length > 0)
			{
				M.toast({html: 'Cargando Documentos Recibidos', classes: 'rounded'});
				for (let index = 0; index < data.length; index++) {
					const element = data[index]; 
					let adjunto = `<i class="material-icons tooltipped" style="color: #039be5; cursor: pointer" onclick="modalUpload(${element.MOVDOC_N_ID})">attach_file</i>`;
					
					$situacion = `<p style="color: #1EB635;" onclick="modalReasignar(${element.MOVDOC_N_ID})"><i class="material-icons" style="cursor: pointer">content_paste</i></p>`;

					$('#resultados').append(`   		
							<tr>
								<td class="center-align">${element.MOVDOC_N_ID}</td>
								<td class="center-align">${element.MOVDOC_C_FECHA_RECEPCION}</td>
								<td class="left-align">${element.RAZON_SOCIAL_DE}</td>
								<td class="left-align">${element.RAZON_SOCIAL_PARA}</td>
								<td class="left-align">${element.CLICON_C_NOMBRE}</td>
								<td class="left-align">${element.TIDORE_C_ABREVIATURA}</td>
								<td class="left-align">${element.MOVDOC_C_NUMERO_DOCUMENTO}</td>
								<td class="center-align">${adjunto}</td>
								<td class="center-align">${element.MOVDOC_D_FECHA_VENCIMIENTO}</td>
								<td class="center-align">${$situacion}</td>
							</tr>
					`);
				}
			}
			else{
                M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
            }
            $('.preloader-background').css({'display': 'none'});                            
        });
	}
    function reasignaDoc(){
	
		let url = '<?= base_url() ?>api/execsp';		
		let sp = 'REASIGNAR_DOCUMENTO';
		
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let documento_id = document.getElementById("documento_id").value;
		let empresa_para = document.getElementById('empresa_para').value;
		let contacto_para = document.getElementById('contacto_para').value;
		let usuario = <?= $session->USUARI_N_ID ?>;

		let data = {sp,empresa,documento_id,empresa_para, contacto_para,usuario};
        
        $('#resultados').html('');
        fetch(url, {
                    method: 'POST', // or 'PUT'
                    body: JSON.stringify(data), // data can be `string` or {object}!
                    headers:{
                        'Content-Type': 'application/json'
                        }
                    })
        .then(function(response) {
            return response.json();
		}).then(function(data){
			buscar();                        
		});	

	}

	function modalUpload(id)
	{		
		document.getElementById('id_movimiento').value = id;
		$('#modalUpload').modal('open');
	}

	async function validarUpload()
	{
		await uploadFile('archivo')
		update();
	}

	function update()
	{		
		console.log('actualizando registro')
		let url = '<?= base_url() ?>api/execsp';
		let sp = 'MOVIMIENTO_DOCUMENTO_UPD';				
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let id = document.getElementById('id_movimiento').value;
		let nameFile = document.getElementById("name_file").value;
		let usuario = <?= $session->USUARI_N_ID ?>; 
		let data = {sp, empresa, id, nameFile, usuario};

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
			console.log(data);
			buscar()

			$('.preloader-background').css({'display': 'none'});                            
		});
	}

	function  eliminar($id)
	{
		console.log('confirmar eliminar')
        $('#modalEliminar').modal('open');
        $('#btnConfirmar').attr('href', 'recepcion_doc/'+$id+'/eliminar')
	}

	function modalReasignar($id){
		document.getElementById('documento_id').value = $id
		console.log('reasignar documento');
        $('#modalReasignarDoc').modal('open');
	}
	function buscarContactoCliente()
    {
		M.toast({html: 'Buscando resultado...', classes: 'rounded'});

		let url = '<?= base_url() ?>api/execsp';
		let sp = "CONTACTO_LIS";
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let cliente = parseInt(document.getElementById("empresa_para").value);
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
				$('#contacto_para').html(`<option value="" disabled selected>Elige una opción</option>`)
				if(data.length > 0 ){
					console.log(data)	
					M.toast({html: 'Datos encontrados', classes: 'rounded'});
					for (let index = 0; index < data.length; index++) {
						const element = data[index];				
						$('#contacto_para').append(`<option value="${element.CLICON_N_ID}">${element.CLICON_C_NOMBRE} ${element.CLICON_C_APELLIDOS}</option>`);
					}
				}else{
					M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
				}
				$('select').formSelect();		
				$('.preloader-background').css({'display': 'none'});                            
			});	
    }	
</script>

