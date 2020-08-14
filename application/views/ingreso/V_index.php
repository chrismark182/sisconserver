<?php 
    $fechaDesde = new DateTime();
    //$fechaDesde->modify('-1 month');
    $fechaDesde->modify('first day of this month');    
    $fechaHasta = new DateTime();
?>

<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Ingreso y Salida</a>
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
                <input id="id" maxlength="20" type="text" name="id"  class="validate">
                <label class="active" for="id">ID Visita</label> 
            </div>
			<div class="input-field col s12 m6 l4">
                <input id="empresa_visita" maxlength="50" type="text" class="validate">
                <label class="active" for="empresa_visita">Empresa Visitada</label> 
            </div>
			<div class="input-field col s12 m6 l4">
                <input id="apellido_visitante" maxlength="50" type="text" class="validate">
                <label class="active" for="apellido_visitante">Apellido Visitante</label> 
            </div>			
			<div class="input-field col s12 m6 l4">
                <input id="empresa_visitante" maxlength="50" type="text" name="empresa_visitante"  class="validate">
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
                    <option value="1">Por Salir</option>
                </select>
                <label for="tipo_documento">Situación</label>
            </div>
			<div class="input-field col s12 m6 l4">
				<select id="tipo_ingreso" required>
					<?php foreach ($tipo_ingreso as $row):?>
						<option value="<?= $row->TIPING_N_ID?>"> <?= $row->TIPING_C_DESCRIPCION ?> </option>
					<?php endforeach; ?>
				</select>
				<label for="tipo_ingreso">Tipo de Ingreso</label>
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
                <th class="left-align">ID</th>
				<th class="left-align">EMPRESA</th>
				<th class="left-align">NOMBRES</th>
                <th class="left-align">APELLIDOS</th>
				<th class="left-align">TIPO</th>
				<th class="center-align">FECHA</th>
				<th class="center-align">LLEGADA</th>
				<th class="center-align">INGRESO</th>
				<th class="center-align">SALIDA</th>
				<th class="center-align">IMPRIMIR</th>
				<th class="left-align">ELIMINAR</th>     
            </tr>
        </thead>
        <tbody id="resultados">   
        </tbody>
    </table>
</div>
<a class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" href="<?= base_url()?>ingreso/nuevo"><i class="material-icons">add</i></a>


<!-- Modal Structure -->
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
        <p>¿Está seguro que desea confirmar el INGRESO ?</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
        <a id="botonConfirmar" href="#!" class="modal-close waves-effect waves-green btn">ACEPTAR</a>
    </div>
</div>

<div id="modalSalida" class="modal">
    <div class="modal-content">
        <h4>Salida</h4>
        <p>¿Está seguro que desea confirmar la SALIDA?</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
        <a id="botonConfirmarSalida" href="#!" class="modal-close waves-effect waves-green btn">ACEPTAR</a>
    </div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		let n = getParameterByName('id');
		if(n != '')
		{
			document.getElementById('id').value = n;
			M.updateTextFields();
			buscar()
		}
	});

	function buscar(){
		M.toast({html: 'Buscando resultado...', classes: 'rounded'});
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
				M.toast({html: 'Cargando Ingresos y Salidas', classes: 'rounded'});
				for (let index = 0; index < data.length; index++) {
					const element = data[index]; 

					let ingreso = ``;
					let salida = ``;
					
					let $eliminar ;
					
					if( element.MOVPER_C_SITUACION  == '0'){
						$eliminar = `<span style="cursor:pointer; color:#039be5" class="material-icons" onclick="eliminar(${element.MOVPER_N_ID})">delete</span>`;	
						if(element.HORA_INGRESO == '')
						{
							ingreso = `<span style="cursor:pointer;; color:#039be5" onclick="confirmarIngreso(${element.MOVPER_N_ID})"  style="cursor:pointer" class="material-icons">directions_walk</span>`;
						}
					}else if( element.MOVPER_C_SITUACION  == '1'){
						$eliminar = `<span style="color:grey" class="material-icons">delete</span>`;
						if(element.FECHA_HORA_SALIDA == '')
						{
							salida = `<span style="color:#039be5" onclick="confirmarSalida(${element.MOVPER_N_ID})" style="cursor:pointer" class="material-icons">directions_walk</span>`;
						}
					}else{
						$eliminar = `<span style="color:grey" class="material-icons">delete</span>`;
					}
					$('#resultados').append(`   		
							<tr>
								<td class="left-align">${element.MOVPER_N_ID}</	td>
								<td class="left-align">${element.RAZON_SOCIAL_VISITANTE}</td>
								<td class="left-align">${element.PERSON_C_NOMBRE}</td>
								<td class="left-align">${element.PERSON_C_APELLIDOS}</td>
								<td style="text-align">${element.TIPING_C_DESCRIPCION}</td> 
								<td class="center-align">${element.FECHA_INGRESO}</td>
								<td class="center-align">${element.HORA_LLEGADA}</td>
								<td class="center-align">${element.HORA_INGRESO} ${ingreso}</td>
								<td class="center-align">${element.FECHA_HORA_SALIDA}${salida} </td>
								<td class="center-align">
									<a href="ingreso/reporte/${element.MOVPER_N_ID}" target="_blank">
										<i class="material-icons">event_note</i>
									</a>
								</td> 
								<td class="center-align">${$eliminar} </td> 
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
