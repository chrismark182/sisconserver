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
					<?php if ($menu->CANTIDAD_HIJOS > 0 ): ?>
						<td class="center-align">
							<i class="material-icons" style="color: #999999" data-tooltip="No puede eliminar, tiene usuarios asignados">delete</i>                        
						</td>
					<?php else: ?>
						<td class="center-align">
                            <i class="material-icons" style="cursor: pointer" onclick="confirmarEliminar(<?= $menu->MENU_ID ?>)">delete</i>                        
                        </td>
                    <?php endif; ?>

						

                    </tr>
                <?php endforeach; ?>  
            <?php endif; ?>
        </tbody>
    </table>
</div>

<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" 
    href="<?= base_url()?>menu/nuevo"><i class="material-icons">add</i></a>

<!-- Modal Structure -->
<div id="modalEliminar" class="modal">
    <div class="modal-content">
        <h4>Eliminar</h4>
        <p>¿Está seguro que desea elimniar el registro?</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
        <a id="btnConfirmar" href="#!" class="modal-close waves-effect waves-green btn">ACEPTAR</a>
    </div>
</div>



<script>
    function confirmarEliminar($id)
    {
        console.log('confirmar eliminar')
        $('#modalEliminar').modal('open');
        $('#btnConfirmar').attr('href', 'menu/'+$id+'/eliminar')
    }
</script>
