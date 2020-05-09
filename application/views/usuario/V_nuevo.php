<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Seguridad</a>
        <a href="<?= base_url() ?>usuarios" class="breadcrumb">Usuarios</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>usuario/crear" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <select name="empresa">
                    <option value="0" disabled>Escoge una opción</option>
                    <?php foreach ($empresas as $empresa): ?>
                        <option value="<?= $empresa->EMPRES_N_ID ?>"><?= $empresa->EMPRES_C_RAZON_SOCIAL ?></option>
                    <?php endforeach; ?>

                </select>
                <label>Categoria</label>
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="username" type="text" name="username" class="validate">
                <label class="active" for="username">Nombre de usuario</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <select name="categoria">
                    <option value="0" disabled>Escoge una opción</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria->CATEGO_N_ID ?>"><?= $categoria->CATEGO_C_DESCRIPCION ?></option>
                    <?php endforeach; ?>

                </select>
                <label>Categoria</label>
            </div>
            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
