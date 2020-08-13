<?php 
    $fechaDesde = new DateTime();
    $fechaHasta = new DateTime();
?>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Recepción de documentos</a>
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
<div class="section container center" style="padding-top: 0px">
    <div class="row" style="margin-bottom: 0px">
        <form action="<?= base_url() ?>clientes" method="post">
			<div class="input-field col s12 m6 l4">
                <input id="desde" type="text" value="<?= $fechaDesde->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="desde">Desde</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="hasta" type="text" value="<?= $fechaHasta->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="hasta">Hasta</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="empresa_de" maxlength="200" type="text">
                <label class="active" for="empresa_de">Empresa de</label> 
            </div>
			<div class="input-field col s12 m6 l4">
                <input id="empresa_para" maxlength="200" type="text">
                <label class="active" for="empresa_de">Empresa para</label> 
            </div>

			<div class="input-field col s12 m6 l4">
                <input id="nombre_de" maxlength="200" type="text">
                <label class="active" for="nombre_de">Nombre de</label> 
            </div>

			<div class="input-field col s12 m6 l4">
                <input id="contacto_recibe" maxlength="200" type="text">
                <label class="active" for="contacto_recibe">Contacto que recibe</label> 
            </div>
			
			<div class="input-field col s12 m6 l4">
                <input id="numero_doc_recibido" maxlength="200" type="text">
                <label class="active" for="numero_doc_recibido">NUmero Documento recibido</label> 
            </div>

			<div class="input-field col s12 m6 l4">
                <input id="situacion" maxlength="200" type="text">
                <label class="active" for="situacion">Situacion</label> 
            </div>
			

            <div class="input-field col s4">
                <div class="btn-small" id="btnBuscar" onclick="buscar()" >Buscar</div>
            </div>
        </form>
    </div>    
</div> 

<div class="container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="left-align">ID </th>
                <th class="left-align">Fecha de recepción</th>
                <th class="left-align">Empresa De</th>
				<th class="left-align">Empresa Para</th>
				<th class="left-align">Tipo de documento</th>
				<th class="left-align">Número documento</th>
				<th class="center-align">Escaneo Adjunto</th>
				<th class="left-align">Fecha Vencimiento</th>
				<th class="left-align">Situacion</th>
				<th class="left-align">Eliminar</th>          
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


<div id="modalEliminar" class="modal">
    <div class="modal-content">
        <h4>Eliminar</h4>
        <p>¿Está seguro que desea elimniar el registro?</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
        <a id="btnConfirmar" href="#!" class="modal-close waves-effect waves-green btn">ACEPTAR</a>
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
		buscar()
	});
	function buscar(){

		$('.preloader-background').css({'display': 'block'});
		let url = '<?= base_url() ?>api/execsp';

		let sp = 'MOVIMIENTO_DOCUMENTO_LIS';
		
		let fecha_desde = $('#desde').val();
			fecha_desde = fecha_desde.split('/');
		let desde = fecha_desde[2] + fecha_desde[1] + fecha_desde[0] ;
		console.log(fecha_desde[0]);
		
		let fecha_hasta = $('#hasta').val();
			fecha_hasta = fecha_hasta.split('/');
		let hasta = fecha_hasta[2] + fecha_hasta[1] + fecha_hasta[0];

		console.log(desde);
		let empresa_de = '%';
		if(document.getElementById('empresa_de').value != ''){
			empresa_de = document.getElementById('empresa_de').value + '%';
		}
		let empresa_para = '%';
		if(document.getElementById('empresa_para').value != ''){
			empresa_para = document.getElementById('empresa_para').value + '%';
		}

		let nombre_de = '%';
		if(document.getElementById('nombre_de').value != ''){
			nombre_de = '%' + document.getElementById('nombre_de').value + '%';
		}

		let contacto_recibe = '%';
		if(document.getElementById('contacto_recibe').value != ''){
			contacto_recibe = '%' + document.getElementById('contacto_recibe').value + '%';
		}

		let numero_doc_recibido = '%';
		if(document.getElementById('numero_doc_recibido').value != ''){
			numero_doc_recibido = '%' + document.getElementById('numero_doc_recibido').value + '%';
		}

		let situacion = '%';
		if(document.getElementById('situacion').value != ''){
			situacion = document.getElementById('situacion').value ;
		}
		
		
		let data = {sp, desde, hasta, empresa_de, empresa_para, nombre_de , contacto_recibe, numero_doc_recibido,situacion};
        
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
				for (let index = 0; index < data.length; index++) {
					const element = data[index]; 
					let adjunto = `<i class="material-icons tooltipped" style="color: #039be5; cursor: pointer" onclick="modalUpload(${element.MOVDOC_N_ID})">attach_file</i>`;
					if(element.MOVDOC_C_SITUACION == '1')
					{
						adjunto = `<a href="<?= base_url() ?>uploads/${element.MOVDOC_C_FOTO}" target="_blank"><i class="material-icons tooltipped" style="color: #039be5; cursor: pointer">attachment</i></a>`;
					}

					if( element.MOVDOC_C_SITUACION  == '0' ||  element.MOVDOC_C_SITUACION  == '1'  ){
						$eliminar = `<span style="cursor:pointer; color:#039be5" class="material-icons" onclick="eliminar(${element.MOVDOC_N_ID})">delete</span>`;
					}
					else{
						$eliminar = `<span style="color:grey" class="material-icons">delete</span>`;
					}
					$('#resultados').append(`   		
							<tr>
								<td class="left-align">${element.MOVDOC_N_ID}</td>
								<td class="left-align">${element.MOVDOC_C_FECHA_RECEPCION}</td>
								<td class="left-align">${element.RAZON_SOCIAL_DE}</td>
								<td class="left-align">${element.RAZON_SOCIAL_PARA}</td>
								<td class="left-align">${element.TIDORE_C_ABREVIATURA}</td>
								<td class="left-align">${element.MOVDOC_C_NUMERO_DOCUMENTO}</td>
								<td class="center-align">${adjunto}</td>
								<td class="left-align">${element.MOVDOC_D_FECHA_VENCIMIENTO}</td>
								<td class="left-align">${element.MOVDOC_C_SITUACION}</td>
								<td class="left-align">${$eliminar} </td> 
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
	
</script>

