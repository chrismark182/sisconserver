<div class="section container">
    <h4>Bienvenido a el sistema SISCON</h4>
    <p>En estos momento procederá a configurar el nombre de la empresa que quiere empezar a gestionar</p>
    
    <div class="section container center">
    <form action="<?= base_url() ?>empresa/crear" method="post">
        <div class="row">
            <div class="input-field col s8">
                <input id="ruc" type="text" name="ruc" class="validate">
                <label class="active" for="ruc">RUC</label> 
            </div>
            <div class="input-field col s8">
                <input id="razon_social" type="text" name="razon_social" class="validate">
                <label class="active" for="razon_social">Razon Social</label> 
            </div>
            <div class="input-field col s12 m6">
        <input class="btn-large" type="submit" value="Guardar">
        </div>
    </form>

</div>
</div>