<?php 
    $fechaDesde = new DateTime();
    $fechaDesde->modify('first day of this month');    
    $fechaHasta = new DateTime();
?>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Tipo de Cambio</a>
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
<div class="section container center" style="padding-top: 0px">
    <div class="row" style="margin-bottom: 0px">
        <form action="<?= base_url() ?>cambio" method="post" id="form">
            
            <div class="input-field col s12 m6 l6">
                <input id="desde" type="text" value="<?= $fechaDesde->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="desde">Desde</label> 
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="hasta" type="text" value="<?= $fechaHasta->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="hasta">Hasta</label> 
                    <div class="input-field col l1">
                        <div class="btn-small" id="btnBuscar">Buscar</div>
                    </div>
            </div>
        </form>
    </div>    
</div>

<div class="container">
    <div class="section container">
        <div>
            &nbsp;
        </div>

    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="center-align">FECHA</th>
                <th class="center-align">TIPO DE CAMBIO</th>
                <th class="center-align">ELIMINAR</th>
                
            </tr>
        </thead>
        <tbody id="resultados">
        </tbody>
    </table>
</div>

<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:absolute;" 
    href="<?= base_url()?>cambio/nuevo"><i class="material-icons">add</i></a>


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
        var btnBuscar = document.getElementById("btnBuscar"); 
        btnBuscar.addEventListener("click", buscar, false);
    });

    function buscar()
        {
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        $fecha_desde = $('#desde').val();
        $fecha_desde = $fecha_desde.split('/');
        
        $fecha_hasta = $('#hasta').val();
        $fecha_hasta = $fecha_hasta.split('/');

        console.log("Buscando")
        M.toast({html: 'Buscando resultado...', classes: 'rounded'});
        $('.preloader-background').css({'display': 'block'});
        var url = 'api/listar_tipo_cambio';
        var data = {
            empresa: <?= $empresa->EMPRES_N_ID ?>,
            desde: $fecha_desde[2] + $fecha_desde[1] + $fecha_desde[0],
            hasta: $fecha_hasta[2] + $fecha_hasta[1] + $fecha_hasta[0],
        };

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
                M.toast({html: 'Cargando Tipo de Cambio', classes: 'rounded'});
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];
                    
                    $eliminar = `<i class="material-icons" style="cursor: pointer" onclick="confirmarEliminar(${element.EMPRES_N_ID},${element.TIPCAM_N_ID})">delete</i>`
                    
                    $('#resultados').append(`   
                        <tr>
                        <td class="center-align">${element.TIPCAM_C_FECHA}</td>
                        <td class="center-align">${element.TIPCAM_N_VALOR_VENTA}</td>
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
    function confirmarEliminar($empresa,$cambio)
        {
            console.log('confirmar eliminar')
            $('#modalEliminar').modal('open');
            $('#btnConfirmar').attr('href', 'cambio/'+$empresa+'/'+$cambio+'/eliminar')
        }

</script>

