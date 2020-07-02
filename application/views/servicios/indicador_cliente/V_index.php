<?php 
    $fechaDesde = new DateTime();
    //$fechaDesde->modify('-1 month');
    $fechaDesde->modify('first day of this month');    
    $fechaHasta = new DateTime();
?>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Indicador por Cliente</a>
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
<div class="row">
    <div class="col s4">
        <div class="section row">
            <div class="input-field col s12 m6">
                <input id="desde" type="text" value="<?= $fechaDesde->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="desde">Desde</label> 
            </div>
            <div class="input-field col s12 m6">
                <input id="hasta" type="text" value="<?= $fechaHasta->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="hasta">Hasta</label> 
            </div>
            <div class="section">
                <h5>Sedes</h5>
                <div id="sedes"></div>
            </div>
            <div class="section">
                <h5>Clientes</h5>
                <div id="clientes"></div>
            </div>
            <div class="input-field col s12">
                <div class="btn-small" id="btnBuscar">Buscar</div>
            </div>
        </div>        
    </div>
    <div class="col s8 blue-grey lighten-5"></div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // var btnBuscar = document.getElementById("btnBuscar"); 
        // btnBuscar.addEventListener("click", buscar, false);
        sedes()
        clientes()
    });
    function sedes()
    {
        $('.preloader-background').css({'display': 'block'});         

        let url = 'api/execsp';
        let sp = 'SEDE_LIS';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let sede = 0;
        let data = {sp, empresa, sede};

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
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                
                $('#sedes').append(`
                    <div class="input-field col s12">
                        <div class="switch">
                            <label>
                                <input type="checkbox" checked>
                                <span class="lever"></span>
                                    ${element.SEDE_C_DESCRIPCION}
                            </label>
                        </div>
                    </div>
                    `)
            }
            $('.preloader-background').css({'display': 'none'});                
        });
    }
    function clientes()
    {
        $('.preloader-background').css({'display': 'block'});         

        let url = 'api/execsp';
        let sp = 'CLIENTE_ESCLIENTE_LIS ';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let escliente = '1';
        let data = {sp, empresa, escliente};

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
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                
                $('#clientes').append(`
                    <div class="input-field col s12">
                        <div class="switch">
                            <label>
                                <input type="checkbox" checked>
                                <span class="lever"></span>
                                    ${element.CLIENT_C_RAZON_SOCIAL}
                            </label>
                        </div>
                    </div>
                    `)
            }
            $('.preloader-background').css({'display': 'none'});                
        });
    }
</script>