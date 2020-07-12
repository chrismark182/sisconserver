<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Seguridad</a>
            <a href="#!" class="breadcrumb">Opciones del Sistema</a>
        </div>
        <ul id="nav-mobile" class="right">
            <div class="input-field col s6 left-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total Registros: 
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2"><?php echo count($menus);?></span>
                    </b>
                </div>
            </div>
        </ul>
    </div>
</nav>

<div class="section container">
    <div>
        &nbsp;
    </div>

    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>     
                <th class="left-align">MENÚ PRINCIPAL</th>
                <th class="left-align">OPCIÓN DEL MENÚ</th>
                <th class="left-align">RUTA</th>
                <th class="center-align">EDITAR</th>
                <th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody>
            <?php if($menus): ?>
                <?php foreach($menus as $menu): ?> 
                    <tr>
                        <td class="left-align"><?=$menu->MENU_PADRE_DESCRIPCION?></td>
                        <td class="left-align"><?=$menu->MENU_DESCRIPCION?></td>
                        <td class="left-align"><a href="<?= base_url() ?><?= $menu->MENU_RUTA ?>"><?= base_url() ?><?= $menu->MENU_RUTA ?></a></td>
                        <td class="center-align">
                            <a href="<?= base_url() ?>menu/<?= $menu->MENU_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td class="center-align">
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
