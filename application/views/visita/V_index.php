<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        
        <a href="#!" class="breadcrumb">Visitas</a>
      </div>
    </div>
</nav>
<div class="container">
<div class="input-field col s10 right-align" style="margin: 0px">
            <div>Total Registros: 
            <span id="total" class="btn"><?php echo count($visitas);?></span></div>
            </div>
    <table>
        <thead>
            <tr>       
                <th>Id</th> 
                <th>Descripcion</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if($visitas): ?>
                <?php foreach($visitas as $visita): ?> 
                    <tr>
                        
                        <td><?=$visita->MOTVIS_N_ID?></td>
                        <td><?=$visita->MOTVIS_C_DESCRIPCION?></td>
                        <td>
                            <a href="<?= base_url() ?>visita/<?= $visita->EMPRES_N_ID ?>/<?= $visita->MOTVIS_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td>
                        
                        <a href="visita/<?= $visita->EMPRES_N_ID ?>/<?= $visita->MOTVIS_N_ID ?>/eliminar")>
                        
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
    href="<?= base_url()?>visita/nuevo"><i class="material-icons">add</i></a>
