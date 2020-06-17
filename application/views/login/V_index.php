<div class="section container center">
    <h5>Iniciar Sesión</h5>
    <form id="form" action="<?= base_url() ?>login/login" method="post">
        <div class="row">
            <div class="input-field col s12">
                <select id="empresa" name="empresa">
                    <?php if($empresas): ?>
                        <option value="" disabled>Escoge una opción</option>
                        <?php foreach($empresas as $empresa): ?> 
                            <option value="<?= $empresa->EMPRES_N_ID ?>"><?= $empresa->EMPRES_C_RAZON_SOCIAL ?></option>
                        <?php endforeach; ?>  
                    <?php endif; ?>
                </select>
                <label>Empresa</label>
            </div>
            <div class="input-field col s12">
                <input id="username" type="text" name="username" class="validate">
                <label class="active" for="username">Usuario</label>
            </div>
            <div class="input-field col s12">
                <input id="password" type="password" name="password" class="validate">
                <label class="active" for="password">Contraseña</label>
            </div>
        </div>
        <div class="row">
            <div class="btn-large col s12" onclick="validar()">Iniciar Sesión</div>
        </div>        
    </form>
</div>
<script>
    elegirEmpresa();
    function elegirEmpresa()
    {
        $countEmpresas = <?= count($empresas) ?>;
        if($countEmpresas == 1)
        {
            console.log('activar la unica empresa')
            $($('#empresa').children()[1]).attr("selected","selected");
        }else{
            $($('#empresa').children()[0]).attr("selected","selected");
        }
        $('select').formSelect();
        console.log('cantidad de empresas:' + $countEmpresas)   
    }
    function validar()
    {
        console.log('validar')
        $empresa = $('#empresa').val();
        $username = $('#username').val();
        $password = $('#password').val();
        if($empresa != '' && $username != '' && $password != '')
        {
            document.getElementById('form').submit();
        }
        else
        {
            M.toast({html: 'Debe llenar todos los campos', classes: 'rounded'});
        }
    }
</script>   