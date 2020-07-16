<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Seguridad</a>
        <a href="<?= base_url() ?>menus" class="breadcrumb">Opciones del Sistema</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>menu/crear" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <select name="mpadre">
                    <option value="0"  selected>Seré Padre</option>
                    <?php foreach ($menus_padre as $mpadre): ?>
                        <option value="<?= $mpadre->MENU_ID ?>"><?= $mpadre->MENU_DESCRIPCION ?></option>
                    <?php endforeach; ?>

                </select>
                <label>Menú Padre</label>
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="descripcion" maxlength="50" type="text" name="descripcion" class="validate" required>
                <label class="active" for="descripcion">Opción del menú</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="ruta" maxlength="50" type="text" name="ruta" class="validate" required>
                <label class="active" for="ruta">Ruta</label> 
            </div>
            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar" >
            </div>
        </div>
    </form>
</div>
<script>

	function validar(){

		var ruta = document.getElementById("ruta").value;
		var descripcion = document.getElementById("descripcion").value;

		if( ruta == ''  && descripcion == ''){
			alert("No as ingresado ningun dato");
		}
		else{
			console.log('perfecto');
		}

	}

</script>
