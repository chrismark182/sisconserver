<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Visitantes</a>
        <a href="<?= base_url() ?>bloqueos" class="breadcrumb">Ingreso</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>

<div class="section container">
	<div class="row">
		<div class="input-field col s6">
			<input id="nombre" value="1" placeholder=" " readonly>
			<label for="first_name">ID</label>
		</div>

		<div class="input-field col s6 ">
			<input placeholder="Placeholder" id="fecha" type="text" class="validate" readonly >
			<label for="documento">Fecha</label>
		</div>
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
	<div class="row">
		<div class="col s8">
			<div class="input-field col s12" >
				<input class="ancho" id="apellido" value="Buitrago" readonly>
				<label for="first_name">Apellidos</label>
			</div>
			<div class="input-field col s12"  >
				<input class="ancho" id="apellido" value="Tomas" readonly>
				<label for="first_name">Nombres</label>
			</div>
			<div class="input-field col s12" >
				<input class="ancho" id="apellido" value="Buitrago" readonly>
				<label for="first_name">Empresa</label>
			</div>			
			<div class="input-field col s12">
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
		</div>
		<div class="col s4">
			<img width="150px" height="150px" src="https://assets.entrepreneur.com/content/3x2/2000/1592523743-CEO-CTO-CCO-CIO.jpg"/>
			<p>SCRT VENCIDO</p>
			<p>BLOQUEADO</p>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12 d-b ">
				<span>Guia Remision</span><input  id="nombre" value="00001010101 " readonly>
		</div>

		<div class="input-field col s6 ">
				<span>Orden de compra</span><input  id="nombre" value="00001010101 " readonly>
		</div>
		<div class="input-field col s6">
			<input placeholder="Placeholder" id="documento" type="text" class="validate">
			<label for="documento">Observaciones</label>
		</div>
	</div>

	<div class="input-field col s4">
        <div class="btn-small" id="btnBuscar" onclick="buscar()" >Grabar</div>
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


