<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Seguridad</a>
        <a href="<?= base_url() ?>menus" class="breadcrumb">Opciones del Sistema</a>
        <a href="#!" class="breadcrumb">Editar</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>menu/<?= $menu->MENU_ID ?>/actualizar" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <select name="mpadre">
                    <option value="0" >Seré Padre</option>
                    <?php foreach ($menus_padre as $mpadre): ?>
                        <option value="<?= $mpadre->MENU_ID ?>" 
                            <?php if($mpadre->MENU_ID == $menu->MENU_PADRE_ID): echo 'selected'; endif; ?>><?= $mpadre->MENU_DESCRIPCION ?></option>
                    <?php endforeach; ?>

                </select>
                <label>Menú padre</label>
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="descripcion" type="text" name="descripcion" value="<?= $menu->MENU_DESCRIPCION ?>" class="validate">
                <label class="active" for="descripcion">Descripción</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="ruta" type="text" name="ruta" value="<?= $menu->MENU_RUTA ?>" class="validate">
                <label class="active" for="ruta">Ruta</label> 
            </div>
            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
