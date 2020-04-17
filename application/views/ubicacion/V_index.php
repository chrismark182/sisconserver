<div class="container">
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
                            <a href="<?= base_url() ?>ubicacion/<?= $ubicacion->UBICAC_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td>
                        <a href="ubicacion/<?= $ubicacion->UBICAC_N_ID ?>/eliminar")>
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
