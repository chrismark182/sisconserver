<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Seguridad</a>
        <a href="#!" class="breadcrumb">Categorias</a>
      </div>
    </div>
</nav>
<div class="container">
    <table>
        <thead>
            <tr>          
                <th>ID</th>
                <th>Descripcion</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if($results): ?>
                <?php foreach($results as $row): ?> 
                    <tr>
                        <td><?=$row->CATEGO_N_ID?></td>
                        <td><?=$row->CATEGO_C_DESCRIPCION?></td>
                        <td>
                            <a href="<?= base_url() ?>categoria/<?= $row->CATEGO_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td>
                        <a href="categoria/<?= $row->CATEGO_N_ID ?>/eliminar")>
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
    href="<?= base_url()?>categoria/nuevo"><i class="material-icons">add</i></a>
