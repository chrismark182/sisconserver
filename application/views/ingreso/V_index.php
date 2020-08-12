<?php 
    $fechaDesde = new DateTime();
    //$fechaDesde->modify('-1 month');
    $fechaDesde->modify('first day of this month');    
    $fechaHasta = new DateTime();
?>

<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Ingreso</a>
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
                <input id="id" maxlength="200" type="text" name="id"  class="validate">
                <label class="active" for="id">ID Visita</label> 
            </div>
			<div class="input-field col s12 m6 l4">
                <input id="empresa_visita" maxlength="11" type="text" class="validate">
                <label class="active" for="empresa_visita">Empresa visita</label> 
            </div>
			<div class="input-field col s12 m6 l4">
                <input id="apellido_visitante" maxlength="11" type="text" class="validate">
                <label class="active" for="apellido_visitante">Apellido </label> 
            </div>			
			<div class="input-field col s12 m6 l4">
                <input id="empresa_visitante" maxlength="200" type="text" name="empresa_visitante"  class="validate">
                <label class="active" for="empresa_visitante">Empresa Visitante</label> 
            </div>	
			<div class="input-field col s12 m6 l4">
                <input id="desde" type="text" value="<?= $fechaDesde->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="desde">Desde</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="hasta" type="text" value="<?= $fechaHasta->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="hasta">Hasta</label> 
            </div>
			<div class="input-field col s12 m6 l4">
                <select id="situacion" required>
                    <option value="0">Todos</option>
                    <option value="1"> Por salir</option>
                </select>
                <label for="tipo_documento">Situacion</label>
            </div>
			<div class="input-field col s12 m6 l4">
				<select id="tipo_ingreso" required>
					<?php foreach ($tipo_ingreso as $row):?>
						<option value="<?= $row->TIPING_N_ID?>"> <?= $row->TIPING_C_DESCRIPCION ?> </option>
					<?php endforeach; ?>
				</select>
				<label for="tipo_ingreso">Tipo de ingreso</label>
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
                <th class="left-align">Id </th>
				<th class="left-align">Nombre</th>
                <th class="left-align">Apellido</th>
				<th class="left-align">Empresa</th>
				<th class="left-align">Tipo Ingreso</th>
				<th class="left-align">Motivo Ingreso</th>
				<th class="center-align">Fecha Ingreso</th>
				<th class="center-align">Hora llegada</th>
				<th class="center-align">Hora Ingreso</th>
				<th class="center-align">Fecha hora salida</th>
				<th class="left-align">Eliminar</th>     
            </tr>
        </thead>
        <tbody id="resultados">   
        </tbody>
    </table>
</div>
<a class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" href="<?= base_url()?>ingreso/nuevo"><i class="material-icons">add</i></a>


<!-- Modal Structure -->

<div id="modalInfoBloqueos" class="modal modal-fixed-footer">
    <div class="modal-content" >
		<h4>Datos del bloqueo</h4>
		<div class="divider"></div>
		<p>Motivo bloqueo: <span id="bloqueo_motivo"></span></p>
		<p>Usuario bloqueo: <span id="bloqueo_usuario"></span></p>
		<p>Fecha bloqueo: <span id="bloqueo_fecha"></span></p>
		<div class="btn" onclick="modalDesbloquear()">DESBLOQUEAR</div>
    </div>
	<div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Aceptar</a>
    </div>
</div> 

<div id="modalInfoDesbloqueado" class="modal modal-fixed-footer">
    <div class="modal-content" >
		<h4>Datos del Ingreso</h4>
		<div class="divider"></div>
		<p>Motivo Ingreso: <span id="des_bloqueo_motivo"></span></p>
		<p>Usuario Ingreso: <span id="des_bloqueo_usuario"></span></p>
		<p>Fecha ingreso: <span id="des_bloqueo_fecha"></span></p>
		<br>
		<h4>Datos del desbloqueo</h4>
		<div class="divider"></div>
		<p>Motivo desbloqueo: <span id="desbloqueo_motivo"></span></p>
		<p>Usuario desbloqueo: <span id="desbloqueo_usuario"></span></p>
		<p>Fecha desbloqueo: <span id="desbloqueo_fecha"></span></p>
		
    </div>
	<div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Aceptar</a>
    </div>
</div> 

