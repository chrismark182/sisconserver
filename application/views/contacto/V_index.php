<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Contactos</a>
        </div>
        <ul id="nav-mobile" class="right">
            <div class="input-field col s6 left-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total Registros: 
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2"><?php echo count($contactos);?></span>
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
                <th class="center-align">DOCUMENTO</th>
                <th class="center-align">NUMERO</th>
                <th class="left-align">NOMBRE DEL CONTACTO</th>
                <th class="left-align">RAZÓN SOCIAL</th>
                <th class="center-align">EDITAR</th>
                <th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody>
            <?php if($contactos): ?>
                <?php foreach($contactos as $contacto): ?> 
                    <tr>
                        <td class="center-align"><?=$contacto->TIPDOC_C_ABREVIATURA?></td>
                        <td class="center-align"><?=$contacto->CLICON_C_DOCUMENTO ?></td>
                        <td class="left-align"><?=$contacto->CLICON_C_NOMBRE?></td>
                        <td class="left-align"><?=$contacto->CLIENT_C_RAZON_SOCIAL?></td>
                        <td class="center-align">
                            <a href="<?= base_url() ?>contacto/<?= $contacto->EMPRES_N_ID ?>/<?= $contacto->CLIENT_N_ID ?>/<?= $contacto->CLICON_N_ID ?>/editar">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                        <td class="center-align">                        
                        <i class="material-icons" style="cursor: pointer" onclick="confirmarEliminar(<?= $contacto->EMPRES_N_ID ?>,<?= $contacto->CLIENT_N_ID ?>,<?= $contacto->CLICON_N_ID ?>)">delete</i>                        
                      
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>  
            <?php endif; ?>
        </tbody>
    </table>
</div>

<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:absolute;" 
    href="<?= base_url()?>contacto/nuevo"><i class="material-icons">add</i></a>
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
    function confirmarEliminar($empresa, $cliente,$contacto)
    {
        console.log('confirmar eliminar')
        $('#modalEliminar').modal('open');
        $('#btnConfirmar').attr('href', 'contacto/'+$empresa+'/'+$cliente+'/'+$contacto+'/eliminar')
    }
</script>