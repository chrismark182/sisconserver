<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Acuerdos de Alquiler</a>
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
<!-- Buscador -->
<!-- <div class="section container center">
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
</div> -->

<div class="section container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="right-align">ID</th>
                <th class="left-align">SEDE</th>
                <th class="left-align">UBICACIÓN</th>
                <th class="left-align">CLIENTE</th>
                <th class="center-align">F. INICIO</th>
                <th class="center-align">F. TERMINO</th>
                <th class="center-align">CERRADO</th>
                <th class="center-align">PERIODOS</th>
                <th class="center-align">EDITAR</th>
                <th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody id="resultados">            
        </tbody>
    </table>
</div>

<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" 
    href="<?= base_url()?>acuerdo/nuevo"><i class="material-icons">add</i></a>

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
 <!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Periodos</h4>
        <table class="striped" style="font-size: 12px;">
            <thead class="blue-grey darken-1" style="color: white">
                <tr>          
                    <th class="right-align">ID</th>
                    <th class="left-align">SEDE</th>
                    <th class="left-align">UBICACIÓN</th>
                    <th class="left-align">CLIENTE</th>
                    <th class="center-align">F. INICIO</th>
                    <th class="center-align">F. TERMINO</th>
                    <th class="center-align">CERRADO</th>
                    <th class="center-align">PERIODOS</th>
                    <th class="center-align">EDITAR</th>
                    <th class="center-align">ELIMINAR</th>
                </tr>
            </thead>
            <tbody id="resultados">            
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        buscar();
    });
    function buscar()
    {
        console.log('Estoy buscando.. ')
        $('.preloader-background').css({'display': 'block'});
        var url = 'api/acuerdos';
        var data = {empresa: <?= $empresa->EMPRES_N_ID ?>};
        
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
               
                $cerrado='<i class="material-icons" style="color: #999">lock_open</i>';

                if(element.ALQUIL_C_ESTA_CERRADO==1){
                    $cerrado = '<i class="material-icons">lock</i>'
                }else if(element.ALQUIL_C_ESTA_CERRADO==0){
                    if(element.CANTIDAD_DETALLES == element.SITUACION_MAYOR_CERO)
                    {
                        $cerrado='<i class="material-icons">lock_open</i>';
                    }
                }

                $eliminar = `<i class="material-icons" style="cursor: pointer; color: #999999">delete</i>`
                if(element.CANTIDAD_DETALLES == element.SITUACION_CERO)
                {
                    $eliminar = `<i class="material-icons" style="cursor: pointer" onclick="confirmarEliminar(${element.EMPRES_N_ID},${element.ALQUIL_N_ID})">delete</i>`
                }
               
                $('#resultados').append(`   <tr>
                                                <td class="left-align">${element.ALQUIL_N_ID}</td>
                                                <td class="left-align">${element.SEDE_C_DESCRIPCION}</td>
                                                <td class="left-align">${element.UBICAC_C_DESCRIPCION}</td>
                                                <td class="left-align">${element.CLIENT_C_RAZON_SOCIAL}</td>
                                                <td class="center-align">${element.ALQUIL_C_FECHA_INICIO}</td>
                                                <td class="center-align">${element.ALQUIL_C_FECHA_FINAL}</td>
                                                <td class="center-align">${$cerrado}</td>
                                                <td class="center-align">
                                                    <a href="#">
                                                        <i class="material-icons">assignment</i>
                                                    </a>
                                                </td>
                                                <td class="center-align">
                                                    <a href="#">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                </td>
                                                <td class="center-align">
                                                    ${$eliminar}                
                                                </td>
                                                </div>
                                            </tr>
                                    `);
            }
            $('.preloader-background').css({'display': 'none'});                            
        });
        
    }
    function confirmarEliminar($empresa,$acuerdo)
    {
        console.log('confirmar eliminar')
        $('#modalEliminar').modal('open');
        $('#btnConfirmar').attr('href', 'acuerdo/'+$empresa+'/'+$acuerdo+'/eliminar')
    }


    function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}


</script>


