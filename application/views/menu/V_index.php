<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Mantenimientos</a>
        <a href="#!" class="breadcrumb">Menus</a>
      </div>
    </div>
</nav>
<div class="section container">
    <table>
        <thead>
            <tr>     
                <th>Menú Padre</th>
                <th>Decripción</th>
                <th>Ruta</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php if($menus): ?>
                <?php foreach($menus as $menu): ?> 
                    <tr>
                        <td><?=$menu->MENU_PADRE_DESCRIPCION?></td>
                        <td><?=$menu->MENU_DESCRIPCION?></td>
                        <td><a href="<?= base_url() ?><?= $menu->MENU_RUTA ?>"><?= base_url() ?><?= $menu->MENU_RUTA ?></a></td>
                        <td>
                            <a href="<?= base_url() ?>menu/<?= $menu->MENU_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td>
                            <a href="<?= base_url() ?>menu/<?= $menu->MENU_ID ?>/eliminar")>
                                <i class="material-icons">delete</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>  
            <?php endif; ?>
        </tbody>
    </table>
</div>
<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" 
    href="<?= base_url()?>menu/nuevo"><i class="material-icons">add</i></a>
