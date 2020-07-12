<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Seguridad</a>
        <a href="#!" class="breadcrumb">Cambio Contraseña</a>
      </div>
    </div>
</nav>
<div class="section container center">
	
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
        <div class="btn-large" onclick="validar()">Guardar</div>
    </div>		

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("cargo pantalla")
    });
    async function validar()
    {
        let url =  '<?= base_url() ?>api/execsp';
        let sp = 'USUARIO_LIS';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let usuario = <?= $session->USUARI_N_ID ?>;
        let username = '';
        let password = '';
        let data = {empresa, usuario, username, password};

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
                M.toast({html: 'Datos Guardados correctamente', classes: 'rounded'});
            });
    }
</script>