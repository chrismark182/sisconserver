<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        
        <a href="#!" class="breadcrumb">Servicios</a>
        
      </div>
    </div>
</nav>
<div class="container">
    <table>
        <thead>
            <tr>          
                
                <th>Servicio</th>
                <th>Descripcion</th>
                
            </tr>
        </thead>
        <tbody>
            <?php if($servicios): ?>
                <?php foreach($servicios as $servicio): ?> 
                    <tr>
                        
                        <td><?=$servicio->SERVIC_N_ID?></td>
                        <td><?=$servicio->SERVIC_C_DESCRIPCION?></td>
                        <td>
                            <a href="<?= base_url() ?>servicio/<?= $servicio->EMPRES_N_ID ?>/<?= $servicio->SERVIC_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td>
                        
                        <a href="servicio/<?= $servicio->EMPRES_N_ID ?>/<?= $servicio->SERVIC_N_ID ?>/eliminar")>
                        
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
    href="<?= base_url()?>servicio/nuevo"><i class="material-icons">add</i></a>
