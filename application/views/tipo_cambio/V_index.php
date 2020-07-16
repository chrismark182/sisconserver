<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Tipo de Cambio</a>
        </div>
        <ul id="nav-mobile" class="right">
            <div class="input-field col s6 left-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total Registros: 
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2"><?php echo count($cambios);?></span>
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
                <th class="left-align">FECHA</th>
                <th class="left-align">TIPO DE CAMBIO</th>
                <th class="center-align">ELIMINAR</th>
                
            </tr>
        </thead>
        <tbody>
            <?php if($cambios): ?>
                <?php foreach($cambios as $cambio): ?> 
                    <tr>
                        <td class="left-align"><?=$cambio->TIPCAM_C_FECHA?></td>
                        <td class="rigth-align"><?=$cambio->TIPCAM_N_VALOR_VENTA?></td>
                        
                        <td class="center-align">
                            <a class="material-icons" style="cursor: pointer" onclick="confirmarEliminar(<?= $cambio->EMPRES_N_ID ?>,<?= $cambio->TIPCAM_N_ID ?>)">delete</i>
                               </a>
                        </td>
                    </tr>
                <?php endforeach; ?>  
            <?php endif; ?>
        </tbody>
    </table>
</div>

<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:absolute;" 
    href="<?= base_url()?>cambio/nuevo"><i class="material-icons">add</i></a>


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
    function confirmarEliminar($empresa,$cambio)
    {
        console.log('confirmar eliminar')
        $('#modalEliminar').modal('open');
        $('#btnConfirmar').attr('href', 'cambio/'+$empresa+'/'+$cambio+'/eliminar')
    }
</script>

