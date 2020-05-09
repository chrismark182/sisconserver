<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        
        <a href="<?= base_url()?>servicios" class="breadcrumb">Servicios</a>
        <a href="#!" class="breadcrumb">Editar</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>servicio/<?= $servicio->EMPRES_N_ID ?>/<?= $servicio->SERVIC_N_ID ?>/actualizar" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <input id="descripcion" maxlength="100" type="text" name="descripcion" value="<?= $servicio->SERVIC_C_DESCRIPCION ?>" class="validate">
                <label class="active" for="descripcion">Descripción</label> 
            </div>
            <div class="input-field col s12 m6 l4 left-align">       
            <?php   $checked='';
                    
                    if($servicio->SERVIC_C_REQUIERE_OS=='1'):
                        $checked='checked';
                         
                     endif; ?>
                <p>
                    <label>
                    <input  <?= $checked ?> id="requiereos" name="requiereos" class="validate" type="checkbox"/>
                        <span>Requiere OS</span>
                        
                    </label>
                </p>
               <?php  
                $checked='';
                    
                    if($servicio->SERVIC_C_AFECTO_IGV=='1'):
                        $checked='checked';
                         
                     endif; ?>
                <p>
                    <label>
                        <input <?= $checked ?> id="afectoigv" name="afectoigv" type="checkbox"/>
                        <span>Afecto IGV</span>
                    </label>
                </p>
               
               
            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
