<?php $fecha = new DateTime(); ?>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="<?= base_url() ?>cambios" class="breadcrumb">Tipo de Cambio</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>cambio/crear" method="post" id="form">
        <div class="row">
            <div class="input-field col s12 m6">
                <input id="fecha" type="text" name="fecha" class="datepicker right-align validate" value="<?= $fecha->format('m/d/Y') ?>">
                <label class="active" for="fecha">Fecha</label> 
            </div>
            <div class="input-field col s12 m6">
                <input id="monto" maxlength="15" type="number" name="monto" class="right-align validate">
                <label class="active" for="monto">Monto</label> 
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
        var options = {
            format: 'dd/mm/yyyy',
            autoClose: true, 
            setDefaultDate: true
        }
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, options);

        M.textareaAutoResize($('#observaciones'));

    });

    document.addEventListener('DOMContentLoaded', function() {
        
        var btn_guardar = document.getElementById("btn_guardar"); 
        btn_guardar.addEventListener("click", validar, false); 
    });
    function validar()
    {

        if( 
            document.getElementById('fecha').value.trim() != '' &&
            document.getElementById('monto').value.trim()  != '' 
            )
            {
            var url =  '<?= base_url() ?>api/validartipocambio';
            var data = { empresa: <?= $empresa->EMPRES_N_ID ?>, 
            fecha: document.getElementById("fecha").value
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
            console.log(data)
            if(data.length>0){
                M.toast({html: 'Documento Duplicada', classes: 'rounded'});
            }
            else{
                document.getElementById('form').submit();
            }

        });

        }
        else
        {
            M.toast({html: 'Debe llenar todos los campos', classes: 'rounded'});
        }


        
        
        
        
    }
</script>
        
