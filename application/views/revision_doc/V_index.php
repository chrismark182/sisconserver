<?php 
    $fechaDesde = new DateTime();
    $fechaHasta = new DateTime();
?>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Revisión de Documentos</a>
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
    <div>
        &nbsp;
    </div>
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
				<th class="center-align">ACEPTAR</th>
				<th class="center-align">RECHAZAR</th>          
            </tr>
        </thead>
        <tbody id="resultados">   
        </tbody>
    </table>
</div>

<div id="modalAceptar" class="modal">
    <div class="modal-content">
        <h4>Aceptar</h4>
        <p>¿Está seguro que desea ACEPTAR EL DOCUMENTO?</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
        <a id="btnConfirmar" href="#!" class="modal-close waves-effect waves-green btn">ACEPTAR</a>
    </div>
</div>

<div id="modalRechazar" class="modal">
    <div class="modal-content">
        <h4>Rechazar</h4>
        <p>¿Está seguro que desea RECHAZAR EL DOCUMENTO?</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
        <a id="btnConfirmar2" href="#!" class="modal-close waves-effect waves-green btn">ACEPTAR</a>
    </div>
</div>


<script>
	document.addEventListener('DOMContentLoaded', function() {
		buscar();
	});

	function buscar(){
		M.toast({html: 'Buscando resultado...', classes: 'rounded'});
		$('.preloader-background').css({'display': 'block'});
		let url = '<?= base_url() ?>api/execsp';

		let sp = 'MOVIMIENTO_DOCUMENTO_LIS_REVISION';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let data = {sp, empresa};
        
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
					
					if(element.MOVDOC_C_SITUACION == '1')
					{
						adjunto = `<a href="<?= base_url() ?>uploads/${element.MOVDOC_C_FOTO}" target="_blank"><i class="material-icons tooltipped" style="color: #039be5; cursor: pointer">attachment</i></a>`;
					}

					$aceptar = `<span style="cursor:pointer; color:#039be5" class="material-icons" onclick="aceptar(${element.MOVDOC_N_ID})">event_available</span>`;
					$rechazar = `<span style="cursor:pointer; color:#039be5" class="material-icons" onclick="rechazar(${element.MOVDOC_N_ID})">event_busy</span>`;

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
								<td class="center-align">${$aceptar}</td>
								<td class="center-align">${$rechazar} </td> 
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

	function aceptar($id)
	{
		console.log('confirmar aceptar')
        $('#modalAceptar').modal('open');
        $('#btnConfirmar').attr('href', 'revision_doc/'+$id+'/aceptar')
	}

	function rechazar($id)
	{
		console.log('confirmar rechazar')
        $('#modalRechazar').modal('open');
        $('#btnConfirmar2').attr('href', 'revision_doc/'+$id+'/rechazar')
	}
</script>

