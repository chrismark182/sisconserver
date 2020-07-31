<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Bloqueo de visitante</a>
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
<a class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" href="http://siscon.esx/bloqueos/nuevo"><i class="material-icons">add</i></a>


<!-- Modal Structure -->

<div id="modalInfoBloqueos" class="modal modal-fixed-footer">
    <div class="modal-content" >
        <table class="striped" style="font-size: 12px;">
			<thead class="blue-grey darken-1" >
				<tr>
					<th>Motivo </th>
					<th>Usuario que registra</th>
					<th>Fecha Bloqueo</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($BuscarDetalle as $row): ?>
					<tr>
						<th>  
							<?= $row->PERBLO_C_MOTIVO_BLOQUEO ?>
						</th>
						<th>
							<?= $row->USUARI_C_USERNAME?>
						</th>
						<th>
							<?= $row->PERBLO_D_FECHA_REG?>		
						</th>
					</tr>
					<?php endforeach;?>
			</tbody>
			<div class="modal-footer">
				<a href="#!" class="modal-close waves-effect waves-green btn-flat">ACEPTAR</a>
			</div>
		 <table>
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
					
					console.log(element);
					$('#resultados').append(`   		
							<tr>
								<td class="left-align">${element.PERSON_C_NOMBRE}</td>
								<td class="left-align">${element.PERSON_C_APELLIDOS}</td>
								<td class="left-align">${element.PERSON_C_DOCUMENTO}</td>
								<td class="left-align">${element.CLIENT_C_RAZON_SOCIAL}</td>
								<td style="text-align:center"> <i id="id_perbloqueo" class="material-icons  tooltipped" style="color: #039be5; cursor: pointer" data-tooltip="" onclick="muestraInfoBloqueo(${element.PERSON_N_ID},${element.PERBLO_N_ITEM})" >lock</i></td> 
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
		let url = '<?= base_url() ?>api/execsp';
		let sp = 'PERSONA_BLOQUEO_ITEM_LIS';				
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		data = {sp, empresa, id, item};

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
			console.log(data);
			$('.preloader-background').css({'display': 'none'});                            
		});
	}


</script>
