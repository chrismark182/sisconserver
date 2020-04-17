<div class="section container center">
    <h5>Iniciar Sesión</h5>
    <form action="<?= base_url() ?>login/login" method="post">
        <div class="row">
            <div class="input-field col s12">
                <select name="empresa">
                    <?php if($empresas): ?>
                        <option value="" disabled selected>Escoge una opción</option>
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
            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Iniciar Sesión">
            </div>
        </div>
    </form>
</div>