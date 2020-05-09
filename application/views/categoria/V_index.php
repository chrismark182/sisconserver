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
                            <a href="<?= base_url() ?>categoria/<?= $row->EMPRES_N_ID ?>/<?= $row->CLIENT_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td>
                            <i class="material-icons" style="cursor: pointer" onclick="confirmarEliminar(<?= $row->EMPRES_N_ID ?>/<?= $row->CLIENT_N_ID ?>?>/)">delete</i>                        
                        </td>
            
                    </tr>
                <?php endforeach; ?>  
            <?php endif; ?>
        </tbody>
    </table>
</div>
<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:absolute;" 
    href="<?= base_url()?>categoria/nuevo"><i class="material-icons">add</i></a>
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
        $('#btnConfirmar').attr('href', 'categoria/<?= $row->EMPRES_N_ID ?>/<?= $row->CLIENT_N_ID ?>/eliminar')
    }
</script>