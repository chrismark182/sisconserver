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

<div class="container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="center-align">ID </th>
                <th class="center-align">RECEPCIÓN</th>
                <th class="left-align">DE</th>
				<th class="left-align">PARA</th>
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
<a class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" href="recepcion_doc/nuevo"><i class="material-icons">add</i></a>


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


		<select id="tipo_documento" required>
			<option value="0">Empresa Para</option>
			<?php foreach ($empresa_para as $row): ?>
				<option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->CLIENT_C_RAZON_SOCIAL ?> </option>
			<?php endforeach; ?>
        </select>

		<select id="tipo_documento" required>
			<option value="0">Contacto Para</option>
			<?php foreach ($contacto_para as $row): ?>
				<option value="<?= $row->CLICON_N_ID?>"> <?= $row->CLICON_C_NOMBRE ?> </option>
			<?php endforeach; ?>
        </select>
    </div>
    <div class="modal-footer">
        <a id="btnConfirmar" href="#!" onclick="reasignaDoc()" class="modal-close waves-effect waves-green btn">MODIFICAR</a>
    </div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		let n = getParameterByName('n');
		if(n != '')
		{
			document.getElementById('n_documento').value = n;
			M.updateTextFields();
			buscar()
		}
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
					
					$situacion = `<p style="color: #1EB635;" onclick="reasignarDoc()"><i class="material-icons" style="cursor: pointer">content_paste</i></p>`;

					$('#resultados').append(`   		
							<tr>
								<td class="center-align">${element.MOVDOC_N_ID}</td>
								<td class="center-align">${element.MOVDOC_C_FECHA_RECEPCION}</td>
								<td class="left-align">${element.RAZON_SOCIAL_DE}</td>
								<td class="left-align">${element.RAZON_SOCIAL_PARA}</td>
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

	buscar();

    function reasignaDoc(){
		alert("Cambiare el destinatario del doc");
		let empresa_para = document.getElementById('empresa_para').value;
		let contacto_recibe = document.getElementById('contacto_recibe').value;

		let url = '<?= base_url() ?>api/execsp';

		let sp = 'ASIGNAR_DOC_UPD';
		
		
		let data = {sp, empresa_para, contacto_recibe};
        
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

	function reasignarDoc(){
		console.log('reasignar documento')
        $('#modalReasignarDoc').modal('open');
	}

</script>

