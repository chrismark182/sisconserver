<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Bloqueo</a>
        <a href="<?= base_url() ?>categorias" class="breadcrumb">Bloqueo</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>categoria/crear" method="post">
        <div class="row">
			<select id="documento" name="documento" required>
                    	<option value="" disabled selected>Seleccionar Cliente</option>
                    <?php foreach ($tdocumentos as $row): ?>
                        <option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
                    <?php endforeach; ?>
            </select>
            <div class="input-field col s12">
                <input id="descripcion" maxlength="100" type="text" name="descripcion" class="validate">
                <label class="active" for="descripcion">Descripción de la Categoría</label> 
            </div>
            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        

