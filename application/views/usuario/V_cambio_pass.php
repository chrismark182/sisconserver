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
        <input id="currentPassword" type="password" name="password" class="validate">
        <label class="active" for="currentPassword"> Contraseña Actual</label> 
    </div>
    <div class="input-field col s12 m6 l4">
        <input id="newPassword" type="password" name="new_password" class="validate"   >
        <label class="active" for="newPassword"> Nueva Contraseña</label> 
    </div>
    <div class="input-field col s12 m6 l4">
        <input id="confirmNewPassword" type="password" name="new_confirm_password" class="validate" >
        <label class="active" for="confirmNewPassword">Confirmar Contraseña</label> 
    </div>
    <div class="input-field col s12">
        <div class="btn-small" onclick="validar()">Guardar</div>
    </div>		

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("cargo pantalla")
    });
    
    async function validar()
    {
        let currentPassword = MD5(document.getElementById('currentPassword').value);
        let newPassword = document.getElementById('newPassword').value; 
        let confirmNewPassword = document.getElementById('confirmNewPassword').value; 
        let url =  '<?= base_url() ?>api/execsp';
        let sp = 'USUARIO_LIS';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let usuario = <?= $session->USUARI_N_ID ?>;
        let username = '';
        let password = '';
        let data = {sp, empresa, usuario, username, password};

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

                if(data[0].USUARI_C_PASSWORD == currentPassword)
                {
                    console.log('Contraseña actual correcta');
                    if(newPassword == confirmNewPassword)
                    {
                        console.log('contraseña coincide');
                        updatePassword(newPassword);
                    }else{
                        M.toast({html: 'Contraseña nueva no coinciden', classes: 'rounded'});    
                    }
                }
                else{
                    console.log('Contraseña actual incorrecta');
                    M.toast({html: 'Contraseña actual incorrecta', classes: 'rounded'});
                }
            });
    }
    function updatePassword(newPass)
    {
        let url =  '<?= base_url() ?>api/execsp';
        let sp = 'USUARIO_CHANGE_PASSWORD';
        let usuario = <?= $session->USUARI_N_ID ?>;
        let newPassword = MD5(newPass); 
        let data = {sp, usuario, newPassword}

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
                M.toast({html: 'Contraseña actualizada correctamente', classes: 'rounded'});     
                window.location.href='<?= base_url() ?>';               
            });
    }
</script>