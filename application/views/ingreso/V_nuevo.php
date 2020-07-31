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

	<div class="input-field col s6">
		<input placeholder="Placeholder" id="hora" type="text" class="validate">
		<label for="hora">Hora</label>
	</div>	

	<div class="input-field col s6">
		<input placeholder="Placeholder" id="" type="text" class="validate">
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

<script>getDate()</script>


