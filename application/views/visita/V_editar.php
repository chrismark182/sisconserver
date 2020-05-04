<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        
        <a href="<?= base_url()?>visitas" class="breadcrumb">Motivo de Visita</a>
        <a href="#!" class="breadcrumb">Editar</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>visita/<?= $visita->EMPRES_N_ID ?>/<?= $visita->MOTVIS_N_ID ?>/actualizar" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l12">
                <input id="descripcion" maxlength="100" type="text" name="descripcion" value="<?= $visita->MOTVIS_C_DESCRIPCION ?>" class="validate">
                <label class="active" for="descripcion">Descripción</label> 
            </div>

            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
