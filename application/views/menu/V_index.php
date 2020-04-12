<div class="container">
    <table>
        <thead>
            <tr>          
                <th>Decripción</th>
                <th>Ruta</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php if($menus): ?>
                <?php foreach($menus as $menu): ?> 
                    <tr>
                        <td><?=$menu->MENU_DESCRIPCION?></td>
                        <td><a href="<?= base_url() ?><?= $menu->MENU_RUTA ?>"><?= base_url() ?><?= $menu->MENU_RUTA ?></a></td>
                        <td>
                            <a href="<?= base_url() ?>menu/<?= $menu->MENU_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>  
            <?php endif; ?>
        </tbody>
    </table>
</div>
<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:absolute;" 
    href="<?= base_url()?>menu/nuevo"><i class="material-icons">add</i></a>
