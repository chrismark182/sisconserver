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
                <input id="nombre" maxlength="200" type="text" name="nombre"  class="validate">
                <label class="active" for="nombre">Nombre</label> 
            </div>

			<div class="input-field col s12 m6 l4">
                <input id="apellido" maxlength="200" type="text" name="apellido"  class="validate">
                <label class="active" for="apellido">Apellido</label> 
            </div>

			<div class="input-field col s12 m6 l4">
                <input id="n_documento" maxlength="11" type="text" class="validate">
                <label class="active" for="n_documento">Numero de documento</label> 
            </div>	

            <div class="input-field col s12 m6 l4">
                <input id="nombre_empresa" maxlength="100" type="text"  class="validate">
                <label class="active" for="nombre_empresa">Nombre de empresa</label> 
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
                <th class="left-align">Nombre </th>
                <th class="left-align">Apellido</th>
                <th class="left-align">N Documento</th>
				<th class="left-align">Empresa</th>
				<th class="left-align" style="text-align: center">Info Bloqueo</th>
				<th class="left-align">Usuario</th>
				<th class="left-align">Fecha Bloqueo</th>          
            </tr>
        </thead>
        <tbody id="resultados">   
        </tbody>
    </table>
</div>
<a class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" href="recepcion_doc/nuevo"><i class="material-icons">add</i></a>


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
		<h4>Datos del bloqueo</h4>
		<div class="divider"></div>
		<p>Motivo bloqueo: <span id="des_bloqueo_motivo"></span></p>
		<p>Usuario bloqueo: <span id="des_bloqueo_usuario"></span></p>
		<p>Fecha bloqueo: <span id="des_bloqueo_fecha"></span></p>
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

		$('.preloader-background').css({'display': 'block'});
		let url = '<?= base_url() ?>api/execsp';

		let sp = 'PERSONA_BLOQUEO_LIS';
		
		let nombre = '%';
		if(document.getElementById('nombre').value != ''){
			nombre = document.getElementById('nombre').value + '%';
		}
		let apellido = '%';
		if(document.getElementById('apellido').value != ''){
			apellido = document.getElementById('apellido').value + '%';
		}
		let numero_documento = '%';
		if(document.getElementById('n_documento').value != ''){
			numero_documento = document.getElementById('n_documento').value + '%';
		}
		let nombre_empresa = '%';
		if(document.getElementById('nombre_empresa').value != ''){
			nombre_empresa = document.getElementById('nombre_empresa').value + '%';
		}
        data = {sp, nombre, apellido, numero_documento, nombre_empresa };
        
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
					let bloqueo = `<i id="id_perbloqueo" class="material-icons  tooltipped" style="color: #039be5; cursor: pointer" data-tooltip="" onclick="muestraInfoBloqueo(${element.PERSON_N_ID},${element.PERBLO_N_ITEM})" >lock</i>`;
					if(element.PERBLO_C_BLOQUEADO == '0')
					{
						bloqueo = `<i id="id_perbloqueo" class="material-icons  tooltipped" style="color: #039be5; cursor: pointer" data-tooltip="" onclick="muestraInfoDesbloqueo(${element.PERSON_N_ID},${element.PERBLO_N_ITEM})">lock_open</i>`;
					}
					$('#resultados').append(`   		
							<tr>
								<td class="left-align">${element.PERSON_C_NOMBRE}</td>
								<td class="left-align">${element.PERSON_C_APELLIDOS}</td>
								<td class="left-align">${element.PERSON_C_DOCUMENTO}</td>
								<td class="left-align">${element.CLIENT_C_RAZON_SOCIAL}</td>
								<td style="text-align:center">${bloqueo}</td> 
								<td class="left-align">${element.USUARI_C_USERNAME}</td>
								<td class="left-align">${element.PERBLO_D_FECHA_REG}</td>
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
</script>
