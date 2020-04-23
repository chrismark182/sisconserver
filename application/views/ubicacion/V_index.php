<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        
        <a href="#!" class="breadcrumb">Ubicaciones</a>
      </div>
    </div>
</nav>
<div class="container">
            <div class="input-field col s10 right-align" style="margin: 0px">
                <div>Total Registros: 
                <span id="total" class="btn"><?php echo count($ubicaciones);?></span></div>
            </div>
    <table>
        <thead>
            <tr>          
                
                <th>Sede</th>
                <th>Ubicacion</th>
                <th>Tipo de Almacen</th>
                <th>Descripcion</th>
                <th>Tamaño M2</th>
                
            </tr>
        </thead>
        <tbody>
            <?php if($ubicaciones): ?>
                <?php foreach($ubicaciones as $ubicacion): ?> 
                    <tr>
                        
                        <td><?=$ubicacion->SEDE_C_DESCRIPCION?></td>
                        <td><?=$ubicacion->UBICAC_N_ID?></td>
                        <td><?=$ubicacion->TIPALM_C_DESCRIPCION?></td>
                        <td><?=$ubicacion->UBICAC_C_DESCRIPCION?></td>
                        <td><?=$ubicacion->UBICAC_N_M2?></td>
                        <td>
                            <a href="<?= base_url() ?>ubicacion/<?= $ubicacion->EMPRES_N_ID ?>/<?= $ubicacion->SEDE_N_ID ?>/<?= $ubicacion->UBICAC_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td>
                        
                        <a href="ubicacion/<?= $ubicacion->EMPRES_N_ID ?>/<?= $ubicacion->SEDE_N_ID ?>/<?= $ubicacion->UBICAC_N_ID ?>/eliminar")>
                        
                        <i class="material-icons">delete</i>
                        </a>
                        </td>
            
                    </tr>
                <?php endforeach; ?>  
            <?php endif; ?>
        </tbody>
    </table>
</div>
<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:absolute;" 
    href="<?= base_url()?>ubicacion/nuevo"><i class="material-icons">add</i></a>
