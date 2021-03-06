<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
       
        <a href="<?= base_url() ?>tarifas" class="breadcrumb">Tarifario</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>tarifa/crear" method="post" id="form">
        <div class="row">
            <div class="input-field col s12 m6 l8">
                <select id="cliente" name="cliente">
                    <option value="0"  selected>Seleccionar Cliente (opcional)</option>
                    <?php if($clientes): ?>
                        <?php foreach($clientes as $cliente): ?> 
                            <option value="<?= $cliente->CLIENT_N_ID ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
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

            <div class="input-field col s6 m6 l5">
                <select id="servicio" name="servicio">
                    <option value="" disabled selected>Seleccionar Servicio</option>
                    <?php if($servicios): ?>
                        <?php foreach($servicios as $servicio): ?> 
                            <option value="<?= $servicio->SERVIC_N_ID ?>"><?= $servicio->SERVIC_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Servicios</label>
            </div>
            <div class="input-field col s6 m6 l3">
                <select id="moneda" name="moneda">
                    <option value="" disabled selected>Seleccionar Moneda</option>
                    <?php if($monedas): ?>
                        <?php foreach($monedas as $moneda): ?> 
                            <option value="<?= $moneda->MONEDA_N_ID ?>"><?= $moneda->MONEDA_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Monedas</label>
            </div>
            <div class="input-field col s6 m6 l4">
                <input id="precio" type="number" step="0.01" min="1" maxlength="6" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="precio" class="validate">
                <label class="active" for="precio">Precio Unitario</label> 
            </div>
            
            <div class="input-field col s12">
                    <div class="btn-small" id="btn_guardar" >Guardar
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {     
        $($('#moneda').children()[1]).attr("selected","selected");
        $('select').formSelect();
        var btn_guardar = document.getElementById("btn_guardar"); 
        btn_guardar.addEventListener("click", validar, false); 
    });

    function validar()
    {
        if(  
            document.getElementById("sede").value != '' &&
            document.getElementById("servicio").value != '' &&
            document.getElementById("precio").value != '' &&
            document.getElementById("moneda").value != '')
        {
            var url =  '<?= base_url() ?>api/tarifavalidar';
            var data = {empresa: <?= $empresa->EMPRES_N_ID ?>, 
                        sede: document.getElementById("sede").value,
                        cliente: document.getElementById("cliente").value,
                        servicio: document.getElementById("servicio").value,
                        moneda: document.getElementById("moneda").value};
            
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
                    M.toast({html: 'Tarifa Duplicada', classes: 'rounded'});
                }
                else{
                    document.getElementById('form').submit();
                }
            });
        }
        else{
            M.toast({html: 'No puede guardar vacio', classes: 'rounded'});   
        }
    }
</script>