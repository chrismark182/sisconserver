<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        
        <a href="<?= base_url() ?>contactos" class="breadcrumb">Persona</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>

<div class="section container center">
    <form action="<?= base_url() ?>contacto/crear" id="form" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <select id="cliente" name="cliente">
                    <option value="" disabled selected>Seleccionar Cliente</option>
                        
                    <?php if($clientes): ?>
                        <?php foreach($clientes as $cliente): ?> 
                            <option value="<?= $cliente->CLIENT_N_ID ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Clientes</label>
            </div>

            <div class="input-field col s12 m6 l4">
                <select id="tdocumento" name="tdocumento">
                    <option value="" disabled selected>Seleccionar Tipo de Documento</option>
                    
                    <?php if($tdocumentos): ?>
                        <?php foreach($tdocumentos as $tdocumento): ?> 
                            <option value="<?= $tdocumento->TIPDOC_N_ID ?>"><?= $tdocumento->TIPDOC_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Tipo de Documento</label>
            </div>

            <div class="input-field col s12 m6 l4">
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">Número de Documento</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="nombres" maxlength="100" type="text" name="nombres" class="validate">
                <label class="active" for="nombres">Nombres</label> 
            </div>
            <div class="input-field col s12 m6 l8">
                <input id="apellidos" maxlength="100" type="text" name="apellidos" class="validate">
                <label class="active" for="apellidos">Apellidos</label> 
            </div>
		
		    
			<form action="#">
				<div class="file-field input-field">
				<div class="btn">
					<span>File</span>
					<input type="file" id="imagen">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
				</div>
			</form>

			<div class="input-field col s12 m6 l4">
                <input id="desde" type="text" value="" class="datepicker">
                <label class="active" for="desde">SCTR Inicio</label> 
            </div>
			
			<div class="input-field col s12 m6 l4">
                <input id="hasta" type="text" value="" class="datepicker">
                <label class="active" for="hasta">SCTR Vencimiento</label> 
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
		
		let cliente = document.getElementById("cliente").value;
		let tdocumento = document.getElementById("tdocumento").value;            
		let	ndocumento = document.getElementById("ndocumento").value;

		console.log(cliente);
		console.log(tdocumento);
		console.log(ndocumento);

        if( 
            document.getElementById('cliente').value.trim() != '' &&
            document.getElementById('tdocumento').value.trim()  != '' &&
            document.getElementById('ndocumento').value.trim() != '' &&
            document.getElementById('nombres').value.trim() != '' &&
            document.getElementById('apellidos').value.trim() != ''
        )
        {
            if( 
                document.getElementById('tdocumento').value.trim() == '2' &&
                document.getElementById('ndocumento').value.trim().length != 8
            )   
            {
                M.toast({html: 'Formato del DNI es inválido', classes: 'rounded'});    
            }
            else
            {
				let url = '<?= base_url() ?>api/execsp';
				sp = 'PERSONA_INS'
                var data = {
							sp,
							empresa: <?= $empresa->EMPRES_N_ID ?>, 
							cliente: document.getElementById("cliente").value,
                            tdocumento: document.getElementById("tdocumento").value,            
							ndocumento: document.getElementById("ndocumento").value,
							nombres: document.getElementById("nombres").value,
							apellidos: document.getElementById("apellidos").value,
							foto: document.getElementById("foto").value,
							persona: <?= $empresa->USUARI_N_ID ?>		
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
                    if(data.length>0){
                        M.toast({html: 'Documento Duplicado', classes: 'rounded'});
                    }
                    else{
                        document.getElementById('form').submit();
                    }
                });
            }
        }
        else
        {
            M.toast({html: 'Debe llenar todos los campos', classes: 'rounded'});
        }
    }
</script>
