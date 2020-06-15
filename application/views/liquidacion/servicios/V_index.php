<?php 
    $fechaDesde = new DateTime();
    //$fechaDesde->modify('-1 month');
    $fechaDesde->modify('first day of this month');    
    $fechaHasta = new DateTime();
?>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Liquidaciones de Servicios</a>
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
<div class="section container center">
    <div class="row" style="margin-bottom: 0px">
        <form action="<?= base_url() ?>tarifas" method="post">
            
            <div class="input-field col s12 m6 l4">
                <input id="desde" type="text" value="<?= $fechaDesde->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="desde">Desde</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="hasta" type="text" value="<?= $fechaHasta->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="hasta">Hasta</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <select id="cliente" name="cliente">
                    <option value="0" selected>Todos los Clientes</option>
                    <?php if($clientes): ?>
                        <?php foreach($clientes as $cliente): ?> 
                            <option value="<?= $cliente->CLIENT_N_ID ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Clientes</label>
            </div>

            <div class="input-field col s12 m6 l4">
                <select id="sede" name="sede">
                    <option value="o" selected>Todas las Sedes</option>
                    <?php if($sedes): ?>
                        <?php foreach($sedes as $sede): ?> 
                            <option value="<?= $sede->SEDE_N_ID ?>"><?= $sede->SEDE_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Sedes</label>
            </div>

            <div class="input-field col s12 m6 l4">
                <input id="numero" type="number" min="1" maxlength="9" name="numero" class="validate">
                <label class="active" for="numero">Orden de Compra</label> 
            </div>

            <div class="input-field col s6 m6 l4">
                <select id="servicio" name="servicio">
                    <option value="" disabled selected>Elige una situación</option>
                    <option value="0">Pendiente de O/C</option>
                    <option value="1">Liquidado</option>
                    <option value="2">En Navasoft</option>
                </select>
                <label>Situación</label>
            </div>

            <div class="input-field col l12">
                <div id="btnBuscar">Buscar</div>
            </div>
        </form>
    </div>    
</div>

<div class="container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="center-align">O.S.</th>
                <th class="left-align">SERVICIO</th>
                <th class="left-align">SEDE</th>
                <th class="left-align">CLIENTE</th>
                <th class="left-align">NUM. FISICO</th>
                <th class="center-align">FECHA</th>
                <th class="center-align">COD.PROY</th>
                <th class="center-align">SITUACION</th>
                <th class="center-align">EDITAR</th>
                <th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" 
    href="<?= base_url()?>liq_servicios/nuevo"><i class="material-icons">add</i></a>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var btnBuscar = document.getElementById("btnBuscar"); 
        btnBuscar.addEventListener("click", buscar, false);
    });
    function buscar()
    {
        console.log('Estoy buscando.. ')
        $('.preloader-background').css({'display': 'block'});

        var url = 'acuerdo/buscar';

        var acuerdo_id = 0; 
        if($('#acuerdo_id').val() != '')
        {
            acuerdo_id = $('#acuerdo_id').val();
        }
        var cliente = '%'; 
        if($('#razon_social').val() != '')
        {
            cliente = $('#razon_social').val() + '%';
        }
        var sede = '%'; 
        if($('#sede').val() != '')
        {
            sede = $('#sede').val() + '%';
        }
        $fecha_desde = $('#desde').val();
        $fecha_desde = $fecha_desde.split('/');
        
        $fecha_hasta = $('#hasta').val();
        $fecha_hasta = $fecha_hasta.split('/');

        var data = {
                    empresa: <?= $empresa->EMPRES_N_ID ?>, 
                    acuerdo: acuerdo_id,
                    cliente: cliente,
                    sede: sede,
                    fecha_desde: $fecha_desde[2] + $fecha_desde[1] + $fecha_desde[0],
                    fecha_hasta: $fecha_hasta[2] + $fecha_hasta[1] + $fecha_hasta[0]
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
         
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
               
                $cerrado='<i class="material-icons" style="color: #999">lock_open</i>';

                if(element.ALQUIL_C_ESTA_CERRADO==1){
                    $cerrado = '<i class="material-icons">lock</i>'
                }else if(element.ALQUIL_C_ESTA_CERRADO==0){
                    if(element.CANTIDAD_DETALLES == element.SITUACION_MAYOR_CERO)
                    {
                        $cerrado=`<i class="material-icons" style="cursor: pointer" onclick="confirmarCerrar(${element.EMPRES_N_ID},${element.ALQUIL_N_ID})">lock_open</i>`;
                    }
                }

                $eliminar = `<i class="material-icons" style="cursor: pointer; color: #999999">delete</i>`
                if(element.CANTIDAD_DETALLES == element.SITUACION_CERO)
                {
                    $eliminar = `<i class="material-icons" style="cursor: pointer" onclick="confirmarEliminar(${element.EMPRES_N_ID},${element.ALQUIL_N_ID})">delete</i>`
                }
               
                $('#resultados').append(`   
                    <tr>
                        <td class="center-align"><?=$orden->ORDSER_N_ID?></td>
                        <td class="left-align"><?=$orden->SERVIC_C_DESCRIPCION?></td>
                        <td class="left-align"><?=$orden->SEDE_C_DESCRIPCION?></td>
                        <td class="left-align"><?=$orden->CLIENT_C_RAZON_SOCIAL?></td>
                        <td class="left-align"><?=$orden->ORDSER_C_NUMERO_FISICO?></td>
                        <td class="center-align"><?=$orden->ORDSER_D_FECHA?></td>
                        <td class="center-align"><?=$orden->ORDSER_C_COD_PROYECTO?></td>
                        <td class="center-align"><?=$orden->ORDSER_C_SITUACION_DESCRIPCION?></td>
                        <td class="center-align">
                            <a href="<?= base_url() ?>ordenservicio/<?= $orden->EMPRES_N_ID ?>/<?= $orden->ORDSER_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td class="center-align">
                            <a href="ordenservicio/<?= $orden->EMPRES_N_ID ?>/<?= $orden->ORDSER_N_ID ?>/eliminar")>
                                <i class="material-icons">delete</i>
                            </a>
                        </td>
                    </tr>
                                    `);
            }
            $('.preloader-background').css({'display': 'none'});                            
        });
        
    }
</script>