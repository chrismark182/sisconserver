<div class="section container center">
    <h5>Crear usuario administrador</h5>
    <form action="<?= base_url() ?>login/create" method="post">
        <div class="row">
            <div class="input-field col s12">
                <input id="username" type="text" name="username" class="validate">
                <label class="active" for="username">Usuario</label>
            </div>
            <div class="input-field col s12">
                <input id="password" type="password" name="password" class="validate">
                <label class="active" for="password">Contraseña</label>
            </div>
            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Crear usuario">
            </div>
        </div>
    </form>
</div>