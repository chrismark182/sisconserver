<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Visitantes</a>
        <a href="<?= base_url() ?>bloqueos" class="breadcrumb">Bloqueo de Personas</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>

<div class="section container center">
    <form action="<?= base_url() ?>bloqueos/nuevo" method="post">
        <div class="row">
            <div class="input-field col s12 m6">
                <select id="tipo_documento" required>
                    <option value="0">Todos</option>
                    <?php foreach ($misdoc as $row): ?>
                        <option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
                    <?php endforeach; ?>
                </select>
                <label for="tipo_documento">Tipo de Documento</label>
            </div>

            <div class="input-field col s12 m6">
                <input id="numero_documento" maxlength="100" type="text" name="numero_documento" class="validate">
                <label class="active" for="numero_documento">Número de Documento</label> 
            </div>
			<div class="input-field col s12">
                <div class="btn-small" onclick="buscar()">Buscar</div>
            </div>
        </div>
    </form>
</div>

<div class="container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="left-align">NRO. DOCUMENTO</th>
                <th class="left-align">APELLIDOS</th>
                <th class="left-align">NOMBFRES</th>
				<th class="left-align">EMPRESA</th>
                <th class="center-align">BLOQUEAR</th>
            </tr>
        </thead>
        <tbody id="resultados">   
        </tbody>
    </table>
</div>

<div id="modalBloqueos" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 class="left">Bloquear persona</h4>
        <div class="section row">
            <input type="hidden" id="persona_id" >
            <div class="input-field col s12">
                <textarea id="motivo" class="materialize-textarea"></textarea>
                <label for="motivo">Motivo de Bloqueo</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" waves-effect waves-green btn-flat" onclick="bloquear()">Aceptar</a>
    </div>
</div>

<script>
    function buscar()
    {
        M.toast({html: 'Buscando resultado...', classes: 'rounded'});
        $('.preloader-background').css({'display': 'block'});
		let url = '<?= base_url() ?>api/execsp';
		console.log(url);
        let sp = 'PERSONA_BLOQUEO_NUEVO_LIS';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let tipo_documento = parseInt(document.getElementById('tipo_documento').value);
        let numero_documento = document.getElementById('numero_documento').value + '%';
        data = {sp, empresa, tipo_documento, numero_documento};
        
        $('#resultados').html('');
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
            $('#total').html(data.length);
            if(data.length > 0)
			{
                M.toast({html: 'Cargando Personas', classes: 'rounded'});
            
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];                
                    $('#resultados').append(`   
                                            <tr>
                                                <td class="left-align">${element.PERSON_C_DOCUMENTO}</td>
                                                <td class="left-align">${element.PERSON_C_APELLIDOS}</td>
                                                <td class="left-align">${element.PERSON_C_NOMBRE}</td>
                                                <td class="left-align">${element.CLIENT_C_RAZON_SOCIAL}</td>
                                                <td class="center-align"><i class="material-icons" style="cursor: pointer;" onclick="modalBloquear(${element.PERSON_N_ID})">lock</i></td>
                                            </tr>
                                        `);
                }
            }
			else{
                M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
            }
            $('.preloader-background').css({'display': 'none'});      
        });
    }

    function modalBloquear($id)
    {
        document.getElementById('persona_id').value = $id;
        $('#modalBloqueos').modal('open');
    }

    function bloquear()
    {

		let url = '<?= base_url() ?>api/execsp';
		let sp = 'PERSONA_BLOQUEO_INS';				
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let motivo = document.getElementById('motivo').value;
		let persona = parseInt(document.getElementById('persona_id').value);
		let usuario = <?= $session->USUARI_N_ID ?>;
		data = {sp, empresa, persona, motivo, usuario};

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
			M.toast({html: 'Persona bloqueada correctamente!', classes: 'rounded'});
            $('.preloader-background').css({'display': 'none'});                            
			setTimeout(() => {
			    window.location.href= "<?= base_url() ?>bloqueos?n=" + data[0].PERSON_C_DOCUMENTO;                
            }, 1000);
		}).catch(error => console.log(error));
    }

    function mostrarHoraActual()
    {
        console.log(horaActual());
        //document.getElementById('numero_documento').value = horaActual();
        setTimeout(() => {
            mostrarHoraActual();
        }, 1000);
    }
    mostrarHoraActual();
</script>
