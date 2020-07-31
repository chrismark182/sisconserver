
<style>

.column{
	width:70%;
}

.column > .col > .ancho{
		width: 80%;
	}

.column > .col > span{
	width: 100px;
	display: inline-block;
}

.column > .col > .select-wrapper{
	width: 80%;
	display: inline-block;
}

	.flex{
		display: flex;
		align-items: center;
		flex-wrap: wrap;
	}

	

	.d-b{
		display:inline-block;
		width: 50% !important;
		display:flex;
		align-items: center;
	}

	.d-b span{
		width: 105px;
		margin-bottom: 9px;
	}
	.flex input{
		margin: -14px;
    	padding: 0px;
	}
</style>



<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Visitantes</a>
        <a href="<?= base_url() ?>bloqueos" class="breadcrumb">Ingreso</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>

<div class="row">
<h4 class="left blue-grey darken-1" style="color:#fff; width: 100%;padding: 10px;">Registro de visitas</h4>
	
	<div>
		<div class="input-field col s12 d-b ">
				<span>ID Visita </span><input  id="nombre" value="00001010101 " readonly>
		</div>

		<div class="input-field col s6 ">
			<input placeholder="Placeholder" id="fecha" type="text" class="validate" readonly >
			<label for="documento">Fecha</label>
		</div>
	</div>
	<div>
		<div class="input-field col s12 m6">
			<select id="tipo_documento" required>
				<option value="0">Todos</option>
				<?php foreach ($misdoc as $row): ?>
					<option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
				<?php endforeach; ?>
			</select>
			<label for="tipo_documento">Tipo de documentos</label>
		</div>
		
		<div class="input-field col s6">
			<input placeholder="Placeholder" id="documento" type="text" class="validate">
			<label for="documento">Documento</label>
		</div>
	</div>	
	<div class="column" >
			<div class="input-field col s12  " >
				<span>Apellidos </span><input class="ancho" id="apellido" value="Buitrago" readonly>
			</div>
			<div class="input-field col s12  "  >
				<span>Nombres </span><input class="ancho" id="apellido" value="Tomas" readonly>
			</div>
			<div class="input-field col s12  " >
				<span>Empresa </span><input class="ancho" id="apellido" value="Buitrago" readonly>
			</div>

			<div class="input-field col s12  ">
				<span>Tipo Ingreso </span>
				<select id="tipo_documento" required>
					<option value="0">Todos</option>
					<?php foreach ($misdoc as $row): ?>
						<option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
					<?php endforeach; ?>
				</select>
			</div>

			
				<div class="input-field col s12  ">
					<span>Ingreso Como </span>
					<select id="tipo_documento" required>
						<option value="0">Todos</option>
						<?php foreach ($misdoc as $row): ?>
							<option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
						<?php endforeach; ?>
					</select>
				</div>

		
				<div class="input-field col s12  ">
					<span>Contacto  </span>
					<select id="tipo_documento" required>
						<option value="0">Todos</option>
						<?php foreach ($misdoc as $row): ?>
							<option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="input-field col s12  ">
					<span>Area destino </span>
					<select id="tipo_documento" required>
						<option value="0">Todos</option>
						<?php foreach ($misdoc as $row): ?>
							<option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
						<?php endforeach; ?>
					</select>
				</div>
					
			<div>

			
		<div class="input-field col s12 d-b ">
				<span>Guia Remision</span><input  id="nombre" value="00001010101 " readonly>
		</div>

		<div class="input-field col s6 ">
				<span>Orden de compra</span><input  id="nombre" value="00001010101 " readonly>
		</div>
	</div>
		<div>
			<div class="input-field col s12 m6">
				<select id="tipo_documento" required>
					<option value="0">Todos</option>
					<?php foreach ($misdoc as $row): ?>
						<option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
					<?php endforeach; ?>
				</select>
				<label for="tipo_documento">Tipo de documentos</label>
			</div>
			
			<div class="input-field col s6">
				<input placeholder="Placeholder" id="documento" type="text" class="validate">
				<label for="documento">Documento</label>
			</div>
		</div>			
	</div>

	<div>
		 <img width="150px" height="150px" src="https://assets.entrepreneur.com/content/3x2/2000/1592523743-CEO-CTO-CCO-CIO.jpg"/>
	</div>		
	

	<div class="input-field col s4">
        <div class="btn-small" id="btnBuscar" onclick="buscar()" >Buscar</div>
    </div>
</div>

<div id="modalBloqueos" class="modal modal-fixed-footer">
	<h4 class="left blue-grey darken-1" style="color:#fff; width: 100%;padding: 10px;">Registro de visitas</h4>
	<div class="modal-content" style="margin: 28px 0;" >
		
		<div class="section row flex" style="display:block" >
			<div class="input-field col s12 d-b ">
						<span>Nombres </span><input  id="nombre" value="Tomas " readonly>
			</div>
			<div class="input-field col s12 d-b ">
						<span>Apellidos </span><input  id="apellido" value="Buitrago Doe" readonly>
			</div>
			<div class="input-field col s12 d-b ">
						<span>Empresa visitante </span><input  id="empresa" value="Exito" readonly>
			</div>
			<div class="input-field col s12 d-b ">
						<span>Foto </span><img src="" />
			</div>
			<div class="input-field col s12 d-b ">
						<span>Fecha SCTR </span><input  id="fecha_sctr" value="2020-07-31" readonly>
			</div>			
		</div>
		</div>
</div>

<script>

function mostrarHoraActual()
    {
        console.log(horaActual());
		document.getElementById("fecha").value = horaActual();
        //document.getElementById('numero_documento').value = horaActual();
        setTimeout(() => {
            mostrarHoraActual();
        }, 1000);
    }
    mostrarHoraActual();


	function buscar()
    {
		$('.preloader-background').css({'display': 'block'});
		$('#modalBloqueos').modal('open');
		/*
		let url = '<?= base_url() ?>api/execsp';
		console.log(url);
        let sp = 'PERSONA_LIS';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let tipo_documento = parseInt(document.getElementById('tipo_documento').value);
        let numero_documento = document.getElementById('numero_documento').value + '%';
        data = {sp, empresa, tipo_documento, numero_documento};
        
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
         
            for (let index = 0; index < data.length; index++) {
                const element = data[index];                
                $('#resultados').append(`   
                                        <tr>
                                            <td class="left-align">${element.PERSON_C_DOCUMENTO}</td>
                                            <td class="left-align">${element.PERSON_C_APELLIDOS}</td>
											<td class="left-align">${element.PERSON_C_NOMBRE}</td>
											<td class="left-align">${element.CLIENT_C_RAZON_SOCIAL}</td>
                                            <td class="center-align"><i class="material-icons" style="cursor: pointer;" onclick="modalBloquear(${element.PERSON_N_ID})">lock</i></td>
                                        </tr>
                                    `);
            }
            $('.preloader-background').css({'display': 'none'});                            
		});
		
		*/
    }	


</script>


