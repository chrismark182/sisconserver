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
			<input id="id" value="1" placeholder=" " readonly>
			<label for="id">ID</label>
		</div>

		<div class="input-field col s6 ">
			<input placeholder="Placeholder" id="fecha" type="text" class="validate" readonly >
			<label for="fecha">Fecha</label>
		</div>
		<div class="input-field col s12 m6">
			<select id="tipo_doc" required>
				<option value="0">Todos</option>
				<?php foreach ($misdoc as $row): ?>
					<option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
				<?php endforeach; ?>
			</select>
			<label for="tipo_doc">Tipo de documentos</label>
		</div>	
		<div class="input-field col s6">
			<input placeholder="Placeholder" id="documento" type="text" class="validate" onchange="buscar()">
			<label for="documento">Documento</label>
		</div>
	</div>
	<div class="row">
		<div class="col s8">
			<div class="input-field col s12" >
				<input  id="apellido" value="" readonly >
				<label class="active" for="apellido">Apellidos</label>
			</div>
			<div class="input-field col s12"  >
				<input class="ancho" id="nombre" value="" readonly>
				<label class="active" for="nombre">Nombres</label>
			</div>
			<div class="input-field col s12" >
				<input class="ancho" id="empresa" value="" readonly>
				<label class="active" for="empresa">Empresa</label>
			</div>			
			<div class="input-field col s12">
				<select id="tipo_ingreso" required>
					<option value="0">Tipo Ingreso</option>
					<?php foreach ($tipo_ingreso as $row): ?>
						<option value="<?= $row->EMPRES_N_ID?>">  <?= $row->TIPING_C_DESCRIPCION ?> </option>
					<?php endforeach; ?>
				</select>
				<label class="active" for="tipo_ingreso"> Ingreso </label>
			</div>

			<div class="input-field col s12  ">
				<select id="ingreso_como" required>
					<option value="0">Ingreso Como</option>
					<?php foreach ($motivo_visita as $row): ?>
						<option value="<?= $row->EMPRES_N_ID ?>"><?= $row->MOTVIS_C_DESCRIPCION ?></option>
					<?php endforeach; ?>
				</select>
				<label class="active" for="ingreso_como">Ingreso Como </label>
			</div>

	
			<div class="input-field col s12 ">
				<select id="contacto" required>
					<option value="0">Contacto</option>
					<?php foreach ($contacto as $row): ?>
						<option value="<?= $row->EMPRES_N_ID?>"> <?= $row->CLIENT_C_RAZON_SOCIAL?> </option>
					<?php endforeach; ?>
				</select>
				<label class="active" for="contacto">Ingreso Como </label>
			</div>
			
			<div class="input-field col s12  ">
				<select id="area_destino" required>
					<option value="0">Area Destino</option>
					<?php foreach ($misdoc as $row): ?>
						<option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
					<?php endforeach; ?>
				</select>
				<label class="active" for="area_destino">Ingreso Como </label>
			</div>
		</div>
		<div class="col s4">
			<img style="width:100%"  src="<?= base_url()?>assets/images/sin-imagen.jpg"/>
			<p id="sctr" ></p>
			<p style="font-weight:bold"  class="center red-text text-darken-4"  id="bloqueado" ></p>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12 d-b ">
				<input  id="remision" value="00001010101 " readonly>
				<label  class="active" for="remision">Guia Remision</label>
		</div>

		<div class="input-field col s6 ">
				<input  id="orden-compra" value="00001010101 " readonly>
				<label  class="active"  for="orden-compra" >Orden de compra</label>
		</div>
		<div class="input-field col s12">
          <textarea id="observaciones" class="materialize-textarea"></textarea>
          <label for="observaciones">Observaciones</label>
        </div>
	</div>

	<div class="input-field col s4">
        <div class="btn-small" id="btnBuscar" onclick="buscar()" >Buscar</div>
    </div>
</div>



<script>



document.addEventListener('DOMContentLoaded', function() {

	console.log("Esta es una funcion del framework");
	M.updateTextFields();
  });

function mostrarHoraActual()
    {
       // console.log(horaActual());
		document.getElementById("fecha").value = horaActual();
        //document.getElementById('numero_documento').value = horaActual();
        setTimeout(() => {
            mostrarHoraActual();
        }, 1000);
    }
    mostrarHoraActual();


	function buscar()
    {
		M.toast({html: 'Buscando resultado...', classes: 'rounded'});



		let url = '<?= base_url() ?>api/execsp';
		let sp = "VISITANTE_LIS";
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let tipo_doc = document.getElementById("tipo_doc").value;
		let documento = document.getElementById("documento").value;
		

		data = {
				sp,
				empresa: <?= $empresa->EMPRES_N_ID ?>,
				tipo_doc: tipo_doc ,
				documento: documento
			};
		
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
				if(data.length > 0 ){

					if(data[0].CANTIDAD_BLOQUEOS > 0){
						document.getElementById('bloqueado').innerHTML = 'BLOQUEADO';
					}
					console.log(data);
					document.getElementById('nombre').value = data[0].PERSON_C_NOMBRE;
					document.getElementById('apellido').value = data[0].PERSON_C_APELLIDOS;
					document.getElementById('empresa').value = data[0].EMPRES_C_RAZON_SOCIAL;
				}else{
					M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
				}

				$('.preloader-background').css({'display': 'none'});                            
			});	
    }	
</script>


