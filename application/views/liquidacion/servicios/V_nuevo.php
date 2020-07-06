<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
       
        <a href="<?= base_url() ?>liq_servicios" class="breadcrumb">Liquidación de Servicios</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>

<!-- Buscardor -->
<div class="section container center" style="padding-bottom: 0px">
    <div class="row" style="margin-bottom: 0px">
        <form action="<?= base_url() ?>tarifa/crear" method="post" id="form">
            <div class="row" style="margin-bottom: 0px">
                <div class="input-field col s12 m6 l8">
                    <select id="cliente" name="cliente">
                        <option value="" disabled selected>Seleccionar Cliente</option>
                        <?php if($clientes): ?>
                            <?php foreach($clientes as $cliente): ?> 
                                <option value="<?= $cliente->CLIENT_N_ID ?>-<?= $cliente->CLIENT_C_REQUIERE_OC ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                            <?php endforeach; ?> 
                        <?php endif; ?>
                    </select>
                    <label>Clientes</label>
                </div>
                <div class="input-field col s6 m6 l4">
                    <select id="sede" name="sede">
                        <option value="" disabled selected>Seleccionar Sede</option>
                        <?php if($sedes): ?>
                            <?php foreach($sedes as $sede): ?> 
                                <option value="<?= $sede->SEDE_N_ID ?>"><?= $sede->SEDE_C_DESCRIPCION ?></option>
                            <?php endforeach; ?> 
                        <?php endif; ?>
                    </select>
                    <label>Sedes</label>
                </div>

                <div class="input-field col s12">
                    <div class="btn-small" id="btnBuscar" >Buscar</div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Resultados -->
<div class="container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="center-align"></th>
                <th class="center-align">ORDEN SERV.</th>
                <th class="left-align">SERVICIO</th>
                <th class="left-align">NUM. FISICO</th>
                <th class="center-align">FECHA</th>
                <th class="left-align">SOLICITANTE</th>
                <th class="center-align">PROYECTO</th>
                <th class="center-align">HORAS</th>
                <th class="center-align">MON</th>
                <th class="right-align">PRECIO X HORA</th>
            </tr>
        </thead>
        <tbody id="resultados">
        </tbody>
    </table>
    <div class="input-field col s12">
        <div class="btn-small" style="display: none" id="btnLiquidar" >Liquidar</div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btnBuscar = document.getElementById("btnBuscar"); 
        btnBuscar.addEventListener("click",  buscar, false); 
        var btnLiquidar = document.getElementById("btnLiquidar"); 
        btnLiquidar.addEventListener("click",  liquidar, false); 
    });

    function buscar()
    {
        $('#resultados').html('');
        var cliente = document.getElementById("cliente").value;
        var sede = document.getElementById("sede").value;

            if(cliente != '' && sede != '')
            {
                $('.preloader-background').css({'display': 'block'});
                cliente = cliente.split('-');

                var url =  '<?= base_url() ?>liq_servicios/nuevo/buscar';
                var data = {empresa: <?= $empresa->EMPRES_N_ID ?>, 
                            sede: sede,
                            cliente: cliente[0],
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
                    console.log(data.length)
                    if(data.length>0){
                        M.toast({html: 'Datos encontrados', classes: 'rounded'});
                        $('#total').html(data.length);
                    
                        for (let index = 0; index < data.length; index++) {
                            const element = data[index];
                            $('#resultados').append(`
                                                    <tr>
                                                        <td class="center-align">
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="check" value="${element.ORDSER_N_ID}"/>
                                                                    <span></span>
                                                                </label>
                                                            </p>
                                                        </td>
                                                        <td class="center-align">${element.ORDSER_N_ID}</td>
                                                        <td class="left-align">${element.SERVIC_C_DESCRIPCION}</td>
                                                        <td class="left-align">${element.ORDSER_C_NUMERO_FISICO}</td>
                                                        <td class="center-align">${element.ORDSER_C_FECHA}</td>
                                                        <td class="left-align">${element.ORDSER_C_SOLICITANTE}</td>
                                                        <td class="left-align">${element.ORDSER_C_COD_PROYECTO}</td>
                                                        <td class="center-align">${element.ORDSER_N_HORAS}</td>
                                                        <td class="center-align">${element.MONEDA_C_SIMBOLO}</td>
                                                        <td class="right-align">${element.ORDSER_N_PRECIO_UNIT}</td>
                                                    </tr>
                                                `);
                        }
                        document.getElementById("btnLiquidar").style.display = "inline-block";
                    }
                    else{
                        document.getElementById("btnLiquidar").style.display = "none";
                        M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
                    }
                    $('.preloader-background').css({'display': 'none'});    

                });
            }else{
                M.toast({html: 'Debe elegir un cliente y una sede', classes: 'rounded'});
            }
    }

    function liquidar()
    {

        var cliente = document.getElementById("cliente").value;
            cliente = cliente.split('-');
        
        var situacion = 1;
        if(cliente[1] == 1){ situacion = 0 }

        var checados = $('.check:checked')
        console.log('Checados:' + checados.length);
        if(checados.length > 0)
        {
            $('.preloader-background').css({'display': 'block'});
            var url =  '<?= base_url() ?>liq_servicios/nuevo/grabar_cabecera';
            var data = {
                        empresa: <?= $empresa->EMPRES_N_ID ?>, 
                        cliente: cliente[0],
                        sede: document.getElementById("sede").value,
                        situacion: situacion, 
                        usuario: <?= $this->data['session']->USUARI_N_ID ?>
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
                if(data.length>0){
                    insertarDetalles(data[0].LIQCAB_N_ID, checados)    
                }
                else{
                    M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
                }   

            });
        }else{
            M.toast({html: 'Debe elegir al menos una orden de servicio', classes: 'rounded'});
        }
    }

    async function insertarDetalles(liquidacion, checados)
    {
        $('.preloader-background').css({'display': 'block'});
        
        var situacion = 1;
        
        var url =  '<?= base_url() ?>liq_servicios/nuevo/grabar_detalle';
        for (let index = 0; index < checados.length; index++) {
            console.log('ejecutando vuelta ' + (index+1))
            const element = checados[index];

            var data = {
                        empresa: <?= $empresa->EMPRES_N_ID ?>, 
                        liquidacion: liquidacion,
                        orden: element.value,
                        usuario: <?= $this->data['session']->USUARI_N_ID ?>
                        };
                    
            await fetch(url, {
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
                console.log('terminó de ejecutar');

            }).catch(function(error) {
                console.log('Hubo un problema con la petición Fetch:' + error.message);
            });
        }
        M.toast({html: 'Liquidación generada correctamente', classes: 'rounded'});
        $('.preloader-background').css({'display': 'none'});    
        window.location.href = "<?= base_url() ?>liq_servicios?li=" + liquidacion;
    }
</script>


        