<div id="modalBloqueos" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 class="left">Desbloquear persona</h4>
        <div class="section row">
            <input type="hidden" id="persona_id" >
			<input type="hidden" id="bloqueo_item" >
            <div class="input-field col s12">
                <textarea id="motivo" class="materialize-textarea"></textarea>
                <label for="motivo">Motivo del desbloqueo</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" waves-effect waves-green btn-flat" onclick="desbloquear()">Aceptar</a>
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

<div id="modalIngreso" class="modal">
    <div class="modal-content">
        <h4>Ingreso</h4>
        <p>¿Está seguro que desea confirmar el ingreso ?</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
        <a id="botonConfirmar" href="#!" class="modal-close waves-effect waves-green btn">ACEPTAR</a>
    </div>
</div>

<div id="modalSalida" class="modal">
    <div class="modal-content">
        <h4>Salida</h4>
        <p>¿Está seguro que desea confirmar la salida?</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
        <a id="botonConfirmarSalida" href="#!" class="modal-close waves-effect waves-green btn">ACEPTAR</a>
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
		
		let sp = 'MOVIMIENTO_PERSONA_LIS';
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		
		let id = 0;
		if(document.getElementById('id').value != ''){
			id =  parseInt(document.getElementById('id').value );
		}
		let empresa_visita = '%';
		if(document.getElementById('empresa_visita').value != ''){
			empresa_visita = document.getElementById('empresa_visita').value + '%';
		}
		let apellido = '%';
		if(document.getElementById('apellido_visitante').value != ''){
			apellido = document.getElementById('apellido_visitante').value + '%';
		}
		let empresa_visitante = '%';
		if(document.getElementById('empresa_visitante').value != ''){
			empresa_visitante = document.getElementById('empresa_visitante').value + '%';
		}		
		$fecha_desde = $('#desde').val();
		$fecha_desde = $fecha_desde.split('/');
		let fecha_desde=  $fecha_desde[2] + $fecha_desde[1] + $fecha_desde[0];
		$fecha_hasta = $('#hasta').val();
		$fecha_hasta = $fecha_hasta.split('/');
		let fecha_hasta= $fecha_hasta[2] + $fecha_hasta[1] + $fecha_hasta[0]
		let situacion = document.getElementById('situacion').value;
		let tipo_ingreso = parseInt(document.getElementById('tipo_ingreso').value);
	 	let	data = {sp, empresa, id, empresa_visita,apellido,empresa_visitante,fecha_desde,fecha_hasta,situacion,tipo_ingreso};	
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
			console.log(data);
			if(data.length > 0)
			{
				for (let index = 0; index < data.length; index++) {
					const element = data[index]; 

					let ingreso = ``;
					if(element.HORA_INGRESO == '')
					{
						ingreso = `<span onclick="confirmarIngreso(${element.MOVPER_N_ID})"  style="cursor:pointer" class="material-icons">assignment</span>`;
					}
					let salida = ``;
					if(element.FECHA_HORA_SALIDA == '')
					{
						salida = `<span confirmarSalida(${element.MOVPER_N_ID}) style="cursor-pointer" class="material-icons">assignment</span>`;
					}

					let $eliminar ;
					
					if( element.MOVPER_C_SITUACION  == '0'){
						$eliminar = `<span style="cursor:pointer; color:blue" class="material-icons" onclick="eliminar(${element.MOVPER_N_ID})">delete</span>`;	
					}else{
						$eliminar = `<span style="color:grey" class="material-icons">delete</span>`;
					}
					$('#resultados').append(`   		
							<tr>
								<td class="left-align">${element.MOVPER_N_ID}</	td>
								<td class="left-align">${element.PERSON_C_NOMBRE}</td>
								<td class="left-align">${element.PERSON_C_APELLIDOS}</td>
								<td class="left-align">${element.RAZON_SOCIAL_VISITANTE}</td>
								<td style="text-align">${element.TIPING_C_DESCRIPCION}</td> 
								<td class="left-align">${element.MOTVIS_C_DESCRIPCION}</td>
								<td class="center-align">${element.FECHA_INGRESO}</td>
								<td class="center-align">${element.HORA_LLEGADA}</td>
								<td class="center-align">${element.HORA_INGRESO} ${ingreso}</td>
								<td class="center-align">${element.FECHA_HORA_SALIDA}${salida} </td>
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

	function muestraInfoBloqueo(id, item)
	{		
		document.getElementById('persona_id').value = id;
		document.getElementById('bloqueo_item').value = item;

		let url = '<?= base_url() ?>api/execsp';
		let sp = 'PERSONA_BLOQUEO_ITEM_LIS';				
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		data = {sp, empresa, id, item};

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
			let element = data[0];
			document.getElementById('bloqueo_motivo').innerHTML = element.PERBLO_C_MOTIVO_BLOQUEO;
			document.getElementById('bloqueo_usuario').innerHTML = element.USUARI_C_USERNAME;
			document.getElementById('bloqueo_fecha').innerHTML = element.PERBLO_D_FECHA_REG;
			$('#modalInfoBloqueos').modal('open');
			$('.preloader-background').css({'display': 'none'});                            
		});
	}
	function muestraInfoDesbloqueo(id, item)
	{		
		document.getElementById('persona_id').value = id;
		document.getElementById('bloqueo_item').value = item;

		let url = '<?= base_url() ?>api/execsp';
		let sp = 'PERSONA_BLOQUEO_ITEM_LIS';				
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		data = {sp, empresa, id, item};

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
			let element = data[0];
			document.getElementById('des_bloqueo_motivo').innerHTML = element.PERBLO_C_MOTIVO_BLOQUEO;
			document.getElementById('des_bloqueo_usuario').innerHTML = element.USUARI_C_USERNAME;
			document.getElementById('des_bloqueo_fecha').innerHTML = element.PERBLO_D_FECHA_REG;

			document.getElementById('desbloqueo_motivo').innerHTML = element.PERBLO_C_MOTIVO_DESBLOQUEO;
			document.getElementById('desbloqueo_usuario').innerHTML = element.USUARIO_DESBLOQUEA;
			document.getElementById('desbloqueo_fecha').innerHTML = element.PERBLO_D_FECHA_UPD;

			$('#modalInfoDesbloqueado').modal('open');
			$('.preloader-background').css({'display': 'none'});                            
		});
	}
	function modalDesbloquear()
    {
		$('.modal').modal('close');
        $('#modalBloqueos').modal('open');
    }
	function desbloquear()
    {

		let url = '<?= base_url() ?>api/execsp';
		let sp = 'PERSONA_BLOQUEO_UPD';				
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let persona = parseInt(document.getElementById('persona_id').value);
		let item = parseInt(document.getElementById('bloqueo_item').value);
		let motivo = document.getElementById('motivo').value;
		let usuario = <?= $session->USUARI_N_ID ?>;
		data = {sp, empresa, persona, item, motivo, usuario};

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
			M.toast({html: 'Persona desbloqueada correctamente!', classes: 'rounded'});
            $('.preloader-background').css({'display': 'none'});                            
			setTimeout(() => {
			    window.location.href= "<?= base_url() ?>bloqueos?n=" + data[0].PERSON_C_DOCUMENTO;                
            }, 1000);
		}).catch(error => console.log(error));
		

	}
	
	function insertarFechaHora (){
		let url = '<?= base_url() ?>api/execsp';
		let sp = 'PERSONA_BLOQUEO_UPD';				
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		
		
		let motivo = document.getElementById('motivo').value;
		let usuario = <?= $session->USUARI_N_ID ?>;
		data = {sp, empresa, persona, item, motivo, usuario};

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
			M.toast({html: 'Persona desbloqueada correctamente!', classes: 'rounded'});
            $('.preloader-background').css({'display': 'none'});                            
			setTimeout(() => {
			    window.location.href= "<?= base_url() ?>bloqueos?n=" + data[0].PERSON_C_DOCUMENTO;                
            }, 1000);
		}).catch(error => console.log(error));

		
	}

	function confirmarIngreso($id)
	{
		console.log('confirmar ingreso')
		$('#modalIngreso').modal('open');
		$('#botonConfirmar').attr('href', 'ingreso/'+$id+'/confirmar_ingreso')
	}

	function confirmarSalida($id)
	{
		console.log('confirmar ingreso')
		$('#modalSalida').modal('open');
		$('#botonConfirmarSalida').attr('href', 'salida/'+$id+'/confirmar_salida')
	}

	

	function eliminar($id)
	{
		console.log('confirmar eliminar')
        $('#modalEliminar').modal('open');
        $('#btnConfirmar').attr('href', 'ingreso/'+$id+'/eliminar')
		
	}


</script>
