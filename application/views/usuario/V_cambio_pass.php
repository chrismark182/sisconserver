<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Seguridad</a>
        <a href="#!" class="breadcrumb">Cambio Contraseña</a>
      </div>
    </div>
</nav>
<div class="section container center">
	<form  action="<?= base_url() ?>usuario/cambio_pass" method="post" id="form-pass" >
		
					<div class="input-field col s12 m6 l4">
										<input id="password" type="password" name="password" class="validate" id="txtcontraactual_editar" >
										<label class="active" for="password"> Contraseña Actual</label> 
					</div>

					<div class="input-field col s12 m6 l4">
										<input type="password" name="new_password" class="validate"id="new_password"  >
										<label class="active" for="new_password"> Nueva Contraseña</label> 
					</div>

					<div class="input-field col s12 m6 l4">
										<input id="new_confirm_password" type="password" name="new_confirm_password" class="validate" >
										<label class="active" for="new_confirm_password">Confirmar Contraseña</label> 
					</div>

					<div class="input-field col s12">
                		<input class="btn-large" type="submit" value="Guardar">
            		</div>
		
		</form>
</div>
