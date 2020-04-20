<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Seguridad</a>
        <a href="<?= base_url() ?>categorias" class="breadcrumb">Categorias</a>
        <a href="#!" class="breadcrumb">Editar</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>categoria/<?= $categoria->CATEGO_N_ID ?>/actualizar" method="post">
        <div class="row">
            <div class="input-field col s12">
                <input id="descripcion" type="text" name="descripcion" value="<?= $categoria->CATEGO_C_DESCRIPCION ?>" class="validate">
                <label class="active" for="descripcion">Descripcion</label> 
            </div>
            <div class="input-field col s12">
                <input class="btn-large" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
