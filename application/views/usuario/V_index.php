<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Seguridad</a>
        <a href="#!" class="breadcrumb">Usuarios</a>
      </div>
    </div>
</nav>
<div class="section container">
    <table>
        <thead>
            <tr>          
				<th>ID</th>
				<th>Usuario</th>
                <th>Descripción</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php if($results): ?>
                <?php foreach($results as $row): ?> 
                    <tr>
                        <td><?=$row->USUARI_N_ID?></td>
						<td><?=$row->USUARI_C_USERNAME?></td>
                        <td><?=$row->CATEGO_C_DESCRIPCION?></td>
                        <td>
                            <a href="<?= base_url() ?>usuario/<?= $row->USUARI_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>  
            <?php endif; ?>
        </tbody>
    </table>
</div>
<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" 
    href="<?= base_url()?>usuario/nuevo"><i class="material-icons">add</i></a>
