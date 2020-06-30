<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Tarifario</a>
        </div>
        <ul id="nav-mobile" class="right">
            <div class="input-field col s6 left-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total Registros: 
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2">0</span>
                    </b>
                </div>
            </div>
        </ul>
    </div>
</nav>

<div class="section container center">
    <div class="row" style="margin-bottom: 0px">
        <form action="<?= base_url() ?>tarifas" method="post" id="form">
            <div class="input-field col s12 m6 l3">
                <select id="sede" name="sede">
                    <option value="0"  selected>Sedes</option>
                    
                    <?php if($sedes): ?>
                    <?php foreach($sedes as $sede): ?> 
                    <tr>
                    <option value="<?= $sede->SEDE_N_ID ?>"><?= $sede->SEDE_C_DESCRIPCION ?></option>
                    <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$tdocumentos</label>
                </select>
                
            </div>
            <div class="input-field col s12 m6 l3">
                    <select id="cliente" name="cliente">
                        <option value="0"  selected>Clientes</option>
                        
                        <?php if($clientes): ?>
                        <?php foreach($clientes as $cliente): ?> 
                        <tr>
                        <option value="<?= $cliente->CLIENT_N_ID ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                        <?php endforeach; ?> 
                        <?php endif; ?>
                        <label>$clientes</label>
                    </select>
            </div>
            <div class="input-field col s6 m6 l3">
                <select id="servicio" name="servicio">
                    <option value="0"  selected>Servicios</option>
                    
                    <?php if($servicios): ?>
                    <?php foreach($servicios as $servicio): ?> 
                    <tr>
                    <option value="<?= $servicio->SERVIC_N_ID ?>"><?= $servicio->SERVIC_C_DESCRIPCION ?></option>
                    <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$servicios</label>
                </select>
            </div>
            <div class="input-field col s3">
                <input id="numero" type="number" min="1" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="numero"  class="validate">
                <label class="active" for="numero">Numero de Tarifa</label> 
            </div>
            <div class="input-field col l12">
                <div class="btn-small" id="btn_buscar">Buscar
                </div>
            </div>
        </form>
    </div>    
</div>

<div class="container">
    <div>
        &nbsp;
    </div>

    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="left-align">SEDE</th>
                <th class="left-align">CLIENTE</th>
                <th class="left-align">SERVICIO</th>
                <th class="center-align">MONEDA</th>
                <th class="right-align">PRECIO UNITARIO</th>
                <th class="center-align">EDITAR</th>
                <th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody id="resultados">
        </tbody>
    </table>
</div>

<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" 
    href="<?= base_url()?>tarifa/nuevo/"><i class="material-icons">add</i></a>

    <div id="modalEliminar" class="modal">
    <div class="modal-content">
      <h4>Eliminar</h4>
      <p>¿Está seguro que desea elimniar el registro?</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
      <a id="btnConfirmar" href="#!" class="modal-close waves-effect waves-green btn">ACEPTAR</a>
    </div>
</div>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        console.log("pagina")

        cliente = getParameterByName('c')
        if(cliente != '')
        {
            $('#cliente').val(cliente)
            M.updateTextFields();
            buscar()
        }
        var btn_buscar = document.getElementById("btn_buscar"); 
        btn_buscar.addEventListener("click", buscar, false); 
    });
    
    function buscar()
    {
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        var numero=0;
        var sede=0;
        var cliente=0;
        var servicio=0;

        if(document.getElementById('numero').value.trim() !='' )
        {
            numero= document.getElementById('numero').value.trim();
        }
        if(document.getElementById('sede').value.trim() !='' )
        {
            sede= document.getElementById('sede').value.trim();
        }
        if(document.getElementById('cliente').value.trim() !='' )
        {
            cliente= document.getElementById('cliente').value.trim();
        }
        if(document.getElementById('servicio').value.trim() !='' )
        {
            servicio= document.getElementById('servicio').value.trim();
        }

        console.log("Buscando")
        $('.preloader-background').css({'display': 'block'});
        var url = 'api/tarifas';
        var data= { empresa, numero, sede, cliente, servicio }
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
                M.toast({html: 'Cargando Tarifas', classes: 'rounded'});
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];
                    $eliminar = `<i class="material-icons" style="cursor: pointer" onclick="confirmarEliminar(${element.EMPRES_N_ID},${element.TARIFA_N_ID})">delete</i>`
                    $('#resultados').append(`   
                            <tr>
                                <td class="left-align">${element.SEDE_C_DESCRIPCION}</td>
                                <td class="left-align">${element.CLIENT_C_RAZON_SOCIAL}</td>
                                <td class="left-align">${element.SERVIC_C_DESCRIPCION}</td>
                                <td class="center-align">${element.MONEDA_C_ABREVIATURA}</td>
                                <td class="right-align">${element.TARIFA_N_PRECIO_UNIT}</td>                       
                                <td class="center-align">
                                    <a href="<?= base_url() ?>tarifa/${element.EMPRES_N_ID}/${element.TARIFA_N_ID}/editar">
                                        <i class="material-icons">edit</i>
                                    </a>
                                </td>
                                <td class="center-align">
                                    ${$eliminar}
                                </td>
                            </tr>
                    `);
                }
            }else{
                M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
            }
            $('.preloader-background').css({'display': 'none'});                            
            $('.tooltipped').tooltip();
            
        });
    }

    function confirmarEliminar($empresa,$tarifa)
    {
        console.log('confirmar eliminar')
        $('#modalEliminar').modal('open');
        $('#btnConfirmar').attr('href', 'tarifa/'+$empresa+'/'+$tarifa+'/eliminar')
    }

    function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}
</script>

