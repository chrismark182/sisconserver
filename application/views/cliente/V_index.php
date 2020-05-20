<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Clientes</a>
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
        <form action="<?= base_url() ?>clientes" method="post">
            <div class="input-field col s5">
                <input id="numero_documento" maxlength="15" type="text" name="numero_documento"  class="validate">
                <label class="active" for="numero_documento">Nro. Documento</label> 
            </div>
            <div class="input-field col s5">
                <input id="razon_social" maxlength="200" type="text" name="razon_social"  class="validate">
                <label class="active" for="razon_social">Razon_social</label> 
            </div>
            <div class="input-field col s2">
                <div class="btn-small" id="btnBuscar">Buscar</div>
            </div>
        </form>
    </div>    
</div>
<div class="container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="left-align">DOCUMENTO</th>
                <th class="center-align">NUMERO</th>
                <th class="left-align">RAZÓN SOCIAL</th>
                <th class="left-align">DIRECCIÓN</th>
                <th class="center-align">CLIENTE</th>
                <th class="center-align">PROVEEDOR</th>
                <th class="center-align">TRANSPORTISTA</th>
                <th class="center-align">EDITAR</th>
                <th class="center-align">ELIMINAR</th>

            </tr>
        </thead>
        <tbody id="resultados">
            
        </tbody>
    </table>
</div>

<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:absolute;" 
    href="<?= base_url()?>cliente/nuevo"><i class="material-icons">add</i></a>

  <!-- Modal Structure -->
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
        numero = getParameterByName('n')
        if(numero != '')
        {
            $('#numero_documento').val(numero)
            M.updateTextFields();
            buscar()
        }
        var btnBuscar = document.getElementById("btnBuscar"); 
        btnBuscar.addEventListener("click", buscar, false);
    });
    function buscar()
    {
        console.log('Estoy buscando.. ')
        $('.preloader-background').css({'display': 'block'});
        var url = 'api/clientes';
        var data = {numero_documento: document.getElementById("numero_documento").value, 
                    razon_social: document.getElementById("razon_social").value};
        
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
               
                $escliente='';
                $esproveedor='';
                $estransportista='';
               if(data[index].CLIENT_C_ESCLIENTE==1){
                $escliente = '<i class="material-icons">done</i>'
               }

               if(data[index].CLIENT_C_ESPROVEEDOR==1){
                $esproveedor = '<i class="material-icons">done</i>'
               }
               if(data[index].CLIENT_C_ESTRANSPORTISTA==1){
                $estransportista = '<i class="material-icons">done</i>'
               }

                $('#resultados').append(`
                                        
                                            <tr>
                                                <td class="left-align">${data[index].TIPDOC_C_ABREVIATURA}</td>
                                                <td class="center-align">${data[index].CLIENT_C_DOCUMENTO}</td>
                                                <td class="left-align">${data[index].CLIENT_C_RAZON_SOCIAL}</td>
                                                <td class="left-align">${data[index].CLIENT_C_DIRECCION}</td>
                                                <td class="center-align">${$escliente}</td>
                                                <td class="center-align">${$esproveedor}</td>
                                                <td class="center-align">${$estransportista}</td>
                                                <td class="center-align">
                                                    <a  href="<?= base_url() ?>cliente/${data[index].EMPRES_N_ID}/${data[index].CLIENT_N_ID}/editar">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                </td>
                                                <td class="center-align">
                                                    <i class="material-icons " style="cursor: pointer" onclick="confirmarEliminar(${data[index].EMPRES_N_ID},${data[index].CLIENT_N_ID})">delete</i>                        
                                                </td>
                                                </div>
                                            </tr>
                                    `);
            }
            $('.preloader-background').css({'display': 'none'});                            
        });
        
    }
    function confirmarEliminar($empresa,$cliente)
    {
        console.log('confirmar eliminar')
        $('#modalEliminar').modal('open');
        $('#btnConfirmar').attr('href', 'cliente/'+$empresa+'/'+$cliente+'/eliminar')
    }


    function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}


</script>


