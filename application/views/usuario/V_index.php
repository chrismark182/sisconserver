<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Seguridad</a>
            <a href="#!" class="breadcrumb">Usuarios</a>
        </div>
        <ul id="nav-mobile" class="right">
            <div class="input-field col s6 left-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total Registros: 
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2"><?php echo count($results);?></span>
                    </b>
                </div>
            </div>
        </ul>
    </div>
</nav>

<div class="container">
    <div>
        &nbsp;
    </div>

    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
				<th class="center-align">ID</th>
				<th class="left-align">USUARIO</th>
                <th class="left-align">CATEGIORÍA</th>
                <th class="center-align">EDITAR</th>
				<th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody>
            <?php if($results): ?>
                <?php foreach($results as $row): ?> 
                    <tr>
                        <td class="center-align"><?=$row->USUARI_N_ID?></td>
						<td class="left-align"><?=$row->USUARI_C_USERNAME?></td>
                        <td class="left-align"><?=$row->CATEGO_C_DESCRIPCION?></td>
                        <td class="center-align">
                            <a href="<?= base_url() ?>usuario/<?= $row->USUARI_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
						<td class="center-align">
                            <a class="material-icons " style="cursor: pointer" onclick="confirmarEliminar(<?=$row->USUARI_N_ID ?>)">delete</i>
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
        $('#btnConfirmar').attr('href', 'usuario/'+$id+'/eliminar')
    }
</script>

