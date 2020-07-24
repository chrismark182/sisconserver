<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Visitantes</a>
        <a href="<?= base_url() ?>bloqueos" class="breadcrumb">Bloqueo de Visitante</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>bloqueos/nuevo" method="post">
        <div class="row">
            <div class="input-field col s12 m6">
                <select id="tipo_documento" required>
                    <option value="" disabled selected>Escoge una opción</option>
                    <?php foreach ($misdoc as $row): ?>
                        <option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
                    <?php endforeach; ?>
                </select>
                <label for="tipo_documento">Tipo de documentos</label>
            </div>

            <div class="input-field col s12 m6">
                <input id="numero_documento" maxlength="100" type="text" name="numero_documento" class="validate">
                <label class="active" for="numero_documento">Numero de documento</label> 
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
                <th class="left-align">Nro. Documento</th>
                <th class="left-align">Apellidos</th>
                <th class="left-align">Nombres</th>
                <th class="center-align">Bloquear</th>
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
        <a href="#!" class=" waves-effect waves-green btn-flat">Aceptar</a>
    </div>
</div>
<script>
    function buscar()
    {
        $('.preloader-background').css({'display': 'block'});
        let url = '<?= base_url() ?>api/execsp';
        let sp = 'PERSONA_LIS';
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
         
            for (let index = 0; index < data.length; index++) {
                const element = data[index];                
                $('#resultados').append(`   
                                        <tr>
                                            <td class="left-align">${element.PERSON_C_DOCUMENTO}</td>
                                            <td class="left-align">${element.PERSON_C_APELLIDOS}</td>
                                            <td class="left-align">${element.PERSON_C_NOMBRE}</td>
                                            <td class="center-align"><i class="material-icons" style="cursor: pointer;" onclick="modalBloquear(${element.PERSON_N_ID})">lock</i></td>
                                        </tr>
                                    `);
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
        
    }
</script>
