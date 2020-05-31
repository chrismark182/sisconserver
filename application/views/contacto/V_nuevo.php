<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        
        <a href="<?= base_url() ?>contactos" class="breadcrumb">Contactos</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>contacto/crear" id="form" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                    <select id="cliente" name="cliente">
                        <option value="" disabled selected>Cliente</option>
                        
                        <?php if($clientes): ?>
                        <?php foreach($clientes as $cliente): ?> 
                        <option value="<?= $cliente->CLIENT_N_ID ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                        <?php endforeach; ?> 
                        <?php endif; ?>
                    </select>
                        <label>clientes</label>
            </div>

            <div class="input-field col s12 m6 l4">
                    <select id="t_documento" name="t_documento">
                        <option value="" disabled selected>Tipo de documento</option>
                        
                        <?php if($tdocumentos): ?>
                        <?php foreach($tdocumentos as $tdocumento): ?> 
                        <option value="<?= $tdocumento->TIPDOC_N_ID ?>"><?= $tdocumento->TIPDOC_C_ABREVIATURA ?></option>
                        <?php endforeach; ?> 
                        <?php endif; ?>
                    </select>
                        <label>Tipo de Documento</label>
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">Numero de Documento</label> 
            </div>
            <div class="input-field col s12 m6 l12">
                <input id="nombres" maxlength="100" type="text" name="nombres" class="validate">
                <label class="active" for="nombres">Nombres</label> 
            </div>
            <div class="input-field col s12">
                <div class="btn-small" id="btn_guardar">
                    Guardar
                </div>
            </div>
        </div>
    </form>
</div>
    
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("cargo pantalla")
        var btn_guardar = document.getElementById("btn_guardar"); 
        btn_guardar.addEventListener("click", validar, false); 
        
    });
    function validar()
    {
        console.log("Validar");
        if( 
            document.getElementById('cliente').value.trim() != '' &&
            document.getElementById('t_documento').value.trim()  != '' &&
            document.getElementById('ndocumento').value.trim() != '' &&
            document.getElementById('nombres').value.trim() != ''
        )
        {
            var url =  '<?= base_url() ?>contacto/crear';
            var data = {empresa: <?= $empresa->EMPRES_N_ID ?>, 
            cliente: document.getElementById("cliente").value,            
            t_documento: document.getElementById("t_documento").value,
            ndocumento: document.getElementById("ndocumento").value,
            nombres: document.getElementById("nombres").value,
            usuario: <?= $session->USUARI_N_ID ?>
                    };

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
                console.log(data)
                M.toast({html: 'Datos Guardados correctamente', classes: 'rounded'});
                setTimeout(() => {
                    window.location.href='<?= base_url() ?>contactos';
                }, 2000);
             });

        }
        else
        {
            M.toast({html: 'Debe llenar todos los campos', classes: 'rounded'});
        }

    }
</script>