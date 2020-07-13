<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Seguridad</a>
        <a href="<?= base_url() ?>usuarios" class="breadcrumb">Usuarios</a>
        <a href="#!" class="breadcrumb">Cambio Contraseña</a>
      </div>
    </div>
</nav>
<div class="section container center">
	<input type="hidden" id="user_id" value="<?= $user_id ?>">
    <div class="input-field col s12 m6 l4">
        <input id="newPassword" type="password" name="new_password" class="validate"   >
        <label class="active" for="newPassword"> Nueva Contraseña</label> 
    </div>
    <div class="input-field col s12 m6 l4">
        <input id="confirmNewPassword" type="password" name="new_confirm_password" class="validate" >
        <label class="active" for="confirmNewPassword">Confirmar Contraseña</label> 
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
        let newPassword = document.getElementById('newPassword').value; 
        let confirmNewPassword = document.getElementById('confirmNewPassword').value; 
        if(newPassword == confirmNewPassword)
        {
            console.log('contraseña coincide');
            updatePassword(newPassword);
        }else{
            M.toast({html: 'Contraseña nueva no coinciden', classes: 'rounded'});    
        }        
    }
    function updatePassword(newPass)
    {
        let url =  '<?= base_url() ?>api/execsp';
        let sp = 'USUARIO_CHANGE_PASSWORD';
        let usuario = document.getElementById('user_id').value;
        let newPassword = MD5(newPass); 
        let data = {sp, usuario, newPassword}
        console.log(data)
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
                window.location.href='<?= base_url() ?>usuarios';               
            });
    }
</script>